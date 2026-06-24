<!DOCTYPE html>
<html>
<head>
    <title>Pizza Calculator</title>
</head>
<body>
    <h2>Pizza Party Calculator</h2>
    <form method="post">
        Number of Students: <input type="number" name="students"><br><br>
        Slices per Student: <input type="number" name="perStudent"><br><br>
        Slices per Pizza: <input type="number" name="perPizza"><br><br>
        <input type="submit" name="calculate" value="Calculate">
    </form>
</body>
</html>

<?php
function calculatePizza($students, $perStudent, $perPizza) {
    $pricePerPizza = 1050;
    $totalSlices = $students * $perStudent;
    $pizzas = ceil($totalSlices / $perPizza);
    $totalBought = $pizzas * $perPizza;
    $leftover = $totalBought - $totalSlices;
    $pricePerSlice = $pricePerPizza / $perPizza;
    $wastedMoney = $leftover * $pricePerSlice;

    echo "<h3>Result:</h3>";
    echo "Total Pizzas: " . $pizzas . "<br>";
    echo "Leftover Slices: " . $leftover . "<br>";
    echo "Wasted Money (BDT): " . $wastedMoney . "<br>";
}

if (isset($_POST['calculate'])) {
    $students = $_POST['students'];
    $perStudent = $_POST['perStudent'];
    $perPizza = $_POST['perPizza'];
    calculatePizza($students, $perStudent, $perPizza);
}
?>