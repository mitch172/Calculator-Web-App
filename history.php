<?php
    session_start();
?>

<html>
    <head>
        <title>History</title>
        <style>
            body {
                background-color:beige;
            }

            table {
                width:50%;
                font-size:30px;
            }
        </style>
    </head>

    <body>
        <?php
            echo "<table align='center' border='1'>";
            echo "<tr>";
            echo "<td>Equation:</td>";
            echo "<td>Equals:</td>";
            echo "<tr>";
            for($i = 0; $i < count($_SESSION["history"]); $i++){
                echo "<tr>";
                echo "<td>" . $_SESSION["history"][$i] . "</td>";
                echo "<td>" . $_SESSION["history_results"][$i] . "</td>";
                echo "<tr>";
            }

            echo "</table>";
        ?>
    </body>
</html>