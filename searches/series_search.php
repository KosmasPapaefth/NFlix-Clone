<!DOCTYPE html>
<html lang="en">
<head>
<title>Series Search</title>
</head>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<section class="ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Series we found</h2>
                <?php

                require_once "../config.php";

                $search = $_POST['search'];
                
                
                //Select query with UNION to execute both of them
                
                $sql = "SELECT * FROM series WHERE Year LIKE '%$search%' OR Category LIKE '%$search%' OR SeriesNAme Like '%$search%'
            UNION 
        SELECT series.SeriesId, SeriesName, Episodes, Seasons, Duration, Description,Year, Category FROM series INNER JOIN creditsseries ON series.SeriesId = creditsseries.seriesID WHERE  Actors LIKE '%$search%' OR Directors LIKE '%$search%' OR Screenwriter LIKE '%$search%' OR Musicians LIKE '%$search%' OR Soundtrack LIKE '%$search%'";

                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
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
                            echo "<tr>";

                            echo "<td>" . '<a href="../series/read_series.php?SeriesId=' . $row['SeriesId'] . '" class="mr-3" title="View Record" data-toggle="tooltip">' . $row['SeriesName'] . '</a>' . "</td>";
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

                // close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</section>
<p><a class="btn btn-danger" href="../user_index.php">Back</a>.</p>
</html>
