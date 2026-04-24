<?php
/**
 * single-proyecto.php
 * Plantilla para entradas del CPT "proyecto" (Pods)
 * Colocar en: wp-content/themes/{tu-tema}/single-proyecto.php
 */

get_header();

/* ════════════════════════════════════════════
   DATOS DEL PROYECTO
   Obtenemos los campos directamente de Pods
   sin ninguna llamada extra a la REST API
════════════════════════════════════════════ */
$post_id = get_the_ID();

/* Pods: intentamos field() primero, luego get_post_meta como fallback */
$helper = function( $field ) use ( $post_id ) {
    $val = null;
    if ( function_exists( 'pods' ) ) {
        $val = pods( 'proyecto', $post_id )->field( $field );
    }
    if ( $val === null || $val === false || $val === '' ) {
        $val = get_post_meta( $post_id, $field, true );
    }
    return $val;
};

$ubicacion = $helper( 'ubiacion' )              ?: '—';
$m2        = $helper( 'm2' )                    ?: '';
$by        = $helper( 'by' )                    ?: '—';
$etapa_val = $helper( 'etapa' )                 ?: '';
$desc      = $helper( 'descripcion_del_proyecto' ) ?: '';
$galeria   = $helper( 'galeria' )               ?: [];

$title    = get_the_title();
$feat_img = get_the_post_thumbnail_url( $post_id, 'full' ) ?: '';
$m2_label = $m2 ? esc_html( $m2 ) . ' m²' : '—';

/* ── Etapa: mapeo de valor a clase CSS + etiqueta ── */
$etapa_map = [
    'terminada'    => [ 'cls' => 'rw-proy-meta__badge--done',     'label' => 'Obra terminada'  ],
    'construccion' => [ 'cls' => 'rw-proy-meta__badge--progress', 'label' => 'En construcción' ],
    'diseno'       => [ 'cls' => 'rw-proy-meta__badge--design',   'label' => 'En diseño'        ],
    'licitacion'   => [ 'cls' => 'rw-proy-meta__badge--design',   'label' => 'En licitación'    ],
];
$etapa_key   = strtolower( remove_accents( $etapa_val ) );
$etapa_key   = preg_replace( '/[^a-z]/', '', $etapa_key );
$etapa_info  = [ 'cls' => 'rw-proy-meta__badge--done', 'label' => esc_html( $etapa_val ) ?: '—' ];
foreach ( $etapa_map as $k => $v ) {
    if ( strpos( $etapa_key, $k ) !== false ) { $etapa_info = $v; break; }
}

/* ── Galería: normalizar a array de URLs ─────────── */
$gallery_imgs = [];
if ( ! is_array( $galeria ) ) {
    $galeria = $galeria ? [ $galeria ] : [];
}
foreach ( $galeria as $item ) {
    if ( is_numeric( $item ) ) {
        /* Pods devuelve IDs */
        $url = wp_get_attachment_image_url( (int) $item, 'large' );
        $alt = get_post_meta( (int) $item, '_wp_attachment_image_alt', true );
        if ( $url ) $gallery_imgs[] = [ 'src' => $url, 'alt' => $alt ?: $title ];
    } elseif ( is_array( $item ) ) {
        /* Pods devuelve objetos con guid / ID */
        $url = $item['guid'] ?? ( isset( $item['ID'] ) ? wp_get_attachment_image_url( $item['ID'], 'large' ) : '' );
        $alt = $item['post_excerpt'] ?? $title;
        if ( $url ) $gallery_imgs[] = [ 'src' => $url, 'alt' => $alt ];
    } elseif ( is_string( $item ) && filter_var( $item, FILTER_VALIDATE_URL ) ) {
        $gallery_imgs[] = [ 'src' => $item, 'alt' => $title ];
    }
}
?>

<!-- ══════════════════════════════════════
     DEBUG TEMPORAL — borrar después de verificar
══════════════════════════════════════ -->
<?php if ( current_user_can( 'administrator' ) ) : ?>
<div style="background:#1a1a1a;color:#0f0;font-family:monospace;font-size:12px;padding:20px;margin:0;white-space:pre-wrap;overflow:auto;max-height:400px;position:relative;z-index:9999;">
<strong>POST ID:</strong> <?php echo $post_id; ?>

<strong>PODS activo:</strong> <?php echo function_exists('pods') ? 'SÍ' : 'NO'; ?>

<strong>TODOS LOS META DEL POST:</strong>
<?php
$all_meta = get_post_meta( $post_id );
foreach ( $all_meta as $key => $values ) {
    if ( substr( $key, 0, 1 ) === '_' ) continue; // ocultar meta privados
    echo esc_html( $key ) . ': ' . esc_html( print_r( $values[0], true ) ) . "\n";
}
?>

<strong>PODS FIELD 'ubicacion':</strong> <?php var_dump( function_exists('pods') ? pods('proyecto', $post_id)->field('ubicacion') : 'Pods no activo' ); ?>
<strong>PODS FIELD 'm2':</strong> <?php var_dump( function_exists('pods') ? pods('proyecto', $post_id)->field('m2') : 'Pods no activo' ); ?>
<strong>PODS FIELD 'by':</strong> <?php var_dump( function_exists('pods') ? pods('proyecto', $post_id)->field('by') : 'Pods no activo' ); ?>
<strong>PODS FIELD 'etapa':</strong> <?php var_dump( function_exists('pods') ? pods('proyecto', $post_id)->field('etapa') : 'Pods no activo' ); ?>
<strong>PODS FIELD 'descripcion':</strong> <?php var_dump( function_exists('pods') ? pods('proyecto', $post_id)->field('descripcion') : 'Pods no activo' ); ?>
<strong>PODS FIELD 'galeria':</strong> <?php var_dump( function_exists('pods') ? pods('proyecto', $post_id)->field('galeria') : 'Pods no activo' ); ?>
</div>
<?php endif; ?>

<!-- ══════════════════════════════════════
     STYLES & SCRIPTS
     (si ya los enqueuás en functions.php,
      podés borrar estas dos líneas)
══════════════════════════════════════ -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles.css">


<!-- ══════════════════════════════════════
     HERO BANNER
══════════════════════════════════════ -->
<section id="inicio" class="rw-proy-hero" aria-label="Proyecto destacado">
  <div class="rw-proy-hero__img">
    <?php if ( $feat_img ) : ?>
      <img src="<?php echo esc_url( $feat_img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="eager">
    <?php endif; ?>
  </div>

  <div class="rw-proy-hero__overlay" aria-hidden="true"></div>
  <div class="rw-proy-hero__bg-num" aria-hidden="true">01</div>

  <div class="rw-proy-hero__content">
    <nav class="rw-proy-hero__breadcrumb" aria-label="Ruta de navegación">
      <a href="<?php echo home_url('/'); ?>">Inicio</a>
      <span aria-hidden="true">·</span>
      <a href="<?php echo home_url('/#proyectos'); ?>">Proyectos</a>
      <span aria-hidden="true">·</span>
      <span><?php echo esc_html( $title ); ?></span>
    </nav>
    <span class="rw-proy-hero__label">Mass Timber</span>
    <h1 class="rw-proy-hero__heading"><?php echo esc_html( $title ); ?></h1>
  </div>

  <div class="rw-proy-hero__scroll" aria-hidden="true">
    <span>Scroll</span>
    <div class="rw-proy-hero__scroll-line"></div>
  </div>
</section>


<!-- ══════════════════════════════════════
     FICHA TÉCNICA
══════════════════════════════════════ -->
<section class="rw-proy-meta" aria-label="Ficha técnica del proyecto">
  <div class="rw-container">
    <div class="rw-proy-meta__grid">

      <div class="rw-proy-meta__item reveal">
        <div class="rw-proy-meta__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
        </div>
        <span class="rw-proy-meta__label">Ubicación</span>
        <span class="rw-proy-meta__value"><?php echo esc_html( $ubicacion ); ?></span>
      </div>

      <div class="rw-proy-meta__item reveal reveal-delay-1">
        <div class="rw-proy-meta__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2"/>
            <path d="M3 9h18M9 3v18"/>
          </svg>
        </div>
        <span class="rw-proy-meta__label">Superficie</span>
        <span class="rw-proy-meta__value"><?php echo esc_html( $m2_label ); ?></span>
      </div>

      <div class="rw-proy-meta__item reveal reveal-delay-2">
        <div class="rw-proy-meta__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
          </svg>
        </div>
        <span class="rw-proy-meta__label">Desarrollado por</span>
        <span class="rw-proy-meta__value"><?php echo esc_html( $by ); ?></span>
      </div>

      <div class="rw-proy-meta__item reveal reveal-delay-3">
        <div class="rw-proy-meta__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
          </svg>
        </div>
        <span class="rw-proy-meta__label">Etapa</span>
        <span class="rw-proy-meta__value">
          <span class="rw-proy-meta__badge <?php echo esc_attr( $etapa_info['cls'] ); ?>">
            <?php echo esc_html( $etapa_info['label'] ); ?>
          </span>
        </span>
      </div>

    </div>
  </div>
</section>


<!-- ══════════════════════════════════════
     DESCRIPCIÓN
══════════════════════════════════════ -->
<section id="descripcion" class="rw-section rw-section--dark rw-proy-desc">

  <div class="rw-proy-desc__wm" aria-hidden="true">
    <svg viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="300" cy="300" r="292" stroke="currentColor" stroke-width="2.5"/>
      <circle cx="300" cy="300" r="270" stroke="currentColor" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="248" stroke="currentColor" stroke-width="2"/>
      <circle cx="300" cy="300" r="225" stroke="currentColor" stroke-width="1"/>
      <circle cx="300" cy="300" r="206" stroke="currentColor" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="185" stroke="currentColor" stroke-width="1"/>
      <circle cx="300" cy="300" r="166" stroke="currentColor" stroke-width="2"/>
      <circle cx="300" cy="300" r="146" stroke="currentColor" stroke-width="1"/>
      <circle cx="300" cy="300" r="128" stroke="currentColor" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="110" stroke="currentColor" stroke-width="1"/>
      <circle cx="300" cy="300" r="92"  stroke="currentColor" stroke-width="2"/>
      <circle cx="300" cy="300" r="75"  stroke="currentColor" stroke-width="1"/>
      <circle cx="300" cy="300" r="59"  stroke="currentColor" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="44"  stroke="currentColor" stroke-width="1"/>
      <circle cx="300" cy="300" r="30"  stroke="currentColor" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="17"  stroke="currentColor" stroke-width="1"/>
      <circle cx="300" cy="300" r="7"   fill="currentColor"/>
      <line x1="300" y1="8"   x2="300" y2="592" stroke="currentColor" stroke-width="0.8"/>
      <line x1="8"   y1="300" x2="592" y2="300" stroke="currentColor" stroke-width="0.8"/>
      <line x1="92"  y1="92"  x2="508" y2="508" stroke="currentColor" stroke-width="0.5" opacity="0.7"/>
      <line x1="508" y1="92"  x2="92"  y2="508" stroke="currentColor" stroke-width="0.5" opacity="0.7"/>
    </svg>
  </div>

  <div class="rw-container">
    <div class="rw-proy-desc__inner">

      <div class="rw-proy-desc__text reveal-left">
        <span class="rw-eyebrow">Descripción</span>
        <div class="rw-proy-desc__accent" aria-hidden="true"></div>
        <?php if ( $desc ) : ?>
          <?php
          /* Si el contenido tiene HTML (WYSIWYG), lo mostramos tal cual.
             Si es texto plano, lo convertimos en párrafos. */
          if ( preg_match( '/<[a-z][\s\S]*>/i', $desc ) ) {
              echo wp_kses_post( $desc );
          } else {
              $paragraphs = preg_split( '/\n\n+/', trim( $desc ) );
              foreach ( $paragraphs as $p ) {
                  echo '<p>' . nl2br( esc_html( trim( $p ) ) ) . '</p>';
              }
          }
          ?>
        <?php endif; ?>
      </div>

      <div class="rw-proy-desc__visual reveal">
        <div class="rw-proy-desc__img-wrap">
          <?php if ( $feat_img ) : ?>
            <img src="<?php echo esc_url( $feat_img ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ══════════════════════════════════════
     GALERÍA DE IMÁGENES
══════════════════════════════════════ -->
<?php if ( ! empty( $gallery_imgs ) ) : ?>
<section id="galeria" class="rw-section rw-section--charcoal rw-proy-gallery">
  <div class="rw-container">

    <header class="rw-proy-gallery__header reveal">
      <div>
        <span class="rw-eyebrow rw-eyebrow--light">Galería</span>
        <h2>Imágenes del proyecto</h2>
      </div>
    </header>

    <div class="rw-proy-gallery__grid" id="rw-proj-gallery-grid">
      <?php foreach ( $gallery_imgs as $i => $img ) :
        $is_featured = ( $i === 0 );
        $delay       = ( $i > 0 && $i < 5 ) ? ' reveal-delay-' . $i : '';
        $cls         = 'rw-proy-gallery__item' . ( $is_featured ? ' rw-proy-gallery__item--featured' : '' ) . ' reveal' . $delay;
      ?>
        <div class="<?php echo esc_attr( $cls ); ?>" data-index="<?php echo $i; ?>">
          <img
            src="<?php echo esc_url( $img['src'] ); ?>"
            alt="<?php echo esc_attr( $img['alt'] ); ?>"
            loading="<?php echo $is_featured ? 'eager' : 'lazy'; ?>"
          >
          <div class="rw-proy-gallery__overlay" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
            </svg>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>


<!-- Lightbox Modal -->
<div class="rw-lightbox" id="rw-lightbox" role="dialog" aria-modal="true" aria-label="Visor de imágenes" hidden>
  <button class="rw-lightbox__close" id="rw-lb-close" aria-label="Cerrar visor">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
    </svg>
  </button>
  <button class="rw-lightbox__nav rw-lightbox__nav--prev" id="rw-lb-prev" aria-label="Imagen anterior">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="28" height="28">
      <line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/>
    </svg>
  </button>
  <div class="rw-lightbox__img-wrap">
    <img src="" alt="" id="rw-lb-img" class="rw-lightbox__img">
  </div>
  <button class="rw-lightbox__nav rw-lightbox__nav--next" id="rw-lb-next" aria-label="Imagen siguiente">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="28" height="28">
      <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
    </svg>
  </button>
  <div class="rw-lightbox__counter" id="rw-lb-counter" aria-live="polite"></div>
</div>


<!-- ══════════════════════════════════════
     CTA
══════════════════════════════════════ -->
<section class="rw-proy-cta">
  <div class="rw-container">
    <div class="rw-proy-cta__inner reveal">
      <div class="rw-proy-cta__text">
        <span class="rw-eyebrow rw-eyebrow--light">Reed Wood</span>
        <h2>¿Tienes un proyecto en mente?</h2>
      </div>
      <div class="rw-proy-cta__actions">
        <a href="<?php echo home_url('/#proyectos'); ?>" class="rw-btn rw-btn--outline-light">
          Ver más proyectos
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
          </svg>
        </a>
        <a href="<?php echo home_url('/#contacto'); ?>" class="rw-btn rw-btn--primary">
          Contáctanos
          <svg viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- Scripts -->
<script src="<?php echo get_template_directory_uri(); ?>/main.js"></script>
<script>
/* ── Scroll Reveal (por si main.js no lo activó aún) ── */
(function () {
  if (!('IntersectionObserver' in window)) {
    document.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(el => el.classList.add('is-visible'));
    return;
  }
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('is-visible'); obs.unobserve(e.target); } });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  document.querySelectorAll('.reveal,.reveal-left,.reveal-right').forEach(el => obs.observe(el));
})();

/* ── Lightbox ── */
(function () {
  const lb        = document.getElementById('rw-lightbox');
  const lbImg     = document.getElementById('rw-lb-img');
  const lbClose   = document.getElementById('rw-lb-close');
  const lbPrev    = document.getElementById('rw-lb-prev');
  const lbNext    = document.getElementById('rw-lb-next');
  const lbCounter = document.getElementById('rw-lb-counter');
  const items     = Array.from(document.querySelectorAll('.rw-proy-gallery__item'));
  if (!lb || !items.length) return;

  const images = items.map(el => ({ src: el.querySelector('img').src, alt: el.querySelector('img').alt }));
  let current  = 0;

  function openAt(i) {
    current = (i + images.length) % images.length;
    lbImg.src = images[current].src;
    lbImg.alt = images[current].alt;
    lbCounter.textContent = (current + 1) + ' / ' + images.length;
    lb.hidden = false;
    document.body.style.overflow = 'hidden';
    lbClose.focus();
  }
  function close() { lb.hidden = true; document.body.style.overflow = ''; }

  lbClose.addEventListener('click', close);
  lbPrev.addEventListener('click',  () => openAt(current - 1));
  lbNext.addEventListener('click',  () => openAt(current + 1));
  lb.addEventListener('click', e => { if (e.target === lb) close(); });

  items.forEach((item, i) => {
    item.style.cursor = 'pointer';
    item.addEventListener('click', () => openAt(i));
    item.setAttribute('tabindex', '0');
    item.addEventListener('keydown', e => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openAt(i); } });
  });

  document.addEventListener('keydown', e => {
    if (lb.hidden) return;
    if (e.key === 'Escape')     close();
    if (e.key === 'ArrowLeft')  openAt(current - 1);
    if (e.key === 'ArrowRight') openAt(current + 1);
  });
})();
</script>

<?php get_footer(); ?>
