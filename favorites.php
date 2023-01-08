<?php
session_start();
if ($_SESSION['username'] == '') {
    header("location:login.php");
}

require_once "config_user.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>UthFlix</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="custom.css">
    <link rel="icon" type="image/ico" href="img/logo.png">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function goToHome() {
            window.location.href = window.location.origin + "/test/user_index.php";
        }
    </script>

</head>

<body>
    <nav class="navbar  navbar-light sticky-top">
        <!-- Links -->
        <div class="container-fluid">
            <ul class="nav">
                <li class="nav-item">
                    <img src="img/logo.png" height="40" width="40" alt="UthFlix" onclick="goToHome()  ">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_index.php"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <li>
                <li class="nav-item">
                    <a class="nav-link" href="favorites.php">Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wishlist.php">WishList</a>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="ptb-100">

        <div class="container">
            <h2> Your Favorite Series &amp; Movies</h2>
            <br>
            <div class="row">
                <div class="col-12">
                    <h2>Series</h2>

                    <div class="result"></div>
                </div>
                <?php
                
                $id = $_SESSION["id"];
                
                $sql = "SELECT series.SeriesId, SeriesName, Episodes, Seasons, Duration, Description,Year, Category FROM series INNER JOIN seriesfav ON series.SeriesId = seriesfav.seriesID AND seriesfav.userID= '$id'";

                if ($result = mysqli_query($link, $sql)) {

                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>SeriesName</th>";
                        echo "<th>Episodes</th>";
                        echo "<th>Seasons</th>";
                        echo "<th>Durationr</th>";
                        echo "<th>Description</th>";
                        echo "<th>Year</th>";
                        echo "<th>Category</th>";

                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo '
                                      <tr>';
                            echo "<td>" . $row['SeriesId'] . "</td>";
                            echo "<td>" . '<a href="series/read_series.php?SeriesId=' . $row['SeriesId'] . '" class="mr-3" title="View Record" data-toggle="tooltip">' . $row['SeriesName'] . '</a>' . "</td>";
                            echo "<td>" . $row['Episodes'] . "</td>";
                            echo "<td>" . $row['Seasons'] . "</td>";
                            echo "<td>" . $row['Duration'] . "</td>";
                            echo "<td>" . $row['Description'] . "</td>";
                            echo "<td>" . $row['Year'] . "</td>";
                            echo "<td>" . $row['Category'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>You have no favorite movies.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

               

                ?>

            </div>
        </div>
        
    </section>


    <section class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Movies</h2>

                    <?php
                  


                    
                    $sql = "SELECT  movies.MovieId, moviename, Duration, Description, Year, Category FROM movies INNER JOIN moviesfav ON movies.MovieId = moviesfav.movieID  AND moviesfav.userID= '$id'";

                    if ($result = mysqli_query($link, $sql)) {
                       
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Name</th>";
                            echo "<th>Duration</th>";
                            echo "<th>Description</th>";
                            echo "<th>Year</th>";
                            echo "<th>Category</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['MovieId'] . "</td>";
                                echo "<td>" . '<a href="movies/read_movie.php?MovieId=' . $row['MovieId'] . '" class="mr-3" title="View Record" data-toggle="tooltip">' . $row['moviename'] . '</a>' . "</td>";
                                echo "<td>" . $row['Duration'] . "</td>";
                                echo "<td>" . $row['Description'] . "</td>";
                                echo "<td>" . $row['Year'] . "</td>";
                                echo "<td>" . $row['Category'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>You have no favorite series.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </section>

</body>

</html>