<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    .card {
      background: rgba(255, 255, 255, 0.8);
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
      margin-bottom: 2%;
    }

    p {
      margin-bottom: 10px; 
    }

    .start-button {
      padding: 10px 20px;
      font-size: 1.5em;
      background-color: #ff69b4;
      color: #00bfff;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      display: block;
      margin: auto;
    }

    .start-button:hover {
      background-color: #ff1493;
    }
  </style>
</head>
<body>

  <div class="jumbotron">
    <div class="card">
      <h1>TOKO SEPEDA KELOMPOK 16</h1>
      <h1>MANAJEMEN TOKO SEPEDA</h1>
      <a href="/login" class="start-button">Start</a>
    </div>
  </div>

</body>
</html>
