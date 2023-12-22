# Remindme

## Running with Laravel Sail

[Laravel Sail](https://laravel.com/docs/8.x/sail) provides an easy-to-use Docker development environment.

1. Clone this repository:

    ```bash
    git clone https://github.com/kafribung/remindme-laravel

    cd remindme-laravel/src
    ```

2. Change configuration in .env if you want recive email (Ex: I use mailtrap)

    ```bash
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=usernname_mailtrap
    MAIL_PASSWORD=password_mailtrap
    ```

3. Run application

    ```bash
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
    ```

4. Run migration and schedule

    ```bash
   sail artisan migrate --seed
   sail artisan schedule:work
    ```
