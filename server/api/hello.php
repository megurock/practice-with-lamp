<?php
  header("Access-Control-Allow-Origin: *");
  $result = array('message' => 'Hello, world!');
  echo json_encode($result);
?>