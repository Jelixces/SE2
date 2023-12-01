<?php
$servername = "localhost";
$dbname = "acs_db";

$conn= new mysqli('localhost','root','','acs_db')or die("Could not connect to mysql".mysqli_error($con));

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: index.php");
        exit();
    } else {
        echo "Login failed. Invalid email or password.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <div class="loginpage">
        <div class="main2">
            <img class="logoimg" src="style/img/logo2.png" alt="Logo">
            <h1>ALLIANCE OF COMPUTER SCIENTISTS</h1>
        </div>
        <div class="main1">
            <div class="logo-name">
                <h1>ACS SOCIETY FEE</h1>
            </div>
            <div class="login-container">
                <h2>Login</h2>
                <form method="post" action="login.php">
                    <div class="input-field">
                        <input type="email" id="email" name="email" required placeholder="Email">
                    </div>
                    <div class="input-field">
                        <input type="password" id="password" name="password" required placeholder="Password">
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
