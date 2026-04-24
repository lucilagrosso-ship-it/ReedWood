/* ============================================
   REED WOOD — main.js
   ============================================ */

/* ── Navbar scroll ─────────────────────────── */
(function () {
  const nav = document.getElementById('rw-nav');
  if (!nav) return;
  const onScroll = () => nav.classList.toggle('rw-nav--scrolled', window.scrollY > 60);
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
})();

/* ── Mobile menu ───────────────────────────── */
(function () {
  const btn     = document.getElementById('rw-menu-btn');
  const menu    = document.getElementById('rw-mobile-menu');
  const overlay = document.getElementById('rw-mobile-overlay');
  if (!btn || !menu) return;

  function openMenu() {
    menu.classList.add('is-open');
    overlay && overlay.classList.add('is-open');
    btn.setAttribute('aria-expanded', 'true');
    btn.setAttribute('aria-label', 'Cerrar menú');
    document.body.style.overflow = 'hidden';
  }

  function closeMenu() {
    menu.classList.remove('is-open');
    overlay && overlay.classList.remove('is-open');
    btn.setAttribute('aria-expanded', 'false');
    btn.setAttribute('aria-label', 'Abrir menú');
    document.body.style.overflow = '';
  }

  btn.addEventListener('click', () => {
    menu.classList.contains('is-open') ? closeMenu() : openMenu();
  });
  overlay && overlay.addEventListener('click', closeMenu);

  menu.querySelectorAll('.rw-mobile-menu__link').forEach(a => {
    a.addEventListener('click', closeMenu);
  });
})();

/* ── Smooth scroll ─────────────────────────── */
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth' });
    }
  });
});

/* ── Hero Slider ───────────────────────────── */
(function initSlider() {
  const slides = document.querySelectorAll('.rw-slide');
  const dots   = document.querySelectorAll('.rw-dot');
  const curEl  = document.getElementById('rw-cur');
  const prog   = document.getElementById('rw-progress');
  if (!slides.length) return;

  const DUR = 6000;
  let current = 0, timer;

  function pad(n) { return String(n + 1).padStart(2, '0'); }

  function goTo(n) {
    slides[current].classList.remove('active');
    if (dots[current]) dots[current].classList.remove('active');
    current = (n + slides.length) % slides.length;
    slides[current].classList.add('active');
    if (dots[current]) dots[current].classList.add('active');
    if (curEl) curEl.textContent = pad(current);
    animProgress();
  }

  function animProgress() {
    if (!prog) return;
    prog.style.transition = 'none';
    prog.style.width = '0%';
    requestAnimationFrame(() => requestAnimationFrame(() => {
      prog.style.transition = `width ${DUR}ms linear`;
      prog.style.width = '100%';
    }));
  }

  function start() {
    clearInterval(timer);
    timer = setInterval(() => goTo(current + 1), DUR);
  }

  const prevBtn = document.getElementById('rw-prev');
  const nextBtn = document.getElementById('rw-next');
  if (prevBtn) prevBtn.addEventListener('click', () => { goTo(current - 1); start(); });
  if (nextBtn) nextBtn.addEventListener('click', () => { goTo(current + 1); start(); });
  dots.forEach((d, i) => d.addEventListener('click', () => { goTo(i); start(); }));

  // Pause on hover
  const slider = document.getElementById('rw-slider');
  if (slider) {
    slider.addEventListener('mouseenter', () => clearInterval(timer));
    slider.addEventListener('mouseleave', () => start());
  }

  // Touch/swipe support
  if (slider) {
    let touchStartX = 0;
    slider.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
    slider.addEventListener('touchend', e => {
      const dx = e.changedTouches[0].clientX - touchStartX;
      if (Math.abs(dx) > 50) { goTo(dx < 0 ? current + 1 : current - 1); start(); }
    }, { passive: true });
  }

  animProgress();
  start();
})();

/* ── Scroll Reveal ─────────────────────────── */
(function initReveal() {
  const els = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
  if (!els.length || !('IntersectionObserver' in window)) {
    els.forEach(el => el.classList.add('is-visible'));
    return;
  }
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
  els.forEach(el => observer.observe(el));
})();

/* ── Counter animation ─────────────────────── */
(function initCounters() {
  const counters = document.querySelectorAll('.rw-counter-num');
  if (!counters.length || !('IntersectionObserver' in window)) return;

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      const target  = parseInt(el.dataset.target, 10);
      const suffix  = el.dataset.suffix || '';
      const start   = performance.now();
      const dur     = 1600;

      function step(now) {
        const p = Math.min((now - start) / dur, 1);
        const eased = 1 - Math.pow(1 - p, 3); // easeOutCubic
        el.textContent = Math.floor(eased * target) + suffix;
        if (p < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
      observer.unobserve(el);
    });
  }, { threshold: 0.5 });

  counters.forEach(el => observer.observe(el));
})();

/* ── Contact form ──────────────────────────── */
(function initForm() {
  const form = document.getElementById('rw-contact-form');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    const btn     = form.querySelector('.rw-form__submit');
    const success = form.querySelector('.rw-form__success');

    btn.disabled = true;
    btn.textContent = 'Enviando…';

    // Simulate async send — replace with real fetch() to your endpoint
    setTimeout(() => {
      if (success) success.classList.add('is-visible');
      btn.style.display = 'none';
      form.querySelectorAll('input, select, textarea').forEach(f => { f.disabled = true; });
    }, 1200);
  });
})();

/* ── Projects Carousel ─────────────────────── */
(function initProjCarousel() {
  const track   = document.getElementById('rw-proj-track');
  const prevBtn = document.getElementById('rw-proj-prev');
  const nextBtn = document.getElementById('rw-proj-next');
  if (!track) return;

  // ── Configuración ──────────────────────────
  const WP_BASE   = 'https://reedwood12968.e.wpstage.net/wp-json/wp/v2';
  const CPT_SLUG  = 'proyecto';       // Cambia si el slug del CPT es distinto
  const LOC_FIELD = 'ubiacion';       // Nombre del campo en Pods
  const PIN_SVG   = `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
    stroke-linecap="round" stroke-linejoin="round" width="13" height="13">
    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
    <circle cx="12" cy="10" r="3"/></svg>`;

  // ── Render de una card ─────────────────────
  function buildCard(p, delay) {
    const img    = p._embedded?.['wp:featuredmedia']?.[0]?.source_url || '';
    const title  = p.title?.rendered || '';
    const loc    = p[LOC_FIELD] || p.acf?.[LOC_FIELD] || p.meta?.[LOC_FIELD] || '';
    const link   = p.link || (p.slug ? `proyectos.html?slug=${p.slug}` : '#proyectos');

    const card = document.createElement('a');
    card.href = link;
    card.className = 'rw-pcard reveal' + (delay ? ' reveal-delay-' + delay : '');
    card.innerHTML = `
      <div class="rw-pcard__img-wrap">
        <img src="${img}" alt="${title}" loading="lazy">
      </div>
      <div class="rw-pcard__info">
        <h3 class="rw-pcard__name">${title}</h3>
        ${loc ? `<p class="rw-pcard__loc">${PIN_SVG}${loc}</p>` : ''}
        <span class="rw-pcard__cta rw-btn rw-btn--outline-light">Ver proyecto <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="12" height="12"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
      </div>`;
    return card;
  }

  // ── Fetch desde la API de WordPress ────────
  async function loadProjects() {
    const url = `${WP_BASE}/${CPT_SLUG}?_embed&per_page=20`;
    console.log('[ReedWood] Fetching proyectos →', url);
    try {
      const res  = await fetch(url);
      console.log('[ReedWood] Respuesta status:', res.status);
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const data = await res.json();
      console.log('[ReedWood] Proyectos recibidos:', data.length, data);

      // Reemplaza skeletons con cards reales
      track.innerHTML = '';
      data.forEach((p, i) => {
        const delay = i < 5 ? i : 0;
        track.appendChild(buildCard(p, delay));
      });

      // Activa el scroll reveal para las nuevas cards
      if ('IntersectionObserver' in window) {
        const obs = new IntersectionObserver((entries) => {
          entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('is-visible'); obs.unobserve(e.target); }
          });
        }, { threshold: 0.1 });
        track.querySelectorAll('.rw-pcard').forEach(c => obs.observe(c));
      } else {
        track.querySelectorAll('.rw-pcard').forEach(c => c.classList.add('is-visible'));
      }

    } catch (err) {
      console.error('[ReedWood] API proyectos ERROR:', err.message);
      track.innerHTML = '<p style="color:rgba(255,255,255,.3);padding:1rem;">No se pudieron cargar los proyectos. Ver consola (F12).</p>';
    }
  }

  loadProjects();

  // ── Navegación ─────────────────────────────
  function getScrollAmount() {
    const card = track.querySelector('.rw-pcard');
    if (!card) return 300;
    return card.offsetWidth + (parseFloat(getComputedStyle(track).gap) || 20);
  }

  if (prevBtn) prevBtn.addEventListener('click', () => track.scrollBy({ left: -getScrollAmount(), behavior: 'smooth' }));
  if (nextBtn) nextBtn.addEventListener('click', () => track.scrollBy({ left:  getScrollAmount(), behavior: 'smooth' }));
})();
