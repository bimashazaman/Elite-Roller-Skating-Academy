# Roller Skating Academy 🛼

A modern web application for managing a roller skating academy, built with Laravel and Bootstrap.

## Features ✨

-   **User Authentication** - Secure login and registration system
-   **Blog Management** - Share news, tips, and updates about skating
-   **Admission System** - Online admission processing for new students
-   **Admin Dashboard** - Comprehensive admin panel for managing the academy
-   **Responsive Design** - Beautiful and mobile-friendly interface

## Prerequisites 📋

-   PHP >= 8.0
-   Composer
-   MySQL/MariaDB
-   Node.js & NPM
-   Laravel CLI

## Installation 🚀

1. Clone the repository

```bash
git clone https://github.com/bimashazaman/Elite-Roller-Skating-Academy
cd Elite-Roller-Skating-Academy
```

2. Install PHP dependencies

```bash
composer install
```

3. Install and compile frontend dependencies

```bash
npm install
npm run dev
```

4. Configure environment variables

```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env` file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

6. Run database migrations and seeders

```bash
php artisan migrate
php artisan db:seed
```

7. Start the development server

```bash
php artisan serve
```

## Usage 💡

-   Visit `http://localhost:8000` to access the application
-   Register a new account or login with existing credentials
-   Admin credentials:
    -   Email: admin@example.com
    -   Password: password

## Features Overview 🎯

### For Users

-   Browse and read blog posts about skating
-   Apply for admission
-   View academy information and updates

### For Administrators

-   Manage blog posts
-   Process admission applications
-   Manage users and roles
-   Access analytics and reports

## Contributing 🤝

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Security 🔒

If you discover any security-related issues, please email security@rollerskating.com instead of using the issue tracker.

## License 📝

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support 💪

For support, email support@rollerskating.com or join our Slack channel.

## Acknowledgments 🙏

-   Laravel Framework
-   Bootstrap
-   All contributors who have helped shape this project

---

Made with ❤️ by Bimasha Zaman
