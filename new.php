<?php 
    session_start();
    if(!isset($_SESSION['unique_id'])) {
        header("Location: login.php");
        exit();
    }

    include_once "includes/head.php";
    include_once "database/connection.php";

    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $site = mysqli_real_escape_string($conn, $_POST['website']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $userId = $_SESSION['unique_id'];

        $sql = "INSERT INTO passwords(website, username, password, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $site, $username, $password, $userId);

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Password added successfully!</div>';
        } else {
            $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 mt-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="display-5 align-center">Add New Password</h3>
                    <hr class="mt-3 mb-4">
                    <?php echo $message; ?>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="text" class="form-control" id="website" name="website" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    $conn->close();
    include_once "includes/footer.php";
?>