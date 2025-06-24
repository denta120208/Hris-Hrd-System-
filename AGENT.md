# AGENT.md - HRIS HRD System Development Guide

## Commands
- **Test all**: `./vendor/bin/phpunit` or `php artisan test`
- **Test single**: `./vendor/bin/phpunit tests/ExampleTest.php` 
- **Build assets**: `gulp` or `npm run dev`
- **Laravel commands**: `php artisan [command]` (migrate, serve, etc.)
- **Composer**: `composer install`, `composer update`

## Architecture
- **Framework**: Laravel 5.1 (PHP >=5.5.9)
- **Database**: MySQL (migrations in database/migrations/)
- **Models**: Located in app/Models/ (Employee, Master, Punishments subdirs)
- **Controllers**: app/Http/Controllers/HRD/ (organized by module)
- **Frontend**: Bootstrap 3 with Sass, Laravel Elixir build system

## Code Style
- **Namespace**: PSR-4 autoloading (App\\ -> app/)
- **Imports**: Multiple use statements grouped by type, line-break separated
- **Controllers**: Extend Controller, dependency injection via constructor
- **Models**: Eloquent ORM, relationships defined
- **Variables**: snake_case for DB fields, camelCase for PHP variables
- **Error handling**: Use Laravel's built-in exception handling and Log facade
- **File structure**: Organized by domain (HRD/Emp/, Master/, etc.)
