Office Asset Management API

A secure REST API for managing office assets, simulating an office inventory system using PHP and MySQL.

Table of Contents

Overview

Features

Project Structure

Requirements

Installation

Database Setup

Security Measures

API Endpoints

Usage

Contributing

License

Overview

This project provides a REST API to manage office assets such as computers, monitors, desks, and chairs. It supports CRUD operations and filtering, with a focus on security and simplicity for development teams.

Features

CRUD operations for office assets

Filter assets by type (e.g., Computer, Monitor)

JSON-based API with CORS support

Pagination for listing assets

Input validation, CSRF protection, and security headers

Project Structure

office-asset-management/
├── config/
│ └── db.php # Database configuration
├── sql/
│ └── asset.sql # Database schema and seed data
├── src/
│ ├── api/
│ │ ├── create.php # Create asset endpoint
│ │ ├── delete.php # Delete asset endpoint
│ │ ├── read.php # Read all assets endpoint
│ │ ├── filter.php # Filter assets by type
│ │ └── update.php # Update asset endpoint
│ └── utils/
│ └── security.php # Security utilities (CSRF, sanitization)
├── .gitignore # Git ignore file
└── README.md # Project documentation

Requirements

PHP 8.0 or higher

MySQL or MariaDB

Web server (e.g., Apache, Nginx)

PHP session support

Installation

Clone the repository:

git clone https://github.com/yourusername/office-asset-management.git
cd office-asset-management

Configure database credentials in config/db.php:

$user = 'your_username'; // Replace with your database username
$pass = 'your_password'; // Replace with your database password
$dbname = 'asset';

Security Note: Avoid hardcoding credentials in production. Consider using environment variables (e.g., getenv()) or a configuration file outside the web root.

Database Setup

Create a MySQL database named asset:

mysql -u your_username -p -e "CREATE DATABASE asset"

Import the sql/asset.sql file:

mysql -u your_username -p asset < sql/asset.sql

Security Measures

CSRF Protection: POST, PATCH, and DELETE endpoints require a valid CSRF token.

Input Sanitization: All inputs are sanitized to prevent XSS.

Security Headers: Includes CSP, X-Content-Type-Options, X-Frame-Options, and X-XSS-Protection.

Prepared Statements: Prevents SQL injection.

Recommendations:

Implement JWT or API keys for authentication.

Use a rate-limiting middleware (e.g., via Apache/Nginx).

Enable HTTPS in production.

Move config/db.php outside the web root in production.

Use environment variables instead of hardcoding credentials.

API Endpoints

POST /src/api/create.php: Create a new asset

Body: {"code": "AC011", "type": "Computer", "description": "Gaming PC", "serial": "SN011", "csrf_token": "your_csrf_token"}

Response: {"status": "Complete", "message": "Asset created"}

GET /src/api/read.php?page=1: Retrieve all assets (10 per page)

Response: [{"id": 1, "code": "AC001", "type": "Computer", "description": "Desktop PC", "serial": "SN001"}, ...]

GET /src/api/filter.php?type=Computer: Filter assets by type (max 5 results)

Response: [{"id": 1, "code": "AC001", "type": "Computer", "description": "Desktop PC", "serial": "SN001"}, ...]

PATCH /src/api/update.php: Update an existing asset

Body: {"id": 1, "code": "AC001", "type": "Computer", "description": "Updated PC", "serial": "SN001", "csrf_token": "your_csrf_token"}

Response: {"status": "Complete", "message": "Asset updated"}

DELETE /src/api/delete.php: Delete an asset

Body: {"id": 1, "csrf_token": "your_csrf_token"}

Response: {"status": "Complete", "message": "Asset deleted"}

Usage

Deploy the project to a web server with PHP and MySQL support.

Configure config/db.php with your database credentials.

Generate a CSRF token for POST/PATCH/DELETE requests:

Create a separate endpoint (e.g., src/api/get_csrf.php) or include in your frontend logic.

Example get_csrf.php:

<?php
session_start();
require_once __DIR__ . '/../utils/security.php';
setSecurityHeaders();
header("Content-type: application/json; charset=utf-8");
echo json_encode(["csrf_token" => generateCsrfToken()]);
?>

Test the API using Postman or curl. Example:

curl -X POST http://localhost/src/api/create.php -H "Content-Type: application/json" -d '{"code":"AC011","type":"Computer","description":"Gaming PC","serial":"SN011","csrf_token":"your_csrf_token"}'

Contributing

Fork the repository.

Create a feature branch: git checkout -b feature/your-feature

Commit your changes: git commit -m "Add your feature"

Push to the branch: git push origin feature/your-feature

Create a Pull Request.

License

This project is licensed under the MIT License.
