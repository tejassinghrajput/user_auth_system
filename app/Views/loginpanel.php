<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login to ShipGlobal</title>
  <link rel="stylesheet" href="styles.css">
</head>
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

</style>
<body>
  <div class="container">
    <h1>Login to ShipGlobal</h1>

    <div class="login-options">
      <a href="/login/google" class="google-login">
        <img src="https://www.svgrepo.com/show/303108/google-icon-logo.svg" alt="Google">
        Google
      </a>
    </div>

    <p class="or">or</p>

    <form class="login-form" method="POST" action="/login/email">
      <input type="email" name="email" placeholder="Enter your Email ID" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <?php if (isset($error)): ?>
        <div style="color: red;">
            <?php echo $error; ?>
        </div>
      <?php endif; ?>
      <a href="#" class="forgot-password">Forgot Password?</a>
      <button type="submit" class="login-button">Login</button>
    </form>

    <p class="signup-link">New to ShipGlobal? <a href="/signup">Sign Up Now</a></p>
  </div>
</body>
</html>
