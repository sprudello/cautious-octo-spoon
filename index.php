<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("Location:login.php");
}
?>
<?php
include_once "includes/head.php";
include_once "database/connection.php";

$userId = $_SESSION['unique_id'];
$res = $conn->query("SELECT * FROM passwords WHERE user_id = {$userId} ORDER BY id DESC, username;");
$array = array();

while ($item = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
    $array[] = $item;
}

$conn->close();
?>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h3 class="display-5 text-center">Password Manager</h3>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <a href="new.php" class="btn btn-success">
                        New Password
                    </a>
                    <a href="logout.php?id=<?php echo $_SESSION['unique_id']; ?>" class="btn btn-danger">
                        Log Out
                    </a>
                </div>

                <div id="password-list">
                    <?php
                    foreach ($array as $item) {
                        echo '
                            <div class="password-item card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="card-title mb-0">
                                            <a href="' . $item["website"] . '" target="_blank">' . $item["website"] . '</a>
                                        </h5>
                                        <form method="post" action="delete.php">
                                            <input type="hidden" name="delid" value="' . $item['id'] . '">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Delete
                                                </button>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="form-label">Username:</label>
                                            <input type="text" class="form-control" value="' . $item['username'] . '" readonly>
                                        </div>
                                        <div class="col-md-12 mb-2 d-flex align-items-center">
                                            <label class="form-label">Password:</label>
                                            <input type="password" class="form-control password-field" value="' . $item["password"] . '" readonly>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                Show Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const passwordField = this.previousElementSibling;

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.textContent = 'Hide Password';
            } else {
                passwordField.type = 'password';
                this.textContent = 'Show Password';
            }
        });
    });
</script>

<?
include_once "includes/footer.php";
?>