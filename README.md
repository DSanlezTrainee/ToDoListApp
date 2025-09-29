# ToDoListApp - Task Management Application

## Overview

ToDoListApp is a task management application built with Laravel and Vue.js that allows users to create, view, edit, and delete tasks. The application features user authentication, task categorization, filtering options, and a responsive design.

## Architecture

The application follows the MVC (Model-View-Controller) architecture pattern with Laravel on the backend:

-   **Models**: Data models represent tasks and user information
-   **Controllers**: Handle user requests and business logic
-   **Views**: Use Inertia.js with Vue.js for a reactive frontend
-   **Policies**: Handle authorization logic for tasks

## Features

-   User registration and authentication
-   Create tasks with title, description, due date, and priority
-   Mark tasks as completed
-   Edit and delete existing tasks
-   Filter tasks by status (completed/pending) and priority
-   Sort tasks by various attributes
-   User-specific task lists with privacy controls

## Technologies Used

-   **Backend**: PHP 8.2, Laravel 12
-   **Frontend**: Vue.js 3, Inertia.js
-   **Styling**: Tailwind CSS
-   **Database**: MySQL
-   **Authentication**: Laravel Jetstream
-   **Build Tools**: Vite

## Implementation

### Data Model

Tasks include the following attributes:

-   Title
-   Description (optional)
-   Completion status
-   Due date (optional)
-   Priority (low, medium, high)
-   User relationship

### Authentication

The application uses Laravel Jetstream for authentication, which provides:

-   User registration and login
-   Two-factor authentication
-   Email verification
-   Password reset
-   Account management

### Task Management

Task operations are handled by the TaskController, which:

-   Lists tasks with filtering options
-   Creates new tasks
-   Updates existing tasks
-   Deletes tasks
-   Implements authorization via TaskPolicy

## Installation Instructions

### Requirements

-   PHP 8.2 or higher
-   Composer
-   Node.js and NPM
-   MySQL/ database

### Setup

```bash
# Clone the repository
git clone https://github.com/DSanlezTrainee/ToDoListApp.git

# Navigate to the project directory
cd ToDoListApp/todo-app

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Copy environment file and set up your database connection
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Optional: Seed the database with sample data
php artisan db:seed
```

### Running the Application

```bash
# Start the development server
php artisan serve

# In another terminal, compile assets
npm run dev
```

Visit `http://localhost:8000` in your browser to access the application.

## Directory Structure

The application follows Laravel's standard directory structure:

-   `app/` - Application core code
    -   `Http/Controllers/` - Request handlers
    -   `Models/` - Data models
    -   `Policies/` - Authorization policies
-   `database/` - Database migrations and seeds
-   `resources/` - Frontend assets and views
    -   `js/` - Vue components and pages
    -   `css/` - Stylesheets
-   `routes/` - Application routes
-   `tests/` - Automated tests

## Testing

The application includes comprehensive tests written with Pest PHP:

```bash
# Run tests
php artisan test
```

## License

This project is open-sourced software 
