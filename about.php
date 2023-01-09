<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>About</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="style/bootstrap/css/bootstrap.min.css">
    </head>

    <body class="bg-warning">
        <div class="text-primary text-center pt-3 pb-3 d-flex flex-row bd-highlight justify-content-center">
        <h1 class="border border-danger p-2 bd-highlight">About Page</h1>
        </div>
        <?php
            //Information about this assignment
            echo "<strong class='pl-3'>What tasks have you not attempted or not completed?</strong>";
            echo "<li class='pl-3'>Nope</li><br>";
            echo "<strong class='pl-3'>What special features/extra challenges have you done, or attempted, when creating the site? 
            </strong>";
            echo "<li class='pl-3'>Using Bootstrap to layout the page</li><br>";
            echo "<strong class='pl-3'>Which parts did you have trouble with?</strong>";
            echo "<li class='pl-3'>When assigning the KPI in Update Staff KPI</li>";
            echo "<li class='pl-3'>Showing the total staff of each KPI in KPI Overview</li><br>";
            echo "<strong class='pl-3'>What would you like to do better next time?</strong>";
            echo "<li class='pl-3'>Perform better SQL query</li><br>";
            echo "<strong class='pl-3'>What additional features did you add to the assignment?</strong>";
            echo "<li class='pl-3'>Nope</li><br>";
            
        ?>

        <br><br>
        <div class="card-footer bg-secondary d-flex justify-content-center">
        <a class="btn btn-primary mr-3" href="Admin/index.php">Main Page</a>
        </div>
    </body>
</html>