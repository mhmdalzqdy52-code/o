# Contact Manager (Custom MVC, PHP + MySQL)

Small contact manager built with plain PHP, PDO and a custom MVC structure (no frameworks).

## Structure
```
index.php        front controller (routing)
config/          database settings
models/          Database, Contact, User (PDO)
views/           layout, auth, contacts
controllers/     Base, Auth, Contact
database.sql     tables
setup_admin.php  creates the admin user (hashed password)
```

## Setup
1. Import `database.sql` in MySQL (phpMyAdmin or `mysql < database.sql`).
2. Edit `config/database.php` if your MySQL user/password differ.
3. Run `php setup_admin.php` and choose the admin password (username: `admin`).
4. Start the server: `php -S localhost:8000` then open http://localhost:8000

## Features
- List, add, edit, delete contacts (id, name, email, phone, created_at)
- Single admin login; only logged-in users can add/edit/delete
- Anyone can view the list

## Security list
- **Prepared statements (PDO)** for every query; emulated prepares disabled
- **Output escaping** with `htmlspecialchars` (`e()` helper) to prevent XSS
- **Password hashing** with `password_hash()` / `password_verify()`; no plain-text passwords
- **Validation** of name, email (`FILTER_VALIDATE_EMAIL`) and phone (regex) on the server
- **Authentication check** on add/edit/delete in the controller (not only hidden links)
- **CSRF tokens** on all POST forms, checked with `hash_equals`
- **Delete only via POST**, not a link
- **Session ID regenerated** on login (prevents session fixation)
- **Route whitelist** in `index.php` (no dynamic file inclusion from user input)
- Generic login error message (does not reveal whether the username exists)

## Version control
Commits were made progressively (database, models, controllers, views, auth, security, README).

## Integrity statement
> I, [محمد الزقدي] ([ 202308949]), declare that this assignment is my own work, except for the sources listed below.
>
> **Sources / help used:**
> - PHP manual: PDO, password_hash, htmlspecialchars (php.net)
> - Course materials, topics 3–7
> - AI assistance: [ Claude was used to generate the initial code structure and the README template. I reviewed, tested and modified the code, and I understand how it work]
>
> **Week-5 progress:** I did not have any saved progress in week 5. I started working on this assignment in week 14. The commit history shows the actual dates of my work.
>
> Signed: [محمد الزقدي]   Date: [22/11]
