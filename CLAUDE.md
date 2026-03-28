# The Publishing Universe — WordPress Block Theme

## Project

A full WordPress block theme (WP 7.0+, theme.json v3) powering 5 personal sites as "different rooms in the same home."

## Design Doc

Approved design: `~/.gstack/projects/wp3ob7o/paolo-unknown-design-20260326-200642.md`

## Reference Materials

- `refs/practical-typography.pdf` — Butterick's Practical Typography. The typographic bible for this project. Consult for all font, spacing, and layout decisions.
- `refs/*_light.png` / `refs/*_dark.png` — Reference screenshots of all 5 current sites in both modes.
- `refs/wireframe-theme.png` — Approved wireframe showing essay mode, single photo mode, dual dark modes, style variations, and specimen page.

## Target Sites

| Site | Primary content mode |
|------|---------------------|
| paolobelcastro.com | Link-in-Bio |
| paolo.blog | Essay |
| ttl.blog | Essay / Magazine |
| monochrome.blog | Essay |
| monochrome.photo | Single Photo |

## Key Conventions

### Typography (Butterick-compliant)
- Body: 17px, professional serif, line-height 1.45
- Measure: 45–90 characters per line (max-width ~640px)
- OpenType features via custom CSS: ligatures, kerning, small caps
- Curly quotes, proper ellipsis, correct em/en dashes
- Bold or italic sparingly, never together
- First-line indents OR paragraph spacing, not both

### Dark Mode (dual surface)
- **Text Dark:** #111111 bg / #b0ada8 text — warm paper for reading
- **Photo Dark:** #0a0a0a bg / #888888 text — near-black for images

### Content Modes
Authors select templates per post via the block editor. Content modes:
Essay, Single Photo, Gallery, Magazine, Link-in-Bio.

### Style Variations
One JSON file per site. Shared: typography, spacing, grid, dark mode. Per-site: logo, name, tagline, body class for nav highlighting.

### Photos
Primarily single images in 5:4 or 4:5 ratio. Gallery is secondary.

## Design System
Always read DESIGN.md before making any visual or UI decisions.
All font choices, colors, spacing, and aesthetic direction are defined there.
Do not deviate without explicit user approval.
In QA mode, flag any code that doesn't match DESIGN.md.

## Git
- Branch naming: always `main`, never `master`
- `refs/` is gitignored (large binary assets)
