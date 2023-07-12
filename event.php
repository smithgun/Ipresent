<?php
session_start();
include "db_conn.php";
// Assuming you have already connected to your database
$conn = mysqli_connect("localhost", "root", "", "db_usim");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $event_name = $_POST["event_name"];
    $event_place = $_POST["event_place"];
    $event_status = $_POST["event_status"];
    $event_date = $_POST["event_date"];
    $event_start_time = $_POST["event_start_time"];
    $event_end_time = $_POST["event_end_time"];

    // Generate JSON data
    $eventData = [
        'event_name' => $event_name,
        'event_place' => $event_place,
        'event_status' => $event_status,
        'event_date' => $event_date,
        'event_start_time' => $event_start_time,
        'event_end_time' => $event_end_time
    ];

    $json = json_encode($eventData);

    // Insert the data into the database (replace 'your_table_name' with your actual table name)
    $sql = "INSERT INTO events (event_name, event_place, event_status, event_date, event_start_time, event_end_time, event_data) 
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
  <title>Add Event | USIM MOBILE</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="event.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
  <link rel="icon" type="image/png" href="./logo.jpg">
</head>
<body>
  <div class="animation-container">
    <!-- Animation bubbles -->
  </div>

  <div class="modal-dialog">
    <div class="modal-content animate__animated animate__fadeInUp">
      <div class="modal-header">
        <h4 class="modal-title">Add Event</h4>
      </div>
      <form id="frmAddEvent" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="modal-body">
          <div class="form-group">
            <label class="control-label" for="event_name">Name</label>
            <input type="text" class="form-control" name="event_name" id="event_name" required>
          </div>
          <div class="form-group">
            <label class="control-label" for="event_place">Place</label>
            <input type="text" class="form-control" name="event_place" id="event_place" required>
          </div>
          <div class="form-group">
            <label class="control-label" for="event_status">Status</label>
            <select name="event_status" class="form-control" id="event_status" required>
              <option value="online">Online</option>
              <option value="face to face">Face to Face</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label" for="event_date">Event Date</label>
            <input type="date" class="form-control" name="event_date" id="event_date" required>
          </div>
          <div class="form-group">
            <label class="control-label" for="event_start_time">Start Time</label>
            <input type="time" class="form-control" name="event_start_time" id="event_start_time" required>
          </div>
          <div class="form-group">
            <label class="control-label" for="event_end_time">End Time</label>
            <input type="time" class="form-control" name="event_end_time" id="event_end_time" required>
          </div>
        </div>
        <div class="modal-footer text-right">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
      <div class="modal-footer text-right">
        <button onclick="generateQRCodeWithInput()" class="btn btn-primary">Generate QR Code</button>
        <button onclick="saveAsImage()" class="btn btn-primary">Save As</button>
        <div id="qrCode"></div>
      </div>
    </div>
  </div>

  <script>
    function generateQRCodeWithInput() {
      var event_name = $("#event_name").val();
      var event_place = $("#event_place").val();
      var event_status = $("#event_status").val();
      var event_date = $("#event_date").val();
      var event_start_time = $("#event_start_time").val();
      var event_end_time = $("#event_end_time").val();

      var eventData = {
        event_name: event_name,
        event_place: event_place,
        event_status: event_status,
        event_date: event_date,
        event_start_time: event_start_time,
        event_end_time: event_end_time
      };

      var qrCodeContainer = $("#qrCode");
      qrCodeContainer.empty();

      qrCodeContainer.qrcode({
        width: 150,
        height: 150,
        text: JSON.stringify(eventData)
      });
    }

    function saveAsImage() {
      var qrCodeCanvas = $("#qrCode canvas")[0];

      // Create a new canvas element with higher resolution
      var hdCanvas = document.createElement("canvas");
      var hdContext = hdCanvas.getContext("2d");
      hdCanvas.width = qrCodeCanvas.width * 2;
      hdCanvas.height = qrCodeCanvas.height * 2;

      // Scale up the QR code image
      hdContext.scale(2, 2);
      hdContext.drawImage(qrCodeCanvas, 0, 0);

      // Create a download link and trigger the download
      var downloadLink = document.createElement("a");
      downloadLink.href = hdCanvas.toDataURL("image/png");
      downloadLink.download = "qrcode.png";
      downloadLink.click();

      // Clear the QR code after download
      var qrCodeContainer = $("#qrCode");
      qrCodeContainer.empty();
    }
  </script>
</body>
</html>