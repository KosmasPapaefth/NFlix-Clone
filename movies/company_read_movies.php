<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: ../login.php');
}


$user = $_SESSION['id'];
$your_rate = NULL;

// Check existence of id parameter before processing further
if (isset($_GET["MovieId"]) && !empty(trim($_GET["MovieId"]))) {
    // Include config file
    require_once "../config_user.php";

    // Prepare a select statement
    $sql = "SELECT * FROM movies WHERE MovieId = ?  ";
    $sql2 = "SELECT AVG(rate) FROM movierating WHERE MovieId = ? ";


    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_MovieId);

        // Set parameters
        $param_MovieId = trim($_GET["MovieId"]);

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
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    if ($stmt2 = mysqli_prepare($link, $sql2)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt2, "i", $param_MovieId);

        // Set parameters
        $param_MovieId  = trim($_GET["MovieId"]);
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt2)) {
            $result = mysqli_stmt_get_result($stmt2);

            if (mysqli_num_rows($result) == 1) {
                $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $your_rate = $row2['AVG(rate)'];
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt2);
    }


$sql = "SELECT * FROM creditsmovies WHERE MovieId =?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_MovieId);

        // Set parameters
        $param_MovieId = trim($_GET["MovieId"]);

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



  
    $sql = "SELECT c.Comment, u.username from moviecomments as c, users as u where c.MovieID = ? and c.UserID=u.id ORDER BY c.CommentID DESC";
   
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_MovieId);

        // Set parameters
        $param_MovieId = trim($_GET["MovieId"]);

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


    mysqli_stmt_close($stmt);

   
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: ../error.php");
    exit();
}







?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> <?php echo $moviename; ?></title>
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
                    <a class="nav-link" href="<?php echo "../".$_SESSION["role"]."_index.php" ?>"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <li>
                <li class="nav-item">
                    <a class="nav-link" href="../company_index.php">Back</a>
                </li>
              

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" style="color:red" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Movie : <?php echo $moviename; ?></h1>
                    <div class="form-group">
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

                        
                        <label>Movie Rating: </label>
                        <p><b><?php if (isset($your_rate)) {
                                    echo $your_rate;
                                } else {
                                    echo '-';
                                } ?></b></p>
                    </div>
                </div>
         
            </div>
           
           
          
            <div class="row">
                <h4>Comments: </h4>
            </div>
            <div class="row">
                
                <?php
                if (isset($rows)) {
                    foreach ($rows as $comment) {
                        echo "<div class='col-12'>";

                        echo "<div style='color:white' class='shadow-lg p-3 mb-5 bg-dark rounded'>";
                        echo $comment["username"] . ":</br>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $comment["Comment"] . " 
                        </div>
                    </div>";
                    }
                } ?>
            </div>
        </div>
    </div>
</body>

</html>
