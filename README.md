# Laravel Book Store API With Cloudinary Integration)

## Objective

The objective of this assignment is to build a Book Store RESTful API that integrates with Cloudinary for professional media management. You will focus on handling file uploads, managing storage cleanup (deleting old files), and organizing API responses.

## Data Models & Migrations

You must generate migrations and models for the following schema:

Table: books 

|Column|Type|Constraints|
|------|----|-----------|
|id|BigInt|Primary Key|
|title|string ||
|cover_image_url|string||
|description|string||
|category_id|BigInt|Foreign Key|
|created_at|datetime||
|updated_at|datetime||

[!NOTE] You should also have a Category model (id, name) to establish a One-to-Many relationship (A category has many books).

## Factories & Database Seeding

- To facilitate testing, implement the following:
    - CategoryFactory: Generate at least 5 book categories (e.g., Fiction, Sci-Fi, Programming).
    - BookFactory: Generate dummy titles and descriptions. For the cover_image_url, you may use a placeholder image URL or leave it null for seeded data.
    - DatabaseSeeder: Seed 5 categories and 20 books.

## Implementation Requirements

- A. Cloudinary Integration (The Core Task)
    - Store (Upload): When creating a book, upload the cover_image to Cloudinary in a folder named rootaccess_bookstore/covers.
    - Update & Cleanup: If a user updates a book and uploads a new cover, you must delete the old image from Cloudinary using its public_id before saving the new one.
    - Destroy: When a book is deleted from the database, the associated image must also be deleted from Cloudinary.
- B. Routing & Controllers
    - Create a BookController with the following endpoints:
    - GET /api/books — List all books (with Category details and Pagination).
    - POST /api/books — Create a book with a cover image upload.
    - GET /api/books/{id} — Show specific book details.
    - POST /api/books/{id}?_method=PUT — Update book details and/or cover image.
    - DELETE /api/books/{id} — Delete book and its image from Cloudinary.
- C. Searching & Pagination
    - Implement a search to find books by title or category name.
    - Implement pagination to get a list of all books.

## Request Validation

- Use a Form Request class with the following rules:
    - title: required|string|max:255
    - category_id: required|exists:categories,id
    - cover_image: image|mimes:jpeg,png,jpg|max:2048 (Max 2MB)

## API Response Format

- All responses must be JSON:
    - Success: 200 OK or 201 Created.
    - Error: 422 Unprocessable Entity (for validation) or 404 Not Found.

## Deliverables

- Laravel Project Source Code on GitHub.
- Cloudinary Service/Logic Logic: Evidence of how you handled the upload/delete logic (e.g., a dedicated Service class).
- Bruno Collection: Exported file to test all endpoints.

#
#


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

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
