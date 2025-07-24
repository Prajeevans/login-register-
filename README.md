# Medical Shop Quotation System

This project is a two-sided web application for a medical shop with:

- **Client side**: User registration, login, and medicine order placement.
- **Pharmacy side**: Access to client orders, generate and send styled HTML email quotations for client approval.

---

## Features

### Client Side
- User registration and secure login
- Place orders specifying drugs, quantity, and rate

### Pharmacy Side
- Login portal to access and manage client orders
- Generate and send quotation emails with detailed order info
- Styled HTML email format consistent with web design

---

## Requirements

- PHP 7.2 or higher
- Composer for dependency management
- SMTP email account (e.g., Gmail) with app password enabled
- MySQL or compatible database
- Web server (Apache, XAMPP, etc.)

---

## Installation

1. Clone or download the repository to your web server directory.

2. Navigate to the project folder in your terminal:

   ```bash
   cd path/to/your/project

3. Install PHPMailer dependency using Composer:
    composer require phpmailer/phpmailer

4. Configure database connection and SMTP settings in the PHP files 
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = '#';
    $mail->Password = '#';

## Time Taken 
    ![Time Taken](./Screenshot%202025-07-24%20203058.png)


