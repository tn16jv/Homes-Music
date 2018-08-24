#!/usr/bin/php-cgi
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="css/main.css" type="text/css" rel="stylesheet" />
    <link rel="icon" href="images/favicon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<?php
include_once("header.html");
?>
<?php
if(isset($_POST['recoverySubmit'])) {
    include("PHP/databaseAccess.php");
    $conn = connectDB();
    $email = $_POST['recoveryEmail'];

    $query = "SELECT * FROM users WHERE email ='" . $email . "'";
    $accSelect = mysqli_query($conn, $query);
    if (mysqli_num_rows($accSelect) == 0) {
        die("<p>Email is not associated with any accounts.</p>");
    }
    $accDetails = mysqli_fetch_assoc($accSelect);

/* This requires an SMTP
    mail($email, 'Account Recovery',
        "Username: ".$accDetails['username']."\n\nPassword: ".md5($accDetails['password']),
        'From: noreply@homesmusic.com');
*/

    echo("<p>Account details will be sent to your email shortly. Be patient.</p>");
    echo("<p>NOTE: password is encrypted in our database, and decrypted live as it is sent.");
} else {
    ?>
    <p>Enter your account's email:</p>
    <form method="POST">
        <input type="email" placeholder="Enter Email" name="recoveryEmail" required>
        <button type="submit" name="recoverySubmit">Send</button>
    </form>
    <?php
}
?>

<?php
include_once("footer.html");
?>
</body>
</html>
