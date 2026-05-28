# Product Requirements Document (PRD)
# Website Klinik Utama Mon Cheri

**Versi:** 1.0  
**Tanggal:** 28 Mei 2026  
**Project Owner:** Klinik Utama Mon Cheri

---

## 1. EXECUTIVE SUMMARY

Website Klinik Utama Mon Cheri adalah platform digital yang dirancang untuk meningkatkan efisiensi operasional klinik dan memberikan kemudahan akses layanan kesehatan bagi pasien. Website ini akan menjadi jembatan antara staff klinik dan pasien dalam mengelola appointment, rekam medis, dan informasi layanan kesehatan.

---

## 2. PROJECT GOALS

### 2.1 Business Goals
- Meningkatkan efisiensi operasional klinik hingga 40%
- Mengurangi waktu tunggu pasien dengan sistem appointment online
- Meningkatkan kepuasan pasien melalui akses informasi yang mudah
- Digitalisasi rekam medis untuk keamanan dan aksesibilitas data
- Meningkatkan brand awareness Klinik Mon Cheri di wilayah Bandung

### 2.2 User Goals
**Untuk Pasien:**
- Booking appointment dengan mudah tanpa harus datang/telepon
- Melihat riwayat kunjungan dan rekam medis
- Mendapatkan informasi layanan dan jadwal dokter
- Konsultasi online dengan dokter

**Untuk Staff Klinik:**
- Mengelola jadwal appointment dengan efisien
- Mengakses dan update rekam medis pasien
- Mengelola data dokter dan layanan
- Monitoring operasional klinik real-time

---

## 3. TARGET USERS

### 3.1 Primary Users

**1. Pasien/Pelanggan**
- **Demografi:** Usia 18-65 tahun, wilayah Bandung dan sekitarnya
- **Karakteristik:** Familiar dengan teknologi, mencari kemudahan akses layanan kesehatan
- **Kebutuhan:** Booking appointment, akses rekam medis, informasi layanan

**2. Staff Klinik (Admin/Resepsionis)**
- **Demografi:** Staff administrasi klinik
- **Karakteristik:** Mengelola operasional harian klinik
- **Kebutuhan:** Manajemen appointment, registrasi pasien, laporan

**3. Dokter**
- **Demografi:** Tenaga medis di Klinik Mon Cheri
- **Karakteristik:** Fokus pada pelayanan medis
- **Kebutuhan:** Akses rekam medis, jadwal praktik, konsultasi online

### 3.2 Secondary Users

**4. Admin/Manager Klinik**
- **Kebutuhan:** Dashboard analytics, laporan keuangan, manajemen staff

---

## 4. FITUR UTAMA

### 4.1 Fitur untuk Pasien (Patient Portal)

#### A. Registrasi & Autentikasi
- Registrasi akun dengan email/nomor HP
- Login dengan email/password
- Verifikasi OTP via WhatsApp/SMS
- Forgot password & reset password
- Profile management (foto, data diri, alamat, kontak darurat)

#### B. Appointment/Booking
- Lihat jadwal dokter yang tersedia
- Pilih dokter, layanan, tanggal & waktu
- Booking appointment online
- Reschedule/cancel appointment
- Notifikasi reminder (H-1, H-0, 1 jam sebelum)
- Queue number real-time
- Riwayat appointment

#### C. Rekam Medis Digital
- Lihat riwayat kunjungan
- Lihat hasil pemeriksaan & diagnosis
- Lihat resep obat
- Download rekam medis (PDF)
- Riwayat pembayaran

#### D. Informasi & Layanan
- Informasi layanan klinik (umum, gigi, anak, dll)
- Profil dokter & jadwal praktik
- Artikel kesehatan & tips
- FAQ
- Lokasi & kontak klinik

#### E. Konsultasi Online (Telemedicine)
- Chat dengan dokter
- Video call consultation (optional)
- Upload foto/dokumen pendukung
- Resep digital

#### F. Pembayaran
- Lihat tagihan
- Pembayaran online (Virtual Account, E-wallet, Transfer)
- Riwayat pembayaran & invoice

### 4.2 Fitur untuk Staff Klinik

#### A. Dashboard Staff
- Overview appointment hari ini
- Jumlah pasien waiting/in-progress/completed
- Quick actions (registrasi pasien baru, check-in)

#### B. Manajemen Pasien
- Registrasi pasien baru (walk-in)
- Pencarian data pasien
- Update data pasien
- Lihat riwayat kunjungan pasien
- Input rekam medis (untuk staff medis)

#### C. Manajemen Appointment
- Lihat semua appointment (calendar view, list view)
- Approve/reject appointment request
- Check-in pasien
- Update status appointment
- Reschedule appointment
- Kelola antrian

#### D. Manajemen Layanan
- CRUD layanan klinik
- Set harga layanan
- Kategori layanan

#### E. Laporan
- Laporan kunjungan harian/bulanan
- Laporan pendapatan
- Laporan per dokter
- Export laporan (Excel, PDF)

### 4.3 Fitur untuk Dokter

#### A. Dashboard Dokter
- Jadwal praktik hari ini
- Daftar pasien hari ini
- Appointment mendatang

#### B. Rekam Medis
- Lihat rekam medis pasien
- Input diagnosis & tindakan
- Input resep obat
- Upload hasil lab/foto rontgen
- E-signature

#### C. Jadwal Praktik
- Lihat jadwal praktik
- Request perubahan jadwal
- Set jadwal cuti/tidak praktik

#### D. Konsultasi Online
- Terima konsultasi chat
- Video consultation
- Buat resep digital

### 4.4 Fitur untuk Admin/Manager

#### A. Dashboard Analytics
- Total pasien (harian, bulanan, tahunan)
- Revenue analytics
- Appointment statistics
- Dokter performance
- Layanan terpopuler

#### B. Manajemen User
- CRUD staff/dokter
- Set role & permission
- Aktivasi/deaktivasi akun

#### C. Manajemen Dokter
- CRUD data dokter
- Set jadwal praktik dokter
- Set spesialisasi & layanan

#### D. Konfigurasi Sistem
- Jam operasional klinik
- Durasi appointment default
- Setting notifikasi
- Payment gateway configuration

---

## 5. USER FLOW

### 5.1 User Flow - Pasien Booking Appointment

```
1. Pasien login/register
2. Pilih menu "Buat Appointment"
3. Pilih layanan (Dokter Umum/Gigi/Anak/dll)
4. Pilih dokter
5. Pilih tanggal & waktu yang tersedia
6. Isi keluhan/catatan (optional)
7. Konfirmasi booking
8. Terima notifikasi konfirmasi
9. Terima reminder H-1 dan 1 jam sebelum
10. Check-in di klinik (scan QR code/nomor booking)
11. Tunggu giliran
12. Konsultasi dengan dokter
13. Pembayaran
14. Selesai - dapat akses rekam medis
```

### 5.2 User Flow - Staff Mengelola Appointment

```
1. Staff login
2. Lihat dashboard appointment hari ini
3. Approve appointment request dari pasien
4. Pasien datang → scan QR/input nomor booking
5. Check-in pasien
6. Update status "Sedang Konsultasi"
7. Dokter selesai konsultasi
8. Staff input pembayaran
9. Update status "Selesai"
10. Pasien terima invoice & rekam medis
```

### 5.3 User Flow - Dokter Input Rekam Medis

```
1. Dokter login
2. Lihat daftar pasien hari ini
3. Pilih pasien
4. Lihat riwayat rekam medis
5. Input diagnosis & tindakan
6. Input resep obat
7. Upload hasil pemeriksaan (optional)
8. Simpan rekam medis
9. E-signature
10. Pasien otomatis dapat akses rekam medis
```

---

## 6. UI/UX DESIGN GUIDELINES

### 6.1 Design Inspiration (Berdasarkan Klinik Mon Cheri)

**Brand Identity:**
- **Warna Utama:** Soft pink/rose (#FFB6C1, #FFC0CB) - mencerminkan "Mon Cheri" (my dear/sayang)
- **Warna Sekunder:** White (#FFFFFF), Cream (#FFF8DC)
- **Warna Aksen:** Gold/Champagne (#D4AF37) untuk CTA buttons
- **Warna Teks:** Dark Gray (#333333), Medium Gray (#666666)

**Typography:**
- **Heading:** Poppins/Montserrat (modern, clean, friendly)
- **Body:** Inter/Open Sans (readable, professional)

**Design Style:**
- Modern minimalist dengan sentuhan feminine & elegant
- Rounded corners untuk buttons & cards
- Soft shadows untuk depth
- Ample white space untuk clean look
- Friendly & welcoming atmosphere

### 6.2 Layout Structure

**Homepage (Public):**
- Hero section dengan CTA "Buat Appointment"
- Layanan unggulan (cards dengan icons)
- Profil dokter (carousel)
- Testimoni pasien
- Artikel kesehatan terbaru
- Lokasi & kontak

**Patient Dashboard:**
- Sidebar navigation (collapsible di mobile)
- Top bar dengan profile & notifications
- Main content area dengan cards
- Quick actions (floating action button di mobile)

**Staff/Dokter Dashboard:**
- Sidebar dengan menu lengkap
- Top bar dengan search & notifications
- Main content dengan data tables & charts
- Filter & sorting options

### 6.3 Responsive Design
- **Desktop:** Full sidebar, multi-column layout
- **Tablet:** Collapsible sidebar, 2-column layout
- **Mobile:** Bottom navigation, single column, touch-optimized

### 6.4 Accessibility
- WCAG 2.1 Level AA compliance
- Keyboard navigation support
- Screen reader friendly
- High contrast mode option
- Font size adjustment

---

## 7. TECH STACK

### 7.1 Backend
- **Framework:** Laravel 11.x (PHP 8.2+)
- **Database:** MySQL 8.0+
- **Authentication:** Laravel Sanctum (API tokens) + Laravel Breeze/Jetstream
- **Queue:** Laravel Queue (Redis/Database driver)
- **Storage:** Laravel Storage (local/S3 for production)
- **API:** RESTful API

### 7.2 Frontend
- **Blade Templates** dengan Alpine.js untuk interactivity
- **CSS Framework:** Tailwind CSS 3.x
- **Icons:** Heroicons/Font Awesome
- **Charts:** Chart.js/ApexCharts
- **Calendar:** FullCalendar.js
- **Notifications:** Laravel Echo + Pusher (real-time)

### 7.3 Additional Libraries
- **PDF Generation:** Laravel DomPDF/Snappy
- **Excel Export:** Laravel Excel (Maatwebsite)
- **Image Processing:** Intervention Image
- **QR Code:** SimpleSoftwareIO/simple-qrcode
- **WhatsApp API:** Twilio/Fonnte untuk notifikasi
- **Payment Gateway:** Midtrans/Xendit

### 7.4 Development Tools
- **Version Control:** Git
- **Package Manager:** Composer, NPM
- **Build Tool:** Vite
- **Testing:** PHPUnit, Laravel Dusk
- **Code Quality:** PHP CS Fixer, Laravel Pint

### 7.5 Infrastructure
- **Web Server:** Nginx/Apache
- **PHP:** PHP-FPM 8.2+
- **Cache:** Redis
- **Environment:** Docker (development), VPS/Cloud (production)

---

## 8. DATABASE OVERVIEW

### 8.1 Core Tables

#### Users
```
- id (PK)
- name
- email (unique)
- phone (unique)
- password
- role (enum: patient, staff, doctor, admin)
- email_verified_at
- phone_verified_at
- is_active
- timestamps
```

#### Patients (extends Users)
```
- id (PK)
- user_id (FK)
- patient_number (unique, auto-generated)
- date_of_birth
- gender
- blood_type
- address
- emergency_contact_name
- emergency_contact_phone
- insurance_number
- allergies (text)
- timestamps
```

#### Doctors
```
- id (PK)
- user_id (FK)
- doctor_number (unique)
- specialization
- license_number
- education
- experience_years
- consultation_fee
- bio (text)
- photo
- is_available
- timestamps
```

#### Services
```
- id (PK)
- name
- category (enum: general, dental, pediatric, etc)
- description
- price
- duration (minutes)
- is_active
- timestamps
```

#### Doctor_Services (pivot)
```
- doctor_id (FK)
- service_id (FK)
```

#### Schedules
```
- id (PK)
- doctor_id (FK)
- day_of_week (0-6)
- start_time
- end_time
- is_available
- timestamps
```

#### Appointments
```
- id (PK)
- appointment_number (unique)
- patient_id (FK)
- doctor_id (FK)
- service_id (FK)
- appointment_date
- appointment_time
- duration
- status (enum: pending, confirmed, checked_in, in_progress, completed, cancelled)
- queue_number
- complaint (text)
- notes (text)
- cancelled_reason
- cancelled_at
- timestamps
```

#### Medical_Records
```
- id (PK)
- appointment_id (FK)
- patient_id (FK)
- doctor_id (FK)
- diagnosis
- treatment
- notes
- blood_pressure
- temperature
- weight
- height
- created_by (FK users)
- timestamps
```

#### Prescriptions
```
- id (PK)
- medical_record_id (FK)
- medicine_name
- dosage
- frequency
- duration_days
- notes
- timestamps
```

#### Payments
```
- id (PK)
- appointment_id (FK)
- patient_id (FK)
- invoice_number (unique)
- amount
- payment_method (enum: cash, transfer, ewallet, va)
- payment_status (enum: pending, paid, failed, refunded)
- paid_at
- payment_proof
- timestamps
```

#### Articles
```
- id (PK)
- title
- slug (unique)
- content (text)
- excerpt
- featured_image
- category
- author_id (FK users)
- published_at
- is_published
- timestamps
```

#### Notifications
```
- id (PK)
- user_id (FK)
- type
- title
- message
- data (json)
- read_at
- timestamps
```

### 8.2 Database Relationships

- User → Patient (1:1)
- User → Doctor (1:1)
- Doctor → Services (M:N)
- Doctor → Schedules (1:M)
- Doctor → Appointments (1:M)
- Patient → Appointments (1:M)
- Appointment → Medical_Record (1:1)
- Medical_Record → Prescriptions (1:M)
- Appointment → Payment (1:1)

---

## 9. TECHNICAL REQUIREMENTS

### 9.1 Functional Requirements

**FR-1: Authentication & Authorization**
- Multi-role authentication (patient, staff, doctor, admin)
- Email & phone verification
- Password reset functionality
- Role-based access control (RBAC)

**FR-2: Appointment Management**
- Real-time availability checking
- Automatic queue number generation
- Appointment reminder system
- Reschedule/cancel with validation rules

**FR-3: Medical Records**
- Secure storage & encryption
- Access control (only authorized users)
- Audit trail for all changes
- PDF export functionality

**FR-4: Payment Processing**
- Multiple payment methods
- Payment gateway integration
- Invoice generation
- Payment confirmation

**FR-5: Notification System**
- Email notifications
- WhatsApp notifications
- In-app notifications
- Push notifications (future)

**FR-6: Reporting**
- Customizable date range
- Export to Excel/PDF
- Real-time data updates
- Visual charts & graphs

### 9.2 Non-Functional Requirements

**NFR-1: Performance**
- Page load time < 3 seconds
- API response time < 500ms
- Support 100+ concurrent users
- Database query optimization

**NFR-2: Security**
- HTTPS/SSL encryption
- SQL injection prevention
- XSS protection
- CSRF protection
- Data encryption at rest
- Regular security audits
- GDPR/privacy compliance

**NFR-3: Scalability**
- Horizontal scaling capability
- Database indexing
- Caching strategy (Redis)
- CDN for static assets

**NFR-4: Reliability**
- 99.5% uptime
- Automated backups (daily)
- Error logging & monitoring
- Disaster recovery plan

**NFR-5: Usability**
- Intuitive UI/UX
- Mobile-responsive
- Accessibility standards
- Multi-language support (ID/EN)

**NFR-6: Maintainability**
- Clean code architecture
- Comprehensive documentation
- Unit & integration tests
- Version control

---

## 10. PROJECT SCOPE

### 10.1 In Scope (MVP - Phase 1)

**Core Features:**
✅ User registration & authentication (all roles)
✅ Patient profile management
✅ Doctor profile & schedule management
✅ Service management
✅ Appointment booking system
✅ Appointment management (staff)
✅ Basic medical records (input & view)
✅ Prescription management
✅ Payment recording (manual)
✅ Dashboard (patient, staff, doctor, admin)
✅ Notifications (email & WhatsApp)
✅ Basic reporting
✅ Public website (homepage, services, doctors, contact)

**Technical:**
✅ Laravel backend with MySQL
✅ Blade + Tailwind CSS frontend
✅ Responsive design (desktop, tablet, mobile)
✅ Basic security implementation
✅ Deployment to production server

### 10.2 Out of Scope (Future Phases)

**Phase 2 (Post-MVP):**
- Video consultation (telemedicine)
- Online payment gateway integration
- Advanced analytics & BI dashboard
- Inventory management (obat & alat medis)
- Laboratory result integration
- Mobile app (iOS/Android)
- Patient feedback & rating system
- Loyalty program

**Phase 3 (Advanced):**
- AI-powered appointment scheduling
- Chatbot for FAQ
- Integration with BPJS/insurance
- Multi-branch support
- Pharmacy integration
- Ambulance booking
- Health tracking & reminders

### 10.3 Assumptions & Constraints

**Assumptions:**
- Staff klinik memiliki akses internet stabil
- Pasien memiliki smartphone/komputer untuk akses
- Klinik memiliki server/hosting untuk deployment
- Data pasien existing dapat dimigrasi ke sistem baru

**Constraints:**
- Budget: Sesuai kesepakatan dengan klien
- Timeline: 3-4 bulan untuk MVP
- Resources: 1-2 developers, 1 UI/UX designer
- Compliance: Harus sesuai regulasi data kesehatan Indonesia

### 10.4 Dependencies

- WhatsApp API provider (Fonnte/Twilio)
- Payment gateway provider (Midtrans/Xendit) - Phase 2
- Hosting/server provider
- SSL certificate
- Domain name

---

## 11. SUCCESS METRICS (KPI)

### 11.1 Business Metrics
- **Adoption Rate:** 60% pasien menggunakan online booking dalam 3 bulan
- **Efficiency:** Pengurangan waktu registrasi dari 10 menit → 3 menit
- **Revenue:** Peningkatan jumlah appointment 20% dalam 6 bulan
- **Patient Satisfaction:** Rating 4.5/5 dari pasien

### 11.2 Technical Metrics
- **Uptime:** 99.5%
- **Page Load Time:** < 3 detik
- **Error Rate:** < 1%
- **API Response Time:** < 500ms

### 11.3 User Engagement
- **Daily Active Users:** 50+ pasien/hari
- **Appointment Completion Rate:** > 85%
- **Return User Rate:** > 70%

---

## 12. PROJECT TIMELINE

### Phase 1: Planning & Design (2 minggu)
- Requirements gathering
- Database design
- UI/UX design & prototype
- Technical architecture

### Phase 2: Development (8 minggu)
- Week 1-2: Setup project, authentication, user management
- Week 3-4: Appointment system, doctor schedule
- Week 5-6: Medical records, prescriptions
- Week 7: Payment, notifications
- Week 8: Dashboard, reporting

### Phase 3: Testing (2 minggu)
- Unit testing
- Integration testing
- User acceptance testing (UAT)
- Bug fixing

### Phase 4: Deployment & Training (1 minggu)
- Production deployment
- Staff training
- Documentation
- Go-live

### Phase 5: Post-Launch Support (1 bulan)
- Monitoring & bug fixes
- User feedback collection
- Minor improvements

**Total Timeline: 3-4 bulan**

---

## 13. RISKS & MITIGATION

| Risk | Impact | Probability | Mitigation |
|------|--------|-------------|------------|
| Data privacy breach | High | Low | Implement encryption, regular security audits |
| System downtime | High | Medium | Backup server, monitoring, quick recovery plan |
| Low user adoption | Medium | Medium | User training, intuitive UI, support team |
| Integration issues | Medium | Medium | Thorough testing, API documentation |
| Scope creep | Medium | High | Clear requirements, change management process |
| Budget overrun | Medium | Medium | Regular budget review, prioritize features |

---

## 14. STAKEHOLDERS

- **Project Owner:** Management Klinik Mon Cheri
- **End Users:** Pasien, Staff Klinik, Dokter
- **Development Team:** Backend dev, Frontend dev, UI/UX designer
- **QA Team:** Tester
- **IT Support:** System administrator

---

## 15. APPROVAL

**Prepared by:** Development Team  
**Reviewed by:** Project Manager  
**Approved by:** Klinik Mon Cheri Management

---

**Document Version History:**
- v1.0 (28 Mei 2026) - Initial PRD

