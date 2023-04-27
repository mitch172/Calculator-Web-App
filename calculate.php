<?php
    // The variable $_SESSION["result"] is the value shown at the top of the calculator
    // If the value of $_SESSION["result"] is null set it to 0, otherwise leave it as is
    // This checks every time the page is reloaded as buttons are pressed
    session_start();
    if(isset($_SESSION["result"])) {
        $_SESSION["result"] = $_SESSION["result"];
    } else {
        $_SESSION["result"] = 0;
    }
?>

<html>   
    <head>
        <title>Calculator</title>
        <style>
            body {
                background-color:beige;
            }

            table {
                width:50%;
                font-size:50px;
            }

            td {
                text-align:center;
            }

            button {
                width:100%;
                height:100px;
                font-size:30px;
                background-color:#bfbfbf;
                border-color:#737373;
            }

            .label {
                height:100px;
                background-color:#bfbfbf;
                border-style:solid;
                border-color:#737373;
            }
        </style>
    </head>

    <body>
        <?php
            // Checks to see which button is pressed
            if(isset($_POST["clear"])) {
                $_SESSION["result"] = 0;
            }

            // If the current value is 0 replace the 0 with the next input
            if($_SESSION["result"] == 0) {
                if(isset($_POST["1"])) {
                    $_SESSION["result"] = 1;
                } else if(isset($_POST["2"])) {
                    $_SESSION["result"] = 2;
                } else if(isset($_POST["3"])) {
                    $_SESSION["result"] = 3;
                } else if(isset($_POST["4"])) {
                    $_SESSION["result"] = 4;
                } else if(isset($_POST["5"])) {
                    $_SESSION["result"] = 5;
                } else if(isset($_POST["6"])) {
                    $_SESSION["result"] = 6;
                } else if(isset($_POST["7"])) {
                    $_SESSION["result"] = 7;
                } else if(isset($_POST["8"])) {
                    $_SESSION["result"] = 8;
                } else if(isset($_POST["9"])) {
                    $_SESSION["result"] = 9;
                } else if(isset($_POST["+"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "+";
                } else if(isset($_POST["-"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "-";
                } else if(isset($_POST["*"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "*";
                } else if(isset($_POST["/"])) {
                    $_SESSION["result"] = $_SESSION["result"] .=  "/";
                }

            // Otherwise, place the new input next to the current string
            } else {
                if(isset($_POST["1"])) {
                    $_SESSION["result"] .= 1;
                } else if(isset($_POST["2"])) {
                    $_SESSION["result"] .= 2;
                } else if(isset($_POST["3"])) {
                    $_SESSION["result"] .= 3;
                } else if(isset($_POST["4"])) {
                    $_SESSION["result"] .= 4;
                } else if(isset($_POST["5"])) {
                    $_SESSION["result"] .= 5;
                } else if(isset($_POST["6"])) {
                    $_SESSION["result"] .= 6;
                } else if(isset($_POST["7"])) {
                    $_SESSION["result"] .= 7;
                } else if(isset($_POST["8"])) {
                    $_SESSION["result"] .= 8;
                } else if(isset($_POST["9"])) {
                    $_SESSION["result"] .= 9;
                } else if(isset($_POST["0"])) {
                    $_SESSION["result"] .= 0;
                } else if(isset($_POST["+"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "+";
                } else if(isset($_POST["-"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "-";
                } else if(isset($_POST["*"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "*";
                } else if(isset($_POST["/"])) {
                    $_SESSION["result"] = $_SESSION["result"] .=  "/";
                }
            }
            
            // If button pressed is equal
            if(isset($_POST["="])) {
                $array = str_split($_SESSION["result"]);

                for($i = 0; $i < strlen($_SESSION["result"]); $i++) {
                    if($array[$i] == "+") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        $_SESSION["result"] = intval($first_half) + intval($second_half);
                    } else if($array[$i] == "-") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        $_SESSION["result"] = intval($first_half) - intval($second_half);
                    } else if($array[$i] == "*") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        $_SESSION["result"] = intval($first_half) * intval($second_half);
                    } else if($array[$i] == "/") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        $_SESSION["result"] = intval($first_half) / intval($second_half);
                    }
                }
            }
        ?>

        <center>
            <!-- Each time any button is pressed, the form is submitted with the value 
            of the given button being reloaded into this page as it refreshes -->
            <form action="calculate.php" method="post">
                <table>
                    <tr>
                        <td colspan="4" class="label">
                            <?php
                                echo $_SESSION["result"];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td><button type="submit" name="7" id="7">7</button></td>
                        <td><button type="submit" name="8" id="8">8</button></td>
                        <td><button type="submit" name="9" id="9">9</button></td>
                        <td><button type="submit" name="*" id="*">*</button></td>
                    </tr>
                    
                    <tr>
                        <td><button type="submit" name="4" id="4">4</button></td>
                        <td><button type="submit" name="5" id="5">5</button></td>
                        <td><button type="submit" name="6" id="6">6</button></td>
                        <td><button type="submit" name="-" id="-">-</button></td>
                    </tr>

                    <tr>
                        <td><button type="submit" name="1" id="1">1</button></td>
                        <td><button type="submit" name="2" id="2">2</button></td>
                        <td><button type="submit" name="3" id="3">3</button></td>
                        <td><button type="submit" name="+" id="+">+</button></td>
                    </tr>

                    <tr>
                        <td><button type="submit" name="clear" id="clear">C</button></td>
                        <td><button type="submit" name="0" id="0">0</button></td>
                        <td><button type="submit" name="/" id="/">/</button></td>
                        <td><button type="submit" name="=" id="=">=</button></td>
                    </tr>
                </table>
            </form>
        </center>
    </body>
</html>