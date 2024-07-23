# Project Setup

## Requirements

Before you begin, ensure you have met the following requirements:
- PHP >= 7.3
- Composer
- MySQL or any other supported database
- Node.js and npm (for frontend assets)

## Installation

1. **Install dependencies:**

    ```sh
    composer install
    npm install
    ```

2. **Copy `.env` file:**

    ```sh
    cp .env.example .env
    ```

3. **Generate application key:**

    ```sh
    php artisan key:generate
    ```

4. **Configure your `.env` file:**

    Open the `.env` file and set your database and other configurations:

    ```env
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:generated_key
    APP_DEBUG=true
    APP_URL=http://localhost

    LOG_CHANNEL=stack

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120

    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS=null
    MAIL_FROM_NAME="${APP_NAME}"

    AWS_ACCESS_KEY_ID=
    AWS_SECRET_ACCESS_KEY=
    AWS_DEFAULT_REGION=us-east-1
    AWS_BUCKET=

    PUSHER_APP_ID=
    PUSHER_APP_KEY=
    PUSHER_APP_SECRET=
    PUSHER_APP_CLUSTER=mt1

    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    ```

5. **Run migrations:**

    ```sh
    php artisan migrate:fresh --seed
    ```

6. **Compile assets:**

    ```sh
    npm run dev
    ```

## Running the application

1. **Start the local development server:**

    ```sh
    php artisan serve
    ```

2. **Access the application:**

    Open your browser and go to `http://localhost:8000`.

## Troubleshooting

If you encounter any issues, here are a few common solutions:

- **Clear application cache:**

    ```sh
    php artisan optimize
    ```

- **Permissions issues:**

    Ensure that the storage and bootstrap/cache directories are writable by your web server.

    ```sh
    chmod -R 775 storage
    chmod -R 775 bootstrap/cache
    ```
