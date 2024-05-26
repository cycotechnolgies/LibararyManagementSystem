# Library Management System

Welcome to the Library Management System (LMS)! This comprehensive software solution is designed to streamline library operations, including user registrations, book management, and fine assignment. This README file provides an overview of the system, its features, installation instructions, and contribution guidelines.

## Features

### 1. Login and User Registration
- **User Registration**: Library staff can register with the system by providing their user ID, first name, last name, username, password, and email address.
  - **Validation**:
    - Passwords must be more than 8 characters.
    - Unique usernames and properly formatted emails are required.
    - User IDs must follow the 'U<BOOK_ID>' format (e.g., U001).
- **User Management**: Users can be updated and deleted individually. User details are displayed in a table with columns for user ID, first name, last name, username, password, and email address.
- **Authentication**: Users log in using their specific username and password. Sessions are used to maintain logged-in states.
- **Logout**: Users can log out from the system.
- **Optional**: Passwords can be hashed using techniques like SHA128 or MD5.

### 2. Books Registration
- **Book Management**: Library staff can register books by providing book ID, book name, and book category.
  - **Validation**:
    - Book IDs must follow the 'B<BOOK_ID>' format (e.g., B001).
- **CRUD Operations**: Books can be created, updated, deleted, and displayed. Book records are shown in a table with columns for book ID, book name, and book category.

### 3. Book Category Registration
- **Category Management**: Library staff can register book categories with details including category ID, category name, and date modified.
  - **Validation**:
    - Category IDs must follow the 'C<CATEGORY_ID>' format (e.g., C001).
- **CRUD Operations**: Categories can be created, updated, deleted, and displayed. Category records are shown in a table with columns for category ID, category name, and date modified.

## Installation

### Prerequisites
- **XAMPP**: To run the system on localhost.
- **PHP**: Ensure PHP is installed and configured.
- **MySQL**: Database management system.

### Steps
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/library-management-system.git
   ```
2. **Navigate to the Project Directory**:
   ```bash
   cd library-management-system
   ```
3. **Setup Database**:
   - Create a database named `library_system` using phpMyAdmin.
   - Import the provided `database.sql` file into the `library_system` database.
4. **Configure XAMPP**:
   - Ensure Apache and MySQL are running.
   - Place the project directory inside the `htdocs` folder of your XAMPP installation.
5. **Run the Application**:
   - Open a web browser and navigate to `http://localhost/library-management-system`.

## Project Technology Stack
- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
- **Optional**: AJAX for asynchronous operations

## License
This project is licensed under the MIT License. See the LICENSE file for more details.

## Acknowledgments
Thank you to all team members for their contributions and collaboration.

---

Feel free to reach out if you have any questions or need further assistance. Happy coding!
