<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="title">
            <h1>Welcome Back</h1>
            <p>Sign in to your account</p>
        </div>

        <form id="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required>
                    <button type="button" class="password-toggle" aria-label="Toggle password visibility">👁️</button>
                </div>
            </div>

            <div class="forgot-password">
                <a href="#">Forgot Password?</a>
            </div>

            <button type="submit" class="submit-button">Sign In</button>
            
            <div class="success-message" id="successMessage">
                Login successful! ✓
            </div>
        </form>

        <div class="divider">
            <span>or</span>
        </div>

        <div class="social-buttons">
            <button type="button" class="social-button">
                <i class="fab fa-google"></i>
            </button>
            <button type="button" class="social-button">
                <i class="fab fa-github"></i>
            </button>
        </div>

        <div class="register-link">
            Don't have an account? <a href="register.html">Sign up</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.password-toggle');
            const loginForm = document.getElementById('loginForm');
            const successMessage = document.getElementById('successMessage');

            toggleButton.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleButton.textContent = '🙈';
                    toggleButton.setAttribute('aria-label', 'Hide password');
                } else {
                    passwordInput.type = 'password';
                    toggleButton.textContent = '👁️';
                    toggleButton.setAttribute('aria-label', 'Show password');
                }
            });

           
        });
    </script>
</body>
</html>
<?php    
    $servername = "localhost";
    $dbusername = "root";  
    $dbpassword = "";      
    $dbname = "signupform";

    // Connect to MySQL
    $con = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Get user data from the database
        $query = "SELECT * FROM registration WHERE username = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row["password"];

            // Check if entered password matches stored password
            if ($password === $stored_password) {
                echo "Login successful!";
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Incorrect username or password";
            }
        } else {
            echo "No account found with that username.";
        }

        $stmt->close();
    }

    $con->close();
?>
