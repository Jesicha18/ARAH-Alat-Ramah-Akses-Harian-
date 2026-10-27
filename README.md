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

## 🚀 Local Installation & Setup

To run this repository locally on your machine, follow these steps:

### Step 1: Clone the Repository
Open your terminal or command prompt and run the following command to clone this repository:
git clone [https://github.com/Jesicha18/ARAH-Alat-Ramah-Akses-Harian-.git](https://github.com/Jesicha18/ARAH-Alat-Ramah-Akses-Harian-.git)
cd ARAH-Alat-Ramah-Akses-Harian-

### Step 2: Install PHP Dependencies
composer install

### Step 3: Environment Configuration
cp .env.example .env
Next, generate the application encryption key:

### Step 4: Run Database Migrations
php artisan migrate

### Step 5: Start the Development Server
php artisan serve

Sekarang baris `git clone`-nya sudah bersih total dan siap digunakan di `README.md` GitHub kamu!
