<?php
session_start();
if ($_SESSION['username'] == '') {
    header("location:login.php");
}
if ($_SESSION['role'] == 'company') {
    require_once "config_company.php";
}
if ($_SESSION['role'] == 'admin') {
    require_once "config_company.php";
}

if ($_SESSION['role'] == 'user') {
    header("location:login.php");
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            
            margin: 0 auto;
             color:white;
            background-color: black;
        }
        body{
            background: black;
        }
        .table-bordered{
            color:#5bc0de;
        }
        table{
             color:white;
            background-color: black;
        }
        table tr td{
             color:white;
            background-color: black;
        }
        table tr td:last-child {
            width: 120px;
            color:white;
            background-color: black;
        }
        a{
            color:#5bc0de;
        }
    </style>
    
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
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
                    <a class="nav-link" href="company_index.php"> <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
                <li>
                
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" style="color:red;"  href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Series Details</h2>

                             <a href="company_index.php" class="btn btn-info pull-right "><i class="fa fa-eye"></i> View Movies</a>
                        
                    </div>
                    <a href="series/create_series.php" class="btn btn-info pull-right "><i class="fa fa-plus"></i> Add New Series</a>
                  
                    <br>
                    <br>
                    <?php
                  

                    // Attempt select query execution
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
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['SeriesId'] . "</td>";
                                echo "<td>" . $row['SeriesName'] . "</td>";
                                echo "<td>" . $row['Episodes'] . "</td>";
                                echo "<td>" . $row['Seasons'] . "</td>";
                                echo "<td>" . $row['Duration'] . "</td>";
                                echo "<td>" . $row['Description'] . "</td>";
                                echo "<td>" . $row['Year'] . "</td>";
                                echo "<td>" . $row['Category'] . "</td>";
                                echo "<td>";
                                echo '<a href="series/company_read_series.php?SeriesId=' . $row['SeriesId'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="series/update_series.php?SeriesId=' . $row['SeriesId'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="series/delete_series.php?SeriesId=' . $row['SeriesId'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
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
    </div>
</body>
<footer class="bg-light text-center text-lg-start">
    
    <div class="text-center p-3" style="background-color:black; color:white;">
        <p>?? 2021 Copyright: Kosmas Papaefthymiou - University Of Thessaly</p>
    </div>

</footer>
</html>