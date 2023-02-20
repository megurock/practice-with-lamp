<?php
  $res = array(
    'status' => 'error',
    'dates' => NULL,
  );

  require './includes/validateParams.php';
  if (validateParams()) {
    // Local variables.
    $customerName = $_GET['name'];
    $customerEmail = $_GET['email'];
    $bookingDate = $_GET['date'];
    $customerId = 0;
    $isCustomerRegistered = false;
    $canBook = true;

    // [1] Connect to the database.
    require './includes/connectDB.php';
    $mysqli = connectDB();

    // [2] Get customer's Id.
    $query = 'SELECT customer_id FROM customers WHERE customer_name = "' . $customerName . '" AND customer_email = "' . $customerEmail . '"';
    $result = $mysqli->query($query);
    if (mysqli_num_rows($result) > 0) {
      $row = $result->fetch_assoc();
      $customerId = $row['customer_id'];
      $isCustomerRegistered = true;
    } 

    // [3-A] If the user is registered, get booking dates matched by the customer name and the email.
    if ($isCustomerRegistered) {
      $query = 'SELECT booking_date FROM bookings INNER JOIN customers USING(customer_id) WHERE customer_name = "' . $customerName . '" AND customer_email = "' . $customerEmail . '"';
      $result = $mysqli->query($query);
      $res['dates'] = array();

      // A user can only book 3 dates.
      $numBookings = mysqli_num_rows($result);
      $canBook = $numBookings < 3;

      if ($numBookings > 0) {
        while ($row = $result->fetch_assoc()) {
          $res['dates'][] = $row['booking_date'];
          if ($bookingDate == $row['booking_date']) {
            $canBook = false;
          }
        }
      }
    } 
    // [3-B] If the user is not yet registered, insert the user into the users table.
    else {
      $query = 'INSERT INTO customers VALUES (NULL, "' . $customerName . '", "' . $customerEmail . '");';
      $mysqli->query($query);
      $customerId = $mysqli->insert_id;
    }

    // [4] If the user can add further booking, insert the date to the bookings table.
    if ($canBook) {
      $query = 'INSERT INTO bookings VALUES (NULL, ' . $customerId . ', "' . $bookingDate .'");';
      $mysqli->query($query);
      $res['dates'][] = $bookingDate;
      $res['status'] = 'success'; 
    } else {
      $res['status'] = 'fail';
    }

    // [5] Close database connection.
    $mysqli->close();
  }

  // In the production environment, all access controls should be denied.
  header('Access-Control-Allow-Origin: *');
  header('Content-type: application/json');
  echo json_encode($res);
?>