# WE Web: My First Project (2023)

A learning management system (LMS) built with **PHP, MySQL and Bootstrap**. It was my very first web project, and it reached the **semi-finals of the ISF competition**. I'm publishing it as-is, as a record of where I started.

## Features

- Three user roles: **Student**, **Teacher** and **Admin**
- Classrooms joined with a class code
- Courses with video playlists
- Test builder for teachers (drag and drop) with auto-graded tests and student results
- Attendance tracking
- Questions and answers section
- Course payments with **Stripe Checkout**
- PDF export with dompdf
- Prepared statements used in most database queries

## Known Issues

This is an early learning project, and I left the flaws in on purpose:

- Passwords are stored in **plain text** (no hashing)
- Authentication and roles rely on **cookies** instead of server-side sessions
- No CSRF protection, and some pages may be vulnerable to XSS
- Database credentials are hard-coded (`redundecyCode/connection.php`)
- The payment price is sent from the browser, and payments are not verified with a Stripe webhook
- Hard-coded `localhost` URLs
- Duplicated code in `redundecyCode/`, and a few leftover test files
- Some typos in file and variable names

**Do not deploy this to production.**

## Tech Stack

PHP 8.2 · MySQL / MariaDB · HTML · CSS · JavaScript · Bootstrap 5 · SortableJS · Stripe · dompdf · Composer

## Getting Started

1. Install [XAMPP](https://www.apachefriends.org) (PHP 8.2 and MySQL/MariaDB) and start **Apache** and **MySQL**.
2. Clone the repo into XAMPP's `htdocs` folder.
3. Install the PHP dependencies by running this in the project folder:
   ```bash
   composer install
   ```
4. Set up the database:
   - Open `http://localhost/phpmyadmin`.
   - Create a new database named **`all_users`** (collation `utf8mb4_general_ci`).
   - Select it, go to **Import**, and choose `database/all_users.sql`.
5. Add your own Stripe **test** key in `payment/checkout.php` (replace `sk_test_YOUR_KEY_HERE`).
6. Open `http://localhost/<folder-name>/Login/login.php`.

> The project expects MySQL on `localhost` with user `root` and an empty password (the XAMPP default). You can change this in `redundecyCode/connection.php`.

## Demo Account

The database dump contains a single demo **Admin** account:

| Email         | Password     |
| ------------- | ------------ |
| `a@gmail.com` | `mygkA200r#` |

You can register new Student and Teacher accounts from the login page.

The original dump held real users, so I removed all of them. Their classrooms, comments, tests and results were removed too, and only the table structure and a few sample courses remain.

## Project Structure

```
Admin/            admin pages (users, courses, news, settings)
Teacher/          classrooms, test creation, test management
Student/          courses, classroom, tests, Q&A, fees
Login/            login and registration
Tests/            test viewing and results
payment/          Stripe checkout
redundecyCode/    shared navbars, footers, Bootstrap includes and DB connection
database/         SQL dump (structure + demo admin)
Image/            static images
```

## What I Learned

- Building a full multi-role web app from scratch
- Working with PHP and MySQL, including prepared statements
- Integrating third-party services (Stripe, dompdf)
- What *not* to do in authentication and security, which I have learned a lot about since

## Author

Built in 2023 as my first project.
