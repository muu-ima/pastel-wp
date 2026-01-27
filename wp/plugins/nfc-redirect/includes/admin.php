<?php
if (!defined('ABSPATH')) exit;


// ===== Next create 呼び出し（WP→Next）=====
if (!defined('NFC_PROFILE_API_BASE')) {
    define('NFC_PROFILE_API_BASE', 'https://nfc-profile-two.vercel.app');
}
if (!defined('NFC_SYNC_TOKEN')) {
    define('NFC_SYNC_TOKEN', 'nF8kP3xZ7mQa2Lw9sT6rV4yH1cJ5uB8');
}

function nfc_log($msg)
{
    $logfile = WP_CONTENT_DIR . '/nfc-sync.log';
    @file_put_contents($logfile, '[' . date('c') . '] ' . $msg . PHP_EOL, FILE_APPEND);
}

function nfc_call_next_create($code)
{
    $res = wp_remote_post(NFC_PROFILE_API_BASE . '/api/profile/create', [
        'timeout' => 15,
        'headers' => [
            'Content-Type' => 'application/json',
            'x-sync-token' => NFC_SYNC_TOKEN,
        ],
        'body' => wp_json_encode(['code' => $code]),
    ]);

    if (is_wp_error($res)) {
        return ['ok' => false, 'error' => $res->get_error_message()];
    }

    $status = wp_remote_retrieve_response_code($res);
    $body = wp_remote_retrieve_body($res);
    $json = json_decode($body, true);

    if ($status !== 200 || !is_array($json) || empty($json['edit_url']) || empty($json['public_url'])) {
        return ['ok' => false, 'error' => "bad response status={$status} body={$body}"];
    }

    return ['ok' => true, 'edit_url' => $json['edit_url'], 'public_url' => $json['public_url']];
}


/**
 * CPT登録
 */
function nfc_redirect_register_cpt()
{
    register_post_type('nfc_redirect', [
        'labels' => [
            'name' => 'NFC Redirect',
            'singular_name' => 'NFC Redirect',
            'add_new' => '新規追加',
            'add_new_item' => 'NFC Redirectを追加',
            'edit_item' => '編集',
            'new_item' => '新規',
            'view_item' => '表示',
            'search_items' => '検索',
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 25,
        'menu_icon' => 'dashicons-randomize',
        'supports' => ['title'],
    ]);
}

/**
 * メタボックス
 */
function nfc_redirect_add_meta_boxes()
{
    add_meta_box(
        'nfc_redirect_meta',
        'リダイレクト設定',
        'nfc_redirect_render_meta_box',
        'nfc_redirect',
        'normal',
        'high'
    );
}

function nfc_redirect_render_meta_box($post)
{
    wp_nonce_field('nfc_redirect_save', 'nfc_redirect_nonce');

    $status = get_post_meta($post->ID, '_nfc_status', true) ?: 'active';

    // 自動生成用 nonce
    $ajax_nonce = wp_create_nonce('nfc_redirect_generate_code');
?>

    <p>
        <label><strong>Status</strong></label><br>
        <select name="nfc_status">
            <option value="active" <?php selected($status, 'active'); ?>>active</option>
            <option value="disabled" <?php selected($status, 'disabled'); ?>>disabled</option>
        </select>
    </p>

    <p style="color:#666;">※ タイトルが code になります（例：TEST123）</p>

    <hr style="margin:16px 0;">

    <p>
        <strong>Code（タイトル）</strong><br>
        <button type="button" class="button" id="nfc-generate-code">自動生成</button>
        <span style="color:#666;font-size:12px;">生成したコードをタイトル欄に入れます</span>
    </p>

    <script>
        (function() {
            const btn = document.getElementById('nfc-generate-code');
            if (!btn) return;

            btn.addEventListener('click', async () => {
                btn.disabled = true;

                try {
                    const fd = new FormData();
                    fd.append('action', 'nfc_redirect_generate_code');
                    fd.append('nonce', '<?php echo esc_js($ajax_nonce); ?>');

                    const res = await fetch(ajaxurl, {
                        method: 'POST',
                        body: fd
                    });
                    const json = await res.json();

                    if (!json || !json.success) {
                        alert((json && json.data && json.data.message) ? json.data.message : '生成に失敗しました');
                        btn.disabled = false;
                        return;
                    }

                    const title = document.getElementById('title');
                    if (title) {
                        title.value = json.data.code;
                        title.dispatchEvent(new Event('input', {
                            bubbles: true
                        }));
                    } else {
                        alert('タイトル欄が見つかりません');
                        btn.disabled = false;
                    }
                } catch (e) {
                    alert('通信エラー');
                    btn.disabled = false;
                }
            });
        })();
    </script>

    <?php
    // ✅ ここに入れる（メタボックス内）
    $edit = get_post_meta($post->ID, '_nfc_edit_url', true);
    $pub  = get_post_meta($post->ID, '_nfc_public_url', true);
    ?>

    <hr style="margin:16px 0;">

    <p>
        <strong>Next Edit URL</strong><br>
        <?php if ($edit): ?>
            <code style="font-size:12px;"><?php echo esc_html($edit); ?></code>
            <button type="button" class="button button-small nfc-copy" data-copy="<?php echo esc_attr($edit); ?>">コピー</button>
        <?php else: ?>
            <span style="color:#666;">未発行</span>
        <?php endif; ?>
    </p>

    <p>
        <strong>Next Public URL</strong><br>
        <?php if ($pub): ?>
            <code style="font-size:12px;"><?php echo esc_html($pub); ?></code>
            <button type="button" class="button button-small nfc-copy" data-copy="<?php echo esc_attr($pub); ?>">コピー</button>
        <?php else: ?>
            <span style="color:#666;">未発行</span>
        <?php endif; ?>
    </p>

    <p>
        <button type="button" class="button" id="nfc-clear-urls">URLを再発行（今のURLを削除）</button>
        <span style="color:#666;font-size:12px;">※押したあと「更新」でNext createを再実行します</span>
    </p>

    <script>
        (function() {
            const btn = document.getElementById('nfc-clear-urls');
            if (!btn) return;

            btn.addEventListener('click', () => {
                if (!confirm('保存済みのNext URLを削除します。よろしいですか？')) return;

                // ✅ WP編集フォームを確実に取得
                const form = document.querySelector('form#post') || document.querySelector('form[name="post"]');
                if (!form) {
                    alert('フォームが見つかりません（管理画面の構造が想定と違う可能性）');
                    return;
                }

                // ✅ 既にあるなら増やさない
                let input = form.querySelector('input[name="nfc_clear_urls"]');
                if (!input) {
                    input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'nfc_clear_urls';
                    form.appendChild(input);
                }
                input.value = '1';

                alert('URL削除フラグをセットしました。次に「更新」を押してください。');
            });
        })();
    </script>
<?php
}

/**
 * 保存
 */
function nfc_redirect_save_meta($post_id)
{
    if (!isset($_POST['nfc_redirect_nonce']) || !wp_verify_nonce($_POST['nfc_redirect_nonce'], 'nfc_redirect_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // code（タイトル）→ code_slug
    $code = get_the_title($post_id);
    $code = is_string($code) ? trim($code) : '';
    $code_slug = $code ? sanitize_title($code) : '';

    $status = isset($_POST['nfc_status']) ? sanitize_text_field($_POST['nfc_status']) : 'active';
    update_post_meta($post_id, '_nfc_status', $status);

    // スラッグを code と同期（検索を安定させる）
    $post = get_post($post_id);
    if ($post && $code_slug && $post->post_name !== $code_slug) {
        remove_action('save_post_nfc_redirect', 'nfc_redirect_save_meta');
        wp_update_post([
            'ID'        => $post_id,
            'post_name' => $code_slug,
        ]);
        add_action('save_post_nfc_redirect', 'nfc_redirect_save_meta');
    }

    // code が無ければ何もしない
    if ($code_slug === '') return;

    // publish のときだけ（下書き保存で叩かない）
    if (get_post_status($post_id) !== 'publish') {
        nfc_log("skip create: not publish post_id={$post_id}");
        return;
    }

    // ✅ 再発行フラグがあれば既存URLを削除（= skip create を回避）
    $force_reissue = !empty($_POST['nfc_clear_urls']);
    if ($force_reissue) {
        delete_post_meta($post_id, '_nfc_edit_url');
        delete_post_meta($post_id, '_nfc_public_url');
        delete_post_meta($post_id, '_nfc_created_at');

        // ✅ デバッグしやすいログ
        nfc_log("cleared urls (force reissue) post_id={$post_id} code={$code_slug}");
    }
    // すでにURLがあるなら二重発行しない
    $edit = get_post_meta($post_id, '_nfc_edit_url', true);
    $pub  = get_post_meta($post_id, '_nfc_public_url', true);
    if ($edit && $pub) {
        nfc_log("skip create: already has urls post_id={$post_id} code={$code_slug}");
        return;
    }

    nfc_log("calling next create post_id={$post_id} code={$code_slug}");

    $ret = nfc_call_next_create($code_slug);
       if (!$ret['ok']) {
        nfc_log("create failed post_id={$post_id} code={$code_slug} err=" . $ret['error']);
        return;
    }
    // ✅ 返却URLの先頭だけログ（tokenが長いので全部はログに出さない）
    if (!empty($ret['edit_url'])) {
        $short = substr($ret['edit_url'], 0, 80);
        nfc_log("next edit_url(head) post_id={$post_id} code={$code_slug} url={$short}...");
    }
    if (!empty($ret['public_url'])) {
        nfc_log("next public_url post_id={$post_id} code={$code_slug} url=" . $ret['public_url']);
    }
 
    update_post_meta($post_id, '_nfc_edit_url', esc_url_raw($ret['edit_url']));
    update_post_meta($post_id, '_nfc_public_url', esc_url_raw($ret['public_url']));
    update_post_meta($post_id, '_nfc_created_at', current_time('mysql'));

    nfc_log("created urls post_id={$post_id} code={$code_slug}");
}

add_action('wp_ajax_nfc_redirect_generate_code', 'nfc_redirect_generate_code_ajax');

function nfc_redirect_generate_code_ajax()
{
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'nfc_redirect_generate_code')) {
        wp_send_json_error(['message' => 'nonce error'], 403);
    }

    $code = nfc_redirect_generate_unique_code(10);
    wp_send_json_success(['code' => $code]);
}

function nfc_redirect_generate_unique_code($length = 10)
{
    $chars = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';
    for ($i = 0; $i < 50; $i++) {
        $code = '';
        for ($j = 0; $j < $length; $j++) {
            $code .= $chars[random_int(0, strlen($chars) - 1)];
        }

        if (!get_page_by_title($code, OBJECT, 'nfc_redirect')) {
            return $code;
        }
    }
    return wp_generate_password($length, false, false);
}

add_filter('manage_edit-nfc_redirect_columns', function ($cols) {
    // 既存 cols: cb / title / date などを残しつつ、titleの次に追加する
    $new = [];

    foreach ($cols as $key => $label) {
        $new[$key] = $label;

        if ($key === 'title') {
            $new['nfc_url'] = 'NFC URL';
            $new['nfc_profile_url'] = 'Profile URL';
        }
    }

    return $new;
});

add_action('manage_nfc_redirect_posts_custom_column', function ($col, $post_id) {
    if ($col !== 'nfc_url' && $col !== 'nfc_profile_url') return;

    $code = get_the_title($post_id);
    $code = is_string($code) ? trim($code) : '';
    $code_slug = $code ? sanitize_title($code) : '';

    if ($code_slug === '') {
        echo '-';
        return;
    }

    // nfc_url は /n/{code}、profile_url は /p/{code}
    $path = ($col === 'nfc_url') ? '/n/' : '/p/';
    $url  = home_url($path . $code_slug);

    echo '<code style="font-size:12px;">' . esc_html($url) . '</code> ';
    echo '<button type="button" class="button button-small nfc-copy" data-copy="' . esc_attr($url) . '">コピー</button>';
}, 10, 2);

// ===============================
// NFC Profiles 一覧：URL列 + コピー
// ===============================

// カラム追加
add_filter('manage_edit-nfc_profile_columns', function ($cols) {
    $cols['nfc_profile_url'] = 'Profile URL';
    return $cols;
});

// カラム表示
add_action('manage_nfc_profile_posts_custom_column', function ($col, $post_id) {
    if ($col !== 'nfc_profile_url') return;

    $code = get_post_meta($post_id, '_nfc_code', true);
    $code = is_string($code) ? trim($code) : '';
    $code_slug = $code ? sanitize_title($code) : '';

    if ($code_slug === '') {
        echo '-';
        return;
    }

    $url = home_url('/p/' . $code_slug);

    echo '<code style="font-size:12px;">' . esc_html($url) . '</code> ';
    echo '<button type="button" class="button button-small nfc-copy" data-copy="' . esc_attr($url) . '">コピー</button>';
}, 10, 2);

// 一覧画面だけで動くコピーボタンJS（nfc_redirect / nfc_profile 両対応）
// 管理画面：コピーJS（一覧 edit.php / 編集 post.php 両対応）
add_action('admin_footer', function () {
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen) return;

    // ✅ 対象の投稿タイプだけ
    if (!in_array($screen->post_type, ['nfc_redirect', 'nfc_profile'], true)) return;

    // ✅ 一覧(edit) と 編集(post) だけ（他の管理画面で動かさない）
    if (!in_array($screen->base, ['edit', 'post'], true)) return;
?>
    <script>
        document.addEventListener('click', async (e) => {
            const btn = e.target.closest('.nfc-copy');
            if (!btn) return;

            const text = btn.getAttribute('data-copy') || '';
            if (!text) return;

            const flash = (label) => {
                const old = btn.textContent;
                btn.textContent = label;
                setTimeout(() => btn.textContent = old, 900);
            };

            try {
                await navigator.clipboard.writeText(text);
                flash('コピー済み');
            } catch (err) {
                // フォールバック（古いブラウザ）
                const ta = document.createElement('textarea');
                ta.value = text;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                ta.remove();
                flash('コピー済み');
            }
        });
    </script>
<?php
});
