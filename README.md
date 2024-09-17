# Team Project Management System (TPMS)

## Introduction
The Team Project Management System is a Laravel-based application for managing projects and tasks. It allows users to work in teams, assigning tasks based on their roles (Project Manager, Developer, Tester). The system includes features for managing projects, tasks, users, and roles, with permissions ensuring that users can only perform actions allowed by their role.

## Prerequisites
- PHP 8.x
- Laravel 9.x
- MySQL
- Composer
- Postman (for API testing)

## Key Features
1. **Project Management**:
   - Create, view, update, and delete projects.
   - Retrieve the latest and oldest tasks of a project.
   
2. **Task Management**:
   - Create, view, update, and delete tasks.
   - Filter tasks by status and priority.
   - Update task statuses and add notes.
   
3. **User Management**:
   - Create, view, update, and delete users.
   - Assign roles to users (Manager, Developer, Tester).

4. **Advanced Relationships**:
   - Use `hasManyThrough` to access tasks through projects.
   - Use `latestOfMany` and `oldestOfMany` to retrieve the latest and oldest tasks.
   
5. **Role-based Permissions**:
   - Project Manager (Manager) can add and modify tasks.
   - Developer can only modify task statuses.
   - Tester can add notes to tasks.
   
6. **Route Protection with Laravel Sanctum**:
   - All routes requiring authentication are protected with `auth:sanctum`.

## Installation

1. **Clone the repository:**

   git clone https://github.com/yourusername/tpms.git
   cd tpms
 

2. **Install dependencies:**

   composer install
  

3. **Set up the database:**
   - Create a new database in MySQL.
   - Update the `.env` file to configure your database connection.

4. **Run migrations:**
   php artisan migrate


5. **Generate the application key:**
   php artisan key:generate


6. **Set up Laravel Sanctum:**

   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate
  

7. **Start the local development server:**
   php artisan serve

## API Testing with Postman
- A Postman Collection is included to test the API endpoints.
- You can import the collection into Postman and use it to test all routes.

## Project Structure

- **Controllers**: Handle the operations for projects, tasks, and users.
- **Models**: Represent the data and relationships between tables.
- **Routes**: Include routes protected by `Sanctum` requiring user authentication.


## Contributing
To contribute to the project:
1. Create a new branch: `git checkout -b feature/your-feature`.
2. Submit a pull request once your feature is complete.



## References

1. **Official Laravel Documentation**:
   - The official Laravel site contains comprehensive documentation covering everything related to the framework, including project setup, database management, authentication, roles and permissions, and more.
   - Link: [https://laravel.com/docs](https://laravel.com/docs)

2. **Composer**:
   - Composer is the package manager used to install necessary libraries for your Laravel project.
   - Link: [https://getcomposer.org/](https://getcomposer.org/)

3. **PHP Documentation**:
   - Since the project is built using PHP, referring to the official PHP documentation can help in understanding how to work with various features of the language.
   - Link: [https://www.php.net/manual/en/](https://www.php.net/manual/en/)

4. **MySQL Documentation**:
   - If you are using MySQL as the database, the official MySQL documentation will be helpful for understanding queries, indexes, and transactions.
   - Link: [https://dev.mysql.com/doc/](https://dev.mysql.com/doc/)

5. **JWT Authentication**:
   - To implement authentication using JWT, refer to the JWT documentation to understand how to generate and validate tokens.
   - Link: [https://jwt.io/introduction](https://jwt.io/introduction)

6. **Soft Deletes in Laravel**:
   - For more information about implementing soft deletes and how to restore them in Laravel.
   - Link: [Soft Deletes in Laravel Documentation](https://laravel.com/docs/9.x/eloquent#soft-deleting)

7. **Role-Based Access Control (RBAC)**:
   - For an in-depth understanding of implementing role-based access control (RBAC) in Laravel.
   - Link: [https://spatie.be/docs/laravel-permission](https://spatie.be/docs/laravel-permission)

8. **GitHub**:
   - If you are using GitHub to manage repositories, GitHub documentation will help you understand how to push your source code, manage branches, open issues, and pull requests.
   - Link: [https://docs.github.com/](https://docs.github.com/)

### Other Useful References:
- **Laravel Query Scopes**: [https://laravel.com/docs/9.x/eloquent#query-scopes](https://laravel.com/docs/9.x/eloquent#query-scopes)
- **Eloquent Relationships**: [https://laravel.com/docs/9.x/eloquent-relationships](https://laravel.com/docs/9.x/eloquent-relationships)

## Contribution
To contribute to this project, you can submit pull requests or open issues on the GitHub repository.

## Contributors

- [GHofran Warrakia] - Development and maintenance of the project.

## References

- [Laravel Documentation](https://laravel.com/docs)
- [JWT Documentation](https://jwt.io/)
- [MySQL Documentation](https://dev.mysql.com/doc/)

## License

This project is licensed under the [[Focal X]].
