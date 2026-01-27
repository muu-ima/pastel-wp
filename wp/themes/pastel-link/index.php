<?php get_header(); ?>

<main class="pl pl-dark" style="padding-top:72px;">
  <section class="pl-section">
    <div class="pl-container">
      <h1 class="pl-h2">
        <?php
          // トップ以外の一覧系ならタイトルをそれっぽく
          if (is_home()) {
            echo esc_html(get_bloginfo('name')) . ' - BLOG';
          } elseif (is_archive()) {
            the_archive_title();
          } elseif (is_search()) {
            echo 'Search: ' . esc_html(get_search_query());
          } else {
            echo esc_html(get_bloginfo('name'));
          }
        ?>
      </h1>

      <?php if (have_posts()) : ?>
        <div class="pl-grid3" style="grid-template-columns:repeat(2, 1fr);">
          <?php while (have_posts()) : the_post(); ?>
            <article class="pl-card">
              <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
                  <?php the_post_thumbnail('large', ['style' => 'width:100%;height:auto;border-radius:18px;']); ?>
                </a>
              <?php else: ?>
                <div class="pl-card__img"></div>
              <?php endif; ?>

              <h2 class="pl-h3" style="margin-top:14px;">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>

              <div class="pl-muted" style="margin-bottom:10px;">
                <?php echo esc_html(get_the_date()); ?>
              </div>

              <div class="pl-lead" style="margin:0;">
                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 24, '…')); ?>
              </div>

              <div style="margin-top:14px;">
                <a class="pl-btn pl-btn-ghost" href="<?php the_permalink(); ?>">続きを読む</a>
              </div>
            </article>
          <?php endwhile; ?>
        </div>

        <div style="margin-top:28px;">
          <?php
            the_posts_pagination([
              'mid_size'  => 1,
              'prev_text' => '←',
              'next_text' => '→',
            ]);
          ?>
        </div>

      <?php else: ?>
        <div class="pl-card">
          <p class="pl-lead" style="margin:0;">記事がありません。</p>
        </div>
      <?php endif; ?>

    </div>
  </section>
</main>

<?php get_footer(); ?>
