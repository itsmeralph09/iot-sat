<?php

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'card_id' parameter is set
    if (isset($_POST["card_id"])) {
        // Retrieve the RFID card ID from the POST data
        $cardID = $_POST["card_id"];

        // Sanitize the input to prevent SQL injection (assuming you're using a database)
        $sanitizedCardID = filter_var($cardID, FILTER_SANITIZE_STRING);

        // Connect to the database (replace with your actual database credentials)
        require '../db/dbconn.php';

        // Check if the RFID card ID exists in the student_tbl table
        $checkQuery = "SELECT student_id, first_name, last_name FROM student_tbl WHERE uid = '$sanitizedCardID'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            // RFID card ID exists in the student_tbl table
            $row = $checkResult->fetch_assoc();
            $studentID = $row["student_id"];
            $firstName = $row["first_name"];
            $lastName = $row["last_name"];

            // Check if the student already has an entry for today
            $latestEntryQuery = "SELECT type FROM attendance_tbl WHERE student_id = '$studentID' AND DATE(date_time) = CURDATE() ORDER BY date_time DESC LIMIT 1";
            $latestEntryResult = $conn->query($latestEntryQuery);

            if ($latestEntryResult->num_rows > 0) {
                $latestEntry = $latestEntryResult->fetch_assoc();
                $latestType = $latestEntry["type"];

                if ($latestType == 1) {
                    // Student already checked IN today, cannot check IN again
                    $response = array(
                        "status" => "error",
                        "message" => "Student has already checked IN today. Please check OUT first.",
                        "lcdMessage" => "ALREADY IN!",
                        "firstName" => $firstName,
                        "lastName" => $lastName
                    );
                    echo json_encode($response);
                } else {
                    // Insert the RFID card ID and student ID into the attendance_tbl table as IN
                    $insertQuery = "INSERT INTO attendance_tbl (uid, student_id, type, date_time) VALUES ('$sanitizedCardID', $studentID, 1, NOW())";
                    if ($conn->query($insertQuery) === TRUE) {
                        // Successfully inserted IN record into the attendance_tbl table
                        $response = array(
                            "status" => "success",
                            "message" => "RFID card ID belongs to $firstName $lastName. IN attendance recorded successfully.",
                            "lcdMessage" => "RECORDED!",
                            "firstName" => $firstName,
                            "lastName" => $lastName
                        );
                        echo json_encode($response);
                    } else {
                        // Error inserting IN record into the attendance_tbl table
                        $response = array(
                            "status" => "error",
                            "message" => "Error recording IN attendance: " . $conn->error,
                            "lcdMessage" => "SQL ERROR!"
                        );
                        echo json_encode($response);
                    }
                }
            } else {
                // No entry found for today, student can check IN
                $insertQuery = "INSERT INTO attendance_tbl (uid, student_id, type, date_time) VALUES ('$sanitizedCardID', $studentID, 1, NOW())";
                if ($conn->query($insertQuery) === TRUE) {
                    // Successfully inserted IN record into the attendance_tbl table
                    $response = array(
                        "status" => "success",
                        "message" => "RFID card ID belongs to $firstName $lastName. IN attendance recorded successfully.",
                        "lcdMessage" => "RECORDED!",
                        "firstName" => $firstName,
                        "lastName" => $lastName
                    );
                    echo json_encode($response);
                } else {
                    // Error inserting IN record into the attendance_tbl table
                    $response = array(
                        "status" => "error",
                        "message" => "Error recording IN attendance: " . $conn->error,
                        "lcdMessage" => "SQL ERROR!"
                    );
                    echo json_encode($response);
                }
            }
        } else {
            // RFID card ID does not exist in the student_tbl table
            $response = array(
                "status" => "error",
                "message" => "RFID card ID does not exist in the student_tbl table",
                "lcdMessage" => "UNKNOWN CARD!"
            );
            echo json_encode($response);
        }

        // Close database connection
        $conn->close();
    } else {
        // 'card_id' parameter is missing
        $response = array(
            "status" => "error",
            "message" => "'card_id' parameter is missing",
            "lcdMessage" => "PARAMETER ERROR!"
        );
        echo json_encode($response);
    }
} else {
    // Invalid request method
    $response = array(
        "status" => "error",
        "message" => "Only POST requests are allowed",
        "lcdMessage" => "POST ERROR!"
    );
    echo json_encode($response);
}

?>
