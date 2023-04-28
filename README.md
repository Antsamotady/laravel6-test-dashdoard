# Task Management
## by Garry Hasintsilavina

This is a web application built with Laravel 6. It allows users to create, update, and delete tasks with priority. 

## Installation

To run this project, you will need to have PHP 7.2 or higher installed on your machine. You will also need Composer to manage dependencies.

1. Clone this repository to your local machine.

   ```
   git clone https://github.com/<your-username>/<your-repo>.git
   ```

2. Navigate to the project directory.

   ```
   cd <your-repo>
   ```

3. Install the project dependencies using Composer.

   ```
   composer install
   ```

4. Copy the `.env.example` file to create a `.env` file.

   ```
   cp .env.example .env
   ```

5. Generate a new application key.

   ```
   php artisan key:generate
   ```

6. Set up the database by updating the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` fields in the `.env` file.

7. Run database migrations to create the necessary tables.

   ```
   php artisan migrate
   ```

8. Start the local development server.

   ```
   php artisan serve
   ```

9. Access the application by visiting `http://localhost:8000` in your web browser.


## Run tests
```
$ vendor/bin/phpunit tests/Feature/TaskTest.php
```
## Deployment

To deploy this application, you can follow the same steps as the installation process above. However, you will need to configure your server environment and update the `.env` file with your production database credentials.

Alternatively, you can use a platform like Heroku or AWS to host and deploy your application. Please refer to their documentation for instructions on how to deploy a Laravel 6 application.

## Note

This project was built using Laravel 6, which is an older version of Laravel. I apologize for any inconvenience caused by not using the latest version of Laravel. However, I hope that the instructions provided below are still helpful and that you are still able to set up and deploy the web application successfully.
