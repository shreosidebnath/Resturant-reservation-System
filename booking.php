<?php
require_once 'config.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$table_id = isset($_GET['table_id']) ? intval($_GET['table_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $booking_date = mysqli_real_escape_string($conn, $_POST['booking_date']);
    $booking_time = mysqli_real_escape_string($conn, $_POST['booking_time']);
    
    $sql = "INSERT INTO bookings (user_id, table_id, booking_date, booking_time, status) 
            VALUES ($user_id, $table_id, '$booking_date', '$booking_time', 'Confirmed')";
    
    if (mysqli_query($conn, $sql)) {
        mysqli_query($conn, "UPDATE tables SET status = 'Booking' WHERE id = $table_id");
        redirect('orderlist.php');
    }
}

$table_sql = "SELECT * FROM tables WHERE id = $table_id";
$table_result = mysqli_query($conn, $table_sql);
$table = mysqli_fetch_assoc($table_result);

$today = date('Y-m-d');
$dates = [];
for ($i = 0; $i < 7; $i++) {
    $dates[] = date('Y-m-d', strtotime("+$i days"));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Table - Online Restaurant Booking System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .calendar-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin: 30px 0;
        }
        .calendar-day {
            padding: 20px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .calendar-day:hover {
            border-color: #c94b8b;
            background: #f8f8f8;
        }
        .calendar-day.selected {
            background: #c94b8b;
            color: white;
            border-color: #c94b8b;
        }
        .time-slots {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 20px 0;
        }
        .time-slot {
            padding: 15px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .time-slot:hover {
            border-color: #c94b8b;
            background: #f8f8f8;
        }
        .time-slot.selected {
            background: #c94b8b;
            color: white;
            border-color: #c94b8b;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav-container">
                <div class="logo">Online Restaurant Booking System</div>
                <ul class="nav-menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="zhuowei.php">Table List</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="calendar-container">
        <h2>Book <?php echo $table ? $table['name'] : 'Table'; ?> (Capacity: <?php echo $table ? $table['capacity'] : 'N/A'; ?>)</h2>
        
        <form method="POST" id="bookingForm">
            <h3>Select Date</h3>
            <div class="calendar-grid">
                <?php foreach ($dates as $date): ?>
                    <div class="calendar-day" onclick="selectDate('<?php echo $date; ?>')">
                        <div><?php echo date('D', strtotime($date)); ?></div>
                        <div style="font-size: 20px; margin: 10px 0;"><?php echo date('d', strtotime($date)); ?></div>
                        <div><?php echo date('M', strtotime($date)); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <h3>Select Time</h3>
            <div class="time-slots">
                <div class="time-slot" onclick="selectTime('10:00')">10:00 AM</div>
                <div class="time-slot" onclick="selectTime('11:00')">11:00 AM</div>
                <div class="time-slot" onclick="selectTime('12:00')">12:00 PM</div>
                <div class="time-slot" onclick="selectTime('13:00')">1:00 PM</div>
                <div class="time-slot" onclick="selectTime('14:00')">2:00 PM</div>
                <div class="time-slot" onclick="selectTime('18:00')">6:00 PM</div>
                <div class="time-slot" onclick="selectTime('19:00')">7:00 PM</div>
                <div class="time-slot" onclick="selectTime('20:00')">8:00 PM</div>
            </div>
            
            <input type="hidden" name="booking_date" id="booking_date" required>
            <input type="hidden" name="booking_time" id="booking_time" required>
            
            <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Confirm Booking</button>
        </form>
    </div>

    <script>
        function selectDate(date) {
            document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('selected'));
            event.target.closest('.calendar-day').classList.add('selected');
            document.getElementById('booking_date').value = date;
        }
        
        function selectTime(time) {
            document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
            event.target.classList.add('selected');
            document.getElementById('booking_time').value = time;
        }
        
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            if (!document.getElementById('booking_date').value || !document.getElementById('booking_time').value) {
                e.preventDefault();
                alert('Please select both date and time');
            }
        });
    </script>
</body>
</html>
