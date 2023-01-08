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


// Define variables and initialize with empty values
$SeriesName = $Episodes = $Seasons = $Duration = $Description = $Year = $Category = "";
$SeriesName_err  = $Episodes_err = $Seasons_err = $Duration_err = $Description_err = $Year_err = $Category_err = "";
$Actors = $Directors = $Screenwriter = $Musicians = $Soundtrack = "";
$Actors_err = $Directors_err = $Screenwriter_err = $Musicians_err = $Soundtrack_err = "";

// Processing form data when form is submitted
if (isset($_POST["SeriesId"]) && !empty($_POST["SeriesId"])) {
    
    $SeriesId = $_POST["SeriesId"];

    // Validate name
    if (empty(trim($_POST["SeriesName"]))) {
        $SeriesName_err = "Please enter a Series name.";
    } else {
        $SeriesName = trim($_POST["SeriesName"]);
    }

    if (empty(trim($_POST["Episodes"]))) {
        $Episodes_err = "Please enter a episode.";
    } else {
        $Episodes = trim($_POST["Episodes"]);
    }

    if (empty(trim($_POST["Seasons"]))) {
        $Seasons_err = "Please enter a description.";
    } else {
        $Seasons = trim($_POST["Seasons"]);
    }


    if (empty(trim($_POST["Duration"]))) {
        $Duration_err = "Please enter a duration.";
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



    if (empty($moviename_err) && empty($Duration_err) && empty($Description_err)  && empty($Year_err) && empty($Category_err) && empty($Actors_err) && empty($Directors_err) && empty($Screenwriter_err) && empty($Musicians_err) && empty($Soundtrack_err)) {
        // Prepare an update statement
        $sql = "UPDATE series SET SeriesName=? , Episodes=? ,Seasons=?,Duration=?, Description=? , Year=? , Category=? WHERE SeriesId=?";
        $sql2 = "UPDATE creditsseries SET Actors=?, Directors=?, Screenwriter=?, Musicians=?, Soundtrack=? WHERE SeriesId=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siiisisi", $param_SeriesName, $param_Episodes, $param_Seasons, $param_Duration, $param_Description, $param_Year, $param_Category,  $param_SeriesId);

            // Set parameters
            $param_SeriesName = $SeriesName;
            $param_Episodes = $Episodes;
            $param_Seasons = $Seasons;
            $param_Duration = $Duration;
            $param_Description = $Description;
            $param_Year = $Year;
            $param_Category = $Category;
            $param_SeriesId = $SeriesId;

             // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
        
                header("location:../company_index2.php");
                
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
          
        }

        // Close statement
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
            $param_movieId = $SeriesId;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt2)) {
                // Redirect
                header("location:../company_index2.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt2);
        }
    }

    // Close connection
    mysqli_close($link);
    
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["SeriesId"]) && !empty(trim($_GET["SeriesId"]))) {
        // Get URL parameter
        $SeriesId =  trim($_GET["SeriesId"]);

        // Prepare a select statement
        $sql = "SELECT * FROM series WHERE SeriesId = ?";
        $sql2 = "SELECT * from creditsseries WHERE SeriesId =?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_SeriesId);

            // Set parameters
            $param_SeriesId = $SeriesId;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $SeriesName = $row["SeriesName"];
                    $Episodes = $row["Episodes"];
                    $Seasons = $row["Seasons"];
                    $Duration = $row["Duration"];
                    $Description = $row["Description"];
                    $Year = $row["Year"];
                    $Category = $row["Category"];
                } 
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
        
        if ($stmt2 = mysqli_prepare($link, $sql2)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "i", $param_SeriesId);

            // Set parameters
            $param_SeriesId = $SeriesId;

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
                    <img src="../img/logo.png" height="40" width="40" alt="UthFlix" onclick="goToHome()  ">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../company_index2.php"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                

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
                    <p>Please edit the input values and submit to update the series record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name of the Series</label>
                            <input type="text" name="SeriesName" class="form-control <?php echo (!empty($SeriesName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $SeriesName; ?>">
                            <span class="invalid-feedback"><?php echo $SeriesName_err; ?></span>
                        </div>


                        <div class="form-group">
                            <label>Episodes of the series</label>
                            <input type="text" name="Episodes" class="form-control <?php echo (!empty($Episodes_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Episodes; ?>">
                            <span class="invalid-feedback"><?php echo $Episodes_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Seasons of the series</label>
                            <input type="text" name="Seasons" class="form-control <?php echo (!empty($Seasons_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Seasons; ?>">
                            <span class="invalid-feedback"><?php echo $Seasons_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Duration of the series</label>
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

                        <input type="hidden" name="SeriesId" value="<?php echo $SeriesId; ?>" />
                        <input type="submit" class="btn btn-danger" value="Submit">
                        <a href="../company_index2.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
