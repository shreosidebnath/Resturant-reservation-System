# Online Restaurant Booking System

A web-based restaurant table booking and food ordering system built with PHP, MySQL, HTML, and CSS.

## Features

### User Features
- User registration and login
- Browse available tables
- Book tables based on capacity
- View food menu
- Place orders
- View order history

### Admin Features
- Manage tables (add, edit, delete)
- Manage users
- Manage food items and pricing
- Update restaurant status (Open/Close)
- View all bookings and orders

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Server**: Apache (XAMPP/WAMP/LAMP)

## Installation

1. Clone the repository
```bash
git clone https://github.com/yourusername/restaurant-booking-system.git
```

2. Import the database
- Create a MySQL database named `restaurant_booking`
- Import the `database.sql` file into your database

3. Configure database connection
- Open `config.php`
- Update database credentials if needed:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'restaurant_booking');
```

4. Start your web server (Apache)
- Place the project folder in your web server's root directory (htdocs/www)

5. Access the application
- Open your browser and navigate to `http://localhost/restaurant-booking-system/`

## Default Login Credentials

### Admin Login
- Username: `admin`
- Password: `admin`

### Test User Login
- Username: `sreo`
- Password: `123`


## Database Schema

### Tables
- `users` - Store user information
- `tables` - Store restaurant table information
- `food` - Store food menu items
- `bookings` - Store table reservations
- `orders` - Store customer orders
- `order_items` - Store order details
- `restaurant_status` - Store restaurant open/close status

## Screenshots

![Home Page](screenshots/home.png)
![Table List](screenshots/tables.png)
![Admin Dashboard](screenshots/admin.png)

## Future Enhancements

- Online payment integration
- Email notifications for bookings
- Advanced booking calendar with date/time selection
- Customer reviews and ratings
- Mobile responsive design
- Real-time table availability updates

## License

This project is open source and available under the MIT License.

## Author

Created as a learning project for web development with PHP and MySQL.

## Support

For issues or questions, please open an issue on GitHub.
