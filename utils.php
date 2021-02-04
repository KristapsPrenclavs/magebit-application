<?php

$columns = array('email', 'date');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

$sortArrow = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';


function parse_email($email)
{
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
  $a = strrpos($email, '@') + 1;
  $domain = substr($email, $a);
  $provider = explode(".", $domain);
  return $provider[0];
}
