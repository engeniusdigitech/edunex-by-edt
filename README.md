# EduCore Coaching Management SaaS

EduCore is a comprehensive, multi-tenant Software as a Service (SaaS) application built to power modern coaching institutes, tuition centers, and educational academies. It handles everything from student enrollment and daily attendance to fee tracking, advanced analytics, and academic learning management—all under a single, isolated, role-based architecture.

## 🚀 Key Features

### 🏢 Multi-Tenant SaaS Architecture
- **Super Administration:** Global platform owners can manage the overarching SaaS configuration, onboard new coaching institutes, and design subscription pricing plans.
- **Strict Data Isolation (`TenantScope`):** Each registered coaching institute is completely siloed. An Institute Admin inherently only interacts with their own students, batches, payments, and staff securely, without explicit where-clauses littering the codebase.

### 👥 Role-Based Access Control (RBAC)
Robust internal Laravel Gates & Policies ensure data integrity:
- **Institute Admin:** Full access to configure the institute, manage staff, and view high-level revenue analytics.
- **Teacher:** Restricted access focused purely on student management, daily attendance marking, and academic grading.
- **Receptionist:** Restricted access focused exclusively on managing the financial ledger, creating fee structures, and recording fee payments.

### 💰 Finance & Fee Management
- **Payment Ledger:** Log manual fee payments against specific, configurable Student Fee Structures.
- **Defaulters List:** Auto-generated reports identifying students with pending tuition payments for the active month.
- **WhatsApp Integration:** Admins can instantly trigger pre-filled WhatsApp reminders to pending defaulters with a single click.

### 📊 Advanced Analytics & Reporting
- **Dynamic Dashboard:** Real-time Chart.js visualizations aggregating active monthly revenue.
- **PDF Export Engine:** One-click, pixel-perfect PDF report generation (via `DomPDF`) for Batch-wise monthly attendance logs and financial defaulters lists.

### 🎓 Learning Management System (LMS)
A dedicated Academics module directly connecting teachers to students:
- **Homework Assignments:** Assign dynamic homework tasks targeting specific batches with strict due dates.
- **Tests & Exams:** Schedule tests with custom total marks configurations. Features a high-speed, spreadsheet-like interface for teachers to bulk-enter marks and remarks for an entire batch at once.

### 📱 The Student Portal (Progressive Web App)
A standalone, fully-featured mobile experience built purely for students (secured via a rigorous Multi-Auth `student` guard).
- **Offline-Ready PWA:** Students can "Install" the portal directly to their iOS/Android home screens without navigating App Stores. It features an immersive standalone display, sleek app icons, and offline caching via a native Service Worker `sw.js`.
- **Instant Push Notifications:** Integrated Laravel Database Notifications dispatch real-time portal alerts directly to the student's dashboard whenever a new homework assignment is given or an exam is scheduled.
- **Personalized Dashboard:** Students can securely monitor their own real-time attendance percentages, upcoming assignment deadlines, previous test scores, and download a history of their paid fee receipts.

---

## 🛠️ Technology Stack
- **Backend Framework:** Laravel 11 (PHP 8.3)
- **Database:** MySQL relational model structured for absolute multi-tenant scale.
- **Authentication:** Dual-stack utilizing Laravel Breeze (Staff) + Custom Multi-Auth Guards (Students).
- **Frontend Design:** Custom HTML5/CSS3 utilizing Bootstrap 5, featuring a highly-modern Glassmorphic UI aesthetic, Outfit Google Font typography, and dynamic background gradients.
- **PDF Generation:** `barryvdh/laravel-dompdf`

---

## ⚙️ Installation & Setup (Local Development)

### 1. Requirements
Ensure your environment (such as Laragon or XAMPP) is running **PHP 8.2+** and **MySQL 8.0+**.

### 2. Software Initialization
Navigate to the project root (`c:\laragon\www\edu`) in your terminal and ensure dependencies are installed:
```bash
composer install
npm install
npm run build
```

### 3. Database Preparation
Create a MySQL database named `educore_db`. Duplicate your `.env.example` to `.env` and verify the DB credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=educore_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Deploy Migrations and Seed Dummy Data
Run the following Artisan command to build the entire production-ready database schema and instantly populate it with secure test accounts:
```bash
php artisan migrate:fresh --seed
```

### 5. Start the Application
If you are strictly using Artisan (instead of a Laragon Virtual Host like `edu.test`), boot the server:
```bash
php artisan serve
```

---

## 🔑 Default Seeded Test Accounts

To immediately test the application's isolated multi-tenant capabilities, login at `http://localhost:8000/login` using the following seeded credentials:

**1. The Platform Owner (Super Admin)**
- Email: `superadmin@educore.com`
- Password: `password`

**2. Coaching Institute Owner (Institute Admin)**
- Email: `admin@apexcoaching.com` (or `admin@institute1.com` depending on seeder generation)
- Password: `password`

**3. Student Mobile Portal Demo**
Navigate to `http://localhost:8000/student/login` to experience the Progressive Web App.
- Email: `student@example.com` (Check the `students` DB table for exact auto-generated emails)
- Password: `password`
