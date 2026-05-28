Implementasi PRD Klinik Mon Cheri selesai. Berikut ringkasan yang telah dibuat:
✅ Database (12 Migration + Seeder)

- users (updated dgn role, phone, is_active)
- patients, doctors, services, doctor_service (pivot)
- schedules, appointments, medical_records (soft deletes)
- prescriptions, payments, articles, inapp_notifications
  ✅ Models (11 Models)
  Semua model dengan relationships: User, Patient, Doctor, Service, Schedule, Appointment, MedicalRecord, Prescription, Payment, Article, InappNotification
  ✅ Middleware
- RoleMiddleware — role-based access (role:patient, role:doctor, role:staff, role:admin)
  ✅ 15 Controllers
  Auth (login/register), Dashboard, Patient, Appointment, Doctor, MedicalRecord, Staff, Admin, Service, Article, Schedule, Payment, Profile, HomeController (public pages)
  ✅ 39 Blade Views
- Public: Homepage pink theme, Layanan, Dokter, Artikel, Kontak
- Auth: Login, Register
- Patient: Dashboard, Profile, Appointments (CRUD), Medical Records
- Staff: Dashboard, Manage Appointments, Patients (CRUD), Payments, Medical Records
- Doctor: Dashboard, Appointments, Medical Records (input + prescriptions)
- Admin: Dashboard, Users, Doctors, Services (CRUD), Articles (CRUD), Schedules
  ✅ 65 Routes
  Public, guest, auth, dan role-specific routes untuk patient/staff/doctor/admin
  ✅ Seeder (Data Awal)
  Akun Email
  Admin admin@moncheri.id (mailto:admin@moncheri.id)
  Dokter 1 dokter.sarah@moncheri.id (mailto:dokter.sarah@moncheri.id)
  Dokter 2 dokter.rina@moncheri.id (mailto:dokter.rina@moncheri.id)
  Staff staff@moncheri.id (mailto:staff@moncheri.id)
  Pasien budi@example.com (mailto:budi@example.com)
- 6 Layanan + 3 Artikel kesehatan
  🎨 Tema
  Warna pink/rose (#FFB6C1) & gold (#D4AF37), font Poppins + Inter, Tailwind CSS 4, Alpine.js
  Jalankan dengan php artisan serve via XAMPP PHP atau langsung dari panel XAMPP Anda.
