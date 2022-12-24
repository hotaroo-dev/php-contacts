<?php

define('host', 'localhost');
define('username', 'root');
define('password', '');
define('dbname', 'contact_db');

// Create connection
$conn = new mysqli(host, username, password, dbname);

// Check connection
if ($conn->connect_errno) {
  die("Connection failed: " . $conn->connect_error);
}

return $conn;
