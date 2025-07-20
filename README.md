# Office Asset Management API 📦

A secure and efficient REST API for managing office assets. Track computers, monitors, and office furniture with comprehensive management capabilities and security features.

---

## 🛠️ Tech Stack

* **Backend**: PHP 8.0+
* **Database**: MySQL/MariaDB
* **Architecture**: RESTful API
* **Format**: JSON
* **Security**: CSRF, Input Sanitization
* **Integration**: CORS Enabled

## 📁 Project Structure

```
office-asset/
├── src/
│   ├── api/          # API endpoints (CRUD operations)
│   └── utils/        # Security and helper functions
├── config/           # Configuration files
└── sql/             # Database schema
```

## 💾 Database Schema

| Field | Type | Description |
|-------|------|-------------|
| `id` | INT | Primary key |
| `code` | VARCHAR(10) | Asset code (e.g., AC001) |
| `type` | VARCHAR(50) | Computer, Monitor, etc. |
| `description` | TEXT | Asset details |
| `serial` | VARCHAR(50) | Serial number |

## ✨ Features
### Asset Management
* ✏️ Create assets with detailed information
* 🔄 Update asset details and status
* 🗑️ Delete assets from system
* 📋 List assets with pagination

### Organization
* 🔍 Filter by asset types
* 💻 Track computer equipment
* 🖥️ Monitor inventory
* 🪑 Furniture management
* 📦 Other office items

## 🚀 Getting Started

### 1. Clone Repository
```bash
git clone https://github.com/windme2/office-asset.git
cd office-asset
```

### 2. Configure Database
```php
// config/db.php
$user = 'your_username';
$pass = 'your_password';
$dbname = 'asset';

```

## 📡 API Reference

### Create Asset
```http
POST /src/api/create.php
Content-Type: application/json

{
  "code": "AC011",
  "type": "Computer",
  "description": "Gaming PC",
  "serial": "SN011",
}
```

### List & Filter Assets
```http
# Get all assets (paginated)
GET /src/api/read.php?page=1

# Filter by type
GET /src/api/filter.php?type=Computer
```

### Update Asset
```http
PATCH /src/api/update.php
Content-Type: application/json

{
  "id": 1,
  "code": "AC001",
  "type": "Computer",
  "description": "Updated PC",
  "serial": "SN001",
}
```

### Delete Asset
```http
DELETE /src/api/delete.php
Content-Type: application/json

{
  "id": 1,
  "csrf_token": "token"
}

```

### API Usage Example
```javascript
// Create new asset
const createAsset = async (assetData) => {
    const token = await getToken();
    const response = await fetch('/src/api/create.php', {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            ...assetData,
            csrf_token: token
        })
    });
    return response.json();
};
```

## 🤝 Contributing

1. **Fork** the repository
2. **Clone** your fork:
   ```bash
   git clone https://github.com/windme2/office-asset.git
   cd office-asset
   ```
3. Create a **feature branch**:
   ```bash
   git checkout -b feature/asset-feature
   ```
4. Make your **changes** and commit:
   ```bash
   git commit -m "Add asset feature"
   ```
5. **Push** to your fork:
   ```bash
   git push origin feature/asset-feature
   ```
6. Create a **Pull Request**

## 📝 License

This project is licensed under the MIT License.


