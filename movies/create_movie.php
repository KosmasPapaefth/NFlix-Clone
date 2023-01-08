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
$moviename =  $Duration = $Description = $Year = $Category = "";
$moviename_err =  $Duration_err = $Description_err = $Year_err = $Category_err = "";
// Creating credits
$Actors = $Directors = $ScreenWriter = $Musicians = $Soundtrack = "-";
$Actors_err = $Directors_err = $ScreenWriter_err = $Musicians_err = $Soundtrack_err = "";




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validations
    if (empty(trim($_POST["moviename"]))) {
        $moviename_err = "Please enter a name.";
    } else {
        $moviename = trim($_POST["moviename"]);
    }

    if (empty(trim($_POST["Duration"]))) {
        $Duration_err = "Please enter a Duration.";
    } else {
        $Duration = trim($_POST["Duration"]);
    }

    if (empty(trim($_POST["Description"]))) {
        $Description_err = "Please enter a Description.";
    } else {
        $Description = trim($_POST["Description"]);
    }

    if (empty(trim($_POST["Year"]))) {
        $Year_err = "Please enter a Year.";
    } else {
        $Year = trim($_POST["Year"]);
    }

    if (empty(trim($_POST["Category"]))) {
        $Category_err = "Please enter a Category.";
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

    if (empty(trim($_POST["ScreenWriter"]))) {
        $ScreenWriter_err = "Please enter the Screenwriter.";
    } else {
        $ScreenWriter = trim($_POST["ScreenWriter"]);
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
    if (empty($moviename_err) && empty($Duration_err) && empty($Description_err)  && empty($Year_err) && empty($Category_err) && empty($Actors_err) && empty($Directors_err) && empty($ScreenWriter_err) && empty($Musicians_err) && empty($Soundtrack_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO movies (moviename, Duration, Description , Year , Category) VALUES (?, ? , ? , ? ,?)";
        $sql2 = "INSERT INTO creditsmovies (Actors, Directors, ScreenWriter, Musicians, Soundtrack, MovieId ) VALUES(?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sisis", $param_moviename, $param_Duration, $param_Description, $param_Year, $param_Category);

            // Set parameters
            $param_moviename = $moviename;
            $param_Duration =  $Duration;
            $param_Description = $Description;
            $param_Year = $Year;
            $param_Category = $Category;


            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                
                header("location:../company_index.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        $last_id = mysqli_insert_id($link);
        if ($stmt2 = mysqli_prepare($link, $sql2)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "sssssi", $param_actors, $param_directors, $param_screenwriter, $param_musicians, $param_soundtrack, $param_movieId);

            // Set parameters
            $param_actors = $Actors;
            $param_directors =  $Directors;
            $param_screenwriter = $ScreenWriter;
            $param_musicians = $Musicians;
            $param_soundtrack = $Soundtrack;
            $param_movieId = $last_id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt2)) {
                
                header("location:../company_index.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt2);
        }
    }

    // Close connection
    mysqli_close($link);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Movie</h2>
                    <p>Please fill this form and submit to add movie record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Movie Name</label>
                            <input type="text" name="moviename" class="form-control <?php echo (!empty($moviename_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $moviename; ?>">
                            <span class="invalid-feedback"><?php echo $moviename_err; ?></span>
                        </div>


                        <div class="form-group">
                            <label>Movie Duration</label>
                            <textarea name="Duration" class="form-control <?php echo (!empty($Duration_err)) ? 'is-invalid' : ''; ?>"><?php echo $Duration; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Duration_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Movie Description</label>
                            <textarea name="Description" class="form-control <?php echo (!empty($Description_err)) ? 'is-invalid' : ''; ?>"><?php echo $Description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Description_err; ?></span>
                        </div>


                        <div class="form-group">
                            <label>Movie Year</label>
                            <textarea name="Year" class="form-control <?php echo (!empty($Year_err)) ? 'is-invalid' : ''; ?>"><?php echo $Year; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Year_err; ?></span>
                        </div>


                        <div class="form-group">
                            <label>Movie Category</label>
                            <textarea name="Category" class="form-control <?php echo (!empty($Category_err)) ? 'is-invalid' : ''; ?>"><?php echo $Category; ?></textarea>
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
                            <label>ScreenWriter</label>
                            <textarea name="ScreenWriter" class="form-control <?php echo (!empty($ScreenWriter_err)) ? 'is-invalid' : ''; ?>"><?php echo $ScreenWriter; ?></textarea>
                            <span class="invalid-feedback"><?php echo $ScreenWriter_err; ?></span>
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

                        <input type="submit" class="btn btn-danger" value="Submit">
                        <a href="../company_index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
