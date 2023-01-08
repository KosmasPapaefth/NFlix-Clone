<!DOCTYPE html>
<html lang="en">
<head>
<title>Movies Search</title>
</head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<section class="ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Movies we found</h2>
                <?php

                require_once "../config.php";

                $search = $_POST['search'];



                //Select query with Union to execute both queries.

                $sql = "SELECT * FROM movies WHERE Year LIKE '%$search%' OR Category LIKE '%$search%' OR moviename LIKE '%$search%'
                UNION 
                SELECT movies.MovieId, moviename, Duration, Description, Year, Category FROM movies INNER JOIN creditsmovies ON movies.MovieId = creditsmovies.movieID WHERE  Actors LIKE '%$search%' OR Directors LIKE '%$search%' OR Screenwriter LIKE '%$search%' OR Musicians LIKE '%$search%' OR Soundtrack LIKE '%$search%' ";

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
                            echo "<td>" . '<a href="../movies/read_movie.php?MovieId=' . $row['MovieId'] . '" class="mr-3" title="View Record" data-toggle="tooltip">' . $row['moviename'] . '</a>' . "</td>";
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


                // close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</section>
<p><a class="btn btn-danger " href="../user_index.php">Back</a>.</p>
</html>
