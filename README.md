# Laravel and React Application

This repository contains a full-stack application with a Laravel backend and a React frontend.

## Prerequisites

- [Node.js](https://nodejs.org/) (v12 or higher)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/) (v7.3 or higher)
- [XAMPP](https://www.apachefriends.org/download.html) or any other supported database
- [Git](https://git-scm.com/)

## Getting Started

### Clone the repository

```sh
git clone https://github.com/matejadjursic/RealestatesApp.git
cd RealestatesAPP
```

### Backend Setup (Laravel)

1. Navigate to the `LaravelAPI` directory:

    ```sh
    cd LaravelAPI
    ```

2. Install backend dependencies:

    ```sh
    composer install
    ```

3. Copy the `.env.example` file to `.env`:

    ```sh
    cp .env.example .env
    ```

4. Generate the application key:

    ```sh
    php artisan key:generate
    ```

5. Set up your database in the `.env` file:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

6. Run the database migrations:

    ```sh
    php artisan migrate
    ```

7. (Optional) Seed the database:

    ```sh
    php artisan db:seed
    ```

8. Start the Laravel development server:

    ```sh
    php artisan serve
    ```

### Frontend Setup (React)

1. Navigate to the `reactfront` directory:

    ```sh
    cd ../reactfront
    ```

2. Install frontend dependencies:

    ```sh
    npm install
    ```

3. Start the React development server:

    ```sh
    npm start
    ```

### Environment Variables

#### Backend (.env)

Ensure that you do not commit your `.env` file to version control. Store your API keys and sensitive information in this file.

#### Frontend (.env)

Create a `.env` file in the `frontend` directory to store environment variables for the React app:

## About the app

Our application enables the search of Instagram accounts and provides users with an intuitive and efficient experience for managing various properties based on those accounts. Administrators have the ability to add new accounts to the system, as well as edit and delete existing accounts. Additionally, they can review new profile suggestions submitted by users and decide whether to approve or reject them. This part of the platform is crucial for maintaining the relevance and quality of the database.

Platform users have access to an advanced search, which includes various filters such as location, profile username, and property price range. These filters are designed to help users precisely tailor their searches to their interests. The application also allows users to suggest new profiles for addition to the system.

One of the important features for users is the ability to mark favorite profiles. This option enables users to quickly access their favorite Instagram profiles.




