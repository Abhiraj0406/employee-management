# Employee Management System

## Project Overview

This project is developed as part of a Laravel technical assignment provided by **Tech2Globe**.

It is a mini **Employee Management System** built using **Laravel 12**, **Blade**, **Laravel Breeze**, **MySQL**, and **Tailwind CSS**. The project demonstrates authentication, role-based access control, employee profile management, file uploads, validation, and clean Laravel MVC structure.

---

## Objective

The objective of this project is to demonstrate:

- Laravel authentication using Breeze
- CRUD operations
- Role-based access control using custom middleware
- Employee profile create, view, and update functionality
- File upload handling for profile photos and documents
- One-to-many relationship between employee profile and education records
- Server-side validation
- Clean MVC-based Laravel architecture

---

## What We Used in This Project

### Backend

- **Laravel 12**
- **PHP**
- **Laravel MVC architecture**
- **Eloquent ORM**
- **Middleware**
- **Form validation**
- **File storage using Laravel public disk**

### Authentication

- **Laravel Breeze**
- Breeze Blade starter kit
- Login
- Register
- Logout
- Account profile update

### Frontend

- **Blade templates**
- **Tailwind CSS**
- Basic JavaScript for dynamic education rows and tabs

### Database

- **MySQL**
- Laravel migrations
- Foreign key relationships

### Tools

- Composer
- NPM
- Vite
- XAMPP / MySQL
- phpMyAdmin
- Git / GitHub

---

## Roles

The system has two roles:

```text
admin
employee
```

### Admin

Admin can:

- Access admin dashboard
- View all employee profiles
- View full details of any employee
- View own account profile

### Employee

Employee can:

- Access employee dashboard
- Create own profile
- Edit own profile
- View own profile
- Upload profile photo
- Add multiple education/document records
- Upload certificate/document files

---

## Role-Based Access Control

Role-based access is implemented using a custom middleware:

```text
app/Http/Middleware/RoleMiddleware.php
```

The middleware checks the logged-in user's role before allowing access to protected routes.

Example route protection:

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Admin routes
});

Route::middleware(['auth', 'role:employee'])->group(function () {
    // Employee routes
});
```

The middleware alias is registered in:

```text
bootstrap/app.php
```

---

## Main Features

### Authentication Module

Implemented using Laravel Breeze.

Features:

- Register
- Login
- Logout
- Authenticated dashboard redirect
- Account profile update

---

### Employee Profile Module

The employee profile form is divided into two tabs.

### Tab 1: Basic Information

Fields:

- Full Name
- Email
- Phone Number
- Date of Birth
- Gender
- Address Line 1
- Address Line 2
- City
- State
- Pincode
- Country
- Profile Photo

### Tab 2: Education & Documents

Fields:

- Diploma / Certificate Name
- Institute Name
- Year of Completion
- Upload File

The education section supports multiple entries using dynamic add/remove rows.

---

### Admin Panel

Admin can:

- View all employees
- View full employee profile
- View employee education records
- View uploaded documents

---

### Employee Panel

Employee can:

- Create own profile
- View own profile
- Edit own profile
- Manage education/document records

---

## Database Design

### Tables

### users

Stores authentication and role information.

Important columns:

```text
id
name
email
email_verified_at
password
role
remember_token
created_at
updated_at
```

### employee_profiles

Stores employee basic profile information.

Important columns:

```text
id
user_id
full_name
email
phone
date_of_birth
gender
address_line_1
address_line_2
city
state
pincode
country
profile_photo
created_at
updated_at
```

### employee_educations

Stores employee education and document records.

Important columns:

```text
id
employee_profile_id
certificate_name
institute_name
year_of_completion
document_file
created_at
updated_at
```

---

## Relationships

```text
User has one EmployeeProfile
EmployeeProfile belongs to User

EmployeeProfile has many EmployeeEducations
EmployeeEducation belongs to EmployeeProfile
```

---

## ERD

```text
users
-----
id PK
name
email
email_verified_at
password
role
remember_token
created_at
updated_at


employee_profiles
-----------------
id PK
user_id FK -> users.id
full_name
email
phone
date_of_birth
gender
address_line_1
address_line_2
city
state
pincode
country
profile_photo
created_at
updated_at


employee_educations
-------------------
id PK
employee_profile_id FK -> employee_profiles.id
certificate_name
institute_name
year_of_completion
document_file
created_at
updated_at
```

---

## Project Structure

```text
app/
 ├── Http/
 │   ├── Controllers/
 │   │   ├── Admin/
 │   │   │   └── EmployeeController.php
 │   │   ├── Employee/
 │   │   │   └── EmployeeProfileController.php
 │   │   └── ProfileController.php
 │   └── Middleware/
 │       └── RoleMiddleware.php
 │
 ├── Models/
 │   ├── User.php
 │   ├── EmployeeProfile.php
 │   └── EmployeeEducation.php

resources/
 └── views/
     ├── admin/
     │   ├── dashboard.blade.php
     │   └── employees/
     │       ├── index.blade.php
     │       └── show.blade.php
     │
     ├── employee/
     │   ├── dashboard.blade.php
     │   └── profile/
     │       ├── create.blade.php
     │       ├── edit.blade.php
     │       └── show.blade.php
     │
     └── profile/

routes/
 ├── web.php
 └── auth.php
```

---

## Installation and Setup

### 1. Clone the repository

```bash
git clone your-repository-url
cd employee-management
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install frontend dependencies

```bash
npm install
```

### 4. Create environment file

```bash
cp .env.example .env
```

For Windows PowerShell:

```bash
copy .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Configure database

Create a database in phpMyAdmin:

```text
t2g_portal
```

Update `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=t2g_portal
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Run migrations

```bash
php artisan migrate:fresh
```

### 8. Create storage link

```bash
php artisan storage:link
```

This is required to display uploaded profile photos and documents in the browser.

### 9. Start Vite

```bash
npm run dev
```

### 10. Start Laravel server

Open another terminal and run:

```bash
php artisan serve
```

Open the project:

```text
http://127.0.0.1:8000
```

---

## Test Users

Register users from:

```text
/register
```

By default, every registered user is created as an employee.

Example employee:

```text
Email: employee@gmail.com
Password: password
Role: employee
```

To make a user admin, update the role in phpMyAdmin or run this SQL query:

```sql
UPDATE users SET role = 'admin' WHERE email = 'admin@gmail.com';
```

Example admin:

```text
Email: admin@gmail.com
Password: password
Role: admin
```

---

## Important Routes

### Common Routes

```text
/
/dashboard
/account/profile
```

### Admin Routes

```text
/admin/dashboard
/admin/employees
/admin/employees/{employeeProfile}
```

### Employee Routes

```text
/employee/dashboard
/employee/profile
/employee/profile/create
/employee/profile/edit
```

---

## File Uploads

Uploaded profile photos are stored in:

```text
storage/app/public/profile_photos
```

Uploaded employee documents are stored in:

```text
storage/app/public/employee_documents
```

Browser access is available through:

```text
public/storage
```

Required command:

```bash
php artisan storage:link
```

---

## Validation

Validation is applied in `EmployeeProfileController` for:

- Required fields
- Email format
- Image upload type
- Document upload type
- Year of completion
- Maximum file size

Allowed profile photo types:

```text
jpg, jpeg, png
```

Allowed document types:

```text
pdf, jpg, jpeg, png
```

---

## Final Testing Checklist

Before submission, verify:

```text
Employee can register and login
Employee can create own profile
Employee can add multiple education records
Employee can upload profile photo
Employee can upload documents
Employee can view own profile
Employee can edit own profile

Admin can login
Admin can view dashboard
Admin can view all employees
Admin can view full employee profile
Admin can view own account profile

Employee cannot access admin routes
Admin routes are protected by role middleware
Employee routes are protected by role middleware
Uploaded files are visible through storage link
```

---

## Project Status

Completed:

- Laravel Breeze authentication
- Role column in users table
- Custom RoleMiddleware
- Admin dashboard
- Employee dashboard
- Employee profile create page
- Employee profile view page
- Employee profile edit page
- Multiple education records
- Dynamic add/remove education rows
- File upload handling
- Admin employee listing
- Admin employee detail page
- README documentation
- ERD documentation

