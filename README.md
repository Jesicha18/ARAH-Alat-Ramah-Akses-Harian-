# ARAH - Daily Accessible Smart Cane

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/IoT-Arduino%2FESP32-blue?style=for-the-badge" alt="IoT">
  <img src="https://img.shields.io/badge/Status-Submissions-success?style=for-the-badge" alt="Status">
</p>

## 📌 Project Overview
**ARAH (Alat Ramah Akses Harian)** is an Internet of Things (IoT)-based **Smart Cane** designed to assist visually impaired individuals in navigating their daily environment safely. This project integrates hardware sensors and microcontrollers with a real-time web monitoring application built using Laravel.

---

## ✨ Key Features
- **Obstacle Detection:** Real-time sensor integration to detect obstacles and alert the user.
- **Web Monitoring Dashboard:** Allows caregivers or administrators to monitor device status and data live via a Laravel web app.
- **Early Alert System:** Fast-response feedback system to improve mobility safety.

---

## 🛠️ Tech Stack
- **Hardware / IoT:** ESP32 / Arduino microcontrollers, obstacle detection sensors.
- **Backend & Web Dashboard:** Laravel Framework (PHP), MySQL database.
- **Frontend:** Blade templates, Tailwind CSS.

---

## 📸 Application Preview
*(Opsional: Tambahkan screenshot tampilan web dashboard atau foto prototipe alat di sini agar juri bisa langsung melihat bentuk visualnya)*
<!-- ![Dashboard Preview](path/to/image.png) -->

---

## 🚀 Local Installation & Setup

To run this repository locally on your machine, follow these steps:

### Step 1: Clone the Repository
Open your terminal or command prompt and run the following command to clone this repository:
**git clone [https://github.com/Jesicha18/ARAH-Alat-Ramah-Akses-Harian-.git](https://github.com/Jesicha18/ARAH-Alat-Ramah-Akses-Harian-.git)**
**cd ARAH-Alat-Ramah-Akses-Harian**

### Step 2: Install PHP Dependencies
Make sure you have PHP and Composer installed, then run:
**composer install**

### Step 3: Environment Configuration
Copy the environment configuration file:
**cp .env.example .env**
- **Open the .env file and adjust your database connection settings (e.g., set your database name in DB_DATABASE=arah_db).**
- **Next, generate the application encryption key:**
**php artisan key:generate**

### Step 4: Run Database Migrations
Run the migrations to set up the required database tables:
**php artisan migrate**

### Step 5: Start the Development Server
**php artisan serve**

### ARAH is built on the belief that technology should empower everyone equally. With every step forward, we aim to bridge the gap between innovation and independence, because safety and accessibility are rights, not privileges.
