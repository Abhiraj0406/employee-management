# Employee Management System

## Project Overview

This project is developed as part of a technical assignment provided by Tech2Globe.

It is a mini Employee Management System built using Laravel 12 and Blade, demonstrating real-world backend development concepts.

## Objective

The objective of this project is to demonstrate:

- CRUD operations
- Role-based access control
- File upload handling
- Clean architecture & validation

## Roles

### Admin

Admin can:

- View all employees
- View full employee profiles
- View own profile

### Employee

Employee can:

- Create own profile
- Edit own profile
- View own profile

## Features

### Employee Profile Module

Profile includes:

- Full Name
- Email
- Phone Number
- Date of Birth
- Gender
- Address Line 1 & 2
- City
- State
- Pincode
- Country
- Profile Photo

### Education & Documents

- Add multiple education records
- Dynamic add/remove fields
- Upload documents

Each record contains:

- Certificate / Diploma Name
- Institute Name
- Year of Completion
- File Upload

## Database Design

### Tables

#### users
- id
- name
- email
- password
- role (admin / employee)

#### employee_profiles
- id
- user_id
- personal details

#### employee_educations
- id
- employee_profile_id
- education details

### Relationships

- One user → One employee profile
- One profile → Many education records

## Tech Stack

- Laravel 12
- Blade
- MySQL
- PHP
- HTML/CSS

## Setup Instructions

```bash
composer install
npm install