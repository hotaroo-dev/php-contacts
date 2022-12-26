<?php

if ( ! $_GET['new']) {
  $contact = json_encode(array(
    $_GET['name'], 
    $_GET['email'], 
    $_GET['avatar'], 
    str_replace("-", "'", $_GET['notes'])
  ));
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contacts - edit</title>
    <link rel="stylesheet" href="style.css" />
    <script>
      const btns = 2
      const contact = <?=$contact ?? 'null'?>;

      contact && document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('contact-form')
        for (let i = 0; i < form.length ; i++) {
          form[i].value = contact[i]
        }
      }) 
    </script>
  </head>
  <body>
    <div id="root">
      <form action="insert.php<?=$_GET['new'] ? "?new=$_GET[new]" : ''?>" method="POST" id="contact-form" novalidate>
        <p>
          <span>Name</span>
          <input type="text" name="name" placeholder="Name" defaultValue="100" />
        </p>
        <label>
          <span>Email</span>
          <input type="email" name="email" placeholder="example@gmail.com" />
        </label>
        <label>
          <span>Avatar</span>
          <input type="text" name="avatar" placeholder="your-custom-seed" />
        </label>
        <label>
          <span>Notes</span>
          <textarea name="notes" rows="5"></textarea>
        </label>
        <p>
          <button type="submit">save</button>
          <a href="contacts.php">
            <button type="button">cancel</button>
          </a>
        </p>
      </form>
    </div>
  </body>
</html>
