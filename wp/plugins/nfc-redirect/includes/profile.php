<?php
if (!defined('ABSPATH')) exit;

/**
 * Profile CPT: nfc_profile
 * URL: /p/{code}
 */

/** -------------------------
 *  CPT
 * ------------------------*/
function nfc_profile_register_cpt()
{
    register_post_type('nfc_profile', [
        'label' => 'NFC Profiles',
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-id',
        'supports' => ['title'],
    ]);
}

/** -------------------------
 *  Meta boxes
 * ------------------------*/
function nfc_profile_add_meta_boxes()
{
    add_meta_box(
        'nfc_profile_meta',
        'Profile Fields',
        'nfc_profile_render_meta_box',
        'nfc_profile',
        'normal',
        'default'
    );
}

function nfc_profile_render_meta_box($post)
{
    wp_nonce_field('nfc_profile_save_meta', 'nfc_profile_nonce');

    $code  = get_post_meta($post->ID, '_nfc_code', true);
    $name  = get_post_meta($post->ID, '_profile_name', true);
    $bio   = get_post_meta($post->ID, '_profile_bio', true);
    $sns   = get_post_meta($post->ID, '_profile_sns', true); // JSONでも文字列でもOK
    $icon_id = (int) get_post_meta($post->ID, '_profile_icon_id', true);

    echo '<p><label><strong>Code</strong></label><br />';
    echo '<input type="text" name="nfc_code" value="' . esc_attr($code) . '" style="width:100%;" />';
    echo '<small>URL は /p/{code} になります</small></p>';

    echo '<p><label><strong>Display Name</strong></label><br />';
    echo '<input type="text" name="profile_name" value="' . esc_attr($name) . '" style="width:100%;" /></p>';

    echo '<p><label><strong>Bio</strong></label><br />';
    echo '<textarea name="profile_bio" rows="5" style="width:100%;">' . esc_textarea($bio) . '</textarea></p>';

    echo '<p><label><strong>SNS (free text for now)</strong></label><br />';
    echo '<input type="text" name="profile_sns" value="' . esc_attr($sns) . '" style="width:100%;" />';
    echo '<small>例: twitter=https://x.com/..., instagram=https://...</small></p>';

    $icon_url = $icon_id ? wp_get_attachment_image_url($icon_id, 'thumbnail') : '';

    echo '<p><label><strong>Icon</strong></label><br />';

    echo '<input type="hidden" id="profile_icon_id" name="profile_icon_id" value="' . esc_attr($icon_id) . '" />';

    echo '<div id="profile_icon_preview" style="margin:8px 0;">';
    if ($icon_url) {
        echo '<img src="' . esc_url($icon_url) . '" style="width:72px;height:72px;border-radius:999px;object-fit:cover;border:1px solid #e5e7eb;" />';
    } else {
        echo '<div style="width:72px;height:72px;border-radius:999px;background:#eee;border:1px solid #e5e7eb;"></div>';
    }
    echo '</div>';

    echo '<button type="button" class="button" id="profile_icon_pick">Select Image</button> ';
    echo '<button type="button" class="button" id="profile_icon_clear">Clear</button>';

    echo '</p>';

    // Media uploader
    wp_enqueue_media();
?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pick = document.getElementById('profile_icon_pick');
            const clear = document.getElementById('profile_icon_clear');
            const input = document.getElementById('profile_icon_id');
            const preview = document.getElementById('profile_icon_preview');
            if (!pick || !clear || !input || !preview) return;

            let frame;

            pick.addEventListener('click', function(e) {
                e.preventDefault();
                if (frame) return frame.open();

                frame = wp.media({
                    title: 'Select Icon',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                });

                frame.on('select', function() {
                    const a = frame.state().get('selection').first().toJSON();
                    input.value = a.id;
                    const url = (a.sizes && a.sizes.thumbnail) ? a.sizes.thumbnail.url : a.url;
                    preview.innerHTML =
                        '<img src="' + url + '" style="width:72px;height:72px;border-radius:999px;object-fit:cover;border:1px solid #e5e7eb;" />';
                });

                frame.open();
            });

            clear.addEventListener('click', function(e) {
                e.preventDefault();
                input.value = '';
                preview.innerHTML =
                    '<div style="width:72px;height:72px;border-radius:999px;background:#eee;border:1px solid #e5e7eb;"></div>';
            });
        });
    </script>
<?php

}

function nfc_profile_save_meta($post_id)
{
    if (!isset($_POST['nfc_profile_nonce']) || !wp_verify_nonce($_POST['nfc_profile_nonce'], 'nfc_profile_save_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $code = isset($_POST['nfc_code']) ? sanitize_text_field($_POST['nfc_code']) : '';
    $name = isset($_POST['profile_name']) ? sanitize_text_field($_POST['profile_name']) : '';
    $bio  = isset($_POST['profile_bio']) ? sanitize_textarea_field($_POST['profile_bio']) : '';
    $sns  = isset($_POST['profile_sns']) ? sanitize_text_field($_POST['profile_sns']) : '';
    $icon_id = isset($_POST['profile_icon_id']) ? (int) $_POST['profile_icon_id'] : 0;


    update_post_meta($post_id, '_nfc_code', $code);
    update_post_meta($post_id, '_profile_name', $name);
    update_post_meta($post_id, '_profile_bio', $bio);
    update_post_meta($post_id, '_profile_sns', $sns);
    update_post_meta($post_id, '_profile_icon_id', $icon_id);
}

/** -------------------------
 *  Rewrite: /p/{code}
 * ------------------------*/
function nfc_profile_register_query_vars($vars)
{
    $vars[] = 'pcode';
    return $vars;
}

function nfc_profile_add_rewrite_rules()
{
    // /p/ABC123 -> index.php?pcode=ABC123
    add_rewrite_rule('^p/([^/]+)/?$', 'index.php?pcode=$matches[1]', 'top');
}

/** -------------------------
 *  Handler
 * ------------------------*/
function nfc_profile_handle_request()
{
    $code = get_query_var('pcode');
    if (!$code) return;

    $code = sanitize_text_field($code);

    // code で nfc_profile を検索
    $q = new WP_Query([
        'post_type'      => 'nfc_profile',
        'post_status'    => 'any',
        'posts_per_page' => 1,
        'meta_query'     => [
            [
                'key'   => '_nfc_code',
                'value' => $code,
            ],
        ],
    ]);

    if (!$q->have_posts()) {
        status_header(404);
        header('Content-Type: text/plain; charset=utf-8');
        echo "Profile not found";
        exit;
    }

    $post = $q->posts[0];

    // テンプレは “プラグイン同梱を強制”
    $template = NFC_REDIRECT_DIR . 'templates/profile.php';
    if (!file_exists($template)) {
        status_header(500);
        header('Content-Type: text/plain; charset=utf-8');
        echo "Profile template missing";
        exit;
    }

    // テンプレへ値を渡す（シンプルに変数で）
    $profile_name = get_post_meta($post->ID, '_profile_name', true);
    $profile_bio  = get_post_meta($post->ID, '_profile_bio', true);
    $profile_sns  = get_post_meta($post->ID, '_profile_sns', true);
    $icon_id = (int) get_post_meta($post->ID, '_profile_icon_id', true);
    $profile_icon = $icon_id ? wp_get_attachment_image_url($icon_id, 'full') : '';

    include $template;
    exit;
}

