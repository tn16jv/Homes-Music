<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register</button>

<div id="id01" class="modal">

    <form class="modal-content animate" action="/action_page.php">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <!--<img src="images/favicon.png" alt="Avatar" class="avatar">-->
        </div>

        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit" name="loginSubmit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>

<div id="id02" class="modal">

    <form class="modal-content animate" method="POST">
        <div class="imgcontainer">
            <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
            <!--<img src="images/favicon.png" alt="Avatar" class="avatar">-->
        </div>

        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="regUname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="regPsw" required>
            <label for="psw"><b>Confirm Password</b></label>
            <input type="password" placeholder="Confirm Password" name="regConfirmPsw" required>
            <label for="regEmail"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="regEmail" required>

            <button type="submit" name="registerSubmit">Register</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</div>

<?php
include "PHP/databaseAccess.php";
$conn = connectDB();

function protect($string) {
    $string = trim(strip_tags(addslashes($string)));
    return $string;
}

if (isset($_POST['registerSubmit'])) {
    $username = protect($_POST['regUname']);
    $password = protect($_POST['regPsw']);
    $email = protect($_POST['regEmail']);

    $usernameQuery = "SELECT * FROM users WHERE username='" . $username . "'";
    $checkUsername = mysqli_query($conn,$usernameQuery);
    $count = mysqli_num_rows($checkUsername);
    if ($count == 1) {
        die("<p>Username taken</p>");
    }

    $emailQuery = "SELECT * FROM users WHERE email='" . $email . "'";
    $checkEmail = mysqli_query($conn, $emailQuery);
    $count = mysqli_num_rows($checkEmail);
    if ($count == 1) {
        die ("<p>Email taken</p>");
    }

    $date = date('U');
    $insertQuery = "INSERT INTO users (username, password, email)
                    VALUES('".$username."', '".md5($password)."', '".$email."')";
    $conn->query($insertQuery);
}