Office Asset Management API 🚀
A secure and lightweight REST API for managing office assets like computers, monitors, desks, and chairs. Built with PHP and MySQL, it offers robust CRUD operations and type-based filtering with a focus on security and simplicity.

📑 Table of Contents

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


🌟 Overview
The Office Asset Management API provides a streamlined solution for tracking office inventory. It supports CRUD operations, type-based filtering, and pagination, all wrapped in a secure and developer-friendly package. Perfect for teams managing office assets with ease and reliability.

✨ Features

🛠️ CRUD Operations: Create, read, update, and delete office assets.
🔎 Type Filtering: Filter assets by type (e.g., Computer, Monitor).
🌐 JSON API with CORS: Seamless integration with frontend applications.
📄 Pagination: Retrieve assets 10 per page for efficient data handling.
🔒 Security: CSRF protection, input sanitization, security headers, and prepared statements.


📂 Project Structure
office-asset-management/
├── 📁 config/
│   └── db.php              # Database configuration
├── 📁 sql/
│   └── asset.sql           # Database schema and seed data
├── 📁 src/
│   ├── 📁 api/
│   │   ├── create.php      # Create asset endpoint
│   │   ├── delete.php      # Delete asset endpoint
│   │   ├── read.php        # Read all assets endpoint
│   │   ├── filter.php      # Filter assets by type
│   │   └── update.php      # Update asset endpoint
│   ├── 📁 utils/
│   │   └── security.php    # Security utilities (CSRF, sanitization)
├── 📄 .gitignore           # Git ignore file
└── 📄 README.md            # Project documentation


🛠️ Requirements

PHP: 8.0 or higher
Database: MySQL or MariaDB
Web Server: Apache, Nginx, or similar
PHP Session Support: For CSRF protection


⚙️ Installation

Clone the repository:
git clone https://github.com/yourusername/office-asset-management.git
cd office-asset-management


Configure database credentials in config/db.php:
$user = 'your_username'; // Replace with your database username
$pass = 'your_password'; // Replace with your database password
$dbname = 'asset';

⚠️ Security Note: Avoid hardcoding credentials in production. Use environment variables (e.g., getenv()) or move config/db.php outside the web root.



🗄️ Database Setup

Create the asset database:
mysql -u your_username -p -e "CREATE DATABASE asset"


Import the schema:
mysql -u your_username -p asset < sql/asset.sql




🔐 Security Measures

CSRF Protection: POST, PATCH, and DELETE endpoints require a valid CSRF token.
Input Sanitization: Prevents XSS by sanitizing all inputs.
Security Headers: Includes CSP, X-Content-Type-Options, X-Frame-Options, and X-XSS-Protection.
Prepared Statements: Mitigates SQL injection risks.

Recommendations:

🔑 Implement JWT or API keys for authentication.
⏱️ Use rate-limiting middleware (e.g., Apache/Nginx).
🔗 Enable HTTPS in production.
📂 Move config/db.php outside the web root.
🌍 Use environment variables for credentials.


🌐 API Endpoints



Method
Endpoint
Description
Request Body/Example Response



POST
/src/api/create.php
Create a new asset
Body: {"code": "AC011", "type": "Computer", "description": "Gaming PC", "serial": "SN011", "csrf_token": "your_csrf_token"}Response: {"status": "Complete", "message": "Asset created"}


GET
/src/api/read.php?page=1
Retrieve assets (10 per page)
Response: [{"id": 1, "code": "AC001", "type": "Computer", "description": "Desktop PC", "serial": "SN001"}, ...]


GET
/src/api/filter.php?type=Computer
Filter assets by type (max 5)
Response: [{"id": 1, "code": "AC001", "type": "Computer", "description": "Desktop PC", "serial": "SN001"}, ...]


PATCH
/src/api/update.php
Update an existing asset
Body: {"id": 1, "code": "AC001", "type": "Computer", "description": "Updated PC", "serial": "SN001", "csrf_token": "your_csrf_token"}Response: {"status": "Complete", "message": "Asset updated"}


DELETE
/src/api/delete.php
Delete an asset
Body: {"id": 1, "csrf_token": "your_csrf_token"}Response: {"status": "Complete", "message": "Asset deleted"}



🚀 Usage

Deploy to a web server with PHP and MySQL support.
Configure config/db.php with your database credentials.
Generate CSRF tokens for POST/PATCH/DELETE requests:
Create src/api/get_csrf.php:<?php
session_start();
require_once __DIR__ . '/../utils/security.php';
setSecurityHeaders();
header("Content-type: application/json; charset=utf-8");
echo json_encode(["csrf_token" => generateCsrfToken()]);
?>


Fetch from frontend:fetch('/src/api/get_csrf.php')
    .then(response => response.json())
    .then(data => {
        // Use data.csrf_token in requests
    });




Test the API with Postman or curl:curl -X POST http://localhost/src/api/create.php \
     -H "Content-Type: application/json" \
     -d '{"code":"AC011","type":"Computer","description":"Gaming PC","serial":"SN011","csrf_token":"your_csrf_token"}'




🤝 Contributing

Fork the repository.
Create a feature branch:git checkout -b feature/your-feature


Commit your changes:git commit -m "Add your feature"


Push to the branch:git push origin feature/your-feature


Create a Pull Request.


📜 License
This project is licensed under the MIT License.

Built with ❤️ for efficient office asset management.
