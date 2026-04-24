<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ══════════════════════════════════════
     HEADER — Reed Wood
══════════════════════════════════════ -->
<nav id="rw-nav" class="rw-nav" role="navigation" aria-label="Navegación principal">
  <div class="rw-nav__inner">

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>#inicio" class="rw-nav__logo" aria-label="Reed Wood — Inicio">
      <img
        src="/bv-wp-content/uploads/2026/03/blancorw.png"
        alt="Reed Wood"
        style="height:48px;width:auto;display:block;"
      >
    </a>

    <div class="rw-nav__links" role="list">
      <a href="#nosotros">Nosotros</a>
      <a href="#servicios">Servicios</a>
      <a href="#mass-timber">Mass Timber</a>
      <a href="#proyectos">Proyectos</a>
      <a href="#clientes">Clientes</a>
    </div>

    <a href="#contacto" class="rw-btn rw-btn--primary rw-nav__cta">Contáctanos</a>

    <button
      id="rw-menu-btn"
      class="rw-nav__burger"
      aria-label="Abrir menú"
      aria-expanded="false"
      aria-controls="rw-mobile-menu"
    >
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- Mobile Overlay -->
<div id="rw-mobile-overlay" class="rw-mobile-overlay" aria-hidden="true"></div>

<!-- Mobile Menu -->
<div id="rw-mobile-menu" class="rw-mobile-menu" role="dialog" aria-modal="true" aria-label="Menú de navegación">

  <nav class="rw-mobile-menu__nav">
    <a href="#nosotros"   class="rw-mobile-menu__link">Nosotros</a>
    <a href="#servicios"  class="rw-mobile-menu__link">Servicios</a>
    <a href="#proyectos"  class="rw-mobile-menu__link">Proyectos</a>
    <a href="#mass-timber" class="rw-mobile-menu__link">Mass Timber</a>
    <a href="#contacto"  class="rw-mobile-menu__link rw-mobile-menu__link--cta">Contacto</a>
  </nav>

</div>
