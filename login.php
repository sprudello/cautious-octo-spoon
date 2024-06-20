<?php
session_start();

if (isset($_SESSION['unique_id'])) {
    header("Location:index.php");
}

include_once "includes/head.php";
include_once "database/connection.php";
?>

<div class="container">
    <div class="container">
        <h1>Log In</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            if (!empty($username) && !empty($password)) {
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}';");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                    $_SESSION['unique_id'] = $row['id'];
                    header("Location:index.php");
                } else {
                    echo '<div class="alert" role="alert">Incorrect username or password. Please try again.</div>';
                }
            } else {
                echo '<div class="alert" role="alert">Please fill all fields.</div>';
            }
        }
        ?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required />
            </div>
            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required />
            </div>
            <p>Don't have an account? <a href="register.php">Sign In here!</a></p>

            <button type="submit">Log In</button>
        </form>
    </div>
</div>

<?php
include_once "includes/footer.php";
?>