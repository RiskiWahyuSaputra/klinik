# Admin Dashboard Guidelines: Klinik Mon Cheri

## Visual Style: Professional Data-Dense
The admin dashboard should prioritize data clarity while maintaining the "Mon Cheri" soft aesthetic.

### Color Tokens (Admin Overrides)
- **Primary (Action):** `#FF69B4` (Pink Dark) for active states.
- **Surface:** `#FFFFFF` (White) for cards.
- **Background:** `#F9FAFB` (Very Light Gray/Rose tint) for the main area.
- **Success:** `#10B981` (Green) for completed statuses.
- **Warning:** `#F59E0B` (Amber) for pending items.
- **Info:** `#3B82F6` (Blue) for confirmed items.

### Layout Principles
- **Grid:** Use a 12-column responsive grid.
- **Spacing:** Tight but breathable padding (`p-4` to `p-6`).
- **Cards:** Rounded corners (`rounded-2xl`), subtle borders (`border border-gray-100`), and very light shadows.

### Components
- **Stat Cards:** Use a top-border accent or a subtle background gradient.
- **Tables:** 
  - Hover states on rows.
  - Clear typography (`font-inter`).
  - Semantic badges for status.
- **Quick Actions:** Icon + Label buttons in a grid or list.

### UX Best Practices
- **No Emojis:** Use Lucide or Heroicons exclusively.
- **Contrast:** Ensure all text on badges meets WCAG AA.
- **Loading:** Use skeleton screens for data-heavy sections.
