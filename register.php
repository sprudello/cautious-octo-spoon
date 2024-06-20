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
        <h1>Register</h1>
        <form action="register.php" method="post">
            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Username" required />
            </div>
            <div class="input-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="example@domain.com" required />
            </div>
            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required />
            </div>
            <div class="input-field">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"
                    required />
            </div>
            <p>Already have an account? <a href="login.php">Log In here!</a></p>

            <button type="submit">Register</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password2 = mysqli_real_escape_string($conn, $_POST['confirm_password']);

            if (!empty($username) && !empty($password) && !empty($email) && !empty($password2)) {
                if ($password == $password2) {
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}';");
                    if (mysqli_num_rows($sql) > 0) {
                        echo '<div class="alert" role="alert">This username is already taken.</div>';
                    } else {
                        $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}';");
                        if (mysqli_num_rows($sql2) > 0) {
                            echo '<div class="alert" role="alert">This email is already taken.</div>';
                        } else {
                            mysqli_query($conn, "INSERT INTO users(username, email, password) VALUES ('{$username}', '{$email}', '{$password}');");
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE username = '{$username}';");
                            if (mysqli_num_rows($sql3) > 0) {
                                $row = mysqli_fetch_assoc($sql3);
                                $_SESSION['unique_id'] = $row['id'];
                                header("Location:index.php");
                            }
                        }
                    }
                } else {
                    echo '<div class="alert" role="alert">The two passwords do not match.</div>';
                }
            } else {
                echo '<div class="alert" role="alert">Please fill all fields.</div>';
            }
        }
        ?>

    </div>
</div>

<?php
include_once "includes/footer.php";
?>