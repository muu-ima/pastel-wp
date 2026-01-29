<?php get_header(); ?>

<main class="pl">

    <!-- HERO（世界観＋一言理解＋CTA） -->
    <section class="pl-hero">
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

        <div class="pl-hero__overlay" aria-hidden="true"></div>

        <div class="pl-container pl-hero__inner">
            <div class="pl-hero__content">
                <div class="pl-eyebrow">Pastel Link</div>

                <h1 class="pl-h1">
                    かざすだけで、<br>あなたのプロフィールへ。
                </h1>

                <p class="pl-lead">
                    NFCカード × Webプロフィール × かんたん編集。<br>
                    情報を“かわいく整えて”届けます。
                </p>

                <div class="pl-actions">
                    <a class="pl-btn pl-btn--primary" href="#lineup">商品・プランを見る</a>
                    <a class="pl-btn pl-btn--glass" href="#how">使い方（3ステップ）</a>
                </div>

                <div class="pl-badges">
                    <span class="pl-badge">アプリ不要</span>
                    <span class="pl-badge">あとから編集OK</span>
                    <span class="pl-badge">停止/無効化</span>
                </div>
            </div>
        </div>
    </section>


    <!-- HOW IT WORKS（3ステップ） -->
    <section id="how" class="pl-section pl-light">
        <div class="pl-container">
            <div class="pl-center">
                <div class="pl-eyebrow">How it works</div>
                <h2 class="pl-h2"><span class="pl-accent">かんたん</span> 3ステップ</h2>
                <p class="pl-lead pl-lead--dark">
                    作る → かざす → 更新。迷わない流れで使えます。
                </p>
            </div>

            <div class="pl-steps">
                <div class="pl-step">
                    <div class="pl-step__illust"></div>
                    <div class="pl-step__title">STEP 1</div>
                    <div class="pl-step__text">カードをスマホにタッチ</div>
                </div>

                <div class="pl-step">
                    <div class="pl-step__illust"></div>
                    <div class="pl-step__title">STEP 2</div>
                    <div class="pl-step__text">プロフィールを入力</div>
                </div>

                <div class="pl-step">
                    <div class="pl-step__illust"></div>
                    <div class="pl-step__title">STEP 3</div>
                    <div class="pl-step__text">共有開始（停止も管理OK）</div>
                </div>
            </div>
        </div>
    </section>


    <!-- PRODUCTS / PLANS（ラインナップ） -->
    <section id="lineup" class="pl-section pl-dark">
        <div class="pl-container">
            <div class="pl-eyebrow">Products / Plans</div>
            <h2 class="pl-h2">商品ラインナップ</h2>
            <p class="pl-lead">
                まずはテンプレ導入、こだわるならオリジナル。運用が必要ならビジネス構成へ。
            </p>

            <div class="pl-grid3">
                <article class="pl-card pl-product">
                    <div class="pl-card__img pl-product__media" aria-hidden="true"></div>

                    <div class="pl-product__body">
                        <h3 class="pl-h3">オフィシャルデザイン</h3>
                        <p class="pl-muted">
                            デザインが準備されているカードをお求めの方はこちら。グラデーション・シンプル・幾何学模様などの多様なデザインの中からお気に入りのデザインを見つけてください。まずはデジタル名刺を試したい方にもおすすめ。
                        </p>

                        <div class="pl-product__foot">
                            <div class="pl-price">¥ x,xxx〜</div>
                            <a class="pl-btn pl-btn-ghost" href="#contact">詳しく見る</a>
                        </div>
                    </div>
                </article>

                <article class="pl-card pl-product">
                    <div class="pl-card__img pl-product__media" aria-hidden="true"></div>

                    <div class="pl-product__body">
                        <h3 class="pl-h3">オリジナルデザイン</h3>
                        <p class="pl-muted">
                            デザインが準備されているカードをお求めの方はこちら。グラデーション・シンプル・幾何学模様などの多様なデザインの中からお気に入りのデザインを見つけてください。まずはデジタル名刺を試したい方にもおすすめ。
                        </p>

                        <div class="pl-product__foot">
                            <div class="pl-price">¥ x,xxx〜</div>
                            <a class="pl-btn pl-btn-ghost" href="#contact">詳しく見る</a>
                        </div>
                    </div>
                </article>

                <article class="pl-card pl-product">
                    <div class="pl-card__img pl-product__media" aria-hidden="true"></div>

                    <div class="pl-product__body">
                        <h3 class="pl-h3">カスタムデザイン</h3>
                        <p class="pl-muted">
                            表面を自由にデザイン可能な、あなただけのデジタル名刺。操作も簡単。Web上のツールを使って、文字を配置したり、好きな画像をアップロードするだけで完成します。
                        </p>

                        <div class="pl-product__foot">
                            <div class="pl-price">¥ x,xxx〜</div>
                            <a class="pl-btn pl-btn-ghost" href="#contact">詳しく見る</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>


    <!-- TEMPLATES（エディタの見せ場） -->
    <section id="templates" class="pl-section pl-light">
        <div class="pl-container">
            <div class="pl-eyebrow">Templates</div>
            <h2 class="pl-h2">好きなデザインからすぐ作成</h2>
            <p class="pl-lead pl-lead--dark">
                テンプレを選んで、文字・色・写真を変えるだけ。雰囲気を崩さず整えられます。
            </p>

            <!-- いまはダミー。後で画像/ショートコード/埋め込みに差し替え -->
            <div class="pl-templates">
                <a class="pl-template" href="#"><span>Template A</span></a>
                <a class="pl-template" href="#"><span>Template B</span></a>
                <a class="pl-template" href="#"><span>Template C</span></a>
                <a class="pl-template" href="#"><span>Template D</span></a>
            </div>

            <div class="pl-actions pl-center">
                <a class="pl-btn pl-btn-primary" href="/editor">テンプレを見る</a>
                <a class="pl-btn pl-btn-ghost pl-btn-ghost--dark" href="#contact">相談して作る</a>
            </div>
        </div>
    </section>


    <!-- FAQ（安心の運用設計をここへ） -->
    <section id="faq" class="pl-section pl-light">
        <div class="pl-container">
            <div class="pl-eyebrow">FAQ</div>
            <h2 class="pl-h2">よくある質問</h2>

            <div class="pl-faq">
                <details class="pl-faq__item">
                    <summary>アプリは必要ですか？</summary>
                    <div class="pl-faq__body">不要です。ブラウザで開きます。</div>
                </details>

                <details class="pl-faq__item">
                    <summary>あとから内容を変えられますか？</summary>
                    <div class="pl-faq__body">編集URLからいつでも更新できます（URLは変えずに中身だけ更新）。</div>
                </details>

                <details class="pl-faq__item">
                    <summary>停止や無効化はできますか？</summary>
                    <div class="pl-faq__body">管理画面から切替できます。運用に合わせて調整可能です。</div>
                </details>

                <details class="pl-faq__item">
                    <summary>運用の仕組み（安全面）は？</summary>
                    <div class="pl-faq__body">
                        WordPressで管理し、公開は別サーバー（Next）で提供する想定です。管理と公開を分離して運用に強くします。
                    </div>
                </details>
            </div>
        </div>
    </section>


    <!-- NEWS（下に回す） -->
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


    <!-- CONTACT（締め） -->
    <section id="contact" class="pl-section pl-light">
        <div class="pl-container">
            <div class="pl-cta">
                <div>
                    <div class="pl-eyebrow">Contact</div>
                    <h2 class="pl-h2">まずは相談から</h2>
                    <p class="pl-lead pl-lead--dark">
                        要件・規模・運用方針に合わせて、構成を最短で整えます。
                    </p>
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