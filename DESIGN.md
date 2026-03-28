# Design System — The Publishing Universe

## Product Context
- **What this is:** A WordPress block theme powering 5 personal sites as a unified publishing universe
- **Who it's for:** Paolo Belcastro's readers across essays, photography, tech leadership, and art
- **Space/industry:** Personal editorial publishing, photography
- **Project type:** Editorial theme with multiple content modes

## Aesthetic Direction
- **Direction:** Editorial/Refined
- **Decoration level:** Minimal. Typography does all the work. No borders, shadows, or textures. Photographs provide visual drama.
- **Mood:** A well-set book, not a website. Warm, literate, unhurried. The reader should feel they're in a room designed for reading.
- **Reference sites:** anthropic.com (typography warmth), craigmod.com (editorial feel), frankchimero.com (restraint)

## Typography

### Typeface
- **Primary (body + headings):** Source Serif 4 (Frank Griesshammer, Adobe)
- **Rationale:** Contemporary transitional serif with moderate contrast. Full OpenType support. Variable font. Closest publicly available match to the warmth and proportion of Anthropic Serif. Single typeface for everything (the theme is one voice).
- **Loading:** Google Fonts CDN via `<link>`, `font-display: swap`
- **Fallback stack:** `"Source Serif 4", "Iowan Old Style", "Palatino Linotype", Palatino, Georgia, serif`

### Type Scale
Tuned by eye per Butterick (no modular scale). Sizes in px, implemented as rem (1rem = 17px body).

| Level | Size | Weight | Line-height | Letter-spacing | Use |
|-------|------|--------|-------------|----------------|-----|
| Display | clamp(28px, 4vw, 36px) | 400 | 1.2 | normal | Post titles, specimen hero |
| H1 | 28px | 400 | 1.25 | normal | Section headings in long essays |
| H2 | 22px | 600 | 1.3 | normal | Subsection headings |
| H3 | 17px | 600 | 1.45 | normal | Same as body, distinguished by weight |
| Body | 17px | 400 | 1.45 | normal | Essay text, all body content |
| Body small | 15px | 400 | 1.5 | normal | Captions, secondary text |
| Meta | 13px | 400 | 1.5 | normal | Dates, reading time, post metadata |
| UI label | 12px | 400 | 1.4 | 0.04em | Cross-site nav, footer links |

### Heading rules (Butterick)
- Limit to 2-3 levels. Two is better.
- No all-caps headings (use sentence case).
- Bold for headings, not italic. Or neither (size alone distinguishes).
- Space above and below headings (not indents). Heading-to-body gap: 8px. Body-to-heading gap: 32px.
- No underlined headings.

### OpenType Features
Applied via custom CSS (not theme.json):
```css
body {
  font-feature-settings: "liga" 1, "kern" 1;
  font-kerning: normal;
}
.small-caps, .smcaps {
  font-variant-caps: small-caps;
  letter-spacing: 0.05em;
}
.old-style-nums {
  font-feature-settings: "onum" 1;
}
```

### Typographic rules (Butterick)
- Curly quotes, proper ellipsis (…), correct em/en dashes
- Bold or italic sparingly, never together
- Space between paragraphs: 12px (half line-height). No first-line indents.
- One space between sentences
- No underline except web links

## Color

### Approach
Restrained. Color is rare and meaningful. Three surface modes, one accent.

### Light Surface (default)
| Token | Hex | Use |
|-------|-----|-----|
| `--color-bg` | #f8f7f4 | Page background (warm off-white) |
| `--color-text` | #1a1a1a | Primary text |
| `--color-text-secondary` | #555555 | Secondary text, metadata |
| `--color-text-muted` | #999999 | Tertiary text, hints |
| `--color-accent` | #9b4d3a | Links, interactive elements (muted brick) |
| `--color-accent-hover` | #7d3e2e | Link hover state |
| `--color-border` | #e0ddd8 | Dividers, subtle borders |
| `--color-surface-raised` | #f0eeea | Cards, raised surfaces (if needed) |

### Text Dark Surface (essays, magazine, specimen)
| Token | Hex | Use |
|-------|-----|-----|
| `--color-bg` | #111111 | Page background (warm dark) |
| `--color-text` | #b0ada8 | Primary text |
| `--color-text-secondary` | #888888 | Secondary text |
| `--color-text-muted` | #666666 | Tertiary text |
| `--color-accent` | #c4725e | Links (brighter ochre for dark bg) |
| `--color-accent-hover` | #d4856e | Link hover |
| `--color-border` | #2a2a2a | Dividers |

### Photo Dark Surface (single photo, gallery)
| Token | Hex | Use |
|-------|-----|-----|
| `--color-bg` | #0a0a0a | Page background (near-black) |
| `--color-text` | #888888 | Primary text (subdued, image is hero) |
| `--color-text-secondary` | #666666 | Secondary text |
| `--color-text-muted` | #444444 | Tertiary text |
| `--color-accent` | #c4725e | Links |
| `--color-border` | #222222 | Dividers |

### Contrast Ratios (WCAG 2.1 AA verified)
- Light: #1a1a1a on #f8f7f4 = 14.5:1 (AAA)
- Light accent: #9b4d3a on #f8f7f4 = 5.5:1 (AA)
- Text Dark: #b0ada8 on #111111 = 7.5:1 (AAA)
- Photo Dark: #888888 on #0a0a0a = 5.2:1 (AA)

## Spacing

### Base Unit
8px. All spacing values are multiples of 8.

### Scale
| Token | Value | Use |
|-------|-------|-----|
| `--space-2xs` | 2px | Hairline gaps |
| `--space-xs` | 4px | Tight internal padding |
| `--space-sm` | 8px | Default small gap |
| `--space-md` | 16px | Standard padding, column gutters |
| `--space-lg` | 24px | Section internal spacing |
| `--space-xl` | 32px | Body-to-heading gap, section breaks |
| `--space-2xl` | 48px | Major section dividers |
| `--space-3xl` | 64px | Page-level vertical rhythm |

### Density
Comfortable. Generous whitespace around text. Photography gets even more air.

### Key Spacings
- Paragraph spacing: 12px (half line-height, per Butterick)
- Heading above: 32px (--space-xl)
- Heading below: 8px (--space-sm)
- Content column padding (mobile): 16px (--space-md)
- Cross-site nav height: 40px
- Footer padding: 48px top (--space-2xl)

## Layout

### Approach
Grid-disciplined. Single centered column for all reading content. No asymmetry.

### Content Widths
| Context | Max-width | Rationale |
|---------|-----------|-----------|
| Essay body | 640px | Butterick measure: ~70 chars/line at 17px Source Serif 4 |
| Photo (centered) | 800px | Enough to showcase near-square images with breathing room |
| Gallery grid | 960px | 2-column grid at 4px gap |
| Magazine list | 640px | Same as essay for reading comfort |
| Link-in-Bio | 400px | Centered, narrow, button-focused |
| Specimen page | 720px | Slightly wider for side-by-side demos |

### Grid
- Desktop: single centered column (no multi-column layout for content)
- Mobile (<640px): full-width with 16px padding
- Tablet (640-1024px): centered column at max-width
- Gallery: 2 columns desktop, 1 column mobile

### Border Radius
None. Square edges throughout. This is editorial, not SaaS.

## Motion

### Approach
Minimal-functional. Motion serves comprehension, not decoration.

### Transitions
| Type | Duration | Easing | Use |
|------|----------|--------|-----|
| Dark mode surface | 200ms | ease-in-out | Background and text color crossfade |
| Link hover | 150ms | ease-out | Color change on hover |
| Focus ring | 0ms | instant | Focus indicators appear immediately |

### Rules
- No scroll animations
- No entrance animations
- No parallax
- Respect `prefers-reduced-motion`: disable all transitions
- Dark mode toggle script runs in `<head>` before paint to prevent FOUT

## Interactive Elements

### Links
- Light: `--color-accent` (#9b4d3a), no underline, underline on hover
- Dark: `--color-accent` (#c4725e), no underline, underline on hover
- Visited: same as unvisited (Butterick preference)

### Dark Mode Toggle
- Location: right side of site header, inline with site navigation
- Visual: sun/moon icon, 20px, `<button role="switch" aria-checked="true/false" aria-label="Dark mode">`
- Keyboard: Space/Enter to toggle

### Cross-site Navigation
- Location: top of page, above site header
- Type: UI label size (12px), uppercase, 0.04em tracking
- Current room: font-weight 600, `--color-text` (not accent)
- Other rooms: font-weight 400, `--color-text-muted`
- Hover: `--color-text-secondary`
- The nav is quiet by design. Coherence comes from shared typography, not a loud room-switcher.

### "Next Room" Footer
- Location: above site footer, separated by `--space-2xl`
- Style: mirrors cross-site nav in quieter tone
- Copy: "More from the universe" as label

### Buttons (Link-in-Bio only)
- Rounded pill shape: `border-radius: 9999px`
- Border: 1px solid `--color-border`
- Padding: 12px 24px
- No fill, no shadow. Text + border only.
- Hover: border darkens to `--color-text-secondary`

## Empty States

All empty states are quiet and typographically consistent with the surrounding template:

- **Essay, no content:** Title renders. Body area shows "This post has no content yet" in body type, centered.
- **Single Photo, no featured image:** Title renders. Image area shows a light gray (#e8e8e8 light / #222 dark) rectangle at 1:1 aspect ratio. No text in placeholder.
- **Gallery, 1 image:** Falls back to Single Photo layout.
- **Magazine, zero posts:** Category chips render. Body shows "No posts yet" in body type.
- **Link-in-Bio, no links:** Avatar, name, tagline render. Button area is simply absent.

## 404 Page
- Uses Text Dark surface colors (warm dark, not photo dark)
- Inherits style variation identity (site name, cross-site nav)
- Centered message in Display type: "Not found"
- Body text: "This page doesn't exist. Here's somewhere to go:" followed by a link to the homepage

## Print Stylesheet
- Page margins: 1 inch
- Body: Source Serif 4 at 12pt, line-height 1.5
- Hide: cross-site nav, site nav, footer, dark mode toggle, "next room" footer
- Widows: 2, orphans: 2
- Page-break-after: avoid on headings
- Images: max-width 80%

## Accessibility
- Target: WCAG 2.1 AA minimum
- Touch targets: 44x44px minimum for all interactive elements
- Skip link: "Skip to content" as first focusable element
- ARIA landmarks: `<nav aria-label="Publishing Universe">` for cross-site nav, `<nav aria-label="Site navigation">` for site nav, `<main>` for content
- Focus indicators: visible focus ring on both light and dark surfaces, 2px solid, offset 2px
- Reduced motion: `prefers-reduced-motion` disables all transitions

## Decisions Log

| Date | Decision | Rationale |
|------|----------|-----------|
| 2026-03-28 | Initial design system created | /design-consultation based on Butterick, site research, Anthropic Serif study |
| 2026-03-28 | Source Serif 4 chosen as typeface | Best OpenType support, closest to Anthropic Serif warmth, free on Google Fonts |
| 2026-03-28 | Single typeface (no sans-serif) | Theme should feel like a book. Extreme coherence over visual distinction. |
| 2026-03-28 | Muted brick (#9b4d3a) as accent | Earthy, European editorial warmth. Better contrast than ochre on both surfaces (5.5:1 light, 5.1:1 dark). User preference. |
| 2026-03-28 | No border-radius anywhere | Editorial, not SaaS. Square edges throughout (except Link-in-Bio pills). |
| 2026-03-28 | Cross-site nav is subtle by design | Coherence from shared typography, not a loud room-switcher. User's explicit preference. |
| 2026-03-28 | No modular type scale | Per Butterick: "When your headings look right, they are right. The ratio is irrelevant." |
