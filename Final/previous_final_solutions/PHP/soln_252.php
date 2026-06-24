<!DOCTYPE html>
<html>
<head>
    <title>Movie Night Screen Calculator</title>
</head>
<body>
    <h2>Movie Night Calculator</h2>
    <form method="post">
        Attendees: <input type="number" name="attendees"><br><br>
        Seat Capacity: <input type="number" name="capacity"><br><br>
        Ticket Price: <input type="number" name="ticket"><br><br>
        <input type="submit" name="calculate" value="Calculate">
    </form>
</body>
</html>

<?php
function calculateScreens($attendees, $capacity, $ticketPrice) {
    $screenCost = 25000;
    $screens = ceil($attendees / $capacity);
    $totalSeats = $screens * $capacity;
    $emptySeats = $totalSeats - $attendees;
    $wastedMoney = $emptySeats * $ticketPrice;

    echo "<h3>Result:</h3>";
    echo "Total Screens: " . $screens . "<br>";
    echo "Empty Seats: " . $emptySeats . "<br>";
    echo "Wasted Money: " . number_format($wastedMoney) . "<br>";
}

if (isset($_POST['calculate'])) {
    $attendees = $_POST['attendees'];
    $capacity = $_POST['capacity'];
    $ticketPrice = $_POST['ticket'];
    calculateScreens($attendees, $capacity, $ticketPrice);
}
?>