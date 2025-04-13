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
