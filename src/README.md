# Laravel Project Name

A brief description of your Laravel project.

## Running with the Traditional Approach

1. Ensure that PHP, Composer, and [Laravel Sail](https://laravel.com/docs/8.x/sail) are installed on your computer.

2. Clone this repository:

    ```bash
    git clone https://github.com/kafribung/remindme-laravel
    ```

3. Navigate to the project directory:

    ```bash
    cd remindme-laravel/src
    ```

4. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

5. Generate the Laravel application key:

    ```bash
    php artisan key:generate
    ```

6. Install dependencies:

    ```bash
    composer install
    ```

7. Run migrations and seed data if needed:

    ```bash
    php artisan migrate --seed
    ```

8. Seed the database:

    ```bash
    php artisan db:seed
    ```

9. Start the server:

    ```bash
    php artisan serve
    ```

10. Set email configuration (Ex: use mailtrap)

    ```bash
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=usernname_mailtrap
    MAIL_PASSWORD=password_mailtrap
    ```

11. Run schedule task

    ```bash
    php artisan schedule:work
    ```

   The Laravel project will be accessible at [http://localhost:8000](http://localhost:8000).

## Running with Laravel Sail

[Laravel Sail](https://laravel.com/docs/8.x/sail) provides an easy-to-use Docker development environment.

1. Clone this repository:

    ```bash
    git clone https://github.com/username/laravel-project-name.git
    ```

2. Navigate to the project directory:

    ```bash
    cd laravel-project-name
    ```

3. Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

4. Generate the Laravel application key:

    ```bash
    sail artisan key:generate
    ```

5. Build and run the Sail containers:

    ```bash
    sail up -d
    ```

6. Run migrations:

    ```bash
    sail artisan migrate
    ```

7. Seed the database:

    ```bash
    sail artisan db:seed
    ```

8. The Laravel project will be accessible at [http://localhost](http://localhost).

9. Set email configuration (Ex: use mailtrap)

    ```bash
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=usernname_mailtrap
    MAIL_PASSWORD=password_mailtrap
    ```

10. Run schedule task

    ```bash
    sail artisan schedule:work
    ```

11. To stop the Sail containers:

    ```bash
    sail down
    ```
