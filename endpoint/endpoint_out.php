<?php

// Replace these with your own values
$apiKey = '2dadc4525e1fa0d424ef5bcf249a9b0c'; // Replace with your actual API key
$apiUrl = 'https://semaphore.co/api/v4/messages';

// Function to send SMS
function sendSMS($apiKey, $apiUrl, $contact, $message) {
    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    $parameters = [
        'apikey' => $apiKey,
        'number' => $contact,
        'message' => $message,
        'sendername' => 'SEMAPHORE'
    ];

    curl_setopt_array($ch, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => http_build_query($parameters),
        CURLOPT_RETURNTRANSFER => true,
    ]);

    // Execute cURL request
    $output = curl_exec($ch);
    curl_close($ch);
    
    return $output;
}

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
        $checkQuery = "SELECT student_id, first_name, last_name, contact, guardian_contact FROM student_tbl WHERE uid = '$sanitizedCardID'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            // RFID card ID exists in the student_tbl table
            $row = $checkResult->fetch_assoc();
            $studentID = $row["student_id"];
            $firstName = $row["first_name"];
            $lastName = $row["last_name"];
            $studentContact = $row["contact"];
            $parentContact = $row["guardian_contact"];

            // Check if the student already has an entry for today
            $latestEntryQuery = "SELECT type FROM attendance_tbl WHERE student_id = '$studentID' AND DATE(date_time) = CURDATE() ORDER BY date_time DESC LIMIT 1";
            $latestEntryResult = $conn->query($latestEntryQuery);

            if ($latestEntryResult->num_rows > 0) {
                $latestEntry = $latestEntryResult->fetch_assoc();
                $latestType = $latestEntry["type"];

                if ($latestType == 2) {
                    // Student already checked OUT today, cannot check OUT again
                    $response = array(
                        "status" => "error",
                        "message" => "Student needs to check IN first.",
                        "lcdMessage" => "ALREADY OUT!"
                    );
                    echo json_encode($response);
                } else {
                    // Insert the RFID card ID and student ID into the attendance_tbl table as OUT
                    $insertQuery = "INSERT INTO attendance_tbl (uid, student_id, type, date_time) VALUES ('$sanitizedCardID', $studentID, 2, NOW())";
                    if ($conn->query($insertQuery) === TRUE) {
                        // Successfully inserted OUT record into the attendance_tbl table
                        $message = "Hi $firstName $lastName. You have successfully checked OUT from school.";
                        sendSMS($apiKey, $apiUrl, $studentContact, $message);
                        sendSMS($apiKey, $apiUrl, $parentContact, $message);

                        $response = array(
                            "status" => "success",
                            "message" => "RFID card ID belongs to $firstName $lastName. OUT attendance recorded successfully.",
                            "lcdMessage" => "RECORDED!",
                            "firstName" => $firstName,
                            "lastName" => $lastName
                        );
                        echo json_encode($response);
                    } else {
                        // Error inserting OUT record into the attendance_tbl table
                        $response = array(
                            "status" => "error",
                            "message" => "Error recording OUT attendance: " . $conn->error,
                            "lcdMessage" => "SQL ERROR!"
                        );
                        echo json_encode($response);
                    }
                }
            } else {
                // No entry found for today, student can't check OUT
                $response = array(
                    "status" => "error",
                    "message" => "Student needs to check IN first.",
                    "lcdMessage" => "CHECK IN FIRST!"
                );
                echo json_encode($response);
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
