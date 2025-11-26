<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Seller / Customer</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 30px;
      background: url("yourimage.jpg") no-repeat center center fixed;
      background-size: cover;
      font-family: Arial, sans-serif;
      background:black;
        background-image: url(images/blenderlogo.png);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .card {
      width: 200px;
      height: 150px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 15px;
      color: white;
      font-size: 22px;
      font-weight: bold;
      text-decoration: none;
      background: rgba(0, 0, 0, 0.6); /* transparent box */
      transition: transform 0.3s, background 0.3s;
      cursor: pointer;
    }

    .card:hover {
      transform: scale(1.05);
      background: rgba(0, 0, 0, 0.8);
    }
  </style>
</head>
<body>
  
  <br>
<br>
<br>
<br>
<h1 style="    font-size: 73px;
    font-family: sans-serif;
    color: white;
    background: linear-gradient(to bottom, #0d0d0d4f, #ee040400);
    border-radius: 22px;
    width: 43%;
    height: 37%;
    text-shadow: 2px 6px 15px #0003ff;
">welcome to registration Section</h1>
<br>
<br>
<br>
<br>
  <a href="seller.php" class="card" style="
    background-image: url(&quot;images/electriclogo2.jpg&quot;);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    border: 1px solid red;
    width:18%;
    height:47%;
    box-shadow: 2px 2px 2px 2px blue;
"><h1>Seller Registration</h1></a>
  <a href="customer.php" class="card" style="
    background-image: url(&quot;images/electriclogo1.jpg&quot;);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    border: 1px solid red;
    width:18%;
    height:47%;
    box-shadow: 2px 2px 2px 2px blue;
"><h1>Customer Registration</h1></a>

</body>
</html>
