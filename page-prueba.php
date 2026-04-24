<?php
/**
 * page-prueba.php — Quiénes Somos · Reed Wood
 */
get_header();
?>

<style>
/* ══════════════════════════════════════
   QUIÉNES SOMOS — Page-specific styles
   ══════════════════════════════════════ */

/* ── Hero ──────────────────────────────── */
.qs-hero {
  position: relative;
  height: 88vh;
  min-height: 560px;
  overflow: hidden;
  display: flex;
  align-items: flex-end;
  background: var(--rw-dark);
}
.qs-hero__bg {
  position: absolute;
  inset: 0;
  will-change: transform;
}
.qs-hero__bg img {
  width: 100%; height: 100%;
  object-fit: cover;
  filter: brightness(0.38);
  transform: scale(1.08);
  transition: transform 0s;
}
.qs-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background:
    linear-gradient(to top,  rgba(13,13,13,0.97) 0%, rgba(13,13,13,0.55) 45%, rgba(13,13,13,0.1) 100%),
    linear-gradient(to right, rgba(13,13,13,0.35) 0%, transparent 60%);
}
.qs-hero__content {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: var(--rw-max-w);
  margin-inline: auto;
  padding-inline: 2rem;
  padding-bottom: 5rem;
}
.qs-breadcrumb {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.6rem;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.35);
  margin-bottom: 1.75rem;
  opacity: 0;
  animation: qs-fade-up 0.7s ease 0.2s both;
}
.qs-breadcrumb a { color: inherit; transition: color var(--rw-t); }
.qs-breadcrumb a:hover { color: var(--rw-red); }
.qs-breadcrumb__sep { color: rgba(255,255,255,0.18); }
.qs-breadcrumb__cur { color: var(--rw-red); }

.qs-hero__label {
  display: inline-flex;
  align-items: center;
  gap: 0.8rem;
  font-size: 0.6rem;
  font-weight: 500;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.45);
  margin-bottom: 1.5rem;
  opacity: 0;
  animation: qs-slide-x 0.7s ease 0.35s both;
}
.qs-hero__label::before {
  content: '';
  width: 32px; height: 1px;
  background: var(--rw-red);
}

.qs-hero__title {
  font-size: clamp(2.8rem, 6vw, 5.5rem);
  font-weight: 300;
  line-height: 1.08;
  letter-spacing: -0.03em;
  color: var(--rw-white);
  max-width: 760px;
  overflow: hidden;
}
.qs-hero__title .word {
  display: inline-block;
  opacity: 0;
  transform: translateY(100%);
}
.qs-hero__title .accent { color: var(--rw-red); font-style: italic; }

.qs-hero__sub {
  margin-top: 1.75rem;
  font-size: 0.95rem;
  font-weight: 300;
  line-height: 1.85;
  color: rgba(255,255,255,0.42);
  max-width: 480px;
  opacity: 0;
  animation: qs-fade-up 0.8s ease 1.1s both;
}

.qs-hero__scroll {
  position: absolute;
  bottom: 2.5rem;
  right: 2.5rem;
  z-index: 2;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.55rem;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.3);
  animation: qs-fade-up 0.8s ease 1.3s both;
  opacity: 0;
}
.qs-hero__scroll-line {
  width: 1px; height: 48px;
  background: linear-gradient(to bottom, var(--rw-red), transparent);
  animation: qs-scroll-line 2s ease-in-out 1.5s infinite;
}
@keyframes qs-scroll-line {
  0%, 100% { transform: scaleY(1); transform-origin: top; opacity: 1; }
  50%       { transform: scaleY(0.3); transform-origin: bottom; opacity: 0.4; }
}

/* ── Manifiesto ──────────────────────────── */
.qs-manifesto {
  position: relative;
  background: var(--rw-dark);
  padding-block: 9rem;
  overflow: hidden;
  text-align: center;
}
.qs-manifesto__wm {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  pointer-events: none;
  opacity: 0.025;
}
.qs-manifesto__wm svg { width: min(80vw, 700px); height: auto; }
.qs-manifesto__inner {
  position: relative;
  z-index: 1;
  max-width: var(--rw-max-w);
  margin-inline: auto;
  padding-inline: 2rem;
}
.qs-manifesto__quote {
  font-family: var(--rw-font-display);
  font-size: clamp(1.7rem, 3.5vw, 3rem);
  font-weight: 300;
  line-height: 1.35;
  letter-spacing: -0.02em;
  color: var(--rw-white);
  max-width: 860px;
  margin-inline: auto;
}
.qs-manifesto__quote .word {
  display: inline-block;
  opacity: 0;
  transform: translateY(18px);
  transition: opacity 0.55s cubic-bezier(0.22,1,0.36,1), transform 0.55s cubic-bezier(0.22,1,0.36,1);
}
.qs-manifesto__quote.words-visible .word { opacity: 1; transform: translateY(0); }
.qs-manifesto__line {
  width: 0; height: 2px;
  background: var(--rw-red);
  margin: 2.5rem auto;
  border-radius: 2px;
  transition: width 0.9s cubic-bezier(0.22,1,0.36,1) 0.3s;
}
.qs-manifesto__line.is-visible { width: 64px; }
.qs-manifesto__caption {
  font-size: 0.62rem;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.28);
}

/* ── Historia ──────────────────────────────── */
.qs-historia {
  background: var(--rw-100);
  color: var(--rw-dark);
  padding-block: var(--rw-section-py);
  overflow: hidden;
}
.qs-historia__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 6rem;
  align-items: center;
  max-width: var(--rw-max-w);
  margin-inline: auto;
  padding-inline: 2rem;
}
.qs-historia__text h2 {
  color: var(--rw-dark);
  margin-top: 0.75rem;
  max-width: 440px;
}
.qs-historia__text p {
  font-size: 0.975rem;
  font-weight: 300;
  line-height: 1.95;
  color: var(--rw-600);
  margin-top: 1.25rem;
  max-width: 500px;
}
.qs-historia__accent {
  width: 0; height: 3px;
  background: var(--rw-red);
  margin: 1.75rem 0;
  border-radius: 2px;
  transition: width 0.7s cubic-bezier(0.22,1,0.36,1) 0.4s;
}
.qs-historia__text.is-visible .qs-historia__accent { width: 52px; }

/* Historia image composition */
.qs-historia__visual {
  position: relative;
  height: 560px;
}
.qs-historia__img {
  position: absolute;
  overflow: hidden;
  border-radius: var(--rw-r-lg);
}
.qs-historia__img img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform 0.7s cubic-bezier(0.22,1,0.36,1);
}
.qs-historia__img:hover img { transform: scale(1.04); }
.qs-historia__img--a {
  top: 0; left: 0;
  width: 80%; height: 60%;
  clip-path: inset(0 100% 0 0 round var(--rw-r-lg));
  transition: clip-path 0.95s cubic-bezier(0.22,1,0.36,1) 0.1s;
}
.qs-historia__visual.is-visible .qs-historia__img--a {
  clip-path: inset(0 0% 0 0 round var(--rw-r-lg));
}
.qs-historia__img--b {
  bottom: 0; right: 0;
  width: 60%; height: 52%;
  border: 5px solid var(--rw-100);
  clip-path: inset(100% 0 0 0 round var(--rw-r-lg));
  transition: clip-path 0.95s cubic-bezier(0.22,1,0.36,1) 0.42s;
  z-index: 2;
}
.qs-historia__visual.is-visible .qs-historia__img--b {
  clip-path: inset(0 0 0 0 round var(--rw-r-lg));
}
.qs-historia__badge {
  position: absolute;
  bottom: calc(52% - 12px);
  right: calc(40% - 12px);
  z-index: 10;
  background: var(--rw-red);
  color: var(--rw-white);
  border-radius: var(--rw-r);
  padding: 1.1rem 1.3rem;
  text-align: center;
  min-width: 96px;
  transform: scale(0);
  transition: transform 0.5s cubic-bezier(0.34,1.56,0.64,1) 0.92s;
}
.qs-historia__visual.is-visible .qs-historia__badge { transform: scale(1); }
.qs-historia__badge strong { display: block; font-size: 2rem; font-weight: 800; line-height: 1; }
.qs-historia__badge span { font-size: 0.55rem; letter-spacing: 0.12em; text-transform: uppercase; opacity: 0.85; margin-top: 0.2rem; display: block; }

.qs-historia__lines {
  position: absolute;
  top: 50%; left: -1.5rem;
  transform: translateY(-50%);
  display: flex; flex-direction: column; gap: 8px;
  z-index: 5;
}
.qs-historia__lines span {
  display: block; height: 3px; border-radius: 2px;
  background: var(--rw-red); width: 0;
  transition: width 0.55s ease;
}
.qs-historia__visual.is-visible .qs-historia__lines span:nth-child(1) { width: 48px; transition-delay: 0.20s; }
.qs-historia__visual.is-visible .qs-historia__lines span:nth-child(2) { width: 28px; transition-delay: 0.32s; }
.qs-historia__visual.is-visible .qs-historia__lines span:nth-child(3) { width: 56px; transition-delay: 0.44s; }
.qs-historia__visual.is-visible .qs-historia__lines span:nth-child(4) { width: 20px; transition-delay: 0.56s; }
.qs-historia__visual.is-visible .qs-historia__lines span:nth-child(5) { width: 40px; transition-delay: 0.68s; }

/* ── MVV ────────────────────────────────────── */
.qs-mvv {
  background: var(--rw-charcoal);
  padding-block: var(--rw-section-py);
  overflow: hidden;
}
.qs-mvv__header {
  text-align: center;
  margin-bottom: 4.5rem;
}
.qs-mvv__header h2 { color: var(--rw-white); }
.qs-mvv__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
  max-width: var(--rw-max-w);
  margin-inline: auto;
  padding-inline: 2rem;
}
.qs-mvv-card {
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: var(--rw-r-lg);
  padding: 2.5rem 2rem;
  position: relative;
  overflow: hidden;
  transition: background var(--rw-t), border-color var(--rw-t), transform 0.4s cubic-bezier(0.22,1,0.36,1);
  opacity: 0;
  transform: translateY(28px);
}
.qs-mvv-card.is-visible { opacity: 1; transform: translateY(0); }
.qs-mvv-card:hover {
  background: rgba(255,255,255,0.055);
  border-color: rgba(233,61,27,0.3);
  transform: translateY(-4px);
}
.qs-mvv-card__num {
  position: absolute;
  top: 1.5rem; right: 1.5rem;
  font-size: 4.5rem;
  font-weight: 800;
  color: rgba(255,255,255,0.03);
  line-height: 1;
  letter-spacing: -0.06em;
  user-select: none;
}
.qs-mvv-card__icon {
  width: 44px; height: 44px;
  background: rgba(233,61,27,0.12);
  border-radius: var(--rw-r-md);
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 1.5rem;
  transition: background var(--rw-t);
}
.qs-mvv-card:hover .qs-mvv-card__icon { background: rgba(233,61,27,0.22); }
.qs-mvv-card__icon svg { width: 20px; height: 20px; stroke: var(--rw-red); fill: none; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; }
.qs-mvv-card__tag {
  font-size: 0.58rem;
  letter-spacing: 0.2em;
  text-transform: uppercase;
  color: var(--rw-red);
  margin-bottom: 0.6rem;
}
.qs-mvv-card h3 {
  font-size: 1.4rem;
  font-weight: 400;
  color: var(--rw-white);
  margin-bottom: 1rem;
}
.qs-mvv-card p {
  font-size: 0.9rem;
  font-weight: 300;
  line-height: 1.85;
  color: rgba(255,255,255,0.48);
}
.qs-mvv-card__line {
  position: absolute;
  bottom: 0; left: 0;
  height: 2px;
  background: var(--rw-red);
  width: 0;
  transition: width 0.6s cubic-bezier(0.22,1,0.36,1);
}
.qs-mvv-card:hover .qs-mvv-card__line { width: 100%; }

/* ── Stats ──────────────────────────────────── */
.qs-stats {
  background: var(--rw-dark);
  padding-block: var(--rw-section-py);
  position: relative;
  overflow: hidden;
}
.qs-stats__wm {
  position: absolute;
  right: -4%; top: 50%;
  transform: translateY(-50%);
  width: min(50vw, 600px);
  opacity: 0.022;
  pointer-events: none;
  animation: rw-wm-float 20s ease-in-out infinite;
}
.qs-stats__grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 0;
  max-width: var(--rw-max-w);
  margin-inline: auto;
  padding-inline: 2rem;
  position: relative;
  z-index: 1;
}
.qs-stat-item {
  padding: 3rem 2rem;
  border-left: 1px solid rgba(255,255,255,0.07);
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s cubic-bezier(0.22,1,0.36,1), transform 0.6s cubic-bezier(0.22,1,0.36,1);
}
.qs-stat-item:first-child { border-left: none; }
.qs-stat-item.is-visible { opacity: 1; transform: translateY(0); }
.qs-stat-item__num {
  font-family: var(--rw-font-display);
  font-size: clamp(2.5rem, 4.5vw, 4rem);
  font-weight: 300;
  letter-spacing: -0.04em;
  color: var(--rw-red);
  line-height: 1;
  display: flex;
  align-items: baseline;
  gap: 0.1em;
}
.qs-stat-item__suffix {
  font-size: 0.45em;
  font-weight: 400;
  opacity: 0.7;
  letter-spacing: 0.05em;
}
.qs-stat-item__label {
  font-size: 0.62rem;
  letter-spacing: 0.14em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.36);
  margin-top: 0.6rem;
  line-height: 1.5;
}
.qs-stat-item__desc {
  font-size: 0.85rem;
  font-weight: 300;
  color: rgba(255,255,255,0.22);
  margin-top: 0.4rem;
  line-height: 1.6;
}

/* ── Pilares / ADN ────────────────────────── */
.qs-pilares {
  background: var(--rw-100);
  color: var(--rw-dark);
  padding-block: var(--rw-section-py);
}
.qs-pilares__inner {
  max-width: var(--rw-max-w);
  margin-inline: auto;
  padding-inline: 2rem;
}
.qs-pilares__header {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 5rem;
  gap: 2rem;
  flex-wrap: wrap;
}
.qs-pilares__header h2 { color: var(--rw-dark); max-width: 480px; }
.qs-pilares__header p {
  font-size: 0.9rem;
  font-weight: 300;
  line-height: 1.85;
  color: var(--rw-500);
  max-width: 360px;
}
.qs-pilares__list { display: grid; gap: 0; }
.qs-pilar {
  display: grid;
  grid-template-columns: 80px 1fr auto;
  align-items: start;
  gap: 2.5rem;
  padding-block: 2.5rem;
  border-top: 1px solid var(--rw-200);
  position: relative;
  overflow: hidden;
  opacity: 0;
  transform: translateX(-20px);
  transition: opacity 0.6s cubic-bezier(0.22,1,0.36,1), transform 0.6s cubic-bezier(0.22,1,0.36,1), background 0.3s;
}
.qs-pilar:last-child { border-bottom: 1px solid var(--rw-200); }
.qs-pilar.is-visible { opacity: 1; transform: translateX(0); }
.qs-pilar:hover { background: rgba(233,61,27,0.025); }
.qs-pilar::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0;
  height: 1px;
  background: var(--rw-red);
  width: 0;
  transition: width 0.5s cubic-bezier(0.22,1,0.36,1);
}
.qs-pilar:hover::after { width: 100%; }
.qs-pilar__num {
  font-family: var(--rw-font-display);
  font-size: 2.8rem;
  font-weight: 300;
  color: var(--rw-red);
  line-height: 1;
  letter-spacing: -0.04em;
  opacity: 0.6;
  padding-top: 0.1rem;
}
.qs-pilar__content h3 {
  font-size: 1.3rem;
  font-weight: 500;
  color: var(--rw-dark);
  margin-bottom: 0.75rem;
}
.qs-pilar__content p {
  font-size: 0.9rem;
  font-weight: 300;
  line-height: 1.85;
  color: var(--rw-500);
  max-width: 560px;
}
.qs-pilar__tag {
  font-size: 0.6rem;
  letter-spacing: 0.15em;
  text-transform: uppercase;
  color: rgba(233,61,27,0.55);
  white-space: nowrap;
  padding-top: 0.35rem;
}

/* ── Sustentabilidad ──────────────────────── */
.qs-sustent {
  background: var(--rw-charcoal);
  padding-block: var(--rw-section-py);
  overflow: hidden;
}
.qs-sustent__split {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 6rem;
  align-items: center;
  max-width: var(--rw-max-w);
  margin-inline: auto;
  padding-inline: 2rem;
}
.qs-sustent__text h2 { color: var(--rw-white); max-width: 420px; }
.qs-sustent__text p {
  font-size: 0.95rem;
  font-weight: 300;
  line-height: 1.95;
  color: rgba(255,255,255,0.48);
  margin-top: 1.25rem;
  max-width: 460px;
}
.qs-sustent__accent {
  width: 0; height: 3px;
  background: var(--rw-red);
  margin: 1.75rem 0;
  border-radius: 2px;
  transition: width 0.7s cubic-bezier(0.22,1,0.36,1) 0.4s;
}
.qs-sustent__text.is-visible .qs-sustent__accent { width: 52px; }

.qs-sustent__items {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin-top: 2.5rem;
}
.qs-sustent__item {
  display: flex;
  align-items: flex-start;
  gap: 0.875rem;
  padding: 1.25rem;
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.06);
  border-radius: var(--rw-r-md);
  transition: background var(--rw-t), border-color var(--rw-t);
}
.qs-sustent__item:hover {
  background: rgba(255,255,255,0.06);
  border-color: rgba(233,61,27,0.25);
}
.qs-sustent__item-icon {
  width: 36px; height: 36px; flex-shrink: 0;
  background: rgba(233,61,27,0.1);
  border-radius: var(--rw-r);
  display: flex; align-items: center; justify-content: center;
}
.qs-sustent__item-icon svg { width: 16px; height: 16px; stroke: var(--rw-red); fill: none; stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round; }
.qs-sustent__item-text strong {
  display: block;
  font-size: 0.75rem;
  font-weight: 500;
  color: var(--rw-white);
  margin-bottom: 0.2rem;
}
.qs-sustent__item-text span {
  font-size: 0.78rem;
  color: rgba(255,255,255,0.35);
  line-height: 1.5;
}

/* SVG tree ring decoration for sustentabilidad */
.qs-sustent__visual {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}
.qs-sustent__ring {
  width: min(42vw, 480px);
  height: auto;
  opacity: 0;
  transform: rotate(-15deg) scale(0.9);
  transition: opacity 0.9s cubic-bezier(0.22,1,0.36,1) 0.3s, transform 0.9s cubic-bezier(0.22,1,0.36,1) 0.3s;
}
.qs-sustent__visual.is-visible .qs-sustent__ring {
  opacity: 0.12;
  transform: rotate(0deg) scale(1);
}
.qs-sustent__co2 {
  position: absolute;
  text-align: center;
}
.qs-sustent__co2 strong {
  display: block;
  font-family: var(--rw-font-display);
  font-size: clamp(2.8rem, 5vw, 4.5rem);
  font-weight: 300;
  color: var(--rw-red);
  letter-spacing: -0.04em;
  line-height: 1;
}
.qs-sustent__co2 span {
  display: block;
  font-size: 0.62rem;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: rgba(255,255,255,0.35);
  margin-top: 0.6rem;
}

/* ── CTA ────────────────────────────────────── */
.qs-cta {
  background: var(--rw-dark);
  padding-block: 9rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.qs-cta__wm {
  position: absolute;
  inset: 0;
  display: flex; align-items: center; justify-content: center;
  pointer-events: none;
  opacity: 0.018;
}
.qs-cta__wm svg { width: min(70vw, 600px); height: auto; }
.qs-cta__inner {
  position: relative;
  z-index: 1;
  max-width: 680px;
  margin-inline: auto;
  padding-inline: 2rem;
}
.qs-cta h2 {
  font-size: clamp(2.2rem, 4.5vw, 3.6rem);
  font-weight: 300;
  color: var(--rw-white);
  letter-spacing: -0.03em;
  line-height: 1.15;
}
.qs-cta h2 em { color: var(--rw-red); font-style: normal; }
.qs-cta p {
  font-size: 0.95rem;
  font-weight: 300;
  line-height: 1.85;
  color: rgba(255,255,255,0.42);
  margin-top: 1.25rem;
  margin-bottom: 2.5rem;
}
.qs-cta__btns {
  display: flex;
  justify-content: center;
  gap: 1rem;
  flex-wrap: wrap;
}

/* ── Global animations ──────────────────────── */
@keyframes qs-fade-up {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes qs-slide-x {
  from { opacity: 0; transform: translateX(-16px); }
  to   { opacity: 1; transform: translateX(0); }
}

/* ── Responsive ─────────────────────────────── */
@media (max-width: 1024px) {
  .qs-stats__grid { grid-template-columns: repeat(2, 1fr); }
  .qs-stat-item:nth-child(3) { border-left: none; }
  .qs-mvv__grid { grid-template-columns: 1fr; max-width: 520px; }
}
@media (max-width: 768px) {
  .qs-historia__grid,
  .qs-sustent__split { grid-template-columns: 1fr; gap: 3rem; }
  .qs-historia__visual { height: 360px; }
  .qs-sustent__visual { display: none; }
  .qs-stats__grid { grid-template-columns: 1fr 1fr; }
  .qs-stat-item { border-left: none; border-top: 1px solid rgba(255,255,255,0.07); }
  .qs-stat-item:nth-child(-n+2) { border-top: none; }
  .qs-pilar { grid-template-columns: 52px 1fr; }
  .qs-pilar__tag { display: none; }
  .qs-sustent__items { grid-template-columns: 1fr; }
  .qs-pilares__header { flex-direction: column; align-items: flex-start; }
  .qs-hero__scroll { display: none; }
}
@media (max-width: 520px) {
  .qs-stats__grid { grid-template-columns: 1fr; }
  .qs-stat-item { border-top: 1px solid rgba(255,255,255,0.07); border-left: none; }
}
</style>


<!-- ══════════════════════════════════════
     HERO
══════════════════════════════════════ -->
<section class="qs-hero" aria-label="Quiénes somos">

  <div class="qs-hero__bg" id="qs-parallax-bg">
    <img
      src="https://reedwood12968.e.wpstage.net/bv-wp-content/uploads/2026/04/DJI_20251121225314_0080_D_websize-2-1.jpg"
      alt="Reed Wood — Vista aérea de proyecto Mass Timber"
      loading="eager"
    >
  </div>

  <div class="qs-hero__content">
    <nav class="qs-breadcrumb" aria-label="Breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Inicio</a>
      <span class="qs-breadcrumb__sep">&#47;</span>
      <span class="qs-breadcrumb__cur">Quiénes somos</span>
    </nav>

    <div class="qs-hero__label" aria-hidden="true">
      Pioneros en Mass Timber · México
    </div>

    <h1 class="qs-hero__title" id="qs-hero-title">
      Construimos<br>con <span class="accent">propósito</span><br>e innovación
    </h1>

    <p class="qs-hero__sub">
      Una empresa mexicana que está redefiniendo la construcción con madera de ingeniería estructural. Desde la investigación hasta la ejecución, con compromiso ambiental en cada paso.
    </p>
  </div>

  <div class="qs-hero__scroll" aria-hidden="true">
    <span>Scroll</span>
    <div class="qs-hero__scroll-line"></div>
  </div>

</section>


<!-- ══════════════════════════════════════
     MANIFIESTO
══════════════════════════════════════ -->
<section class="qs-manifesto" aria-label="Manifiesto">

  <div class="qs-manifesto__wm" aria-hidden="true">
    <svg viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="300" cy="300" r="292" stroke="#fff" stroke-width="2.5"/>
      <circle cx="300" cy="300" r="270" stroke="#fff" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="248" stroke="#fff" stroke-width="2"/>
      <circle cx="300" cy="300" r="225" stroke="#fff" stroke-width="1"/>
      <circle cx="300" cy="300" r="206" stroke="#fff" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="185" stroke="#fff" stroke-width="1"/>
      <circle cx="300" cy="300" r="166" stroke="#fff" stroke-width="2"/>
      <circle cx="300" cy="300" r="146" stroke="#fff" stroke-width="1"/>
      <circle cx="300" cy="300" r="128" stroke="#fff" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="110" stroke="#fff" stroke-width="1"/>
      <circle cx="300" cy="300" r="92"  stroke="#fff" stroke-width="2"/>
      <circle cx="300" cy="300" r="75"  stroke="#fff" stroke-width="1"/>
      <circle cx="300" cy="300" r="59"  stroke="#fff" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="44"  stroke="#fff" stroke-width="1"/>
      <circle cx="300" cy="300" r="30"  stroke="#fff" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="17"  stroke="#fff" stroke-width="1"/>
      <circle cx="300" cy="300" r="7" fill="#fff"/>
      <line x1="300" y1="8" x2="300" y2="592" stroke="#fff" stroke-width="0.8"/>
      <line x1="8"   y1="300" x2="592" y2="300" stroke="#fff" stroke-width="0.8"/>
      <line x1="92" y1="92" x2="508" y2="508" stroke="#fff" stroke-width="0.5" opacity="0.7"/>
      <line x1="508" y1="92" x2="92"  y2="508" stroke="#fff" stroke-width="0.5" opacity="0.7"/>
    </svg>
  </div>

  <div class="qs-manifesto__inner">
    <span class="rw-eyebrow rw-eyebrow--light reveal">Nuestra identidad</span>
    <p class="qs-manifesto__quote" id="qs-quote">
      Reed Wood no es solo una empresa constructora — es una visión de futuro hecha madera. Creemos que construir mejor es construir con menos impacto, más precisión y mayor respeto por el planeta.
    </p>
    <div class="qs-manifesto__line reveal"></div>
    <p class="qs-manifesto__caption reveal">Reed Wood · México · Est. 2018</p>
  </div>

</section>


<!-- ══════════════════════════════════════
     HISTORIA
══════════════════════════════════════ -->
<section class="qs-historia rw-section" aria-label="Nuestra historia">
  <div class="qs-historia__grid">

    <div class="qs-historia__text reveal-left">
      <span class="rw-eyebrow">Nuestra historia</span>
      <h2>Pioneros desde<br>el primer día</h2>
      <div class="qs-historia__accent"></div>
      <p>Reed Wood nació de una convicción: México merecía acceder a la tecnología constructiva más avanzada del mundo. Fundada por un equipo de ingenieros y arquitectos apasionados por los sistemas Mass Timber, la empresa se convirtió en pionera en desarrollar, producir y montar estructuras de madera de ingeniería a nivel nacional.</p>
      <p>Desde nuestra primera obra hasta hoy, hemos instalado más de 50,000 m² de estructuras Mass Timber en México, el Caribe y Sudamérica, trabajando junto a los arquitectos y desarrolladores más exigentes de la región.</p>
      <p>Contamos con una planta de producción en México y alianzas estratégicas con proveedores en Uruguay y Argentina, lo que nos permite responder a proyectos de cualquier escala con la más alta calidad y trazabilidad de materiales.</p>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>#proyectos" class="rw-btn rw-btn--outline-dark" style="margin-top:2rem;">
        Ver proyectos
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
      </a>
    </div>

    <div class="qs-historia__visual" id="qs-historia-visual">
      <div class="qs-historia__lines" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span>
      </div>
      <div class="qs-historia__img qs-historia__img--a">
        <img
          src="https://reedwood12968.e.wpstage.net/bv-wp-content/uploads/2026/04/IMG_6711-1-scaled.jpeg"
          alt="Estructura Mass Timber Reed Wood"
          loading="lazy"
        >
      </div>
      <div class="qs-historia__img qs-historia__img--b">
        <img
          src="https://reedwood12968.e.wpstage.net/bv-wp-content/uploads/2026/04/WhatsApp-Image-2026-04-16-at-5.04.32-PM.jpeg"
          alt="Equipo Reed Wood en obra"
          loading="lazy"
        >
      </div>
      <div class="qs-historia__badge">
        <strong>+50k</strong>
        <span>m² instalados</span>
      </div>
    </div>

  </div>
</section>


<!-- ══════════════════════════════════════
     MISIÓN · VISIÓN · VALORES
══════════════════════════════════════ -->
<section class="qs-mvv rw-section" aria-label="Misión, visión y valores">
  <div class="rw-container">

    <header class="qs-mvv__header">
      <span class="rw-eyebrow rw-eyebrow--light reveal">ADN Reed Wood</span>
      <h2 class="reveal reveal-delay-1">Lo que nos define</h2>
    </header>

    <div class="qs-mvv__grid">

      <!-- Misión -->
      <div class="qs-mvv-card" data-delay="0">
        <div class="qs-mvv-card__num" aria-hidden="true">01</div>
        <div class="qs-mvv-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="12" cy="12" r="3"/>
            <path d="M12 2v3M12 19v3M4.22 4.22l2.12 2.12M17.66 17.66l2.12 2.12M2 12h3M19 12h3M4.22 19.78l2.12-2.12M17.66 6.34l2.12-2.12"/>
          </svg>
        </div>
        <div class="qs-mvv-card__tag">Misión</div>
        <h3>Construir diferente</h3>
        <p>Crear edificaciones de alto desempeño, sostenibles y eficientes, utilizando madera de ingeniería certificada proveniente de plantaciones forestales responsables, desde la conceptualización hasta la ejecución en obra.</p>
        <div class="qs-mvv-card__line"></div>
      </div>

      <!-- Visión -->
      <div class="qs-mvv-card" data-delay="120">
        <div class="qs-mvv-card__num" aria-hidden="true">02</div>
        <div class="qs-mvv-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
          </svg>
        </div>
        <div class="qs-mvv-card__tag">Visión</div>
        <h3>Liderar el futuro</h3>
        <p>Ser la empresa referente en América Latina en sistemas Mass Timber, impulsando un cambio de paradigma en la industria de la construcción hacia modelos más responsables, eficientes y alineados con los estándares ESG globales.</p>
        <div class="qs-mvv-card__line"></div>
      </div>

      <!-- Valores -->
      <div class="qs-mvv-card" data-delay="240">
        <div class="qs-mvv-card__num" aria-hidden="true">03</div>
        <div class="qs-mvv-card__icon">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
          </svg>
        </div>
        <div class="qs-mvv-card__tag">Valores</div>
        <h3>Nuestros principios</h3>
        <p>Innovación técnica continua · Compromiso ambiental genuino · Excelencia constructiva · Transparencia con clientes y socios · Responsabilidad en cada proyecto, desde el primer trazo hasta la última pieza instalada.</p>
        <div class="qs-mvv-card__line"></div>
      </div>

    </div>
  </div>
</section>


<!-- ══════════════════════════════════════
     ESTADÍSTICAS
══════════════════════════════════════ -->
<section class="qs-stats" aria-label="Números que nos definen">

  <div class="qs-stats__wm" aria-hidden="true">
    <svg viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="300" cy="300" r="290" stroke="#e93d1b" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="260" stroke="#e93d1b" stroke-width="1"/>
      <circle cx="300" cy="300" r="230" stroke="#e93d1b" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="200" stroke="#e93d1b" stroke-width="1"/>
      <circle cx="300" cy="300" r="170" stroke="#e93d1b" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="140" stroke="#e93d1b" stroke-width="1"/>
      <circle cx="300" cy="300" r="110" stroke="#e93d1b" stroke-width="1.5"/>
      <circle cx="300" cy="300" r="80"  stroke="#e93d1b" stroke-width="1"/>
      <circle cx="300" cy="300" r="52"  stroke="#e93d1b" stroke-width="1.2"/>
      <circle cx="300" cy="300" r="28"  stroke="#e93d1b" stroke-width="1"/>
      <circle cx="300" cy="300" r="9" fill="#e93d1b"/>
    </svg>
  </div>

  <div class="rw-container" style="position:relative;z-index:1;">
    <header style="text-align:center; margin-bottom:4rem;">
      <span class="rw-eyebrow rw-eyebrow--light reveal">Impacto real</span>
      <h2 class="reveal reveal-delay-1">Números que<br>hablan por nosotros</h2>
    </header>
  </div>

  <div class="qs-stats__grid">

    <div class="qs-stat-item" data-target="50000" data-suffix="m²">
      <div class="qs-stat-item__num">
        <span class="qs-counter">0</span>
        <span class="qs-stat-item__suffix">m²+</span>
      </div>
      <div class="qs-stat-item__label">Instalados</div>
      <div class="qs-stat-item__desc">en México, el Caribe y Sudamérica</div>
    </div>

    <div class="qs-stat-item" data-delay="100" data-target="7" data-suffix="+">
      <div class="qs-stat-item__num">
        <span class="qs-counter">0</span>
        <span class="qs-stat-item__suffix">+</span>
      </div>
      <div class="qs-stat-item__label">Años de experiencia</div>
      <div class="qs-stat-item__desc">liderando Mass Timber en México</div>
    </div>

    <div class="qs-stat-item" data-delay="200" data-target="3" data-suffix=" países">
      <div class="qs-stat-item__num">
        <span class="qs-counter">0</span>
        <span class="qs-stat-item__suffix"> países</span>
      </div>
      <div class="qs-stat-item__label">Presencia internacional</div>
      <div class="qs-stat-item__desc">México · Caribe · Sudamérica</div>
    </div>

    <div class="qs-stat-item" data-delay="300" data-target="4" data-suffix="">
      <div class="qs-stat-item__num">
        <span class="qs-counter">0</span>
        <span class="qs-stat-item__suffix"> áreas</span>
      </div>
      <div class="qs-stat-item__label">Solución integral</div>
      <div class="qs-stat-item__desc">ingeniería · producción · montaje · acabados</div>
    </div>

  </div>
</section>


<!-- ══════════════════════════════════════
     PILARES / METODOLOGÍA
══════════════════════════════════════ -->
<section class="qs-pilares" aria-label="Nuestros pilares">
  <div class="qs-pilares__inner">

    <header class="qs-pilares__header">
      <div>
        <span class="rw-eyebrow reveal">Metodología</span>
        <h2 class="reveal reveal-delay-1">Cuatro pilares,<br>una solución total</h2>
      </div>
      <p class="reveal reveal-delay-2">En Reed Wood ofrecemos un servicio 360° que acompaña cada proyecto desde la ingeniería conceptual hasta la última pieza en obra.</p>
    </header>

    <div class="qs-pilares__list">

      <div class="qs-pilar" data-delay="0">
        <div class="qs-pilar__num" aria-hidden="true">01</div>
        <div class="qs-pilar__content">
          <h3>Ingeniería y Consultoría</h3>
          <p>Consultoría estructural especializada en madera de ingeniería, respaldada por un equipo in-house con amplia experiencia en sistemas Mass Timber. Analizamos cada proyecto desde sus cimientos para entregar soluciones óptimas, seguras y certificadas.</p>
        </div>
        <span class="qs-pilar__tag">CLT · Glulam</span>
      </div>

      <div class="qs-pilar" data-delay="80">
        <div class="qs-pilar__num" aria-hidden="true">02</div>
        <div class="qs-pilar__content">
          <h3>Producción y Abastecimiento</h3>
          <p>Capacidad productiva única en México con planta local y red estratégica de proveedores internacionales en Uruguay y Argentina. Abastecemos proyectos de cualquier escala con trazabilidad total de la madera y certificaciones forestales.</p>
        </div>
        <span class="qs-pilar__tag">FSC · PEFC</span>
      </div>

      <div class="qs-pilar" data-delay="160">
        <div class="qs-pilar__num" aria-hidden="true">03</div>
        <div class="qs-pilar__content">
          <h3>Montaje y Construcción</h3>
          <p>Capacidad técnica y operativa para montar proyectos complejos de estructuras de madera. Más de 50,000 m² instalados avalan nuestra experiencia en obras de cualquier complejidad, con equipos especializados y protocolos de seguridad de primer nivel.</p>
        </div>
        <span class="qs-pilar__tag">In-situ</span>
      </div>

      <div class="qs-pilar" data-delay="240">
        <div class="qs-pilar__num" aria-hidden="true">04</div>
        <div class="qs-pilar__content">
          <h3>Laboratorio de Acabados</h3>
          <p>Laboratorio especializado donde desarrollamos y aplicamos tratamientos de alta calidad para proteger y realzar la madera en cada proyecto. Desde barnices naturales hasta sistemas de protección UV y retardantes al fuego certificados.</p>
        </div>
        <span class="qs-pilar__tag">Premium</span>
      </div>

    </div>
  </div>
</section>


<!-- ══════════════════════════════════════
     SUSTENTABILIDAD
══════════════════════════════════════ -->
<section class="qs-sustent" aria-label="Compromiso ambiental">
  <div class="qs-sustent__split">

    <div class="qs-sustent__text reveal-left">
      <span class="rw-eyebrow rw-eyebrow--light">Sustentabilidad</span>
      <h2>Construimos<br>con balance<br>positivo de carbono</h2>
      <div class="qs-sustent__accent"></div>
      <p>La madera es el único material estructural renovable que actúa como sumidero de CO₂ durante toda la vida útil del edificio. En Reed Wood, cada metro cuadrado instalado es una decisión ambiental consciente.</p>
      <p>Trabajamos exclusivamente con madera proveniente de plantaciones forestales certificadas, garantizando que cada árbol utilizado forme parte de un ciclo forestal sostenible y regenerativo.</p>

      <div class="qs-sustent__items" style="margin-top:2rem;">
        <div class="qs-sustent__item reveal" style="--delay:0.1s">
          <div class="qs-sustent__item-icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22V12M12 12C12 7 17 3 21 3c0 5-3 9-9 9zM12 12C12 7 7 3 3 3c0 5 3 9 9 9z"/></svg>
          </div>
          <div class="qs-sustent__item-text">
            <strong>Madera certificada</strong>
            <span>FSC y PEFC en todos nuestros materiales</span>
          </div>
        </div>
        <div class="qs-sustent__item reveal" style="--delay:0.2s">
          <div class="qs-sustent__item-icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
          </div>
          <div class="qs-sustent__item-text">
            <strong>Carbon negative</strong>
            <span>Cada m² almacena CO₂ por décadas</span>
          </div>
        </div>
        <div class="qs-sustent__item reveal" style="--delay:0.3s">
          <div class="qs-sustent__item-icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
          </div>
          <div class="qs-sustent__item-text">
            <strong>50% más rápido</strong>
            <span>Menor impacto en obra vs. sistemas tradicionales</span>
          </div>
        </div>
        <div class="qs-sustent__item reveal" style="--delay:0.4s">
          <div class="qs-sustent__item-icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
          </div>
          <div class="qs-sustent__item-text">
            <strong>Alineado con ESG</strong>
            <span>Cumple con los más altos estándares ambientales globales</span>
          </div>
        </div>
      </div>
    </div>

    <div class="qs-sustent__visual" id="qs-sustent-visual">
      <svg class="qs-sustent__ring" viewBox="0 0 600 600" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <circle cx="300" cy="300" r="292" stroke="#e93d1b" stroke-width="2.5"/>
        <circle cx="300" cy="300" r="270" stroke="#e93d1b" stroke-width="1.5"/>
        <circle cx="300" cy="300" r="248" stroke="#e93d1b" stroke-width="2"/>
        <circle cx="300" cy="300" r="225" stroke="#e93d1b" stroke-width="1"/>
        <circle cx="300" cy="300" r="206" stroke="#e93d1b" stroke-width="1.5"/>
        <circle cx="300" cy="300" r="185" stroke="#e93d1b" stroke-width="1"/>
        <circle cx="300" cy="300" r="166" stroke="#e93d1b" stroke-width="2"/>
        <circle cx="300" cy="300" r="146" stroke="#e93d1b" stroke-width="1"/>
        <circle cx="300" cy="300" r="128" stroke="#e93d1b" stroke-width="1.5"/>
        <circle cx="300" cy="300" r="110" stroke="#e93d1b" stroke-width="1"/>
        <circle cx="300" cy="300" r="92"  stroke="#e93d1b" stroke-width="2"/>
        <circle cx="300" cy="300" r="75"  stroke="#e93d1b" stroke-width="1"/>
        <circle cx="300" cy="300" r="59"  stroke="#e93d1b" stroke-width="1.5"/>
        <circle cx="300" cy="300" r="44"  stroke="#e93d1b" stroke-width="1"/>
        <circle cx="300" cy="300" r="30"  stroke="#e93d1b" stroke-width="1.5"/>
        <circle cx="300" cy="300" r="17"  stroke="#e93d1b" stroke-width="1"/>
        <circle cx="300" cy="300" r="7" fill="#e93d1b"/>
        <line x1="300" y1="8" x2="300" y2="592" stroke="#e93d1b" stroke-width="0.8"/>
        <line x1="8"   y1="300" x2="592" y2="300" stroke="#e93d1b" stroke-width="0.8"/>
        <line x1="92"  y1="92"  x2="508" y2="508" stroke="#e93d1b" stroke-width="0.5" opacity="0.7"/>
        <line x1="508" y1="92"  x2="92"  y2="508" stroke="#e93d1b" stroke-width="0.5" opacity="0.7"/>
      </svg>
      <div class="qs-sustent__co2">
        <strong class="qs-counter-co2">0</strong>
        <span>toneladas de CO₂<br>almacenadas por 1,000 m²</span>
      </div>
    </div>

  </div>
</section>


<!-- ══════════════════════════════════════
     CTA FINAL
══════════════════════════════════════ -->
<section class="qs-cta" aria-label="Contacto">

  <div class="qs-cta__wm" aria-hidden="true">
    <svg viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="250" cy="250" r="240" stroke="currentColor" stroke-width="1.2"/>
      <circle cx="250" cy="250" r="210" stroke="currentColor" stroke-width="0.9"/>
      <circle cx="250" cy="250" r="178" stroke="currentColor" stroke-width="1.1"/>
      <circle cx="250" cy="250" r="148" stroke="currentColor" stroke-width="0.8"/>
      <circle cx="250" cy="250" r="120" stroke="currentColor" stroke-width="1"/>
      <circle cx="250" cy="250" r="94"  stroke="currentColor" stroke-width="0.8"/>
      <circle cx="250" cy="250" r="70"  stroke="currentColor" stroke-width="0.9"/>
      <circle cx="250" cy="250" r="48"  stroke="currentColor" stroke-width="0.7"/>
      <circle cx="250" cy="250" r="28"  stroke="currentColor" stroke-width="0.8"/>
      <circle cx="250" cy="250" r="12"  stroke="currentColor" stroke-width="1"/>
    </svg>
  </div>

  <div class="qs-cta__inner">
    <span class="rw-eyebrow rw-eyebrow--light reveal">¿Trabajamos juntos?</span>
    <h2 class="reveal reveal-delay-1">Tu próximo proyecto<br>merece ser de <em>madera</em></h2>
    <p class="reveal reveal-delay-2">
      Cuéntanos tu idea y el equipo de Reed Wood te brindará una asesoría técnica especializada sin costo.
    </p>
    <div class="qs-cta__btns reveal reveal-delay-3">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>#contacto" class="rw-btn rw-btn--primary">
        Contactar ahora
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
      </a>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>#proyectos" class="rw-btn rw-btn--outline-light">
        Ver proyectos
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
      </a>
    </div>
  </div>
</section>


<script>
/* ══════════════════════════════════════
   Quiénes Somos — Page Animations
══════════════════════════════════════ */
(function () {
  'use strict';

  /* ── Hero: split words into spans ── */
  (function splitHeroTitle() {
    const el = document.getElementById('qs-hero-title');
    if (!el) return;
    const html = el.innerHTML;
    const result = html.replace(/(\S+)/g, function(word) {
      if (word.includes('<') || word.includes('>')) return word;
      return '<span class="word">' + word + '</span>';
    });
    el.innerHTML = result;
    el.querySelectorAll('.word').forEach(function(w, i) {
      w.style.animation = 'qs-fade-up 0.7s cubic-bezier(0.22,1,0.36,1) ' + (0.55 + i * 0.07) + 's both';
    });
  })();

  /* ── Parallax hero bg ── */
  (function initParallax() {
    const bg = document.getElementById('qs-parallax-bg');
    if (!bg || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    let ticking = false;
    window.addEventListener('scroll', function() {
      if (!ticking) {
        requestAnimationFrame(function() {
          const y = window.scrollY;
          if (y < window.innerHeight) {
            bg.style.transform = 'translateY(' + (y * 0.3) + 'px)';
          }
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  })();

  /* ── Quote: word-by-word reveal ── */
  (function initQuote() {
    const quote = document.getElementById('qs-quote');
    if (!quote) return;
    const text = quote.textContent;
    const words = text.trim().split(/\s+/);
    quote.innerHTML = words.map(function(w, i) {
      return '<span class="word" style="transition-delay:' + (i * 0.04) + 's">' + w + ' </span>';
    }).join('');

    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('words-visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.3 });
    obs.observe(quote);
  })();

  /* ── Global reveal observer ── */
  (function initReveal() {
    const targets = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    if (!targets.length) return;
    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    targets.forEach(function(t) { obs.observe(t); });
  })();

  /* ── Historia visual ── */
  (function initHistoria() {
    const el = document.getElementById('qs-historia-visual');
    if (!el) return;
    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) { el.classList.add('is-visible'); obs.unobserve(el); }
      });
    }, { threshold: 0.2 });
    obs.observe(el);
  })();

  /* ── MVV cards stagger ── */
  (function initMvv() {
    const cards = document.querySelectorAll('.qs-mvv-card');
    if (!cards.length) return;
    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          const delay = parseInt(entry.target.dataset.delay || 0);
          setTimeout(function() {
            entry.target.classList.add('is-visible');
          }, delay);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    cards.forEach(function(c) { obs.observe(c); });
  })();

  /* ── Stats: counter animation ── */
  (function initStats() {
    const items = document.querySelectorAll('.qs-stat-item');
    if (!items.length) return;

    function easeOutQuart(t) { return 1 - Math.pow(1 - t, 4); }

    function animateCounter(el, target, duration) {
      const counterEl = el.querySelector('.qs-counter');
      if (!counterEl) return;
      const start = performance.now();
      function update(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const eased = easeOutQuart(progress);
        const value = Math.round(eased * target);
        counterEl.textContent = target >= 1000
          ? value.toLocaleString('es-MX')
          : value;
        if (progress < 1) requestAnimationFrame(update);
      }
      requestAnimationFrame(update);
    }

    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          const item = entry.target;
          const delay = parseInt(item.dataset.delay || 0);
          const target = parseInt(item.dataset.target || 0);
          setTimeout(function() {
            item.classList.add('is-visible');
            animateCounter(item, target, 1800);
          }, delay);
          obs.unobserve(item);
        }
      });
    }, { threshold: 0.3 });
    items.forEach(function(i) { obs.observe(i); });
  })();

  /* ── Pilares stagger ── */
  (function initPilares() {
    const items = document.querySelectorAll('.qs-pilar');
    if (!items.length) return;
    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          const delay = parseInt(entry.target.dataset.delay || 0);
          setTimeout(function() {
            entry.target.classList.add('is-visible');
          }, delay);
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    items.forEach(function(i) { obs.observe(i); });
  })();

  /* ── Sustentabilidad visual ── */
  (function initSustent() {
    const visual = document.getElementById('qs-sustent-visual');
    const co2el  = document.querySelector('.qs-counter-co2');
    const text   = document.querySelector('.qs-sustent__text');
    if (!visual) return;

    function easeOutQuart(t) { return 1 - Math.pow(1 - t, 4); }

    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          visual.classList.add('is-visible');
          if (text) text.classList.add('is-visible');
          if (co2el) {
            const start = performance.now();
            const target = 850;
            (function update(now) {
              const p = Math.min((now - start) / 2000, 1);
              co2el.textContent = Math.round(easeOutQuart(p) * target).toLocaleString('es-MX');
              if (p < 1) requestAnimationFrame(update);
            })(start);
          }
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.25 });
    obs.observe(visual);
  })();

  /* ── Historia text reveal ── */
  (function initHistoriaText() {
    const el = document.querySelector('.qs-historia__text');
    if (!el) return;
    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          el.classList.add('is-visible');
          obs.unobserve(el);
        }
      });
    }, { threshold: 0.2 });
    obs.observe(el);
  })();

  /* ── Manifesto line ── */
  (function initManifestoLine() {
    const line = document.querySelector('.qs-manifesto__line');
    if (!line) return;
    const obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          line.classList.add('is-visible');
          obs.unobserve(line);
        }
      });
    }, { threshold: 0.5 });
    obs.observe(line);
  })();

})();
</script>

<?php get_footer(); ?>
