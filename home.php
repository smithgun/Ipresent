<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>I-Present | By USIM MOBILE</title>
  <link rel="stylesheet" href="home_style.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="icon" type="image/png" href="./logo.jpg">
</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="./img/izna.jpg">
          <span class="nav-item">DASHBOARD</span>
        </a></li>

        <li>
  <a href="#" onclick="redirectUSIMMOBILE(event);">
    <i class="fas fa-home"></i>
    <span class="nav-item">Home</span>
  </a>
</li>

<script>
  function redirectUSIMMOBILE(event) {
    event.preventDefault(); // Prevent default link behavior
    // Redirect to login.php
    window.location.href = "https://usimmobile.usim.edu.my/student/#/login";
  }
</script>

        </a></li>
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

<script>
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
  </script>

<script>
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


    <section class="main">
      <div class="main-top">
        <h1>Attendance Records</h1>
        <i class="fas fa-user-cog"></i>
      </div>
      <div class="main-skills">
        <div class="card">
          <i class="fas fa-laptop-code"></i>
          <h3>SKJ 2212</h3>
          <p>Ethical Hacking</p>
          <button id="scanButton1" onclick="redirectToNextFile()">Scan</button>
          <script>
            document.getElementById('scanButton1').addEventListener('click', function() {
              // Redirect to the specified URL after scanning
              window.location.href = './scan_qr.php';
            });
          </script>
        </div>

        <div class="card">
          <i class="fab fa-wordpress"></i>
          <h3>SKJ 2083</h3>
          <p>Software Engineering</p>
          <button id="scanButton2" onclick="redirectToNextFile()">Scan</button>
          <script>
            document.getElementById('scanButton2').addEventListener('click', function() {
              // Redirect to the specified URL after scanning
              window.location.href = './scan_qr.php';
            });
          </script>
        </div>
        
        <div class="card">
          <i class="fas fa-palette"></i>
          <h3>UTK 2012</h3>
          <p>Creative Thinking</p>
          <button id="scanButton3" onclick="redirectToNextFile()">Scan</button>
          <script>
            document.getElementById('scanButton3').addEventListener('click', function() {
              // Redirect to the specified URL after scanning
              window.location.href = './scan_qr.php';
            });
          </script>
        </div>
        <div class="card">
          <i class="fab fa-app-store-ios"></i>
          <h3>SKJ 3103</h3>
          <p>Operating System</p>
          <button id="scanButton4" onclick="redirectToNextFile()">Scan</button>
          <script>
            document.getElementById('scanButton4').addEventListener('click', function() {
              // Redirect to the specified URL after scanning
              window.location.href = './scan_qr.php';
            });
          </script>
        </div>
      </div>

      <section class="main-course">
        <h1>Subjects</h1>
        <div class="course-box">
          <div class="course">
          <div class="box">
          <h3>SKJ 2212</h3>
          <p>Respective Lecturer:<br>Dr Fadzly</p>
          <i class="fas fa-laptop-code"></i>
          <button id="continueButton1" onclick="redirectToNextFile()">Continue</button>
          <span class="green-bar">Passed</span>
         <script>
        document.getElementById('continueButton1').addEventListener('click', function() {
         // Redirect to new page
       window.location.href = 'subject1.php';
       });
       </script>
        </div>
          <div class="box">
          <h3>SKJ 2083</h3>
          <p>Respective Lecturer:<br>Dr NurLida</p>
          <i class="fab fa-wordpress"></i>
          <button id="continueButton2" onclick="redirectToNextFile()">Continue</button>
          <span class="green-bar">Passed</span>
         <script>
        document.getElementById('continueButton2').addEventListener('click', function() {
         // Redirect to new page
       window.location.href = 'subject2.php';
       });</script>
        </div>
        <div class="box">
  <h3>UTK 2012</h3>
  <p>Respective Lecturer:<br>Dr Ros Fazila</p>
  <i class="fas fa-palette"></i>
  <button id="continueButton3" onclick="redirectToNextFile()">Continue</button>
  <span class="red-bar">Barred</span>
</div>
<script>
  document.getElementById('continueButton3').addEventListener('click', function() {
    // Redirect to new page
    window.location.href = 'subject3.php';
  });
</script>
<style>
  .red-bar {
    display: inline-block;
    background-color: red;
    color: white;
    padding: 5px 10px;
    margin-left: 10px;
    font-weight: bold;
    border-radius: 10px;
  }
</style>

<style>
  .green-bar {
    display: inline-block;
    background-color: green;
    color: white;
    padding: 5px 10px;
    margin-left: 10px;
    font-weight: bold;
    border-radius: 10px;
  }
</style>

          </div>
        </div>
      </section>
    </section>
  </div>
</body>
</html>
