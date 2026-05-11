# Molla Clean PHP Auth Project

This project converts the uploaded single HTML login page into a clean PHP project with reusable header, footer, mobile menu, modal, scripts, database connection, user registration, login, dashboard and logout.

## Folder Structure

```text
molla_clean_php_project/
├── actions/
│   ├── login.php
│   └── register.php
├── assets/
│   ├── README.md
│   └── css/custom-auth.css
├── config/
│   ├── app.php
│   ├── config.php
│   └── database.php
├── database/
│   └── molla_auth.sql
├── includes/
│   ├── alerts.php
│   ├── footer.php
│   ├── header.php
│   ├── head.php
│   ├── mobile-menu.php
│   ├── scripts.php
│   └── signin-modal.php
├── dashboard.php
├── index.php
├── login.php
└── logout.php
```

## Setup Steps

1. Copy the folder into your local server root:
   - XAMPP: `htdocs/molla_clean_php_project`
   - Laragon: `www/molla_clean_php_project`
2. Copy the original Molla template `assets` folder into this project folder.
3. Import `database/molla_auth.sql` through phpMyAdmin or MySQL command line.
4. Update database credentials in `config/config.php`.
5. Open `http://localhost/molla_clean_php_project/login.php`.

## Features

- Header/footer separated into reusable include files
- MySQL database connection using PDO
- Secure registration using `password_hash()`
- Secure login using `password_verify()`
- Session authentication
- CSRF token protection
- Flash success/error messages
- Protected dashboard page
- Logout system

## Note

The social login buttons are UI placeholders only. Google/Facebook OAuth is not connected in this basic version.
