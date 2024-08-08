<?php
require '../../db/dbconn.php';

$last_fetch_id = isset($_GET['last_fetch_id']) ? $_GET['last_fetch_id'] : null;

// Query to fetch data newer than last fetch ID, ordered by attendance_id in descending order
$display_attendance = "
    SELECT att.attendance_id, 
           CONCAT(ay.year_start, ' - ', ay.year_end, ' ', 
                  CASE ay.semester
                      WHEN 1 THEN '1st Sem'
                      WHEN 2 THEN '2nd Sem'
                      WHEN 3 THEN 'Mid Year'
                      ELSE 'Unknown Sem'
                  END) AS acadyearsem, 
           att.uid, 
           att.date_time, 
           att.type, 
           CONCAT(st.last_name, ' ', st.first_name) AS name, 
           CONCAT(pt.program_code, ' ', ct.year, '-', ct.section) AS class
    FROM attendance_tbl att
    INNER JOIN student_tbl st ON att.student_id = st.student_id
    INNER JOIN class_tbl ct ON ct.class_id = st.class_id
    INNER JOIN program_tbl pt ON pt.program_id = ct.program_id
    INNER JOIN acad_yr_tbl ay ON att.acad_id = ay.acad_id
    WHERE att.attendance_id > '$last_fetch_id'
    ORDER BY att.attendance_id DESC
";

$result = mysqli_query($conn, $display_attendance);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
