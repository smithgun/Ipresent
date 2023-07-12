<?php
$conn = mysqli_connect("localhost", "root", "", "db_usim") or die(mysqli_error($conn));

// File Upload
if (isset($_POST['submit'])) {
  $fileCount = count($_FILES['photo']['name']);

  for ($i = 0; $i < $fileCount; $i++) {
    $name = $_FILES['photo']['name'][$i];
    $size = $_FILES['photo']['size'][$i];
    $type = $_FILES['photo']['type'][$i];
    $temp = $_FILES['photo']['tmp_name'][$i];

    // Check file size
    $maxFileSize = 10 * 1024 * 1024; // 10MB (adjust as needed)
    if ($size > $maxFileSize) {
      die("File size exceeds the maximum allowed size.");
    }

    // Validate file extension
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
    $fileExtension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
      die("Invalid file extension. Only JPG, JPEG, PNG, GIF, and PDF files are allowed.");
    }

    // Read file data
    $data = file_get_contents($temp);
    $data = mysqli_real_escape_string($conn, $data);

    // Insert file details into database
    $insert = mysqli_query($conn, "INSERT INTO files (name, size, type, data) VALUES ('$name', '$size', '$type', '$data')");

    if (!$insert) {
      die(mysqli_error($conn));
    }
  }

  header("location: subject1.php");
  exit;
}
?>

<?php
$conn = mysqli_connect("localhost", "root", "", "db_usim") or die(mysqli_error($conn));

// Delete File
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $delete = mysqli_query($conn, "DELETE FROM files WHERE id='$id'");

  if (!$delete) {
    die(mysqli_error($conn));
  }

  header("location: subject1.php");
  exit;
}

// Fetch files from database
$select = mysqli_query($conn, "SELECT name, id FROM files ORDER BY id DESC");
$files = mysqli_fetch_all($select, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>I-Present | By USIM MOBILE</title>
  <link rel="stylesheet" href="home_style.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="icon" type="image/png" href="./logo.jpg">
</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li>
          <a href="#" class="logo">
            <img src="./img/izna.jpg">
            <span class="nav-item">DASHBOARD</span>
          </a>
        </li>
        <li>
          <a href="#" onclick="redirectUSIMMOBILE(event);">
            <i class="fas fa-home"></i>
            <span class="nav-item">Home</span>
          </a>
        </li>
        <li><a href="">
          <i class="fas fa-user"></i>
          <span class="nav-item">Profile</span>
        </a></li>
        <li>
          <a href="#" class="notification-icon" onclick="toggleNotificationBox(event)">
            <i class="fas fa-inbox"></i>
            <span class="nav-item">Notifications</span>
            <span class="badge">2</span>
          </a>
        </li>
        <div id="notification-box">
          <ul id="notification-list">
            <!-- Notifications will be dynamically added here -->
          </ul>
        </div>
        <li><a href="">
          <i class="fas fa-cog"></i>
          <span class="nav-item">Settings</span>
        </a></li>
        <li><a href="">
          <i class="fas fa-question-circle"></i>
          <span class="nav-item">Help</span>
        </a></li>
        <li><a href="#" class="logout" onclick="confirmLogout(event)">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item">Log out</span>
        </a></li>
      </ul>
    </nav>

    <section class="main">
  <h1>SKJ 2212-Ethical Hacking</h1>
  <style>
  .main-course {
    padding: 10px 10px;
    background-color: #f5f5f5;
    border-radius: 5px;
  }

  .main-course h1 {
    text-align: center;
    margin-bottom: 0 px;
    margin-top: 0 px;
  }

  .course-box {
    background-color: #fff;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  tbody tr:hover {
    background-color: #f9f9f9;
    cursor: pointer;
  }

  tbody tr:last-child td {
    border-bottom: none;
  }
</style>

<section class="main-course">
  <h1>Record of Attendance</h1>
  <div class="course-box">
  <div class="progress-bar">Progress: 13/14</div>
  <table>
    <thead>
      <tr>
        <th>Place</th>
        <th>Mode</th>
        <th>Timestamp</th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows will be dynamically added here -->
    </tbody>
  </table>
</div>

<style>
  .course-box {
    position: relative;
  }
  
  .progress-bar {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: darkblue;
    color: white;
    padding: 5px 10px;
    font-weight: bold;
  }
</style>

</section>
<script>
  // Example data (Replace with your own data)
  const attendanceRecords = [
    { place: "DKS 1.1", mode: "face to face", timestamp: "2023-03-02 09:30:00" },
    { place: "MS TEAMS", mode: "online", timestamp: "2023-03-12 10:45:00" },
    { place: "DKS 1.1", mode: "face to face", timestamp: "2023-04-02 14:00:00" },
    { place: "MS TEAMS", mode: "online", timestamp: "2023-04-14 11:15:00" },
    { place: "DKS 1.1", mode: "face to face", timestamp: "2023-05-05 09:00:00" },
    { place: "MS TEAMS", mode: "online", timestamp: "2023-05-10 13:30:00" },
    { place: "DKS 1.1", mode: "face to face", timestamp: "2023-05-12 15:45:00" },
    { place: "MS TEAMS", mode: "online", timestamp: "2023-06-03 10:30:00" },
    { place: "DKS 1.1", mode: "face to face", timestamp: "2023-06-11 08:45:00" },
    { place: "DKS 1.1", mode: "face to face", timestamp: "2023-06-18 08:35:00" },
    { place: "MS TEAMS", mode: "online", timestamp: "2023-06-24 08:05:00" },
    { place: "DKS 1.1", mode: "face to face", timestamp: "2023-06-28 08:25:00" },
    { place: "DKS 1.1", mode: "face to face", timestamp: "2023-07-02 08:00:00" },
  ];

  const tableBody = document.querySelector('.main-course .course-box tbody');

  attendanceRecords.forEach(record => {
    const newRow = document.createElement('tr');

    const placeCell = document.createElement('td');
    placeCell.textContent = record.place;

    const modeCell = document.createElement('td');
    modeCell.textContent = record.mode;

    const timestampCell = document.createElement('td');
    timestampCell.textContent = record.timestamp;

    newRow.appendChild(placeCell);
    newRow.appendChild(modeCell);
    newRow.appendChild(timestampCell);

    tableBody.appendChild(newRow);
  });
</script>


  <section class="main-course">
  <h1>Document</h1>
  <h5>Absent Letter Submission Section</h5>
  <style>
    .main-course {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #f2f2f2;
    }

    .course-box {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .file-upload,
    .uploaded-files {
      width: 100%;
      margin-bottom: 20px;
    }

    .file-upload form,
    .uploaded-files table {
      width: 100%;
    }

    .file-upload h3,
    .uploaded-files h3 {
      margin-top: 0;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .file-upload table th,
    .file-upload table td,
    .uploaded-files table th,
    .uploaded-files table td {
      padding: 10px;
      border: 1px solid #ddd;
    }

    .file-upload table th {
      text-align: left;
      background-color: #f2f2f2;
    }

    .file-upload table td {
      text-align: center;
    }

    .file-upload input[type="file"] {
      display: block;
      margin: 0 auto;
      font-size: 16px;
      background-color: #63c963;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .file-upload input[type="file"]:hover {
      background-color: #52b352;
    }

    .uploaded-files table a {
      text-decoration: none;
      color: #333;
    }

    .uploaded-files table .delete-btn {
      color: #fff;
      background-color: #dc3545;
      border: none;
      padding: 4px 8px;
      border-radius: 4px;
      transition: background-color 0.3s ease;
      font-size: 14px;
      margin-right: 10px;
    }

    .uploaded-files table .delete-btn:hover {
      background-color: #c82333;
    }

    .uploaded-files table .submit-btn {
      color: #fff;
      background-color: #ffc107;
      border: none;
      padding: 4px 8px;
      border-radius: 4px;
      transition: background-color 0.3s ease;
      font-size: 14px;
    }

    .uploaded-files table .submit-btn:hover {
      background-color: #e0a800;
    }
  </style>

  <div class="course-box">
    <div class="file-upload">
      <!-- File Upload Form -->
      <h3 class="text-center"><strong>Upload File</strong></h3>
      <form enctype="multipart/form-data" action="" name="form" method="post">
        <table class="table">
          <tr>
            <th>Choose File</th>
            <td>
              <label for="photo"></label>
              <input type="file" name="photo[]" id="photo" accept="image/*, .pdf" multiple />
            </td>
          </tr>
          <tr>
          <th colspan="2" scope="row" style="text-align: center;">
  <input type="submit" name="submit" id="submit" value="Upload" class="submit-btn" style="font-weight: bold;" />
</th>

          </tr>
        </table>
      </form>
    </div>

    <div class="uploaded-files">
      <!-- Display Uploaded Files -->
      <h3 class="text-center">Uploaded Files</h3>
      <table class="table">
        <thead>
          <tr>
            <th>File Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($files as $file) { ?>
            <tr>
              <td width="300">
                <a href="download.php?id=<?php echo $file['id']; ?>"><?php echo $file['name']; ?></a>
              </td>
              <td class="text-center">
  <a class="btn btn-danger delete-btn" href="subject1.php?id=<?php echo $file['id']; ?>">Delete</a>
  <input type="submit" name="submit" id="submit" value="Submit" class="submit-btn" onclick="window.location.href = 'home.php';" />
</td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</section>


    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
      function redirectUSIMMOBILE(event) {
        event.preventDefault(); // Prevent default link behavior
        // Redirect to login.php
        window.location.href = "https://usimmobile.usim.edu.my/student/#/login";
      }

      function toggleNotificationBox(event) {
        event.preventDefault(); // Prevent the default behavior of the link

        const notificationBox = document.getElementById('notification-box');

        if (notificationBox.style.display === 'block') {
          notificationBox.style.display = 'none';
        } else {
          displayNotifications();
          notificationBox.style.display = 'block';
        }
      }

      // Simulated notifications (Replace with your own data)
      const notifications = [
        { id: 1, message: 'SKJ 2083: Upload Absent Letter'},
        { id: 2, message: 'SKJ 2083:Leave Balance:2' },
      ];

      function displayNotifications() {
        const notificationList = document.getElementById('notification-list');
        notificationList.innerHTML = '';

        notifications.forEach(notification => {
          const listItem = document.createElement('li');
          listItem.innerText = notification.message;
          notificationList.appendChild(listItem);
        });
      }

      function confirmLogout(event) {
        event.preventDefault(); // Prevent the default behavior of the link

        // Display a confirmation dialog
        var confirmed = confirm("Are you sure you want to log out?");

        if (confirmed) {
          // Redirect to login.php
          window.location.href = "login.php";
        } else {
          // Cancel the logout operation
          return false;
        }
      }
    </script>
  </div>
</body>
</html>
<script>
    // Delete button click handler
    $(document).on('click', '.delete-btn', function() {
      var fileId = $(this).data('id');
      if (confirm('Are you sure you want to delete this file?')) {
        window.location.href = 'subject1.php?id=' + fileId;
      }
    });
  </script>
