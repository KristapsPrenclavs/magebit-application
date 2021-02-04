<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>
  <h2>Emails</h2>
  <?php
  require_once "../config.php";
  require_once "../utils.php";
  $provider = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provider = trim($_POST["provider"]);
  }

  $sql = "SELECT * FROM emails WHERE email LIKE '%$provider%'";

  if ($stmt = $mysqli->prepare($sql)) {
    if ($stmt->execute()) {
      $result = $stmt->get_result();
  ?>
      <table class='table table-bordered table-striped'>
        <tr>
          <th>Email</th>
          <th>Date</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $emailToProvider = parse_email($row['email']);
            if ($provider == $emailToProvider) {
        ?>
              <tr>
                <td><a href="delete.php?email=<?php echo $row['email']; ?>" class="fas fa-trash"></a><?php echo $row['email']; ?></td>
                <td><?php echo $row['date']; ?></td>
              </tr>
    <?php
            }
          }
        } else {
          echo "<p>No matches found</p>";
        }
      }
    } ?>
      </table>
      <form method="POST" action="find.php">Search for Email <input type="text" name="email" id="inputEmail">
        <button type="submit">Search</button>
      </form>
      <a href="../records.php">Back to all records</a>
</body>

</html>