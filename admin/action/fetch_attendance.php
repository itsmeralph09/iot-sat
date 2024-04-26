<?php
require '../../db/dbconn.php';

$last_fetch_id = isset($_GET['last_fetch_id']) ? $_GET['last_fetch_id'] : null;

// Query to fetch data newer than last fetch ID, ordered by attendance_id in descending order
$display_attendance = "
    SELECT att.attendance_id, att.uid, att.date_time, att.type, CONCAT(st.last_name, ' ', st.first_name) as name, CONCAT(pt.program_code, ' ',ct.year,'-',ct.section) as class
    FROM attendance_tbl att
    INNER JOIN student_tbl as st ON att.student_id = st.student_id
    INNER JOIN class_tbl as ct ON ct.class_id = st.class_id
    INNER JOIN program_tbl as pt ON pt.program_id = ct.program_id
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
