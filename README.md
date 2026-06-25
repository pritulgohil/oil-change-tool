# Oil Change Tool

A small Laravel 12 application that checks whether a vehicle is due for an oil change based on:

* Kilometres driven since the previous oil change
* Time passed since the previous oil change

A vehicle is due for an oil change when:

* More than 5,000 km have been driven since the previous oil change, or
* More than 6 months have passed since the previous oil change

## Requirements

Make sure the following are installed:

* PHP 8.2 or newer
* Composer
* Git
* SQLite

## Installation

Clone the repository:

```bash
git clone https://github.com/pritulgohil/oil-change-tool.git
```

Go into the project folder:

```bash
cd oil-change-tool
```

Install PHP dependencies:

```bash
composer install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the Laravel application key:

```bash
php artisan key:generate
```

Create the SQLite database file:

```bash
touch database/database.sqlite
```

Make sure the following value is set in `.env`:

```env
DB_CONNECTION=sqlite
```

Run the database migrations:

```bash
php artisan migrate
```

Start the Laravel development server:

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```