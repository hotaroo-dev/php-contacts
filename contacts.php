<?php

  $query = $_GET['q'];

  $conn = require "connect.php";

  if ($query) {
    $sql = "SELECT * FROM contacts WHERE name LIKE '$query%'";
  } else {
    $sql = "SELECT * FROM contacts";
  }

  $result = $conn->query($sql);

  if ($result->num_rows) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $contact .=  "
      <div class='contact-wrapper' data-id='$row[id]'>
        <div>
          <img src='https://avatars.dicebear.com/api/open-peeps/$row[avatar].svg' />
        </div>
        <div>
          <h2>$row[name]</h2>  
          <label>$row[email]</label>
          <p>$row[notes]</p>
          <span class='delete'>&times;</span>
          <a
            href='edit.php?name=$row[name]&email=$row[email]&avatar=$row[avatar]&notes=$row[notes]'
          >
            <button>Edit</button>
          </a>
        </div>
      </div>
      "; }
  } else {
      $contact = "<p>No Contact</p>";
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contacts</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        $('.delete').click(function() {
          var _contact = $(this).parent().parent()
          var _id = _contact.attr('data-id')

          $.ajax({
            url: 'delete.php',
            data: {
              id: _id
            },
            type: "POST",
            dataType: 'json',
            success: function(__res) {
              if (__res.success) {
                _contact.addClass('fall');
                _contact.on('transitionend', () => _contact.remove())
              }
            }
          })
        })

        var input = $('form input').val('<?=$query?>')

        input.val() && input.focus()
        input.on('input', function() {
          $(this).closest('form').submit()
        })

      })
    </script>
  </head>
  <body>
    <div id="navbar">
      <Form id="search-form" role="search">
        <input placeholder="Search" type="search" name="q" />
      </Form>
      <a href="edit.php">
        <button type="button">New</button>
      </a>
    </div>

    <div id="container"><?=$contact?></div>
  </body>
</html>
