<?php
/**
 * Template Name: Order
 */
if (!defined('ABSPATH')) exit;
get_header();
?>

<main class="pl">

  <!-- ORDER (MEET style) -->
  <section class="pl-order">
    <div class="pl-container">

      <!-- Title -->
      <header class="pl-order__title">
        <div class="pl-eyebrow">Pastel Link</div>
        <h1 class="pl-h1">オフィシャルデザイン</h1>
      </header>

      <!-- TOP: product area -->
      <div class="pl-order__top">

        <!-- LEFT: gallery -->
        <div class="pl-order__gallery">

          <figure class="pl-order__hero">
            <div class="pl-order__heroImg" aria-hidden="true"></div>
          </figure>

          <div class="pl-order__thumbRow" aria-label="gallery thumbnails">
            <button class="pl-thumb is-active" type="button" aria-label="thumb 1"><span></span></button>
            <button class="pl-thumb" type="button" aria-label="thumb 2"><span></span></button>
            <button class="pl-thumb" type="button" aria-label="thumb 3"><span></span></button>
            <button class="pl-thumb" type="button" aria-label="thumb 4"><span></span></button>
          </div>

        </div>

        <!-- RIGHT: purchase panel -->
        <aside class="pl-order__panel">

          <!-- Options -->
          <div class="pl-block">
            <div class="pl-label">カードの色を選択</div>
            <div class="pl-swatches">
              <button class="pl-swatch is-active" type="button" aria-label="mint"></button>
              <button class="pl-swatch" type="button" aria-label="coral"></button>
              <button class="pl-swatch" type="button" aria-label="lavender"></button>
              <button class="pl-swatch" type="button" aria-label="lemon"></button>
              <button class="pl-swatch" type="button" aria-label="night"></button>
            </div>
          </div>

          <div class="pl-block">
            <div class="pl-label">デザインを選ぶ</div>
            <div class="pl-chips">
              <button class="pl-chip is-active" type="button">S1</button>
              <button class="pl-chip" type="button">S2</button>
              <button class="pl-chip" type="button">S3</button>
              <button class="pl-chip" type="button">S4</button>
              <button class="pl-chip" type="button">S5</button>
            </div>
          </div>

          <div class="pl-block">
            <div class="pl-label">数量</div>
            <div class="pl-qty">
              <button type="button" aria-label="decrease">−</button>
              <input type="number" value="1" min="1">
              <button type="button" aria-label="increase">＋</button>
            </div>
          </div>

          <!-- Price -->
          <div class="pl-order__price">
            <div class="pl-muted">価格(税込)</div>
            <div class="pl-order__priceRow">
              <strong class="pl-order__yen">¥1,980</strong>
              <span class="pl-muted">（税込 ¥2,178）</span>
            </div>
          </div>

          <!-- CTA -->
          <button class="pl-btn pl-btn-primary pl-order__cta" type="button">
            カートに追加する
          </button>

          <!-- Notes -->
          <p class="pl-order__note pl-muted">
            購入後にリンクURLの登録（プロフィール / SNS / LP など）が可能です。
          </p>

          <!-- Info box -->
          <section class="pl-order__info">
            <h2 class="pl-h3">今ならオプションの「オフィシャルリンク」が無料</h2>
            <p class="pl-muted">
              名刺の裏面に埋め込むリンク（プロフィール等）を無料で付与できます。
              運用方法に合わせて、後から変更できる設計にも対応可能です。
            </p>

            <dl class="pl-order__faq">
              <div>
                <dt>内容</dt>
                <dd class="pl-muted">カード + リンク設定（無料）</dd>
              </div>
              <div>
                <dt>納期</dt>
                <dd class="pl-muted">3〜5営業日目安（仮）</dd>
              </div>
              <div>
                <dt>対応端末</dt>
                <dd class="pl-muted">NFC対応のスマートフォン（仮）</dd>
              </div>
            </dl>

            <a class="pl-link" href="#device">対応端末について</a>
          </section>

        </aside>

      </div>

      <!-- FLOW -->
      <section class="pl-flow" id="flow">
        <div class="pl-flow__head">
          <div class="pl-eyebrow">FLOW</div>
          <h2 class="pl-h2">ご購入から<br>ご利用開始までの流れ</h2>
        </div>

        <div class="pl-flow__grid">
          <article class="pl-step">
            <div class="pl-step__badge">STEP 1</div>
            <h3 class="pl-h3">お支払い方法の登録</h3>
            <p class="pl-muted">購入完了後、必要な情報を登録します。（仮）</p>
            <div class="pl-step__shot" aria-hidden="true"></div>
          </article>

          <article class="pl-step">
            <div class="pl-step__badge">STEP 2</div>
            <h3 class="pl-h3">リンクURLの設定</h3>
            <p class="pl-muted">プロフィールURLなどを登録し、カードに紐づけます。（仮）</p>
            <div class="pl-step__shot" aria-hidden="true"></div>
          </article>

          <article class="pl-step">
            <div class="pl-step__badge">STEP 3</div>
            <h3 class="pl-h3">受け取り・利用開始</h3>
            <p class="pl-muted">カードが届いたら、タッチしてすぐ使えます。（仮）</p>
            <div class="pl-step__shot" aria-hidden="true"></div>
          </article>
        </div>

        <div class="pl-flow__cta">
          <a class="pl-btn pl-btn-primary" href="#lineup">商品一覧を見る</a>
        </div>
      </section>

      <!-- RECOMMEND -->
      <section class="pl-reco" id="lineup">
        <h2 class="pl-h2">こちらもおすすめ</h2>

        <div class="pl-reco__grid">
          <article class="pl-recoCard">
            <div class="pl-recoCard__img" aria-hidden="true"></div>
            <div class="pl-recoCard__body">
              <h3 class="pl-h3">オリジナルデザイン</h3>
              <div class="pl-muted">¥2,980〜</div>
            </div>
          </article>

          <article class="pl-recoCard">
            <div class="pl-recoCard__img" aria-hidden="true"></div>
            <div class="pl-recoCard__body">
              <h3 class="pl-h3">パーソナライズデザイン</h3>
              <div class="pl-muted">¥4,980〜</div>
            </div>
          </article>
        </div>
      </section>

      <!-- DEVICE -->
      <section class="pl-device" id="device">
        <h2 class="pl-h2">対応端末について</h2>
        <p class="pl-muted">
          NFC対応のスマートフォンで利用できます。（ここは後で実情報に差し替え）
        </p>
      </section>

    </div>
  </section>

</main>

<?php get_footer(); ?>

