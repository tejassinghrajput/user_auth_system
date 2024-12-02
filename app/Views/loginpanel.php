<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login to ShipGlobal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #6e7cfc, #8e9dff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      animation: backgroundAnimation 10s infinite alternate;
    }

    @keyframes backgroundAnimation {
      0% {
        background: linear-gradient(135deg, #6e7cfc, #8e9dff);
      }
      50% {
        background: linear-gradient(135deg, #f7c9d1, #f3b0c3);
      }
      100% {
        background: linear-gradient(135deg, #6e7cfc, #8e9dff);
      }
    }

    .container {
      background-color: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
      transition: transform 0.3s ease-in-out;
    }

    .container:hover {
      transform: translateY(-10px);
    }

    h1 {
      margin-bottom: 30px;
      color: #333;
      font-size: 24px;
      font-weight: bold;
    }

    .login-options {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .login-options a {
      background-color: #f2f2f2;
      color: #333;
      padding: 12px 20px;
      text-decoration: none;
      border-radius: 4px;
      display: flex;
      align-items: center;
      margin-right: 10px;
      transition: background-color 0.3s ease;
    }

    .login-options a:hover {
      background-color: #ececec;
    }

    .login-options a img {
      height: 20px;
      margin-right: 10px;
    }

    .or {
      margin: 20px 0;
      color: #888;
    }

    .login-form input {
      width: 100%;
      padding: 12px 20px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }

    .login-form input:focus {
      border-color: #7986cb;
      outline: none;
    }

    .forgot-password {
      color: #7986cb;
      text-decoration: none;
      font-size: 14px;
      display: block;
      margin-top: -15px;
      margin-bottom: 15px;
    }

    .login-button {
      background-color: #7986cb;
      color: white;
      padding: 14px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .login-button:hover {
      background-color: #5f74b7;
    }

    .signup-link {
      margin-top: 20px;
    }

    .signup-link a {
      color: #7986cb;
      text-decoration: none;
      font-weight: bold;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      padding-top: 60px;
    }

    .modal-content {
      background-color: white;
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      width: 90%;
      max-width: 400px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      position: relative;
      text-align: center;
      animation: fadeIn 0.3s ease;
    }

    .modal-content h2 {
      margin-bottom: 15px;
      color: #333;
      font-size: 20px;
      font-weight: bold;
    }

    .modal-content input {
      width: 100%;
      padding: 12px 20px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }

    .modal-content input:focus {
      border-color: #7986cb;
      outline: none;
    }

    .modal-content button {
      background-color: #7986cb;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }

    .modal-content button:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }

    .modal-content button:hover:not(:disabled) {
      background-color: #5f74b7;
    }

    .timer {
      font-size: 14px;
      color: #888;
      margin-top: 10px;
      font-style: italic;
    }

    .close-btn {
      top: 15px;
      right: 15px;
      background-color: transparent;
      border: none;
      font-size: 18px;
      color: #888;
      cursor: pointer;
    }

    .close-btn:hover {
      color: #333;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .toast {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #28a745;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      display: none;
      z-index: 1050;
      transition: opacity 0.3s ease, bottom 0.3s ease;
    }

  .toast.show {
      display: block;
      opacity: 1;
      bottom: 30px;
  }

  .toast.error {
      background-color: #dc3545;
  }
  </style>
</head>
<body>
  <div class="container">
    <h1>Login to ShipGlobal</h1>
    <div class="login-options">
      <a href="/login/google" class="google-login">
        <img src="https://www.svgrepo.com/show/303108/google-icon-logo.svg" alt="Google">
        Google
      </a>
      <a href="javascript:void(0);" class="phone-login" onclick="openPhoneModal()">
        <img src="https://www.reshot.com/preview-assets/icons/XZTUCW7SFA/phone-XZTUCW7SFA.svg" alt="Phone">
        Phone
      </a>
    </div>
    <p class="or">or</p>
    <form class="login-form" method="POST" action="/login/userAuth/email">
      <input type="email" name="email" placeholder="Enter your Email ID" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <a href="#" class="forgot-password">Forgot Password?</a>
      <button type="submit" class="login-button">Login</button>
    </form>
    <p class="signup-link">New to ShipGlobal? <a href="/signup">Sign Up Now</a></p>
  </div>
  <div id="phoneModal" class="modal">
    <div class="modal-content">
      <button class="close-btn" onclick="closePhoneModal()">×</button>
      <h2>Enter your Phone Number</h2>
      <div id="phoneNumberSection">
        <input type="text" id="phoneNumber" placeholder="Enter phone number" required>
        <button id="sendOtpButton" onclick="sendOtp()">Send OTP</button>
      </div>
      <div id="otpVerificationSection" style="display:none;">
        <form id="otpForm" method="POST" action="/login/userAuth/phone">
            <input type="text" id="otpInput" name="otp" placeholder="Enter OTP" min="000000" max="999999" required>
            <input type="hidden" id="phoneInput" name="phone">
            <button type="submit" id="verifyOtpButton">Verify OTP</button>
            <button type="button" id="resendOtpButton" onclick="resendOtp()" disabled>Resend OTP</button>
            <div id="timer" class="timer"></div>
        </form>
      </div>
    </div>
  </div>

  <div id="toast" class="toast">
        <p id="toast-message"></p>
  </div>
  <script>
    let countdown;
    let seconds = 30;
    let generatedOtp = null;

    function openPhoneModal() {
      document.getElementById("phoneModal").style.display = "block";
      resetModal();
    }

    function closePhoneModal() {
      document.getElementById("phoneModal").style.display = "none";
      resetModal();
    }

    function resetModal() {
      clearInterval(countdown);
      document.getElementById("phoneNumberSection").style.display = "block";
      document.getElementById("otpVerificationSection").style.display = "none";
      document.getElementById("sendOtpButton").disabled = false;
      document.getElementById("resendOtpButton").disabled = true;
      document.getElementById("timer").textContent = "";
      seconds = 30;
      generatedOtp = null;
    }

    function sendOtp() {
      const phoneNumber = document.getElementById("phoneNumber").value;
      if (phoneNumber && /^[0-9]{10}$/.test(phoneNumber)) {
        document.getElementById("phoneInput").value = phoneNumber;
        document.getElementById("phoneNumberSection").style.display = "none";
        document.getElementById("otpVerificationSection").style.display = "block";
        startOtpTimer();
        otpSend(phoneNumber);
      } else {
        showToast("Please enter a valid 10-digit phone number.");
      }
    }

    function startOtpTimer() {
      document.getElementById("resendOtpButton").disabled = true;
      seconds = 5;
      countdown = setInterval(function () {
        document.getElementById("timer").textContent = `Resend OTP in ${seconds} seconds`;
        seconds--;
        if (seconds < 0) {
          clearInterval(countdown);
          document.getElementById("resendOtpButton").disabled = false;
          document.getElementById("timer").textContent = "You can resend OTP now!";
        }
      }, 1000);
    }

    async function verifyOtp(){
      const enteredOtp = document.getElementById("otpInput").value;
      const phoneNumber = document.getElementById("phoneNumber").value;
      if (enteredOtp.length !== 6 || !/^\d{6}$/.test(enteredOtp)) {
        showToast("Please enter a valid 6-digit OTP.");
        return;
      }

      const response = await fetch('api/verifyOtp',{
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({phone : phoneNumber, otp: enteredOtp}),
      });

      const data = await response.json();

      if(data.status==true){
        showToast("OTP Verified Successfully");
        window.location.href = "/dashboard";
      }
      else{
        showToast("Invalid OTP");
      }
    }

    async function otpSend(phone){
      const response = await fetch('/api/sendOtp', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ phone }),
      });

      const data = await response.json();

      if(data.status == true){
        showToast("OTP Send Successfully")
      }
      else{
        showToast("Failed to send OTP")
      }
    }

    function resendOtp() {
      if (seconds <= 0) {
        sendOtp();
      }
    }

    function showToast(message, type) {
      const toast = document.getElementById("toast");
      const toastMessage = document.getElementById("toast-message");
      
      toastMessage.textContent = message;
      toast.classList.add(type);
      toast.classList.add("show");

      setTimeout(() => {
          toast.classList.remove("show");
      }, 3000);
    }

  </script>
</body>
</html>