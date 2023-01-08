<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
if ($_SESSION['role'] == 'company') {
    require_once "../config_company.php";
    
}
if ($_SESSION['role'] == 'admin') {
    require_once "../config.php";
}
if ($_SESSION['role'] == 'user') {
    header("location:../user_index.php");
}

// Process delete operation after confirmation
if (isset($_POST["SeriesId"]) && !empty($_POST["SeriesId"])) {
   

    // Prepare a delete statement
    $sql = "DELETE FROM series WHERE SeriesId = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_SeriesId);

        // Set parameters
        $param_SeriesId = trim($_POST["SeriesId"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records deleted successfully. Redirect to landing page
            header("location:../company_index2.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["SeriesId"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <nav class="navbar  navbar-light sticky-top">
        <!-- Links -->
        <div class="container-fluid">
            <ul class="nav">
                <li class="nav-item">
                    <img src="../img/logo.png" height="40" width="40" alt="UthFlix" onclick="goToHome()  ">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../company_index.php"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="SeriesId" value="<?php echo trim($_GET["SeriesId"]); ?>" />
                            <p>Do you sure you want to delete this record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="../company_index2.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
