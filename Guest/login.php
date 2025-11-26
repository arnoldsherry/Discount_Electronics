<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & FontAwesome -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css?family=Numans');

    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Numans', sans-serif;
      background: url("images/blenderlogo.png") no-repeat center center fixed;
      background-size: cover;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Logo styling */
    .logo {
          margin-top: -57px;
    max-width: 433px;
    animation: fadeSlide 1s 
ease-in-out forwards;
    }

    @keyframes fadeSlide {
      from {
        opacity: 0;
        transform: translateY(-40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .container {
      flex-grow: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
    }

    .card {
      height: auto;
      min-height: 370px;
      width: 380px;
      background-color: rgba(0,0,0,0.65) !important;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.3);
      animation: zoomIn 0.6s ease;
    }

    @keyframes zoomIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    .card-header h3 { color: #fff; }
    .social_icon span {
      font-size: 50px;
      margin: 0 5px;
      color: #FFC312;
      transition: all 0.3s ease;
    }
    .social_icon span:hover { color: #fff; transform: scale(1.2); }

    .input-group-prepend span {
      width: 50px;
      background-color: #FFC312;
      color: black;
      border: 0 !important;
    }
    .form-control:focus { box-shadow: none; }

    .login_btn {
      background-color: #FFC312;
      color: #000;
      font-weight: bold;
    }
    .login_btn:hover {
      background-color: #fff;
      color: #000;
    }

    .links { color: #ddd; }
    .links a { margin-left: 5px; color: #FFC312; text-decoration: none; }
    .links a:hover { text-decoration: underline; }
  </style>
</head>
<body>

  <!-- Centered Logo -->
  <img src="images/mailogo.png" alt="Logo" class="logo">

  <!-- Login card -->
  <div class="container">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Sign In</h3>
        <div class="social_icon">
          <span><i class="fab fa-facebook-square"></i></span>
          <span><i class="fab fa-google-plus-square"></i></span>
          <span><i class="fab fa-twitter-square"></i></span>
        </div>
      </div>
      <div class="card-body">
        <form action="loginaction.php" method="POST">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="username" name="username" required>
          </div>
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" class="form-control" placeholder="password" name="password" required>
          </div>
          <div class="form-group">
            <input type="submit" value="Login" class="btn float-right login_btn">
          </div>
        </form>
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center links">
          Don't have an account? <a href="signup.php">Sign Up</a>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
