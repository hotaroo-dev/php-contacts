<?php

if (empty($_POST["name"])) {
  die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
  die("Invalid email");
}

if (strlen($_POST["notes"]) < 10) {
  die("Notes must be at least 10 characters");
}

$conn = require "connect.php";

if ($_GET["new"]) {
  $sql = "INSERT INTO contacts (name, email, avatar, notes)
          VALUES (?, ?, ?, ?)";
} else {
  $sql = "UPDATE contacts 
          SET name = ?, email = ?, avatar = ?, notes = ?
          WHERE email = '$_POST[email]'";
}

$stmt = $conn->prepare($sql);

$stmt->bind_param('ssss', 
  $_POST["name"], 
  $_POST["email"], 
  $_POST["avatar"], 
  $_POST["notes"]
);

if ($stmt->execute()) {
  header("Location: contacts.php");
  exit;
}
