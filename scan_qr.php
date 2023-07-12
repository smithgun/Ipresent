<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON data from the QR code
    $json = $_POST["json_data"];

    // Decode the JSON data
    $eventData = json_decode($json, true);

    // Get the individual data fields
    $event_name = $eventData['event_name'];
    $event_place = $eventData['event_place'];
    $event_status = $eventData['event_status'];
    $event_date = $eventData['event_date'];
    $event_start_time = $eventData['event_start_time'];
    $event_end_time = $eventData['event_end_time'];

    // Insert the data into the database (replace 'your_table_name' with your actual table name)
    $conn = mysqli_connect("localhost", "root", "", "db_usim");
    $sql = "INSERT INTO record (event_name, event_place, event_status, event_date, event_start_time, event_end_time, event_data) 
            VALUES ('$event_name', '$event_place', '$event_status', '$event_date', '$event_start_time', '$event_end_time', '$json')";

    if (mysqli_query($conn, $sql)) {
        // Data inserted successfully
        echo "Event data recorded in the database.";
    } else {
        // Error occurred while inserting data
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Scan QR Code | USIM MOBILE</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>
  <link rel="stylesheet" href="scan.css" />
  <link rel="icon" type="image/png" href="./logo.jpg">
</head>
<body>
  <h1 class="title">Scan QR Code</h1>
  <div class="button-wrapper">
    <label for="qrFileInput" class="custom-button">Choose File</label>
    <input type="file" id="qrFileInput" accept="image/*" class="choose-file" onchange="displaySelectedFile()">
    <button onclick="scanQRCode()" class="submit-button">Submit</button>
  </div>
  <div id="qrScanner">
    <video id="videoElement" width="500" height="500" autoplay></video>
  </div>
  <div id="qrResult">
    <!-- QR code data will be displayed here -->
  </div>
  <div id="selectedFile"></div>
  
  <script src="scan.js"></script>
</body>
</html>



