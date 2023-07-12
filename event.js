var uuid = null;

function generateUUID() {
  uuid = generateUUIDString();
  alert("Generated UUID: " + uuid);
}

function resetUUID() {
  uuid = null;
  document.getElementById("uuid").innerText = "";
}

function generateUUIDString() {
  var dt = new Date().getTime();
  var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
    var r = (dt + Math.random() * 16) % 16 | 0;
    dt = Math.floor(dt / 16);
    return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
  });
  return uuid;
}

function generateQRCode() {
  if (uuid) {
    var qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=125x125&data=" + encodeURIComponent(uuid);
    var qrCodeImage = document.createElement("img");
    qrCodeImage.src = qrCodeUrl;

    var qrCodeContainer = document.getElementById("qrCode");
    qrCodeContainer.innerHTML = "";
    qrCodeContainer.appendChild(qrCodeImage);
  }
}

function saveAsImage() {
  if (uuid) {
    var qrCodeContainer = document.getElementById("qrCode");
    var qrCodeImage = qrCodeContainer.getElementsByTagName("img")[0];

    // Create a temporary anchor element to download the image
    var link = document.createElement("a");
    link.href = qrCodeImage.src;
    link.download = "qr_code.svg";
    link.click();
  }
}

// Get the container element
var container = document.querySelector('.animation-container');

// Set the container dimensions
var containerWidth = container.offsetWidth;
var containerHeight = container.offsetHeight;

// Define the bubble class
class Bubble {
  constructor() {
    this.size = Math.floor(Math.random() * 80) + 20;
    this.x = Math.random() * (containerWidth - this.size);
    this.y = Math.random() * (containerHeight - this.size);
    this.dx = (Math.random() - 0.5) * 4; // Random horizontal velocity
    this.dy = (Math.random() - 0.5) * 4; // Random vertical velocity

    this.element = document.createElement('div');
    this.element.className = 'bubble';
    this.element.style.width = this.size + 'px';
    this.element.style.height = this.size + 'px';
    this.element.style.left = this.x + 'px';
    this.element.style.top = this.y + 'px';

    container.appendChild(this.element);
  }

  update() {
    this.x += this.dx;
    this.y += this.dy;

    // Check collision with other bubbles
    for (var i = 0; i < bubbles.length; i++) {
      if (bubbles[i] !== this) {
        var other = bubbles[i];
        var dx = this.x - other.x;
        var dy = this.y - other.y;
        var distance = Math.sqrt(dx * dx + dy * dy);

        if (distance < this.size / 2 + other.size / 2) {
          // Bounce off the collided bubble
          this.dx *= -1;
          this.dy *= -1;
        }
      }
    }

    // Check collision with container edges
    if (this.x < 0 || this.x + this.size > containerWidth) {
      this.dx *= -1;
    }

    if (this.y < 0 || this.y + this.size > containerHeight) {
      this.dy *= -1;
    }

    this.element.style.left = this.x + 'px';
    this.element.style.top = this.y + 'px';
  }
}

// Create an array to store the bubbles
var bubbles = [];

// Create bubbles
for (var i = 0; i < 10; i++) {
  var bubble = new Bubble();
  bubbles.push(bubble);
}

// Animation loop
function animate() {
  for (var i = 0; i < bubbles.length; i++) {
    bubbles[i].update();
  }

  requestAnimationFrame(animate);
}

// Start the animation
animate();
