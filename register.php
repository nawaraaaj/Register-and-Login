<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>Create Account</h1>
            <p>Get started with your free account</p>
        </div>

        <form id="registerForm" action="register.php" method="POST">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <button type="button" class="password-toggle">👁️</button>
                </div>
            </div>

            <button type="submit" class="submit-button">Create Account</button>

            <div class="success-message" id="successMessage">
                Registration successful! ✓
            </div>
        </form>

        <div class="divider">
            <span>or</span>
        </div>

        <div class="social-buttons">
            <button class="social-button">
                <i class="fab fa-google"></i>
            </button>
            <button class="social-button">
                <i class="fab fa-github"></i>
            </button>
        </div>

        <div class="login-link">
            Already have an account? <a href="login.html">Sign in</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.password-toggle');

            toggleButton.addEventListener('click', function () {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleButton.textContent = '🙈';
                } else {
                    passwordInput.type = 'password';
                    toggleButton.textContent = '👁️';
                }
            });
        });
    </script>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $servername = "localhost";
    $dbusername = "root";  
    $dbpassword = "";      
    $dbname = "signupform";
    $con = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "INSERT INTO registration(fullname, username, email, password) 
            VALUES('$fullname', '$username', '$email', '$password')";

    if (!empty($sql)) {
        $result = $con->query($sql);
    } else {
        echo "SQL query is empty!";
    }

    // Check for success
    if ($result === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>
