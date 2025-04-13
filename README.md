<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Laravel Sanctum Demo

This is a demo project to learn about Laravel Sanctum authentication.

## Installation

1. Clone the repository
2. Install dependencies:
```bash
composer install
```
3. Copy `.env.example` to `.env` and configure your database
4. Generate application key:
```bash
php artisan key:generate
```

### Using Docker (Recommended)

1. Start the MySQL container:
```bash
docker-compose up -d
```

2. Run migrations and seeders:
```bash
php artisan migrate
php artisan db:seed
```

The MySQL database will be available at:
- Host: 127.0.0.1
- Port: 3306
- Database: laravel_sanctum
- Username: root
- Password: secret

### Test User Credentials

A test user has been created with the following credentials:
- Email: test@example.com
- Password: password123

## API Endpoints

### Authentication

#### Register
- **URL**: `http://127.0.0.1:8000/api/register`
- **Method**: `POST`
- **Body**:
```json
{
    "name": "Your Name",
    "email": "your@email.com",
    "password": "your_password"
}
```

#### Login
- **URL**: `http://127.0.0.1:8000/api/login`
- **Method**: `POST`
- **Body**:
```json
{
    "email": "your@email.com",
    "password": "your_password",
    "role": "user|editor|admin"  // Optional, default is 'user'
}
```
- **Response**:
```json
{
    "access_token": "your_token",
    "token_type": "Bearer",
    "abilities": ["post:read"]  // or other abilities based on role
}
```

#### Get Current User
- **URL**: `http://127.0.0.1:8000/api/me`
- **Method**: `GET`
- **Headers**: 
```
Authorization: Bearer {your_token}
```

#### Logout
- **URL**: `http://127.0.0.1:8000/api/logout`
- **Method**: `POST`
- **Headers**: 
```
Authorization: Bearer {your_token}
```

### Post API

#### List Posts
- **URL**: `http://127.0.0.1:8000/api/posts`
- **Method**: `GET`
- **Headers**: 
```
Authorization: Bearer {your_token}
```
- **Required Ability**: `post:read`

#### Create Post
- **URL**: `http://127.0.0.1:8000/api/posts`
- **Method**: `POST`
- **Headers**: 
```
Authorization: Bearer {your_token}
Content-Type: application/json
```
- **Body**:
```json
{
    "title": "Post Title",
    "content": "Post Content"
}
```
- **Required Ability**: `post:create`

#### Get Post
- **URL**: `http://127.0.0.1:8000/api/posts/{id}`
- **Method**: `GET`
- **Headers**: 
```
Authorization: Bearer {your_token}
```
- **Required Ability**: `post:read`

#### Update Post
- **URL**: `http://127.0.0.1:8000/api/posts/{id}`
- **Method**: `PUT`
- **Headers**: 
```
Authorization: Bearer {your_token}
Content-Type: application/json
```
- **Body**:
```json
{
    "title": "Updated Title",
    "content": "Updated Content"
}
```
- **Required Ability**: `post:update`

#### Delete Post
- **URL**: `http://127.0.0.1:8000/api/posts/{id}`
- **Method**: `DELETE`
- **Headers**: 
```
Authorization: Bearer {your_token}
```
- **Required Ability**: `post:delete` or `*`

## Token Abilities

The API uses token abilities to control access to different endpoints. Here are the available abilities:

- `post:read`: Read posts (list and detail)
- `post:create`: Create new posts
- `post:update`: Update existing posts
- `post:delete`: Delete posts
- `*`: All abilities (admin only)

### Role-based Abilities

When logging in, you can specify a role to get different sets of abilities:

1. **User** (default):
   - `post:read`

2. **Editor**:
   - `post:read`
   - `post:create`
   - `post:update`

3. **Admin**:
   - `*` (all abilities)

Example login with role:
```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password123","role":"editor"}'
```

## Security

- All passwords are hashed using bcrypt
- Tokens are stored securely in the database
- Protected routes require valid Sanctum tokens with appropriate abilities
- CSRF protection is enabled for web routes

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
