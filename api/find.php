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
  require_once "paginate.php";

  if (isset($_REQUEST["email"])) {

    $paginate = new Paginate($mysqli);

    $query = 'SELECT * FROM emails WHERE email LIKE ? ORDER BY ' . $column . ' ' . $sort_order;

    if ($stmt = $mysqli->prepare($query)) {

      $email = $_REQUEST["email"] . '%';
      $stmt->bind_param("s", $email);

      if ($stmt->execute()) {
        $result = $stmt->get_result();
  ?>
        <table class='table table-bordered table-striped'>
          <tr>
            <th><a href="find.php?email=<?php echo $email; ?>&column=email&order=<?php echo $asc_or_desc; ?>">Email<i class="fas fa-sort<?php echo $column == 'age' ? '-' . $sortArrow : ''; ?>"></i></a></th>
            <th><a href="find.php?email=<?php echo $email; ?>&column=date&order=<?php echo $asc_or_desc; ?>">Date<i class="fas fa-sort<?php echo $column == 'date' ? '-' . $sortArrow : ''; ?>"></i></a></th>
          </tr>
          <?php

          if ($result->num_rows > 0) {
            $arr = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              $provider = parse_email($row['email']);
              array_push($arr, $provider); ?>
              <tr>
                <td><a href="delete.php?email=<?php echo $row['email']; ?>" class="fas fa-trash"></a><?php echo $row['email']; ?></td>
                <td><?php echo $row['date']; ?></td>
              </tr>
            <?php }
            ?>
        </table>
        <form href="find.php?email=<?php echo $email; ?>">Search for Email <input type="text" name="email" id="inputEmail">
          <button type="submit">Search</button>
        </form>
        <form method="POST" action="findByProvider.php">
          <span>Filter By Provider</span>
          <?php $a = array_unique($arr);
            foreach ($a as $value) {
          ?>
            <button type="submit" name="provider" value="<?php echo $value ?>"><?php echo $value ?></button>
  <?php
            }
          } else {
            echo "No matches found";
          }
        }
      }
    } else echo "Plese insert search param"
  ?>
        </form>
</body>

</html>