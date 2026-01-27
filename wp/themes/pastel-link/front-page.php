<?php get_header(); ?>

<main class="pl">

    <!-- HERO -->
    <!-- HERO -->
    <section class="pl-hero">

        <!-- ★ 背景動画 -->
        <video
            class="pl-hero__video"
            autoplay
            muted
            loop
            playsinline
            preload="metadata"
            aria-hidden="true">
            <source src="http://enyukari.capoo.jp/pastel-link/wp-content/uploads/2026/01/3b36526450e04768986a28aacf4fb0b5.HD-1080p-7.2Mbps-61209861.mp4" type="video/mp4">
        </video>

        <!-- ★ 黒オーバーレイ（文字読みやすくする） -->
        <div class="pl-hero__overlay" aria-hidden="true"></div>

        <div class="pl-container pl-hero__inner">
            <div class="pl-hero__content">
                <div class="pl-eyebrow">Pastel Link</div>
                <h1 class="pl-h1">やさしく、つながる。<br>あなたのプロフィール</h1>
                <p class="pl-lead">
                    PastelLinkは、<br>
                    あなたのリンクや情報を“かわいく整えて”届けます。
                </p>

                <div class="pl-actions">
                    <a class="pl-btn pl-btn--primary" href="/products">商品ラインナップ</a>
                    <a class="pl-btn pl-btn--glass" href="/features">機能を見る</a>
                </div>

                <div class="pl-badges">
                    <span class="pl-badge">導入実績</span>
                    <span class="pl-badge">運用サポート</span>
                    <span class="pl-badge">停止/無効化</span>
                </div>
            </div>
        </div>
    </section>

    <!-- AWARD / TRUST (white card) -->
    <section class="pl-section pl-light">
        <div class="pl-container">
            <div class="pl-trust-card">
                <div>
                    <h2 class="pl-h2">安心の運用設計</h2>
                    <p class="pl-lead pl-lead--dark">
                        WordPressで管理、公開は別サーバー（Next）で提供。<br>
                        “管理と公開”を分離して、守りが固い構成にします。
                    </p>
                </div>
                <div class="pl-trust-badge">
                    <div class="pl-trust-badge__mark">★</div>
                    <div class="pl-trust-badge__text">
                        <div class="pl-trust-badge__big">信頼の土台</div>
                        <div class="pl-trust-badge__small">運用・停止・更新に強い</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LOGOS -->
    <section class="pl-section pl-light">
        <div class="pl-container">
            <h2 class="pl-h2 pl-center">導入企業イメージ</h2>
            <div class="pl-logos">
                <span class="pl-logo">LOGO</span>
                <span class="pl-logo">LOGO</span>
                <span class="pl-logo">LOGO</span>
                <span class="pl-logo">LOGO</span>
                <span class="pl-logo">LOGO</span>
                <span class="pl-logo">LOGO</span>
            </div>
        </div>
    </section>

    <!-- CAMPAIGN -->
    <section class="pl-section pl-dark">
        <div class="pl-container">
            <div class="pl-campaign">
                <div class="pl-campaign__left">
                    <div class="pl-eyebrow">CAMPAIGN</div>
                    <div class="pl-campaign__title">初期導入プラン</div>
                    <div class="pl-campaign__price">980円〜</div>
                </div>
                <div class="pl-campaign__right">
                    <a class="pl-btn pl-btn-primary" href="#contact">今すぐ相談する</a>
                </div>
            </div>
        </div>
    </section>

    <!-- LINEUP (3 cards) -->
    <section id="lineup" class="pl-section pl-dark">
        <div class="pl-container">
            <h2 class="pl-h2">商品ラインナップ</h2>

            <div class="pl-grid3">
                <article class="pl-card">
                    <div class="pl-card__img"></div>
                    <h3 class="pl-h3">オフィシャルデザイン</h3>
                    <p class="pl-muted">テンプレから選んで最短導入</p>
                    <div class="pl-price">¥ 1,480〜</div>
                    <a class="pl-btn pl-btn-ghost" href="#contact">このプランで相談</a>
                </article>

                <article class="pl-card">
                    <div class="pl-card__img"></div>
                    <h3 class="pl-h3">オリジナルデザイン</h3>
                    <p class="pl-muted">写真・配色・レイアウトを自由に</p>
                    <div class="pl-price">¥ 6,980〜</div>
                    <a class="pl-btn pl-btn-ghost" href="#contact">このプランで相談</a>
                </article>

                <article class="pl-card">
                    <div class="pl-card__img"></div>
                    <h3 class="pl-h3">ビジネス運用</h3>
                    <p class="pl-muted">複数人/停止/運用保証に強い</p>
                    <div class="pl-price">見積</div>
                    <a class="pl-btn pl-btn-ghost" href="#contact">見積を依頼</a>
                </article>
            </div>
        </div>
    </section>

    <!-- FEATURES (split / alternate) -->
    <section id="features" class="pl-section pl-dark">
        <div class="pl-container">
            <div class="pl-split">
                <div>
                    <h2 class="pl-h2">2つのモードを利用可能</h2>
                    <p class="pl-lead">
                        マルチリンク（SNSまとめ）と、デジタル名刺（プロフィール）を切替。<br>
                        “どの見せ方が正解か”を状況で選べます。
                    </p>
                    <div class="pl-actions">
                        <a class="pl-btn pl-btn-ghost" href="#">マルチリンク例</a>
                        <a class="pl-btn pl-btn-ghost" href="#">名刺例</a>
                    </div>
                </div>
                <div class="pl-phone-mock"></div>
            </div>

            <div class="pl-split pl-split--reverse">
                <div>
                    <h2 class="pl-h2">プロフィールを充実させる</h2>
                    <p class="pl-lead">
                        URL、SNS、実績、写真、自己紹介。必要なものだけを綺麗に整理。<br>
                        編集URLはトークン付きで発行、漏洩しない運用に寄せます。
                    </p>
                </div>
                <div class="pl-phone-mock"></div>
            </div>
        </div>
    </section>

    <!-- 3 STEPS -->
    <section class="pl-section pl-dark">
        <div class="pl-container">
            <h2 class="pl-h2 pl-center"><span class="pl-accent">かんたん</span> 3ステップ</h2>

            <div class="pl-steps">
                <div class="pl-step">
                    <div class="pl-step__illust"></div>
                    <div class="pl-step__title">STEP 1</div>
                    <div class="pl-step__text">届いたカードにスマホをかざす</div>
                </div>
                <div class="pl-step">
                    <div class="pl-step__illust"></div>
                    <div class="pl-step__title">STEP 2</div>
                    <div class="pl-step__text">プロフィールを登録</div>
                </div>
                <div class="pl-step">
                    <div class="pl-step__illust"></div>
                    <div class="pl-step__title">STEP 3</div>
                    <div class="pl-step__text">共有開始（停止も管理可能）</div>
                </div>
            </div>
        </div>
    </section>

    <section class="pl-section pl-light" id="plNews">
        <div class="pl-container">
            <div class="pl-news-head">
                <div>
                    <div class="pl-eyebrow">News</div>
                    <h2 class="pl-h2">最新のお知らせ</h2>
                </div>

                <a class="pl-news-more" href="<?php echo esc_url(get_post_type_archive_link('pl_news')); ?>">
                    すべて表示 →
                </a>
            </div>

            <?php
            $q = new WP_Query([
                'post_type'      => 'pl_news',
                'posts_per_page' => 6,
                'post_status'    => 'publish',
            ]);
            ?>

            <?php if ($q->have_posts()): ?>
                <div class="pl-news-grid">
                    <?php while ($q->have_posts()): $q->the_post(); ?>
                        <a class="pl-news-card" href="<?php the_permalink(); ?>">
                            <div class="pl-news-thumb">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('pl-news-thumb'); ?>
                                <?php else: ?>
                                    <div class="pl-news-thumb__ph"></div>
                                <?php endif; ?>
                            </div>

                            <div class="pl-news-body">
                                <div class="pl-news-meta">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date('Y.m.d')); ?>
                                    </time>

                                    <?php
                                    $terms = get_the_terms(get_the_ID(), 'pl_news_cat');
                                    if (!is_wp_error($terms) && !empty($terms)):
                                        $t = $terms[0];
                                    ?>
                                        <span class="pl-news-tag"><?php echo esc_html($t->name); ?></span>
                                    <?php endif; ?>
                                </div>

                                <h3 class="pl-news-title"><?php the_title(); ?></h3>

                                <p class="pl-news-excerpt">
                                    <?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 28)); ?>
                                </p>

                                <div class="pl-news-arrow">→</div>
                            </div>
                        </a>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            <?php else: ?>
                <div class="pl-card">まだNewsがありません。</div>
            <?php endif; ?>
        </div>
    </section>


    <!-- CONTACT CTA -->
    <section id="contact" class="pl-section pl-light">
        <div class="pl-container">
            <div class="pl-cta">
                <div>
                    <h2 class="pl-h2">まずは相談から</h2>
                    <p class="pl-lead pl-lead--dark">要件・規模・運用方針に合わせて、構成を最短で整えます。</p>
                </div>
                <div class="pl-actions">
                    <a class="pl-btn pl-btn-primary" href="/contact">お問い合わせ</a>
                    <a class="pl-btn pl-btn-ghost pl-btn-ghost--dark" href="#lineup">ラインナップを見る</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>