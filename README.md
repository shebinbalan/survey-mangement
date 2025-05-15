# 📝 Laravel 11+ Survey Management System

A powerful and fully-featured Survey Management System built with Laravel 11+, supporting both admin and user modules. Create, manage, and analyze surveys with multilingual support, advanced question types, response analytics, and export options.

---

## 🚀 Features

### 👨‍💼 Admin Module
- Role-based login using Spatie
- Create and manage surveys
- Add questions and options (multiple types: text, MCQ, rating, Likert scale, image upload)
- Drag-and-drop question and option reordering
- Set survey visibility (active/inactive)
- Preview surveys before publishing
- View all responses grouped by user
- View answers grouped by question
- Chart-based analytics using Chart.js (Bar & Pie)
- Export responses to Excel/PDF

### 👤 User Module
- Register/Login
- Dashboard showing available surveys and past responses
- One-question-at-a-time interface with progress bar
- Survey timer countdown
- Support for star ratings, Likert scale, image upload
- Multilingual surveys (English / Malayalam)
- View submitted surveys & answers

---

## 📦 Tech Stack

- Laravel 11+
- Spatie Permissions
- Blade Templating (Bootstrap/Tailwind)
- Chart.js
- Laravel Excel (for export)
- Flatpickr (datepicker)
- MySQL

---

## ⚙️ Installation Instructions

```bash
git clone https://github.com/your-username/laravel-survey-project.git
cd laravel-survey-project
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install && npm run build
php artisan serve
