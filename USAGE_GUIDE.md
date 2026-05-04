# EduNex Usage Guide

---

## 🔐 Login URLs
- **Staff (Admin/Teacher/Principal/Receptionist):** `http://edunexerp.online/login`
- **Student Portal:** `http://edunexerp.online/student/login`

---

## 🛡️ As Institute Admin

**Credentials:** `admin@apexinstitute.com` / `password`

1. Login at `/login`
2. **Setup Institute** → Go to Settings, configure institute name, logo, and details
3. **Create Batches** → Navigate to Batches → Add New Batch (e.g., "Grade 10 - Math")
4. **Add Staff** → Go to Staff → Invite/Create Teacher or Receptionist accounts
5. **Enroll Students** → Go to Students → Add New Student, assign to a batch
6. **Create Fee Structures** → Go to Finance → Fee Structures → Define monthly fee amounts per batch
7. **View Analytics** → Dashboard shows real-time revenue charts and attendance summaries
8. **Export Reports** → Go to Reports → Download PDF for attendance or defaulters list
9. **Send WhatsApp Reminders** → Go to Finance → Defaulters → Click WhatsApp icon next to pending students

---

## 🎓 As Teacher

**Credentials:** Create via Admin panel or use seeded teacher account / `password`

1. Login at `/login`
2. **Mark Attendance** → Go to Attendance → Select Batch → Mark Present/Absent for each student → Save
3. **Assign Homework** → Go to Academics → Homework → Add New → Select batch, set title, description, and due date
4. **Schedule a Test** → Go to Academics → Tests → Add New → Set test name, total marks, and batch
5. **Enter Test Marks** → Go to Academics → Tests → Click on a test → Use the spreadsheet-like interface to bulk-enter marks and remarks for all students → Save

---

## 📱 As Student

**Credentials:** Check `students` DB table for email / `password`

1. Login at `/student/login`
2. **Dashboard** → View attendance percentage, upcoming homework deadlines, and recent test scores
3. **Attendance** → See a detailed log of your daily attendance records
4. **Homework** → View all assigned homework with due dates
5. **Test Results** → Check marks and remarks for completed tests
6. **Fee Receipts** → Download PDF receipts for all paid fees
7. **Notifications** → Bell icon shows real-time alerts for new homework or scheduled tests
8. **Install as PWA** → On mobile, tap browser menu → "Add to Home Screen" to install the portal as an app (works on iOS & Android)
