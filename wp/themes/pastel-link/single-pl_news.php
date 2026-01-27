<?php get_header(); ?>

<main style="padding:90px 0;">
  <div class="pl-container" style="max-width:820px;">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>

      <p style="margin:0 0 10px; color:var(--muted); font-size:12px;">
        <?php echo esc_html(get_the_date('Y.m.d')); ?>
      </p>

      <h1 style="margin:0 0 18px; font-size:clamp(26px, 3vw, 40px); letter-spacing:-.02em;">
        <?php the_title(); ?>
      </h1>

      <?php if (has_post_thumbnail()): ?>
        <div style="border-radius:22px; overflow:hidden; border:1px solid rgba(0,0,0,.08); background:#fff;">
          <?php the_post_thumbnail('large'); ?>
        </div>
      <?php endif; ?>

      <article style="margin-top:18px; line-height:1.95; color:rgba(20,20,20,.90);">
        <?php the_content(); ?>
      </article>

      <div style="margin-top:28px;">
        <a class="pl-news-more" href="<?php echo esc_url(get_post_type_archive_link('pl_news')); ?>">
          ← News一覧へ
        </a>
      </div>

    <?php endwhile; endif; ?>
  </div>
</main>

<?php get_footer(); ?>
