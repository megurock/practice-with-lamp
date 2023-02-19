<?php

/**
 * Create MySQLI instance and return it.
 */
function connectDB() {
  // When using Docker, the hostname is the container's service name, mysql.
  $mysqli = new mysqli('mysql', 'root', 'root', 'booking');
  if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
    exit();
  } else {
    $mysqli->set_charset('utf8"');
  }
  return $mysqli;
}

?>