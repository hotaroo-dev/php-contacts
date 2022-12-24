<?php

$success = false;

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if ($id) {
  $conn = require 'connect.php';

  $sql = "DELETE FROM contacts WHERE id = $id";

  $conn->query($sql);

  $success = true;
}

header('Content-Type: application/json');
echo json_encode(array('success' => $success));

?>
