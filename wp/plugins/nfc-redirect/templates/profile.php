<?php
if (!defined('ABSPATH')) exit;
?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title><?php echo esc_html(($profile_name ?: 'Profile') . ' | NFC Profile'); ?></title>

    <meta property="og:title" content="<?php echo esc_attr(($profile_name ?: 'Profile') . ' | NFC Profile'); ?>">
    <meta property="og:type" content="profile">
    <?php
    $req_uri = isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '/';
    $og_url  = home_url($req_uri);
    ?>
    <meta property="og:url" content="<?php echo esc_url($og_url); ?>">


    <?php if (!empty($profile_bio)): ?>
        <meta property="og:description" content="<?php echo esc_attr(mb_strimwidth($profile_bio, 0, 120, '…', 'UTF-8')); ?>">
    <?php endif; ?>

    <?php if (!empty($profile_icon)): ?>
        <meta property="og:image" content="<?php echo esc_url($profile_icon); ?>">
        <meta property="og:image:width" content="512">
        <meta property="og:image:height" content="512">
    <?php endif; ?>

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            background: #f6f7fb;
            color: #111;
        }

        .wrap {
            max-width: 720px;
            margin: 0 auto;
            padding: 24px;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 20px;
        }

        .row {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .icon {
            width: 72px;
            height: 72px;
            border-radius: 999px;
            background: #eee;
            object-fit: cover;
        }

        .name {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .bio {
            white-space: pre-wrap;
            line-height: 1.7;
            color: #333;
            margin-top: 12px;
        }

        .sns {
            margin-top: 16px;
            font-size: 14px;
            color: #555;
        }

        .sns-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 16px;
        }

        .sns-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            background: #fff;
            color: #111;
            text-decoration: none;
            font-size: 14px;
        }

        .sns-btn:hover {
            background: #f3f4f6;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="card">
            <div class="row">
                <?php if ($profile_icon): ?>
                    <img class="icon" src="<?php echo esc_url($profile_icon); ?>" alt="" />
                <?php else: ?>
                    <div class="icon"></div>
                <?php endif; ?>

                <div>
                    <p class="name"><?php echo esc_html($profile_name ?: 'No Name'); ?></p>
                    <div style="font-size:12px;color:#777;">pastel-link</div>
                </div>
            </div>

            <?php if ($profile_bio): ?>
                <div class="bio"><?php echo esc_html($profile_bio); ?></div>
            <?php endif; ?>

            <?php
            $links = [];
            if (!empty($profile_sns)) {
                $lines = preg_split("/\r\n|\n|\r/", trim($profile_sns));
                foreach ($lines as $line) {
                    $line = trim($line);
                    if ($line === '') continue;

                    $label = '';
                    $url = $line;

                    if (strpos($line, '=') !== false) {
                        [$label, $url] = array_map('trim', explode('=', $line, 2));
                    }

                    if (!preg_match('#^https?://#i', $url)) {
                        $url = 'https://' . ltrim($url, '/');
                    }

                    $safe_url = esc_url($url);
                    if (!$safe_url) continue;

                    if ($label === '') {
                        $host = parse_url($url, PHP_URL_HOST);
                        $label = $host ?: 'Link';
                    }

                    $links[] = ['label' => $label, 'url' => $safe_url];
                }
            }
            ?>

            <?php if (!empty($links)): ?>
                <div class="sns-links">
                    <?php foreach ($links as $l): ?>
                        <a class="sns-btn" href="<?php echo $l['url']; ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html($l['label']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>