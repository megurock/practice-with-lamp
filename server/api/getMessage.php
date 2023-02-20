<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');
  $res = array("message" => "Hello, world");
  echo json_encode($res);
?>
