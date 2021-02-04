<?php
require_once "../config.php";

$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = trim($_POST["formText"]);

  if (empty($email)) {
    header("Location: ../index.php?email=empty");
    exit();
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../index.php?email=invalid");
    exit();
  } elseif (substr($email, -2) == "co") {
    header("Location: ../index.php?email=co");
    exit();
  } elseif (!isset($_POST["check"])) {
    header("Location: ../index.php?email=checkbox");
    exit();
  } else {
    $query = "CREATE TABLE emails(
      id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
      email VARCHAR(70) NOT NULL,
      date VARCHAR(70) NOT NULL
  )";

    if (mysqli_query($mysqli, $query)) {
      echo "Table created successfully.";
    }

    $sql = "INSERT INTO emails (email, date) VALUES (?, NOW())";

    if ($stmt = $mysqli->prepare($sql)) {
      $param_email = $email;

      $stmt->bind_param("s", $param_email);

      if ($stmt->execute()) {
        $result = $stmt->get_result();
        header("Location: ../index.php?email=success");
        exit();
      } else {
        echo "Something went wrong executing query";
      }
    } 
    exit();
  }
}
