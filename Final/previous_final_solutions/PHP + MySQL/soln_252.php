<?php

// Database Connection
$pdo = new PDO(
    "mysql:host=localhost;dbname=shop",
    "root",
    ""
);


// ==========================
// Question 1
// Total Revenue Per Category
// ==========================

echo "<h3>Question 1</h3>";

$stmt = $pdo->prepare("
SELECT CategoryName, SUM(Revenue) AS TotalRevenue
FROM sales
GROUP BY CategoryName
");

$stmt->execute();

echo "<table border='1'>";
echo "<tr><th>Category Name</th><th>Total Revenue</th></tr>";

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $category = $row["CategoryName"];
    $revenue = $row["TotalRevenue"];

    echo "<tr>";
    echo "<td>$category</td>";
    echo "<td>$revenue</td>";
    echo "</tr>";
}

echo "</table>";




// ==========================
// Question 2
// Update Category
// ==========================

echo "<h3>Question 2</h3>";

$stmt = $pdo->prepare("
UPDATE sales
SET CategoryName='Low Performing'
WHERE Revenue<40000
");

$stmt->execute();

echo "Category updated successfully.<br>";




// ==========================
// Question 3
// Add 10% Bonus Revenue
// ==========================

echo "<h3>Question 3</h3>";

$stmt = $pdo->prepare("SELECT * FROM sales");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $saleID = $row["SaleID"];
    $revenue = $row["Revenue"];

    if($revenue > 70000){

        $newRevenue = $revenue + ($revenue * 0.10);

        $stmt2 = $pdo->prepare("
        UPDATE sales
        SET Revenue=?
        WHERE SaleID=?
        ");

        $stmt2->execute([$newRevenue, $saleID]);
    }
}

echo "Revenue updated successfully.<br>";




// ==========================
// Question 4
// Top Seller / Regular Seller
// ==========================

echo "<h3>Question 4</h3>";

$stmt = $pdo->prepare("SELECT * FROM sales");
$stmt->execute();

echo "<table border='1'>";
echo "<tr>";
echo "<th>Product Name</th>";
echo "<th>Category Name</th>";
echo "<th>Label</th>";
echo "</tr>";

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $product = $row["ProductName"];
    $category = $row["CategoryName"];
    $revenue = $row["Revenue"];

    // Find average revenue of this category
    $stmt2 = $pdo->prepare("
    SELECT AVG(Revenue) AS AvgRevenue
    FROM sales
    WHERE CategoryName=?
    ");

    $stmt2->execute([$category]);

    $avgRow = $stmt2->fetch(PDO::FETCH_ASSOC);
    $average = $avgRow["AvgRevenue"];

    if($revenue > $average){
        $label = "Top Seller";
    }
    else{
        $label = "Regular Seller";
    }

    echo "<tr>";
    echo "<td>$product</td>";
    echo "<td>$category</td>";
    echo "<td>$label</td>";
    echo "</tr>";
}

echo "</table>";

?>