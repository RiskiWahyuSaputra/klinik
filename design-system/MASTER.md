# Design System Master: Klinik Mon Cheri

## Visual Identity & Brand

**Core Concept:** Modern Minimalist with a Feminine & Elegant touch. Soft, rounded, and welcoming.

### Color Palette (PRD Focused)
| Role | Hex | Tailwind Class (Approx) | Description |
|------|-----|-------------------------|-------------|
| **Primary** | `#FFB6C1` | `bg-[#FFB6C1]` | Light Pink / Rose (Main Brand) |
| **Secondary** | `#FFF8DC` | `bg-[#FFF8DC]` | Cream (Backgrounds / Surfaces) |
| **Accent (CTA)** | `#D4AF37` | `bg-[#D4AF37]` | Gold / Champagne (Buttons / Highlights) |
| **Background** | `#FFFFFF` | `bg-white` | Pure White |
| **Text (Dark)** | `#333333` | `text-[#333333]` | Dark Gray (Primary Body) |
| **Text (Muted)** | `#666666` | `text-[#666666]` | Medium Gray (Subtext) |

### Typography
- **Heading:** `Poppins` or `Montserrat` (PRD Choice)
- **Body:** `Inter` or `Open Sans` (PRD Choice)
- **Mood:** Modern, clean, professional yet friendly.

### Style: Soft Minimalism / Neumorphic Influence
- **Corners:** Large rounded corners (`rounded-2xl` or `12-16px`).
- **Shadows:** Soft, diffused shadows for depth (`shadow-soft` or `0 10px 15px -3px rgba(0,0,0,0.05)`).
- **Depth:** Subtle "Neumorphic" touches (embossed/debossed) can be used for cards but keep contrast high for accessibility.

---

## Layout & Components

### Page Structure: Minimal Single Column / Clean Grid
- **Spacing:** Ample whitespace (`p-8`, `gap-8`).
- **Containers:** Max width `max-w-7xl` (1280px).
- **Mobile First:** Optimized for 375px (iPhone SE size).

### Components Guidelines
- **Buttons:**
  - Primary: Gold background (`#D4AF37`), white text, rounded corners.
  - Secondary: Soft pink border/text, rounded.
  - Interaction: 150ms smooth transition on hover/active.
- **Cards:**
  - Soft background, rounded-2xl, subtle shadow.
- **Forms:**
  - Floating labels or clear visible labels.
  - Large touch targets (min 44px height).

---

## UX Principles & Quality Control

### Accessibility (CRITICAL)
- **Contrast:** Ensure text contrast is at least 4.5:1. (Note: Gold on white might be low, use darker variants for text).
- **Icons:** Use SVG icons (Heroicons/Lucide). **No Emojis** for navigation or system UI.
- **Touch Targets:** Minimum 44x44px.

### Performance
- **Images:** Use WebP/AVIF, lazy load.
- **Layout Shift:** Declare width/height for images to prevent CLS.

---

## Anti-Patterns (Avoid)
- ❌ Hard edges / Sharp corners.
- ❌ Dark, heavy shadows.
- ❌ Neon or overly saturated colors.
- ❌ Cluttered navigation.
- ❌ Emoji-based icons.
