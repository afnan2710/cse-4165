<!DOCTYPE html>
<html>
<head>
    <title>UIU Tech Fest Venue Calculator</title>
</head>
<body>
    <h2>Venue Budget Calculator</h2>
    <form method="post">
        Attendees: <input type="number" name="attendees"><br><br>
        Cost per Person: <input type="number" name="costPerPerson"><br><br>
        Venue Capacity: <input type="number" name="capacity"><br><br>
        <input type="submit" name="calculate" value="Calculate">
    </form>
</body>
</html>

<?php
function calculateVenue($attendees, $costPerPerson, $capacity) {
    $venueCost = 15000;
    $venues = ceil($attendees / $capacity);
    $totalSeats = $venues * $capacity;
    $emptySeats = $totalSeats - $attendees;
    $wastedMoney = $emptySeats * $costPerPerson;

    echo "<h3>Result:</h3>";
    echo "Total Venues: " . $venues . "<br>";
    echo "Empty Seats: " . $emptySeats . "<br>";
    echo "Wasted Money (BDT): " . number_format($wastedMoney) . "<br>";
}

if (isset($_POST['calculate'])) {
    $attendees = $_POST['attendees'];
    $costPerPerson = $_POST['costPerPerson'];
    $capacity = $_POST['capacity'];
    calculateVenue($attendees, $costPerPerson, $capacity);
}
?>