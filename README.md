# 🚀 Office Asset Management API

A secure and lightweight REST API for managing office assets like computers, monitors, desks, and chairs. Built with PHP and MySQL, it offers robust CRUD operations and type-based filtering with a focus on security and simplicity.

---

## 📑 Table of Contents

- [Overview](#overview)  
- [Features](#features)  
- [Project Structure](#project-structure)  
- [Requirements](#requirements)  
- [Installation](#installation)  
- [Database Setup](#database-setup)  
- [Security Measures](#security-measures)  
- [API Endpoints](#api-endpoints)  
- [Usage](#usage)  
- [Contributing](#contributing)  
- [License](#license)  

---

## 🧭 Overview

The Office Asset Management API is designed to streamline office inventory tracking. It supports CRUD operations, type-based filtering, and pagination, delivering a secure and developer-friendly solution for managing office assets efficiently.

---

## ✨ Features

- 🛠️ **CRUD Operations**: Create, read, update, and delete office assets  
- 🔎 **Type Filtering**: Filter assets by type (e.g., Computer, Monitor)  
- 🌐 **JSON API with CORS**: Seamless integration with frontend applications  
- 📄 **Pagination**: Retrieve assets 10 per page for efficient data handling  
- 🔒 **Security**: CSRF protection, input sanitization, security headers, and prepared statements  

---

## ⚙️ Requirements

- PHP: **8.0** or higher  
- Database: **MySQL** or **MariaDB**  
- Web Server: Apache, Nginx, or similar  
- PHP Session Support: For CSRF protection  

---

## 🛠 Installation

## 📂 Clone the Repository

```sh
git clone https://github.com/yourusername/office-asset-management.git
cd office-asset-management
```

## 🔑 Configure Database Credentials
Edit config/db.php:
```sh
<?php
$user = 'your_username'; // Replace with your database username
$pass = 'your_password'; // Replace with your database password
$dbname = 'asset';
?>
```
⚠️ Security Note: Avoid hardcoding credentials in production. Use environment variables (e.g., getenv()) or move config/db.php outside the web root.

---

## 🗄 Database Setup
### 🏗 Create the Database
```sh
mysql -u your_username -p -e "CREATE DATABASE asset"  
```
### 📥 Import the Schema
```sh
mysql -u your_username -p asset < sql/asset.sql  
```

---

## 🔒 Security Measures
- 🛡 CSRF Protection: Requires a valid CSRF token for POST, PATCH, and DELETE endpoints
- 🔍 Input Sanitization: Prevents XSS by sanitizing all inputs
- ⚙️ Security Headers: Includes CSP, X-Content-Type-Options, X-Frame-Options, and X-XSS-Protection
- 🏗 Prepared Statements: Mitigates SQL injection risks

---

## 🎯 Recommendations
🔑 Implement JWT or API keys for authentication  
⏱️ Use rate-limiting middleware (e.g., Apache/Nginx)  
🔗 Enable HTTPS in production  
📂 Move config/db.php outside the web root  
🌍 Use environment variables for credentials  

---

## 📡 API Endpoints
### ➕ Create a new asset

| 🛠️ Method | 🔗 Endpoint | 📋 Description | 📩 Request / 📤 Response |
| --- | --- | --- | --- |
| POST | `/src/api/create.php` | Create a new asset | **📩 Request**:<br>```json<br>{"code": "AC011", "type": "Computer", "description": "Gaming PC", "serial": "SN011", "csrf_token": "your_csrf_token"}<br>```<br>**📤 Response**:<br>```json<br>{"status": "Complete", "message": "Asset created"}<br>``` |
| GET | `/src/api/read.php?page=1` | Retrieve assets (10/page) | **📩 Request**: `GET /src/api/read.php?page=1`<br>**📤 Response**:<br>```json<br>[<br>  {"id": 1, "code": "AC001", "type": "Computer", "description": "Desktop PC", "serial": "SN001"},<br>  ...<br>]<br>``` |
| GET | `/src/api/filter.php?type=Computer` | Filter assets by type (max 5) | **📩 Request**: `GET /src/api/filter.php?type=Computer`<br>**📤 Response**:<br>```json<br>[<br>  {"id": 1, "code": "AC001", "type": "Computer", "description": "Desktop PC", "serial": "SN001"},<br>  ...<br>]<br>``` |
| PATCH | `/src/api/update.php` | Update an existing asset | **📩 Request**:<br>```json<br>{"id": 1, "code": "AC001", "type": "Computer", "description": "Updated PC", "serial": "SN001", "csrf_token": "your_csrf_token"}<br>```<br>**📤 Response**:<br>```json<br>{"status": "Complete", "message": "Asset updated"}<br>``` |
| DELETE | `/src/api/delete.php` | Delete an asset | **📩 Request**:<br>```json<br>{"id": 1, "csrf_token": "your_csrf_token"}<br>```<br>**📤 Response**:<br>```json<br>{"status": "Complete", "message": "Asset deleted"}<br>``` |

---

## 🔧 Usage
### 🚀 Deploy
Deploy to a web server with PHP and MySQL support  

### 🔧 Configure
Update config/db.php with your database credentials  

### 🔑 Generate CSRF Tokens
Create src/api/get_csrf.php:
```sh
<?php
session_start();
require_once __DIR__ . '/../utils/security.php';
setSecurityHeaders();
header("Content-type: application/json; charset=utf-8");
echo json_encode(["csrf_token" => generateCsrfToken()]);
?>
```

🔍 Fetch from frontend:
```sh
fetch('/src/api/get_csrf.php')
    .then(response => response.json())
    .then(data => {
        // Use data.csrf_token in requests
    });
```

---

## 🤝 Contributing
### 🔄 Fork the repository  
### 🌿 Create a feature branch:
```sh 
git checkout -b feature/your-feature  
```

### 📝 Commit your changes:
```sh
git commit -m "Add your feature"  
```

### 🚀 Push to the branch:
```sh
git push origin feature/your-feature  
```

### 📨 Create a Pull Request  

---

## 📜 License
This project is licensed under the MIT License.  


