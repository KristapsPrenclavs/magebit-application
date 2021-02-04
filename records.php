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

  require_once "config.php";
  require_once "utils.php";
  require_once "./api/paginate.php";

  $paginate = new Paginate($mysqli);

  $arr = array();

  $query = 'SELECT * FROM emails ORDER BY ' . $column . ' ' . $sort_order;

  $records_per_page = 10;
  $newquery = $paginate->page($query, $records_per_page);
  $data = $paginate->getData($newquery); ?>
  <form method="POST" action="./api/exportCsv.php">
    <table class='table table-bordered table-striped'>
      <tr>
        <th><a href="records.php?column=email&order=<?php echo $asc_or_desc; ?>">Email<i class="fas fa-sort<?php echo $column == 'age' ? '-' . $sortArrow : ''; ?>"></i></a></th>
        <th><a href="records.php?column=date&order=<?php echo $asc_or_desc; ?>">Date<i class="fas fa-sort<?php echo $column == 'date' ? '-' . $sortArrow : ''; ?>"></i></a></th>
      </tr>
      <?php foreach ($data as $row) {
        $provider = parse_email($row['email']);
        array_push($arr, $provider);
      ?>
        <tr>
          <td><input type="checkbox" name="checkbox[]" value="<?php echo $row['email']; ?>"><?php echo $row['email']; ?><a href="./api/delete.php?email=<?php echo $row['email']; ?>" class="fas fa-trash"></a></td>
          <td><?php echo $row['date']; ?></td>
        </tr>

      <?php
      }
      ?>
    </table>
    <input type="submit" value="export">
  </form>
  <form method="POST" action="./api/find.php">Search for Email <input type="text" name="email" id="inputEmail">
    <button type="submit">Search</button>
  </form>

  <form method="POST" action="./api/findByProvider.php">
    <span>Filter By Provider</span>
    <?php
    $a = array_unique($arr);
    foreach ($a as $value) {
    ?>
      <button type="submit" name="provider" value="<?php echo $value ?>"><?php echo $value ?></button>
    <?php
    }
    ?>
  </form>
  <?php
  $paginate->pagelink($query, $records_per_page);
  ?>

</body>

</html>