# Laravel Social Media Platform

A modern, feature-rich social media and blog platform built with Laravel 11, featuring user authentication, post management, commenting system, likes, notifications, weather integration, and quote services.

## 🚀 Features

### Core Functionality
- **User Authentication & Authorization**
  - Laravel Breeze authentication system
  - Role-based access control (Admin/User roles)
  - Email verification
  - Password reset functionality

- **Social Media Features**
  - Create, edit, and delete posts with image uploads
  - Like/unlike posts and comments
  - Comment system with nested replies
  - User profiles with customizable information
  - Real-time notifications

- **Admin Panel**
  - Dashboard with user, post, and comment statistics
  - User management
  - Post moderation
  - Admin-only access controls

### Additional Services
- **Weather Service**: Real-time weather information using OpenWeatherMap API
- **Quote Service**: Random quotes and author-specific quotes using Quotable API
- **Notification System**: Real-time notifications for user interactions

### Technical Features
- **Modern UI/UX**: Built with Tailwind CSS and Alpine.js
- **Responsive Design**: Mobile-first approach
- **Image Management**: Secure file uploads with validation
- **Database Relationships**: Properly structured Eloquent relationships
- **API Integration**: External API consumption for weather and quotes
- **Testing**: Comprehensive test suite with Pest PHP

## 🛠️ Technology Stack

### Backend
- **PHP 8.2+**
- **Laravel 11.9** - Modern PHP framework
- **MySQL/SQLite** - Database
- **Laravel Breeze** - Authentication scaffolding

### Frontend
- **Tailwind CSS 3.1** - Utility-first CSS framework
- **Alpine.js 3.4** - Lightweight JavaScript framework
- **Vite** - Build tool and development server
- **PostCSS** - CSS processing

### Development Tools
- **Laravel Sail** - Docker development environment
- **Laravel Pint** - PHP code style fixer
- **Pest PHP** - Testing framework
- **Faker** - Data generation for testing

## 📋 Prerequisites

Before running this project, ensure you have:

- **PHP 8.2 or higher**
- **Composer** (PHP package manager)
- **Node.js & NPM** (for frontend assets)
- **MySQL/PostgreSQL** or **SQLite** database
- **Git** (for version control)

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Laravel-project
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

9. **Build frontend assets**
   ```bash
   npm run build
   ```

10. **Start the development server**
    ```bash
    php artisan serve
    ```

## 🔧 Configuration

### API Keys Setup

For weather and quote services, you'll need to configure API keys:

1. **Weather API** (OpenWeatherMap)
   - Sign up at [OpenWeatherMap](https://openweathermap.org/api)
   - Add your API key to the WeatherController

2. **Quote API** (Quotable)
   - No API key required (free service)

### Environment Variables

Key environment variables to configure:

```env
APP_NAME="Laravel Social Platform"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_social
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 📁 Project Structure

```
Laravel-project/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Application controllers
│   │   ├── Middleware/           # Custom middleware
│   │   └── Requests/             # Form request validation
│   ├── Models/                   # Eloquent models
│   ├── Services/                 # Business logic services
│   └── View/                     # View components
├── database/
│   ├── factories/                # Model factories
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
├── resources/
│   ├── views/                    # Blade templates
│   ├── css/                      # Stylesheets
│   └── js/                       # JavaScript files
├── routes/                       # Application routes
├── storage/                      # File storage
└── tests/                        # Application tests
```

## 🗄️ Database Schema

### Core Tables
- **users** - User accounts and authentication
- **posts** - User-created posts with content and images
- **comments** - Comments on posts
- **likes** - Polymorphic likes for posts and comments
- **profiles** - User profile information
- **notifications** - User notifications

### Key Relationships
- Users have many Posts, Comments, and Likes
- Posts belong to Users and have many Comments and Likes
- Comments belong to Users and Posts
- Likes are polymorphic (can be on Posts or Comments)
- Users have one Profile
- Users have many Notifications

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Feature/PostTest.php
```

## 🚀 Deployment

### Production Setup

1. **Environment Configuration**
   ```bash
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimize for Production**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   composer install --optimize-autoloader --no-dev
   npm run build
   ```

3. **Database Setup**
   ```bash
   php artisan migrate --force
   ```

### Server Requirements
- PHP 8.2+
- MySQL 5.7+ or PostgreSQL 10+
- Composer
- Node.js & NPM
- Web server (Apache/Nginx)

## 🔐 Security Features

- **CSRF Protection** - Built-in Laravel CSRF protection
- **SQL Injection Prevention** - Eloquent ORM with parameter binding
- **XSS Protection** - Blade template escaping
- **File Upload Security** - Image validation and secure storage
- **Authentication** - Laravel Breeze with proper session management
- **Authorization** - Role-based access control

## 📱 Features in Detail

### User Management
- Registration and login with email verification
- Password reset functionality
- User profiles with customizable information
- Role-based permissions (Admin/User)

### Post System
- Create, edit, and delete posts
- Image upload support with validation
- Rich text content
- Pagination for better performance

### Social Features
- Like/unlike posts and comments
- Comment system with user attribution
- Real-time notifications
- User activity tracking

### Admin Features
- Dashboard with statistics
- User management
- Post moderation
- System overview

### External Integrations
- **Weather Service**: Real-time weather data
- **Quote Service**: Inspirational quotes
- **Email Notifications**: User activity notifications

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

This project was developed as part of a Master's degree module, demonstrating modern web development practices with Laravel.

## 🆘 Support

For support and questions:
- Check the [Laravel Documentation](https://laravel.com/docs)
- Review the code comments and documentation
- Open an issue in the repository

---

**Note**: This is an educational project showcasing Laravel development best practices, modern web technologies, and full-stack development skills.
