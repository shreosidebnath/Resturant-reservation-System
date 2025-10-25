# Quick Installation Guide

## Step 1: Download & Extract
Download the entire `restaurant-booking-system` folder

## Step 2: Setup Database

### Option A: Using phpMyAdmin
1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Click "New" to create a database
3. Name it `restaurant_booking`
4. Click on the database
5. Go to "Import" tab
6. Choose `database.sql` file
7. Click "Go"

### Option B: Using MySQL Command Line
```bash
mysql -u root -p
CREATE DATABASE restaurant_booking;
USE restaurant_booking;
SOURCE /path/to/database.sql;
EXIT;
```

## Step 3: Configure Database Connection
Open `config.php` and update if needed:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Your MySQL username
define('DB_PASS', '');            // Your MySQL password
define('DB_NAME', 'restaurant_booking');
```

## Step 4: Move to Web Server
Copy the entire folder to:
- **XAMPP**: `C:\xampp\htdocs\`
- **WAMP**: `C:\wamp\www\`
- **MAMP**: `/Applications/MAMP/htdocs/`
- **Linux**: `/var/www/html/`

## Step 5: Start Server
- Start Apache and MySQL from your control panel
- Make sure both services are running (green indicators)

## Step 6: Access the Application
Open your browser and go to:
```
http://localhost/restaurant-booking-system/
```

## Test Login

### Admin Panel
1. Go to login page
2. Username: `admin`
3. Password: `admin`
4. You'll be redirected to admin dashboard

### Regular User
1. Go to login page
2. Username: `Sreo`
3. Password: `password`
4. You'll be redirected to table list

OR register a new account!

## Troubleshooting

**Error: Database connection failed**
- Check if MySQL is running
- Verify database credentials in config.php
- Make sure database `restaurant_booking` exists

**Error: Cannot find page**
- Check if files are in correct directory
- Verify Apache is running
- Check URL spelling

**Error: Access denied**
- Check MySQL username and password
- Try using 'root' with no password (default XAMPP)

## Common Issues

1. **Blank white page**: Check PHP error logs
2. **CSS not loading**: Check file paths in HTML
3. **Images not showing**: Normal - using SVG placeholders
4. **Session not working**: Check PHP session settings

## For GitHub

To upload to GitHub:
```bash
cd restaurant-booking-system
git init
git add .
git commit -m "Initial commit - Restaurant booking system"
git remote add origin https://github.com/yourusername/restaurant-booking.git
git push -u origin main
```

Remember to add your own GitHub repository URL!

## Need Help?

Check the README.md for detailed documentation and features list.
