<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}
$user = $_SESSION['id'];
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM users WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $username = $row["username"];
                $role = $row["role"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         .wrapper {
            width: 600px;
            margin: 0 auto;
            color:white;
            background-color:black;
        }
        body {
            background: black;
        }
        a{
            color:#5bc0de;
        }
    </style>
</head>

<body>
    <nav class="navbar  navbar-light sticky-top">
        <!-- Links -->
        <div class="container-fluid">
            <ul class="nav">
                <li class="nav-item">
                    <img src="img/logo.png" height="40" width="40" alt="UthFlix">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo "".$_SESSION["role"]."_index.php" ?>"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <li>
                </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" style="color:red" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Username</label>
                        <p><b><?php echo $row["username"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <p><b><?php echo $row["role"]; ?></b></p>
                    </div>

                    <p><a href="admin_index.php" class="btn btn-danger">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>