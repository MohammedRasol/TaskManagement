# Taskmanager

Taskmanager is a task management application built with Laravel and modern front-end tools. This guide will help you set up the project locally.

## Prerequisites

Before you begin, ensure you have the following installed:

-   **Git**
-   **PHP** (>= 8.0)
-   **Composer**
-   **Node.js** and **npm**
-   **MySQL** or another supported database
-   A terminal or command-line interface

## Installation Steps

Follow these steps to set up the project on your local machine:

1. **Clone the Repository**

    ```bash
    git clone git@github.com:MohammedRasol/Taskmanager.git

    ```

2. **Navigate to the Project Directory**
   cd Taskmanager

3. **Rename the Environment File**
   Rename the .env.example file to .env
   mv .env.example .env

4. **Install PHP Dependencies**
   Mak sure uncomment extension=zip  in  php.ini 
   composer install

5. **Install JavaScript Dependencies**
   npm install

6. **Build Front-End Assets**
   npm run build

7. **Generate Application Key**
   php artisan key:generate

8. **Run Database Migrations**
   php artisan migrate

    ## type yes to create database if not exist

9. **crate dummy data**
   php artisan db:seed
   #login with email:moh@test.com password:123

10. **Start the Development Server**
    php artisan serve
