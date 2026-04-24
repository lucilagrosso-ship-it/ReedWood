<?php
/**
 * functions.php — Reedwood Theme
 */

/* ── Theme Setup ── */
add_action( 'after_setup_theme', function() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo' );

    register_nav_menus( [
        'primary' => __( 'Menú Principal', 'reedwood' ),
        'footer'  => __( 'Menú Footer', 'reedwood' ),
    ] );
} );

/* ── Enqueue Scripts & Styles ── */
add_action( 'wp_enqueue_scripts', function() {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();

    // Main stylesheet
    wp_enqueue_style( 'reedwood-styles', $uri . '/styles.css', [], filemtime( $dir . '/styles.css' ) );

    // GSAP (CDN)
    wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', [], '3.12.5', true );

    // Main JS (depends on GSAP)
    wp_enqueue_script( 'reedwood-main', $uri . '/main.js', [ 'gsap' ], filemtime( $dir . '/main.js' ), true );

    // Pass REST API base URL to JS
    wp_localize_script( 'reedwood-main', 'rwData', [
        'restUrl' => esc_url_raw( rest_url() ),
        'nonce'   => wp_create_nonce( 'wp_rest' ),
    ] );

    // Mass Timber GSAP slider (inline, depends on reedwood-main)
    $mt_slider = <<<'GSAP'
(function initMtSlider() {
  var slides  = document.querySelectorAll('.rw-mt-img-slide');
  var curEl   = document.querySelector('.rw-mt-img-cur');
  var progBar = document.querySelector('.rw-mt-img-progress-bar');
  var prevBtn = document.querySelector('.rw-mt-img-prev');
  var nextBtn = document.querySelector('.rw-mt-img-next');
  if (!slides.length || typeof gsap === 'undefined') return;

  var TOTAL = slides.length;
  var DUR   = 5000;
  var current = 0;
  var progTween, timer;

  function pad(n) { return String(n + 1).padStart(2, '0'); }

  gsap.set(slides, { opacity: 0 });
  gsap.set(slides[0], { opacity: 1 });
  slides[0].classList.add('is-active');

  function animProgress() {
    if (!progBar) return;
    if (progTween) progTween.kill();
    gsap.set(progBar, { width: '0%' });
    progTween = gsap.to(progBar, { width: '100%', duration: DUR / 1000, ease: 'none' });
  }

  function goTo(next) {
    next = ((next % TOTAL) + TOTAL) % TOTAL;
    if (next === current) return;
    gsap.to(slides[current], { opacity: 0, duration: 0.6, ease: 'power2.inOut' });
    gsap.fromTo(slides[next],
      { opacity: 0, scale: 1.04 },
      { opacity: 1, scale: 1, duration: 0.8, ease: 'power2.out' }
    );
    slides[current].classList.remove('is-active');
    slides[next].classList.add('is-active');
    current = next;
    if (curEl) curEl.textContent = pad(current);
    animProgress();
  }

  function start() {
    clearInterval(timer);
    timer = setInterval(function() { goTo(current + 1); }, DUR);
  }

  if (prevBtn) prevBtn.addEventListener('click', function() { goTo(current - 1); start(); animProgress(); });
  if (nextBtn) nextBtn.addEventListener('click', function() { goTo(current + 1); start(); animProgress(); });

  animProgress();
  start();
})();
GSAP;
    wp_add_inline_script( 'reedwood-main', $mt_slider );
} );
