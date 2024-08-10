<?php
// Connect to the database (replace with your actual database credentials)
require '../../db/dbconn.php';

// Get the current year
$currentYear = date("Y");

// Query to fetch attendance count per month for the current year
$query = "
    SELECT 
        MONTH(date_time) AS month, 
        COUNT(*) AS total_attendance
    FROM attendance_tbl
    WHERE YEAR(date_time) = $currentYear
    GROUP BY MONTH(date_time)
    ORDER BY MONTH(date_time)
";

$result = $conn->query($query);

$data = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = [
            'month' => date('F', mktime(0, 0, 0, $row['month'], 10)), // Convert month number to month name
            'total_attendance' => (int) $row['total_attendance']
        ];
    }
}

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);

// Close database connection
$conn->close();
?>
