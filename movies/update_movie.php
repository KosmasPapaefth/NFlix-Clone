<?php
// Include config file
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

// Define variables and initialize with empty values
$moviename = $Duration = $Description = $Year = $Category = "";
$moviename_err  = $Duration_err = $Description_err = $Year_err = $Category_err = "";
$Actors = $Directors = $Screenwriter = $Musicians = $Soundtrack = "";
$Actors_err = $Directors_err = $Screenwriter_err = $Musicians_err = $Soundtrack_err = "";

// Processing form data when form is submitted
if (isset($_POST["MovieId"]) && !empty($_POST["MovieId"])) {
    // Get hidden input value
    $MovieId = $_POST["MovieId"];

    // Validate name
    if (empty(trim($_POST["moviename"]))) {
        $movieame_err = "Please enter a moviename.";
    } else {
        $moviename = trim($_POST["moviename"]);
    }

    if (empty(trim($_POST["Duration"]))) {
        $Duration_err = "Please enter a Duration.";
    } else {
        $Duration = trim($_POST["Duration"]);
    }

    if (empty(trim($_POST["Description"]))) {
        $Description_err = "Please enter a description.";
    } else {
        $Description = trim($_POST["Description"]);
    }

    if (empty(trim($_POST["Year"]))) {
        $Year_err = "Please enter a year.";
    } else {
        $Year = trim($_POST["Year"]);
    }

    if (empty(trim($_POST["Category"]))) {
        $Category_err = "Please enter a category.";
    } else {
        $Category = trim($_POST["Category"]);
    }
    if (empty(trim($_POST["Actors"]))) {
        $Actors_err = "Please enter Actors.";
    } else {
        $Actors = trim($_POST["Actors"]);
    }

    if (empty(trim($_POST["Directors"]))) {
        $Directors_err = "Please enter the Director.";
    } else {
        $Directors = trim($_POST["Directors"]);
    }

    if (empty(trim($_POST["Screenwriter"]))) {
        $Screenwriter_err = "Please enter the Screenwriter.";
    } else {
        $Screenwriter = trim($_POST["Screenwriter"]);
    }

    if (empty(trim($_POST["Musicians"]))) {
        $Musicians_err = "Please enter the musicians.";
    } else {
        $Musicians = trim($_POST["Musicians"]);
    }

    if (empty(trim($_POST["Soundtrack"]))) {
        $Soundtrack_err = "Please enter a soundtrack.";
    } else {
        $Soundtrack = trim($_POST["Soundtrack"]);
    }



    // Check input errors before inserting in database
    if (empty($moviename_err) && empty($Duration_err) && empty($Description_err)  && empty($Year_err) && empty($Category_err) && empty($Actors_err) && empty($Directors_err) && empty($Screenwriter_err) && empty($Musicians_err) && empty($Soundtrack_err)) {
        // Prepare an update statement
        $sql = "UPDATE movies SET moviename=? , Duration=? , Description=? , Year=? , Category=? WHERE MovieId=?";
        $sql2 = "UPDATE creditsmovies SET Actors=?, Directors=?, Screenwriter=?, Musicians=?, Soundtrack=? WHERE MovieId=?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sisisi", $param_moviename, $param_Duration, $param_Description, $param_Year, $param_Category,  $param_MovieId);

            // Set parameters
            $param_moviename = $moviename;
            $param_Duration = $Duration;
            $param_Description = $Description;
            $param_Year = $Year;
            $param_Category = $Category;
            $param_MovieId = $MovieId;


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                
                header("location:../company_index.php");
              
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
        
        
        if ($stmt2 = mysqli_prepare($link, $sql2)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "sssssi", $param_actors, $param_directors, $param_screenwriter, $param_musicians, $param_soundtrack, $param_movieId);

            // Set parameters
            $param_actors = $Actors;
            $param_directors =  $Directors;
            $param_screenwriter = $Screenwriter;
            $param_musicians = $Musicians;
            $param_soundtrack = $Soundtrack;
            $param_movieId = $MovieId;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt2)) {

                header("location:../company_index.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt2);
        }

        // Close statement

    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["MovieId"]) && !empty(trim($_GET["MovieId"]))) {
        // Get URL parameter
        $MovieId =  trim($_GET["MovieId"]);

        // Prepare a select statement
        $sql = "SELECT * FROM movies WHERE MovieId = ?";
        $sql2 = "SELECT * FROM creditsmovies WHERE MovieId = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_MovieId);

            // Set parameters
            $param_MovieId = $MovieId;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $moviename = $row["moviename"];
                    $Duration = $row["Duration"];
                    $Description = $row["Description"];
                    $Year = $row["Year"];
                    $Category = $row["Category"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
        if ($stmt2 = mysqli_prepare($link, $sql2)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "i", $param_MovieId);

            // Set parameters
            $param_MovieId = $MovieId;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt2)) {
                $result = mysqli_stmt_get_result($stmt2);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $Actors = $row["Actors"];
                    $Directors = $row["Directors"];
                    $Screenwriter = $row["Screenwriter"];
                    $Musicians = $row["Musicians"];
                    $Soundtrack = $row["Soundtrack"];
                } 
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt2);
        // Close connection
        mysqli_close($link);
    } else {
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
    <title>Update Record</title>
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
                    <img src="../img/logo.png" height="40" width="40" alt="UthFlix">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../company_index.php"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the movie record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name of the movie</label>
                            <input type="text" name="moviename" class="form-control <?php echo (!empty($moviename_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $moviename; ?>">
                            <span class="invalid-feedback"><?php echo $moviename_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Duration of the movie</label>
                            <input type="text" name="Duration" class="form-control <?php echo (!empty($Duration_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Duration; ?>">
                            <span class="invalid-feedback"><?php echo $Duration_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" name="Description" class="form-control <?php echo (!empty($Description_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Description; ?>">
                            <span class="invalid-feedback"><?php echo $Description_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" name="Year" class="form-control <?php echo (!empty($Year_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Year; ?>">
                            <span class="invalid-feedback"><?php echo $Year_err; ?></span>
                        </div>


                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="Category" class="form-control <?php echo (!empty($Category_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Category; ?>">
                            <span class="invalid-feedback"><?php echo $Category_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Actors</label>
                            <textarea name="Actors" class="form-control <?php echo (!empty($Actors_err)) ? 'is-invalid' : ''; ?>"><?php echo $Actors; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Actors_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Directors</label>
                            <textarea name="Directors" class="form-control <?php echo (!empty($Directors_err)) ? 'is-invalid' : ''; ?>"><?php echo $Directors; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Directors_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Screenwriter</label>
                            <textarea name="Screenwriter" class="form-control <?php echo (!empty($Screenwriter_err)) ? 'is-invalid' : ''; ?>"><?php echo $Screenwriter; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Screenwriter_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Musicians</label>
                            <textarea name="Musicians" class="form-control <?php echo (!empty($Musicians_err)) ? 'is-invalid' : ''; ?>"><?php echo $Musicians; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Musicians_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Soundtrack</label>
                            <textarea name="Soundtrack" class="form-control <?php echo (!empty($Soundtrack_err)) ? 'is-invalid' : ''; ?>"><?php echo $Soundtrack; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Soundtrack_err; ?></span>
                        </div>

                        <input type="hidden" name="MovieId" value="<?php echo $MovieId; ?>" />
                        <input type="submit" class="btn btn-danger" value="Submit">
                        <a href="../company_index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
