function scanQRCode() {
  var fileInput = document.getElementById("qrFileInput");
  var file = fileInput.files[0];

  if (file) {
    var reader = new FileReader();

    reader.onload = function(event) {
      var imageData = event.target.result;

      // Create a new image element
      var image = new Image();

      image.onload = function() {
        // Create a canvas element to draw the image
        var canvas = document.createElement("canvas");
        var context = canvas.getContext("2d");

        canvas.width = image.width;
        canvas.height = image.height;
        context.drawImage(image, 0, 0, image.width, image.height);

        // Get the pixel data of the QR code
        var imageData = context.getImageData(0, 0, image.width, image.height);
        var qrCode = jsQR(imageData.data, imageData.width, imageData.height);

        if (qrCode) {
          // Display the scanned QR code data
          document.getElementById("qrResult").innerHTML = qrCode.data;

          // Send the scanned data to the server
          $.ajax({
            url: "scan_qr.php",
            type: "POST",
            data: { json_data: qrCode.data },
            success: function(response) {
              // Display the server response
              alert(response);
              // Redirect to home.php
              window.location.href = "home.php";
            }
          });
        } else {
          alert("QR code not found.");
        }
      };

      image.src = imageData;
    };

    reader.readAsDataURL(file);
  } else {
    alert("No file selected.");
  }
}

function displaySelectedFile() {
  var fileInput = document.getElementById("qrFileInput");
  var selectedFile = fileInput.files[0];
  var selectedFileName = "";

  if (selectedFile) {
    selectedFileName = selectedFile.name;
  }

  document.getElementById("selectedFile").textContent = "Selected file: " + selectedFileName;
}

// QR code scanning using camera
function startCameraScanner() {
  var video = document.getElementById("videoElement");
  var qrResult = document.getElementById("qrResult");

  // Request access to the camera
  navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(stream) {
      // Display the video stream in the video element
      video.srcObject = stream;

      // Create the canvas element for drawing the video frames
      var canvas = document.createElement("canvas");
      var context = canvas.getContext("2d");

      // Start scanning for QR codes
      function scanVideoFrame() {
        // Draw the current video frame on the canvas
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Get the pixel data of the canvas
        var imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        var qrCode = jsQR(imageData.data, imageData.width, imageData.height);

        if (qrCode) {
          // Stop scanning and display the QR code data
          video.srcObject.getTracks().forEach(function(track) {
            track.stop();
          });

          qrResult.innerHTML = qrCode.data;

          // Send the scanned data to the server
          $.ajax({
            url: "scan_qr.php",
            type: "POST",
            data: { json_data: qrCode.data },
            success: function(response) {
              // Display the server response
              alert(response);
              // Redirect to home.php
              window.location.href = "home.php";
            }
          });
        } else {
          // Continue scanning
          requestAnimationFrame(scanVideoFrame);
        }
      }

      // Start the QR code scanning process
      scanVideoFrame();
    })
    .catch(function(error) {
      console.error("Camera access denied: ", error);
    });
}

// Start QR code scanning using the camera
startCameraScanner();
