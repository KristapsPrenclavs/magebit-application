<?php require_once "config.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="main.css" />
  <script src="https://kit.fontawesome.com/8e828dcac2.js"></script>
</head>

<body>
  <div class="container">
    <div class="mainContainer">
      <nav class="navbar">
        <div class="logo">
          <img class="pineappleLogo" src="media/pineapple-logo.svg" alt="" />
          <img class="pineappleText" src="media/pineapple.svg" alt="" />
        </div>
        <div class="navigation">
          <a href="#">About</a>
          <a href="#">How it works</a>
          <a href="#">Contact</a>
        </div>
      </nav>
      <div id="contentMiddle" class="contentMiddle">
        <div class="heading" id="heading">
          <h1>Subscribe to newsletter</h1>
          <p>
            Subscribe to our newsletter and get 10% discount on pineapple
            glasses.
          </p>
        </div>
        <form method="post" name="inputForm" id="form" class="input_container" action="./api/create.php">
          <input id="input" name="formText" class="inputField" placeholder="Type your email address here..." onkeyup="checkForErrors();" />
          <input type="image" id="arrowBtn" class="input_img" src="media/arrow.svg" alt="Submit" onclick="isEnabled();">

          <?php
          if (isset($_GET['email'])) {

            $message = $_GET['email'];

            if ($message == "empty") {
              echo "<p class='message'>Email address is required</p>";
            } elseif ($message == "invalid") {
              echo "<p class='message'>Please provide a valid e-mail address</p>";
            } elseif ($message == "checkbox") {
              echo "<p class='message'>You must accept the terms and conditions</p>";
            } elseif ($message == "co") {
              echo "<p class='message'>We are not accepting subscriptions from Colombia emails</p>";
            } elseif ($message == "success") {
              header('location: subscribed.html');
            }
          }
          ?>
          <span class="errorMessage" id="errorMessage"></span>
          <div class="termsInput" id="check">
            <label class="tofInput">
              <input type="checkbox" name="check" />
              <span id="mark" class="checkmark"></span>I agree to
              <a href="#">terms of service</a>
            </label>
          </div>
        </form>

        <div class="lineSvg">
          <img class="line" src="media/line.svg" alt="" />
        </div>
        <div class="icons">
          <div class="iconBorder">
            <i id="i" class="fab fa-facebook-f"></i>
          </div>
          <div class="iconBorder">
            <i id="i" class="fab fa-instagram"></i>
          </div>
          <div class="iconBorder">
            <i id="i" class="fab fa-twitter"></i>
          </div>
          <div class="iconBorder">
            <i id="i" class="fab fa-youtube"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="backgroudImage"></div>
  </div>
  <script src="App.js"></script>
</body>

</html>