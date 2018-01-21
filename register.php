<?php
$page_title = 'Registration';
include ('header.html');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require_once ('mysqli_connect.php');
  $errors = array();

  if (empty($_POST['first_name'])) {
    $errors[] = 'You forgot to enter your first name.';
  }else {
    $firstname = mysqli_real_escape_string($conn,trim($_POST['first_name']));
  }
  if (empty($_POST['last_name'])) {
    $errors[] = 'You forgot to enter your last name.';
  }else {
      $lastname = mysqli_real_escape_string($conn,trim($_POST['last_name']));
  }
  if (empty($_POST['dob'])) {
    $errors[] = 'You forgot to enter your date of birth.';
  }else {
      $dob = mysqli_real_escape_string($conn,trim($_POST['dob']));
  }
  if (empty($_POST['email'])) {
    $errors[] = 'You forgot to enter your email address.';
  }else {
      $email = mysqli_real_escape_string($conn,trim($_POST['email']));
  }
  if (!empty($_POST['pass1'])) {
    if ($_POST['pass1'] != $_POST['pass2']) {
      $errors[] = 'Your passwords did not match.';
    }else {
      $password = mysqli_real_escape_string($conn,trim($_POST['pass1']));
    }
  }else {
    $errors[] = 'You forgot to enter your password.';
  }
  if (empty($errors)) {
    $query = "INSERT INTO users (first_name, last_name, email, pass, registration_date, dob)
    VALUES ('$firstname', '$lastname','$email', SHA1('$password'), NOW(), '$dob' )";

    $results = @mysqli_query ($conn, $query);
    if ($results) {
      echo '<h3>Thank you!</h3>
      <p>You have successfully registered.</p>';
    }else {
      echo '<h3 class="error">System Error</h3>
      <p class="error">Registration failed because of a system error:</p>';
      //DEBUGGING echo '<p class="error">' .mysqli_error($conn) . '</p>
      //DEBUGGING <p class="error">Query: ' . $query . '</p>';
    }
    mysqli_close($conn);
    include ('footer.html');
    exit();

  }else {
    echo '<h3 class="error">Error</h3>
    <p class="error">The following error(s) occurred:</p>';
      foreach ($errors as $message) {
        echo "<p class='error'>$message</p>";
      }
      echo '<p>Please try again.</p>';
  }
  mysqli_close($conn);
}
?>

<h3>Registration</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<p>First Name: <input type="text" name="first_name" size="30" maxlength="30" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
<p>Last Name: <input type="text" name="last_name" size="50" maxlength="50" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
<p>Date of Birth: <input type="date" name="dob" value="<?php if (isset($_POST['dob'])) echo $_POST['dob']; ?>" /></p>
<p>Email Address: <input type="text" name="email" size="60" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /> </p>
<p>Password: <input type="password" name="pass1" size="40" maxlength="40" /></p>
<p>Confirm Password: <input type="password" name="pass2" size="40" maxlength="40" /></p>
<p><input type="submit" name="submit" value="Register" /></p>
</form>

<?php
include ('footer.html');
?>
