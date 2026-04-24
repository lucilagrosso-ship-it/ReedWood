# Reed Wood — Plan de Rediseño Web

## Empresa
**Reed Wood** es una empresa mexicana pionera en sistemas **Mass Timber** (madera de ingeniería estructural). Se dedica a la investigación, ingeniería, desarrollo y construcción con madera estructural certificada proveniente de plantaciones forestales responsables. Su misión: edificaciones de alto desempeño, sostenibles y eficientes — desde la conceptualización hasta la ejecución en obra.

---

## Sistema de Diseño

### Colores
| Token | Valor | Uso |
|---|---|---|
| `--rw-red` | `#e93d1b` | Acento principal, CTAs, highlights |
| `--rw-dark` | `#0d0d0d` | Fondo oscuro (hero, navbar) |
| `--rw-charcoal` | `#1a1a18` | Fondos secundarios oscuros |
| `--rw-gray-900` | `#111110` | Texto sobre claro |
| `--rw-gray-600` | `#4b4b48` | Texto secundario |
| `--rw-gray-400` | `#9b9b96` | Labels, metadata |
| `--rw-gray-100` | `#f4f4f2` | Fondos claros, secciones alternas |
| `--rw-white` | `#ffffff` | Texto sobre oscuro |
| `--rw-border` | `rgba(255,255,255,0.08)` | Bordes en fondos oscuros |

### Tipografía
- **Display/Headings**: `'Inter'` o system-ui — peso 300/400, tracking negativo
- **Body**: system-ui — peso 300/400, line-height 1.8
- **Labels/Caps**: system-ui — peso 500, letter-spacing 0.18em, uppercase, tamaño 0.6–0.7rem
- Estilo: minimalista tipo Tailwind/Vercel, sin serifs en UI

### Animaciones
- Fade + translateY en scroll (IntersectionObserver)
- Ken Burns en imágenes hero
- Hover: fill slide con `#e93d1b` en botones
- Transiciones: `0.3s ease` en hover, `0.8s cubic-bezier(0.22,1,0.36,1)` en entradas

---

## Arquitectura de Archivos

```
reedwood/
├── index.html        ← Página única unificada (todo el sitio)
├── styles.css        ← Todos los estilos (variables, componentes, animaciones)
├── main.js           ← Toda la lógica JS (slider, scroll animations, nav)
├── plan.md           ← Este archivo
├── Brief.pdf         ← Referencia de contenido
├── sliders.html      ← Fuente: slider hero (ya integrado en index)
├── servicios.html    ← Fuente: imagen stack (ya integrado en index)
└── sliders.json      ← Export Elementor (referencia)
```

---

## Secciones del Sitio (index.html)

| # | Sección | Estado | Notas |
|---|---|---|---|
| 1 | **Navbar** | Pendiente | Logo + nav links + CTA. Sticky con blur. |
| 2 | **Hero Slider** | Pendiente | Integrar desde `sliders.html` |
| 3 | **Quiénes Somos** | Pendiente | Texto empresa + imagen stack de `servicios.html` |
| 4 | **Servicios** | Pendiente | Cards de servicios: diseño, ingeniería, fabricación, montaje |
| 5 | **Mass Timber** | Pendiente | Sección tech: qué es Mass Timber, ventajas |
| 6 | **Proyectos** | Pendiente | Grid de proyectos realizados |
| 7 | **Sustentabilidad** | Pendiente | Madera certificada, impacto ambiental, carbono |
| 8 | **Contacto** | Pendiente | Form + datos de contacto |
| 9 | **Footer** | Pendiente | Links + redes + copyright |

---

## Tareas

### Fase 1 — Estructura base
- [x] Crear `styles.css` con variables CSS, reset, tipografía, utilidades
- [x] Crear `main.js` con módulos: slider, scroll-reveal, navbar
- [x] Crear `index.html` con estructura HTML semántica y links a CSS/JS externos

### Fase 2 — Integración componentes existentes
- [x] Migrar slider de `sliders.html` → `index.html` (extraer a CSS/JS separados)
- [x] Migrar image stack de `servicios.html` → sección "Quiénes Somos" en `index.html`

### Fase 3 — Nuevas secciones
- [x] Navbar sticky con glassmorphism en scroll + menú móvil
- [x] Sección Servicios con 4 cards animadas (ingeniería, fabricación, montaje, consultoría)
- [x] Sección Mass Timber (CLT, Glulam, NLT, DLT + 6 ventajas)
- [x] Grid de Proyectos (layout 12 columnas, 5 proyectos)
- [x] Sección Sustentabilidad (4 pilares + imagen con stat box)
- [x] Formulario de Contacto (nombre, email, teléfono, tipo, mensaje)
- [x] Footer (4 columnas + redes sociales)

### Fase 4 — Polish
- [x] Scroll-reveal animations en todas las secciones (reveal, reveal-left, reveal-right + delays)
- [x] Responsivo mobile (breakpoints: 480px, 768px, 1024px)
- [x] Imágenes lazy-load, Inter via Google Fonts, touch/swipe en slider
- [x] Contador animado en stats (IntersectionObserver + easeOutCubic)
- [x] Formulario con estado de éxito animado

---

## Decisiones de Diseño
- Estilo: **tech-minimalista** — oscuro predominante, acentos rojos, mucho espacio blanco en secciones claras
- Sin framework CSS externo: CSS puro con custom properties (filosofía Tailwind pero vanilla)
- Sin dependencias JS externas: vanilla JS puro
- Tipografía: Inter via Google Fonts
- Prefijo de clases: `rw-` para todos los componentes

---

## Contenido clave (de Brief.pdf + copy existente)
- Pioneros en México en Mass Timber
- CLT (Cross-Laminated Timber), Glulam, NLT, DLT
- Plantaciones forestales certificadas (FSC/PEFC)
- Construcción más rápida, ligera y sustentable vs. concreto/acero
- Proyectos: Pérgola Las Canteras, Rancho Neptuno (visible en servicios.html)

---

## Log de Cambios
| Fecha | Cambio |
|---|---|
| 2026-03-31 | Plan inicial creado |
| 2026-03-31 | Fases 1–4 completadas: styles.css, main.js, index.html (9 secciones unificadas) |
