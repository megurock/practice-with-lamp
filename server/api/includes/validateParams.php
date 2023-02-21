<?php

function validateParams() {
  $isAllParamsSet = isset($_GET['name']) && isset($_GET['email']) && isset($_GET['date']);

  if ($isAllParamsSet) {

    // Validate name.
    $nameParam = $_GET['name'];
    $nameLength = mb_strlen($nameParam);
    $isValidName = (0 <= $nameLength) && ($nameLength <= 50);

    // Validate email.
    $emailParam = $_GET['email'];
    $emailLength = mb_strlen($emailParam);
    $isValidEmail = (0 < $emailLength) && ($emailLength <= 256);

    // Validate date format.
    $dateParam = $_GET['date'];
    $date = date('Y-m-d', strtotime($dateParam));
    $isValidDate = $dateParam === $date;

    return $isValidName && $isValidEmail && $isValidDate;
  } 

  return false;
}


?>