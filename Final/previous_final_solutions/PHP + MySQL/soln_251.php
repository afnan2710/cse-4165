<?php

// Database Connection
$pdo = new PDO(
    "mysql:host=localhost;dbname=company",
    "root",
    ""
);


// ==========================
// Question 1
// Count Performance Ratings
// ==========================

echo "<h3>Question 1</h3>";

$stmt = $pdo->prepare("SELECT * FROM employee");
$stmt->execute();

$count = [];

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $rating = $row["PerformanceRating"];

    if(isset($count[$rating])){
        $count[$rating] = $count[$rating] + 1;
    }
    else{
        $count[$rating] = 1;
    }
}

print_r($count);



// ==========================
// Question 2
// Update Performance Rating
// ==========================

echo "<h3>Question 2</h3>";

$stmt = $pdo->prepare("
UPDATE employee
SET PerformanceRating='C'
WHERE Salary<40000
AND PerformanceRating!='D'
");

$stmt->execute();

echo "Performance ratings updated successfully.<br>";




// ==========================
// Question 3
// Add Bonus Salary
// ==========================

echo "<h3>Question 3</h3>";

$stmt = $pdo->prepare("SELECT * FROM employee");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $employeeID = $row["EmployeeID"];
    $salary = $row["Salary"];

    if($salary > 50000){

        $newSalary = $salary + 5000;

        if($newSalary <= 60000){

            $stmt2 = $pdo->prepare("
            UPDATE employee
            SET Salary=?
            WHERE EmployeeID=?
            ");

            $stmt2->execute([$newSalary, $employeeID]);
        }
    }
}

echo "Salary updated successfully.<br>";




// ==========================
// Question 4
// Department Wise Employee Count
// ==========================

echo "<h3>Question 4</h3>";

$stmt = $pdo->prepare("
SELECT DepartmentName,
COUNT(*) AS TotalEmployees
FROM employee
GROUP BY DepartmentName
ORDER BY TotalEmployees DESC
");

$stmt->execute();

echo "<table border='1'>";
echo "<tr>";
echo "<th>Department Name</th>";
echo "<th>Total Employees</th>";
echo "</tr>";

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $department = $row["DepartmentName"];
    $total = $row["TotalEmployees"];

    echo "<tr>";
    echo "<td>$department</td>";
    echo "<td>$total</td>";
    echo "</tr>";
}

echo "</table>";

?>