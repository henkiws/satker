# SATKER-PPBJ Management System

Sistem manajemen untuk Satuan Kerja (Satker) memilih Pengelola Pengadaan Barang/Jasa (PPBJ).

## Features (Phase 1)

- ✅ Login & Authentication
- ✅ Admin Dashboard
- ✅ CRUD Data Satker (Kode, Nama, Alamat)
- ✅ CRUD Data PPBJ (Nama, NIP, Jabatan)
- ✅ CRUD Data User & Role Management
- ✅ Responsive Design (Mobile-friendly)
- ✅ Minimalist Modern UI

## Tech Stack

- **Backend**: PHP Native (MVC Pattern)
- **Database**: MySQL
- **Frontend**: Tailwind CSS
- **Icons**: Font Awesome 6

## Color Palette

- Primary Dark: `#0F2854`
- Primary: `#1C4D8D`
- Primary Light: `#4988C4`
- Accent: `#BDE8F5`

## Installation

### Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx with mod_rewrite enabled
- Composer (optional)

### Steps

1. **Clone or Download Project**
```bash
   git clone <repository-url>
   cd satker-ppbj
```

2. **Create Database**
   - Import `database.sql` to your MySQL
```bash
   mysql -u root -p < database.sql
```
   Or manually create database and import via phpMyAdmin

3. **Configure Database**
   - Edit `config/database.php`
```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'satker_ppbj');
```

4. **Configure Base URL**
   - Edit `config/config.php`
```php
   define('BASE_URL', 'http://localhost/satker-ppbj/public');
```

5. **Set Permissions** (Linux/Mac)
```bash
   chmod -R 755 storage/
```

6. **Access Application**
   - Open browser: `http://localhost/satker-ppbj/public`
   - Default login:
     - Username: `admin`
     - Password: `admin123`

## Project Structure
```
satker-ppbj/
├── app/
│   ├── controllers/       # Application controllers
│   ├── models/           # Database models
│   └── views/            # View templates
├── config/               # Configuration files
├── core/                 # Core framework files
├── helpers/              # Helper functions
├── public/               # Public accessible files
│   ├── assets/          # CSS, JS, Images
│   └── index.php        # Entry point
├── storage/              # Logs and temp files
├── database.sql          # Database schema
└── README.md
```

## Default User

After installation, you can login with:
- **Username**: admin
- **Password**: admin123

⚠️ **Important**: Change the default password after first login!

## Routes

### Authentication
- `GET /auth/login` - Login page
- `POST /auth/loginProcess` - Process login
- `GET /auth/logout` - Logout

### Dashboard
- `GET /dashboard` - Admin dashboard

### Satker Management
- `GET /satker` - List all satker
- `GET /satker/create` - Create form
- `POST /satker/store` - Store new satker
- `GET /satker/edit/{id}` - Edit form
- `POST /satker/update/{id}` - Update satker
- `POST /satker/delete/{id}` - Delete satker

### PPBJ Management
- `GET /ppbj` - List all PPBJ
- `GET /ppbj/create` - Create form
- `POST /ppbj/store` - Store new PPBJ
- `GET /ppbj/edit/{id}` - Edit form
- `POST /ppbj/update/{id}` - Update PPBJ
- `POST /ppbj/delete/{id}` - Delete PPBJ

### User Management
- `GET /user` - List all users
- `GET /user/create` - Create form
- `POST /user/store` - Store new user
- `GET /user/edit/{id}` - Edit form
- `POST /user/update/{id}` - Update user
- `POST /user/delete/{id}` - Delete user

## Roles

1. **Admin**: Full access to all features
2. **Satker**: (For Phase 2 - Select PPBJ)
3. **PPBJ**: (For Phase 2 - View assignments)

## Next Phase (Phase 2)

- [ ] Satker can select PPBJ
- [ ] Assignment management
- [ ] PPBJ availability tracking
- [ ] Notification system
- [ ] Reports & Analytics

## Support

For issues and questions, please contact the development team.

## License

This project is proprietary software for government use.