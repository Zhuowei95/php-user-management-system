# PHP User Management System

This repository is prepared to satisfy the task requirements from the attached assignment:

1. Repeat the work according to the given task.
2. Supplement the given project with a version that stores data in a database.
3. Store all tasks as different versions in one GitHub repository.
4. Submit a PDF test report with the GitHub repository URL.

## Repository contents

- `v1-session/` - Version 1. User management system with PHP sessions for register/login/logout/profile.
- `v2-database/` - Version 2. Extended project with database storage, roles, namespaces, interfaces, abstract classes, traits, and session-based authentication.
- `report/` - Test report files for submission.

## Recommended GitHub versioning

Use one repository and save the work as different versions:

- Commit 1: `Version 1 - session based user management`
- Commit 2: `Version 2 - database user management`

You may also create tags:

- `v1-session`
- `v2-database`

## Suggested repository URL format

Replace the placeholder in the PDF report with your real repository URL, for example:

`https://github.com/YOUR-USERNAME/php-user-management-system`

## How to run Version 1

1. Place the project in your XAMPP `htdocs` folder.
2. Start Apache in XAMPP.
3. Open `http://localhost/php-user-management-repo/v1-session/index.php`

## How to run Version 2

1. Start Apache and MySQL in XAMPP.
2. Create a MySQL database, for example: `user_management_db`
3. Import `v2-database/db/schema.sql`
4. Copy one of these files:
   - `v2-database/App/Config/config.example.php` to `v2-database/App/Config/config.php`, or
   - `v2-database/config/config.example.php` to `v2-database/config/config.php`
5. Set your database credentials in `config.php`
6. Open `http://localhost/php-user-management-repo/v2-database/public/index.php`

## Default admin account for Version 2

After importing `schema.sql`:

- Email: `admin@example.com`
- Password: `admin123`
- Temporary update made in secondary branch for branch and merge demonstration.
