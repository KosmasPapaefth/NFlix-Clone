<?php
session_start();
if ($_SESSION['username'] == '') {
  header("location:login.php");
} ?>

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
                    
                    <a class="nav-link" style="color:red;"href="user_index.php"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
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
                    <a class="nav-link" style="color:red;" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <img width="100%" src="img/movie.jpg" />
    </div>
    <section class="ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Series</h2>
                    <form action="searches/series-search.php" method="post">
                        Search by Year/ Category/ Series Credentials:<input type="text" name="search"><br>
                    </form>
                    <div class="result"></div>
                </div>
                <?php
        // Include config file
        require_once "config.php";

        
        $sql = "SELECT * FROM series";

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
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
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
                    <form action="searches/movies-search.php" method="post">
                        Search by Year/ Category/ Movie Credentials:<input type="text" name="search"><br>

                    </form>
                    <?php
         


          // Attempt select query execution
          $sql = "SELECT * FROM movies";

          if ($result = mysqli_query($link, $sql)) {
              
            
            if (mysqli_num_rows($result) > 0) {
               
              echo '<table class="table table-bordered table-striped ">';
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
              echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
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
    <footer class="bg-light text-center text-lg-start">
    
    <div class="text-center p-3" style="background-color:black; color:white;">
        <p>© 2021 Copyright: Kosmas Papaefthymiou - University Of Thessaly</p>
    </div>

</footer>

</html>