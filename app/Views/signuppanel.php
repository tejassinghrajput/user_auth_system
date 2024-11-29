<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up for ShipGlobal</title>
  <style>
    
    body {
      font-family: 'Arial', sans-serif;
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

    .signup-form input {
      width: 100%;
      padding: 12px 20px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }

    .signup-form input:focus {
      border-color: #7986cb;
      outline: none;
    }

    .error {
      color: red;
      font-size: 12px;
      margin-top: -15px;
      margin-bottom: 10px;
    }

    .signup-button {
      background: linear-gradient(90deg, #7986cb, #5c6bc0);
      color: white;
      padding: 14px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .signup-button:hover {
      background: linear-gradient(90deg, #5c6bc0, #7986cb);
    }

    .login-link {
      margin-top: 20px;
    }

    .login-link a {
      color: #7986cb;
      text-decoration: none;
      font-weight: bold;
    }

    .popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      display: flex;
      justify-content: center;
      align-items: center;
      visibility: hidden;
      opacity: 0;
      transition: visibility 0.3s, opacity 0.3s ease;
    }

    .popup-overlay.show {
      visibility: visible;
      opacity: 1;
    }

    .popup {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      text-align: center;
      max-width: 400px;
      width: 90%;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      transform: translateY(-50px);
      opacity: 0;
      transition: transform 0.4s ease, opacity 0.4s ease;
    }

    .popup.show {
      transform: translateY(0);
      opacity: 1;
    }

    .popup h2 {
      color: #5c6bc0;
      margin-bottom: 10px;
      font-size: 22px;
    }

    .popup p {
      margin-bottom: 20px;
      color: #555;
      font-size: 16px;
    }

    .popup .close-btn {
      background: linear-gradient(90deg, #7986cb, #5c6bc0);
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .popup .close-btn:hover {
      background: linear-gradient(90deg, #5c6bc0, #7986cb);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Sign Up for ShipGlobal</h1>
    <form class="signup-form" id="signup-form">
      <input type="text" name="username" placeholder="Enter your Username" required>
      <div class="error" id="usernameError"></div>
      <input type="email" name="email" placeholder="Enter your Email ID" required>
      <div class="error" id="emailError"></div>
      <input type="tel" name="phone" placeholder="Enter your Phone Number (optional)">
      <div class="error" id="phoneError"></div>
      <input type="password" name="password" placeholder="Create a Password" required>
      <div class="error" id="passwordError"></div>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <div class="error" id="confirmPasswordError"></div>
      <button type="submit" class="signup-button">Sign Up</button>
    </form>
    <p class="login-link">Already have an account? <a href="/login">Log In</a></p>
  </div>

  <div class="popup-overlay" id="popupOverlay">
    <div class="popup" id="popup">
      <h2 id="popupTitle">Info!</h2>
      <p id="popupMessage">Welcome to the ShipGlobal family!</p>
      <button class="close-btn" onclick="closePopup()">Close</button>
    </div>
  </div>

  <script>

    const form = document.getElementById('signup-form');
    const usernameInput = form.querySelector('input[name="username"]');
    const emailInput = form.querySelector('input[name="email"]');
    const phoneInput = form.querySelector('input[name="phone"]');
    const passwordInput = form.querySelector('input[name="password"]');
    const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');

    function showError(input, message) {
      const errorDiv = document.getElementById(`${input.name}Error`);
      errorDiv.textContent = message;
    }

    function validateUsername() {
      const username = usernameInput.value.trim();
      if (username.length < 3) {
        showError(usernameInput, 'Username must be at least 3 characters long.');
      } else {
        showError(usernameInput, '');
      }
    }

    function validateEmail() {
      const email = emailInput.value.trim();
      const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      if (!regex.test(email)) {
        showError(emailInput, 'Please enter a valid email address.');
      } else {
        showError(emailInput, '');
      }
    }

    function validatePhone() {
      const phone = phoneInput.value.trim();
      if (phone && !/^\+?\d{1,4}?\d{7,14}$/.test(phone)) {
        showError(phoneInput, 'Please enter a valid phone number.');
      } else {
        showError(phoneInput, '');
      }
    }

    function validatePassword() {
      const password = passwordInput.value.trim();
      if (password.length < 6) {
        showError(passwordInput, 'Password must be at least 6 characters long.');
      } else {
        showError(passwordInput, '');
      }
    }

    function validateConfirmPassword() {
      const confirmPassword = confirmPasswordInput.value.trim();
      const password = passwordInput.value.trim();
      if (confirmPassword !== password) {
        showError(confirmPasswordInput, 'Passwords do not match.');
      } else {
        showError(confirmPasswordInput, '');
      }
    }

    usernameInput.addEventListener('input', validateUsername);
    emailInput.addEventListener('input', validateEmail);
    phoneInput.addEventListener('input', validatePhone);
    passwordInput.addEventListener('input', validatePassword);
    confirmPasswordInput.addEventListener('input', validateConfirmPassword);

    form.addEventListener('submit', function(event) {
      event.preventDefault();
      if (
        !usernameInput.value.trim() ||
        !emailInput.value.trim() ||
        !passwordInput.value.trim() ||
        passwordInput.value !== confirmPasswordInput.value
      ) {
        showPopup('Error', 'Please fix the errors before submitting.');
        return;
      }
      const formData = new FormData(form);
      fetch('/signup/addUser', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
      })
      .then(data => {
        showPopup(data.status === 'success' ? 'Success!' : 'Error', data.message);
        if (data.status === 'success') form.reset();
      })
      .catch(error => showPopup('Error', 'Something went wrong, Please try again.'));
    });

    function showPopup(title, message) {
      const popupOverlay = document.getElementById('popupOverlay');
      document.getElementById('popupTitle').textContent = title;
      document.getElementById('popupMessage').textContent = message;
      popupOverlay.classList.add('show');
      document.getElementById('popup').classList.add('show');
    }

    function closePopup() {
      const popupOverlay = document.getElementById('popupOverlay');
      popupOverlay.classList.remove('show');
      document.getElementById('popup').classList.remove('show');
    }
  </script>
</body>
</html>
