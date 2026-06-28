<?php

$pdo = new PDO(
    "mysql:host=localhost;dbname=school",
    "root",
    ""
);


// ======================
// Question 1
// Count students by Letter Grade
// ======================

echo "<h3>Question 1</h3>";

$stmt = $pdo->prepare("SELECT * FROM student");
$stmt->execute();

$count = [];

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $letterGrade = $row["LetterGrade"];

    if(isset($count[$letterGrade])){
        $count[$letterGrade] = $count[$letterGrade] + 1;
    }
    else{
        $count[$letterGrade] = 1;
    }
}

print_r($count);



// ======================
// Question 2
// Update Letter Grade
// ======================

echo "<h3>Question 2</h3>";

$stmt = $pdo->prepare("
UPDATE student
SET LetterGrade='C'
WHERE Grade<75 AND LetterGrade!='D'
");

$stmt->execute();

echo "Letter grades updated successfully.<br>";




// ======================
// Question 3
// Add bonus marks
// ======================

echo "<h3>Question 3</h3>";

$stmt = $pdo->prepare("SELECT * FROM student");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $studentID = $row["StudentID"];
    $grade = $row["Grade"];

    if($grade > 80){

        $newGrade = $grade + 5;

        if($newGrade <= 90){

            $stmt2 = $pdo->prepare("
            UPDATE student
            SET Grade=?
            WHERE StudentID=?
            ");

            $stmt2->execute([$newGrade,$studentID]);
        }
    }
}

echo "Bonus marks added successfully.<br>";




// ======================
// Question 4
// Course-wise student count
// ======================

echo "<h3>Question 4</h3>";

$stmt = $pdo->prepare("
SELECT CourseTitle, COUNT(*) AS TotalStudents
FROM student
GROUP BY CourseTitle
ORDER BY TotalStudents DESC
");

$stmt->execute();

echo "<table border='1'>";
echo "<tr>
<th>Course Title</th>
<th>Total Students</th>
</tr>";

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $course = $row["CourseTitle"];
    $total = $row["TotalStudents"];

    echo "<tr>";
    echo "<td>$course</td>";
    echo "<td>$total</td>";
    echo "</tr>";
}

echo "</table>";

?>