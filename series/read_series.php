<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}
$user = $_SESSION['id'];
$your_rate = NULL;

// Check existence of id parameter before processing further
if (isset($_GET["SeriesId"]) && !empty(trim($_GET["SeriesId"]))) {
    // Include config file
    require_once "../config_user.php";

    $SeriesID = $_GET["SeriesId"];
    // Prepare a select statement
    $sql = "SELECT * FROM series WHERE SeriesId = ?  ";
    $sql2 = "SELECT * FROM seriesrating WHERE SeriesId = ? AND userID = ? ";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_SeriesId);

        // Set parameters
        $param_SeriesId = trim($_GET["SeriesId"]);

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
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    $sql = "SELECT * FROM seriesfav WHERE seriesID = ?  AND userID=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ii", $param_seriesId,  $param_userid);

        // Set parameters
        $param_seriesId = trim($_GET["SeriesId"]);
        $param_userid = $user;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                        contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                
                $favorited = true;
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                $favorited = false;
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    $sql = "SELECT * FROM creditsseries WHERE SeriesId =?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_SeriesId);

        // Set parameters
        $param_SeriesId = trim($_GET["SeriesId"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

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
            } else {
                
                $Actors = "-";
                $Directors = "-";
                $Screenwriter = "-";
                $Musicians = "-";
                $Soundtrack = "-";
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    $sql = "SELECT * FROM serieswish WHERE SeriesID = ?  AND userID=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ii", $param_SeriesId,  $param_userid);

        // Set parameters
        $param_seriesId = trim($_GET["SeriesId"]);
        $param_userid = $user;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                
                $wished = true;
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                $wished = false;
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


    $sql = "SELECT c.Comment, u.username from seriescomments as c, users as u where c.SeriesID = ? and c.UserID=u.id ORDER BY c.CommentID DESC";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_SeriesId);

        // Set parameters
        $param_SeriesId  = trim($_GET["SeriesId"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                /* Fetch result rows as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                

            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    if ($stmt2 = mysqli_prepare($link, $sql2)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt2, "ii", $param_SeriesId, $param_userId);

        // Set parameters
        $param_SeriesId  = trim($_GET["SeriesId"]);
        $param_userId = $_SESSION['id'];
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt2)) {
            $result = mysqli_stmt_get_result($stmt2);

            if (mysqli_num_rows($result) == 1) {
                $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $your_rate = $row2['rate'];
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}
mysqli_stmt_close($stmt2);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["SubmitComment"])) {
    require_once "../config.php";
    $SeriesID = $_GET["SeriesId"];
    $user = $_SESSION['id'];
    if (empty(trim($_POST["CommentText"]))) {
        $empty_comment = "Please enter a comment.";
    } else {
        $comment_text = trim($_POST["CommentText"]);
        // Close statement
    }
    if (empty($empty_comment)) {
        $sql_2 = "INSERT INTO seriescomments (SeriesID , UserID , Comment) VALUES (?, ? ,?)";

        if ($stmt_2 = mysqli_prepare($link, $sql_2)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt_2, "iis", $param_seriesID, $param_userID, $param_comment);

            // Set parameters
            $param_seriesID = $SeriesID;
            $param_userID =  $user;
            $param_comment = $comment_text;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt_2)) {
               
                mysqli_stmt_close($stmt_2);
                mysqli_close($link);
                header("location: #");

               

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt_2);
        }
        // Close connection
        mysqli_close($link);
    }
}

if (isset($_POST['favoritesSubmit'])) {
    if (isset($_POST['favorites-checkbox']) && $favorited == 0) {
        $sql = "INSERT INTO seriesfav (seriesID, userID) VALUES (? ,?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_seriesID,  $param_userid);

            // Set parameters
            $param_seriesID = trim($_GET["SeriesId"]);
            $param_userid = $user;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);

                $favorited = 1;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    } else if (!isset($_POST['favorites-checkbox']) && $favorited == 1) {
        $sql = "DELETE FROM seriesfav WHERE seriesID=? AND  userID=?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_seriesID,  $param_userid);

            // Set parameters
            $param_seriesID = trim($_GET["SeriesId"]);
            $param_userid = $user;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                $favorited = 0;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
}

if (isset($_POST['wishSubmit'])) {
    if (isset($_POST['wishlist-checkbox']) && $wished == 0) {
        $sql = "INSERT INTO serieswish (seriesID, userID) VALUES (? ,?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_seriesID,  $param_userid);

            // Set parameters
            $param_seriesID = trim($_GET["SeriesId"]);
            $param_userid = $user;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {


                $wished = 1;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    } else if (!isset($_POST['wishlist-checkbox']) && $wished == 1) {
        $sql = "DELETE FROM serieswish WHERE seriesID=? AND  userID=?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ii", $param_seriesID,  $param_userid);

            // Set parameters
            $param_seriesID = trim($_GET["SeriesId"]);
            $param_userid = $user;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);

                $wished = 0;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["SubmitRate"])) {
    require_once "../config.php";
    $SeriesID = $_GET["SeriesId"];
    $user = $_SESSION['id'];
    if (empty(trim($_POST["SeriesRating"]))) {
        $empty_rate = "Please rate these series.";
    } else {
        $rating_number = trim($_POST["SeriesRating"]);
        // Close statement
    }
    if (empty($empty_comment)) {
        if ($your_rate == NULL) {
            $sql_3 = "INSERT INTO seriesrating ( rate, seriesID, userID) VALUES ( ?, ? ,?)";
        } else {
            $sql_3 = "UPDATE  seriesrating SET rate=? WHERE seriesID=? AND userID = ?";
        }

        if ($stmt_3 = mysqli_prepare($link, $sql_3)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt_3, "iii", $param_review, $param_seriesID, $param_userID);

            // Set parameters
            $param_review = $rating_number;
            $param_seriesID = $SeriesID;
            $param_userID =  $user;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt_3)) {
                // Close connection
                mysqli_stmt_close($stmt_3);
                mysqli_close($link);
                header("location: #");

                

            } else {
                echo "Error.";
            }

            // Close statement
            mysqli_stmt_close($stmt_3);
        }
        
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $SeriesName; ?></title>
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
                    <img src="../img/logo.png" height="40" width="40" alt="UthFlix">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../user_index.php"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <li>
                <li class="nav-item">
                    <a class="nav-link" href="../favorites.php">Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../wishlist.php">WishList</a>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Series : <?php echo $SeriesName; ?></h1>
                    <div class="form-group">

                        <label>Episodes </label>
                        <p><b><?php echo $Episodes; ?></b></p>

                        <label>Seasons </label>
                        <p><b><?php echo $Seasons; ?></b></p>

                        <label>Duration</label>
                        <p><b><?php echo $Duration; ?></b></p>

                        <label>Description</label>
                        <p><b><?php echo $Description; ?></b></p>

                        <label>Year</label>
                        <p><b><?php echo $Year; ?></b></p>

                        <label>Category</label>
                        <p><b><?php echo $Category; ?></b></p>

                        <label>Actors</label>
                        <p><b><?php echo $Actors; ?></b></p>

                        <label>Directors</label>
                        <p><b><?php echo $Directors; ?></b></p>

                        <label>Screenwriter</label>
                        <p><b><?php echo $Screenwriter; ?></b></p>

                        <label>Musicians</label>
                        <p><b><?php echo $Musicians; ?></b></p>

                        <label>Soundtrack</label>
                        <p><b><?php echo $Soundtrack; ?></b></p>

                        <label>Your Rating is </label>
                        <p><b><?php if (isset($your_rate)) {
                                    echo $your_rate;
                                } else {
                                    echo '-';
                                } ?></b></p>
                    </div>
                    <div class="form-check">
                        <form action="" method="post">
                            <input class="form-check-input" type="checkbox" value='0' id=" flexCheckChecked" name="favorites-checkbox" 
                                   <?php if ($favorited == 1) {
                                        echo 'checked'; } ?>>
                            
                            <label class="form-check-label" for="flexCheckChecked">
                                Add to Favorites
                            </label>
                            <input type="submit" name="favoritesSubmit" value="Submit">
                        </form>
                    </div>
                    <div class="form-check">
                        <form action="" method="post">

                            <input class="form-check-input" type="checkbox" value="0" id="flexCheckChecked" name="wishlist-checkbox" 
                                   <?php if ($wished == 1) {
                                    echo 'checked';} ?>> 
                            <label class="form-check-label" for="flexCheckChecked">
                            Add to Wishlist
                            </label>
                            <input type="submit" name="wishSubmit" value="Submit" />
                        </form>
                    </div>
                    
                    <form action="" method="POST">

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Rate the series</label>
                            <input type="number" class="form-control" id="exampleFormControlSelect1" name="SeriesRating" min="1" max="5" />

                            <button type="submit" class="btn btn-primary" name="SubmitRate"> Rate</button>

                        </div>

                    </form>
                    <div class="row">
                        <h4>Comments: </h4>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="" method="POST">
                                <div class="form-group shadow-textarea">
                                    <textarea name="CommentText" class="form-control" id="exampleFormControlTextarea5" rows="3" placeholder="Leave a comment"></textarea>
                                    <button type="submit" name="SubmitComment" class="btn btn-primary">Submit </button>
                                </div>
                        
                        </form>
                            </div>
                        <?php
                        if (isset($rows)) {
                            foreach ($rows as $comment) {
                                echo "<div class='col-12'>";

                                echo "<div class='shadow-lg p-3 mb-5 bg-white rounded'>";
                                echo $comment["username"] . ":</br>";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $comment["Comment"] . " 
                        </div>
                    </div>";
                            }
                        } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
