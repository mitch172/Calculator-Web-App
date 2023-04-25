<?php
    session_start();
    if(isset($_SESSION["result"])) {
        $_SESSION["result"] = $_SESSION["result"];
    } else {
        $_SESSION["result"] = "0";
    }
?>

<html>   
    <head>
        <title>Calculator</title>
        <style>
            table {
                width:66%;
                font-size:50px;
            }

            td {
                text-align:center;
            }

            button {
                width:100%;
                height:100px;
                font-size:30px;
            }

            .label {
                height:100px;

            }
        </style>
    </head>

    <body>
        <?php
            if($_SESSION["result"] == 0) {
                if(isset($_POST["1"])) {
                    $_SESSION["result"] = "1";
                } else if(isset($_POST["2"])) {
                    $_SESSION["result"] = "2";
                } else if(isset($_POST["3"])) {
                    $_SESSION["result"] = "3";
                } else if(isset($_POST["4"])) {
                    $_SESSION["result"] = "4";
                } else if(isset($_POST["5"])) {
                    $_SESSION["result"] = "5";
                } else if(isset($_POST["6"])) {
                    $_SESSION["result"] = "6";
                } else if(isset($_POST["7"])) {
                    $_SESSION["result"] = "7";
                } else if(isset($_POST["8"])) {
                    $_SESSION["result"] = "8";
                } else if(isset($_POST["9"])) {
                    $_SESSION["result"] = "9";
                }
            } else {
                if(isset($_POST["1"])) {
                    $_SESSION["result"] .= "1";
                } else if(isset($_POST["2"])) {
                    $_SESSION["result"] .= "2";
                } else if(isset($_POST["3"])) {
                    $_SESSION["result"] .= "3";
                } else if(isset($_POST["4"])) {
                    $_SESSION["result"] .= "4";
                } else if(isset($_POST["5"])) {
                    $_SESSION["result"] .= "5";
                } else if(isset($_POST["6"])) {
                    $_SESSION["result"] .= "6";
                } else if(isset($_POST["7"])) {
                    $_SESSION["result"] .= "7";
                } else if(isset($_POST["8"])) {
                    $_SESSION["result"] .= "8";
                } else if(isset($_POST["9"])) {
                    $_SESSION["result"] .= "9";
                }
            }

            if(isset($_POST["+"])) {
                $_SESSION["result"] = $_SESSION["result"] .= "+";
            } else if(isset($_POST["-"])) {
                $_SESSION["result"] = $_SESSION["result"] .= "-";
            } else if(isset($_POST["*"])) {
                $_SESSION["result"] = $_SESSION["result"] .= "*";
            } else if(isset($_POST["/"])) {
                $_SESSION["result"] = $_SESSION["result"] .=  "/";
            } else if(isset($_POST["clear"])) {
                $_SESSION["result"] = "0";
            }
        ?>

        <center>
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
                        <td><button type="submit" name="clear" id="clear">clr</button></td>
                        <td><button type="submit" name="0" id="0">0</button></td>
                        <td><button type="submit" name="/" id="/">/</button></td>
                        <td><button type="submit" name="=" id="=">=</button></td>
                    </tr>
                </table>
            </form>
        </center>

        
    </body>
</html>