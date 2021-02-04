<?php
if (isset($_POST["email"]) && !empty($_POST["email"])) {
  require_once "../config.php";

  $sql = "DELETE FROM emails WHERE email = ?";

  if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("s", $param_email);

    $param_email = trim($_POST["email"]);

    if ($stmt->execute()) {
      header("location: ../records.php");
      exit();
    } else {
      echo "Oops! Something went wrong.";
    }
  }

  $stmt->close();

  $mysqli->close();
} else {
  if (empty(trim($_GET["email"]))) {
    header("location: subscribed.html");
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Delete Email</title>
</head>

<body>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input type="hidden" name="email" value="<?php echo trim($_GET["email"]); ?>" />
    <p>Are you sure you want to delete this record?</p><br>
    <p>
      <input type="submit" value="Yes">
      <a href="../records.php">No</a>
    </p>
  </form>
</body>

</html>