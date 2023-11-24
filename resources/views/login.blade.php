<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f5f5f5; /* Set a light background color */
    }

    .card {
      background: #fff; /* White background for the card */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: auto;
      max-width: 400px;
    }

    .jumbotron {
      position: relative;
      height: 100vh;
      background: url('{{asset('images/bike.JPG')}}') center/cover no-repeat;
      color: #fff;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    h1 {
      margin: 0;
      color: black;
      margin-bottom: 15px; /* Increased margin-bottom for spacing */
    }

    .start-button {
      padding: 12px 24px;
      font-size: 1.5em;
      background-color: #ff69b4;
      color: #fff; /* White text color for better contrast */
      text-decoration: none;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      display: block;
      margin: auto;
      margin-top: 20px;
    }

    .start-button:hover {
      background-color: #ff1493;
    }

    .login-form {
      text-align: center;
    }

    .form-group {
      margin-bottom: 20px; /* Increased margin-bottom for spacing */
    }

    .form-group label {
      display: block;
      margin-bottom: 10px; /* Increased margin-bottom for spacing */
      color: #333;
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
  </style>
</head>
<body>

  <div class="jumbotron">
    <div class="card">
      <h1>LOGIN AS A SUPERVISOR</h1>

      <!-- Login Form -->
      <form class="login-form" action="/login" method="post">
        @csrf
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="start-button">Login</button>
      </form>

    </div>
  </div>

</body>
</html>
