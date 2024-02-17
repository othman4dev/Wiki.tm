# Wiki.tm

Wiki.tm is a platform that allows users to share their knowledge on various topics, and categorize them with different tags.

## Getting Started

These instructions will guide you on how to get a copy of the project up and running on your local machine.

### Prerequisites

Ensure you have the following installed on your local machine:

- PHP 8.3 or higher
- Composer
- XAMPP / WAMP server or any local server of your choice

### Installation

1. Clone the project to your local machine:

```bash
git clone https://github.com/othman4dev/Wiki.tm.git
```
2. Navigate to your local server's phpMyAdmin. If you're using XAMPP or WAMP, this is typically found at: localhost/phpmyadmin/.

3. Import the SQL file located in the project's database directory to phpMyAdmin.

### Running the Project
1. Open the project in Visual Studio Code.

2. Open a new terminal in VS Code and run the following commands:
```bash
composer update
```
```bas
php -S localhost:8000
```
 3. Navigate to localhost:8000 in your web browser. You should now see the login form of the website.
### If you're unable to see the login form, ensure the following:

- PHP 8.3 or higher is installed on your machine.
- Composer is installed on your machine.
- Your local server is running.
- Your php.ini file is configured correctly.
