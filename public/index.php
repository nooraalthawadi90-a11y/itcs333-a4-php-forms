<?php
declare(strict_types=1);

/**
 * ITCS333 A4 starter — contact form.
 * Requirements (see README rubric):
 *   - GET: render the form
 *   - POST: validate name (required, 2-60 chars), email (valid), message (required, 10-1000 chars)
 *   - invalid POST: re-render with inline errors + repopulated fields (200)
 *   - valid POST: redirect (302/303) to a success page (PRG)
 *   - escape all output with htmlspecialchars
 */

require_once __DIR__ . '/../src/validate.php';

$error = '';
$name = '';
$email = '';
$message = '';

if($_SERVER["REQUEST_METHOD"] === "POST"){
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  $message = $_POST['message'] ?? '';

  if(!validate_required($name)){
    $error .= 'Name is required.<br>';
  }
  elseif(!validate_length($name, 2, 60)){
    $error .= 'Name is too short or too long  (must be between 2 and 60 characters).<br>';
  }

  if(!validate_required($email)){
    $error .= 'Email is required.<br>';
  }
  elseif(!validate_email($email)){
    $error .= 'Email address is invalid.<br>';
  }

  if(!validate_required($message)){
    $error .= 'Message is required.<br>';
  }
  elseif(!validate_length($message, 10, 1000)){
    $error .= 'Message is too short or too long (must be between 10 and 1000 characters).<br>';
  }
  if ($error === '') {
        header('Location: success.php', true, 303);
        exit;
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us</title>
</head>
<body>
  <h1>Contact Us</h1>
  <?php 
  if ($error !== '') {
    echo '<p style= "color: red;">' .$error. '</p>';
  }
  ?>
  <form method="post" action="index.php" novalidate>
    <label>Name <input type="text" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>"></label><br>
    <label>Email <input type="email" name="email" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"></label><br>
    <label>Message <textarea name="message" value="<?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>"></textarea></label><br>
    <button type="submit">Send</button>
  </form>
</body>
</html>
