<?php get_header(); ?>

<main class="pl-news-wrap">
  <div class="pl-container">

    <div class="pl-news-head">
      <div>
        <h1 class="pl-news-title">News</h1>
        <p class="pl-news-sub">お知らせ / 実績 / アップデート</p>
      </div>

      <div class="pl-news-head__right">
        <!-- カテゴリを置きたければ後でここに -->
        <a class="pl-news-more" href="<?php echo esc_url(get_post_type_archive_link('pl_news')); ?>">
          すべて表示 →
        </a>
      </div>
    </div>

    <section class="pl-news-grid">
      <?php if (have_posts()): while (have_posts()): the_post(); ?>
        <?php
          $date = get_the_date('Y.m.d');
          $terms = get_the_terms(get_the_ID(), 'pl_news_cat');
          $excerpt = get_the_excerpt();
        ?>

        <article class="pl-news-card">
          <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
            <div class="pl-news-thumb">
              <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('pl-news-thumb'); ?>
              <?php else: ?>
                <!-- no image: gradientだけ -->
              <?php endif; ?>
            </div>

            <div class="pl-news-body">
              <div class="pl-news-meta">
                <span><?php echo esc_html($date); ?></span>

                <div class="pl-news-badges">
                  <?php if (!empty($terms) && !is_wp_error($terms)): ?>
                    <?php foreach (array_slice($terms, 0, 2) as $t): ?>
                      <span class="pl-news-badge pl-news-badge--accent">
                        <?php echo esc_html($t->name); ?>
                      </span>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>

              <h2 class="pl-news-card__title"><?php the_title(); ?></h2>

              <?php if ($excerpt): ?>
                <p class="pl-news-card__excerpt"><?php echo esc_html($excerpt); ?></p>
              <?php endif; ?>
            </div>
          </a>
        </article>

      <?php endwhile; endif; ?>
    </section>

    <div style="margin-top:26px;">
      <?php the_posts_pagination(); ?>
    </div>

  </div>
</main>

<?php get_footer(); ?>
