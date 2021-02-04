<?php

class Paginate
{
  function __construct($DB_con)
  {
    $this->db = $DB_con;
  }

  public function getData($query)
  {
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data;
  }

  public function page($query, $records_per_page)
  {
    $starting_position = 0;
    if (isset($_GET["page_no"])) {
      $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
    }
    $query = $query . " limit $starting_position,$records_per_page";
    return $query;
  }

  public function pagelink($query, $records_per_page)
  {
    $self = $_SERVER['PHP_SELF'];

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = mysqli_num_rows($result);

    $total_no_of_records = $result;


    if ($total_no_of_records > 0) {
  ?>
      <tr>
        <td>
          <?php
          $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
          $current_page = 1;
          if (isset($_GET["page_no"])) {
            $current_page = $_GET["page_no"];
          }
          if ($current_page != 1) {
            $previous = $current_page - 1;
            echo "<a href='" . $self . "?pages_no=1'>First</a>&nbsp;&nbsp;";
            echo "<a href='" . $self . "?page_no=" . $previous . "'>Previous</a>&nbsp;&nbsp;";
          }
          for ($i = 1; $i <= $total_no_of_pages; $i++) {
            if ($i == $current_page) {
              echo "<strong><a href='" . $self . "?page_no=" . $i . "' >" . $i . "</a></strong>&nbsp;&nbsp;";
            } else {
              echo "<a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a>&nbsp;&nbsp;";
            }
          }
          if ($current_page != $total_no_of_pages) {
            $next = $current_page + 1;
            echo "<a href='" . $self . "?page_no=" . $next . "'>Next</a>&nbsp;&nbsp;";
            echo "<a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Last</a>&nbsp;&nbsp;";
          }
          ?>
        </td>
      </tr>
  <?php
    }
  }
}
