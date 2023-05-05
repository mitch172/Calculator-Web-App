<?php
    // The variable $_SESSION["result"] is the value shown at the top of the calculator
    // If the value of $_SESSION["result"] is null set it to clear, otherwise leave it as is
    // This checks every time the page is reloaded as buttons are pressed
    session_start();
    if(isset($_SESSION["result"])) {
        $_SESSION["result"] = $_SESSION["result"];
    } else {
        $_SESSION["result"] = "Cleared";
    }
    
    // Array used for storing history of calculations
    if(isset($_SESSION["history"])) {
        $_SESSION["history"] = $_SESSION["history"];
        $_SESSION["history_results"] = $_SESSION["history_results"];
    } else {
        $_SESSION["history"] = array();
        $_SESSION["history_results"] = array();
    }

    //String of hexadecimal valus
    $hexValuesStr = "0123456789ABCDEF";
    //Array of Hex values
    $hexValues = array('0'=>"0",'1'=>"1",'2'=>"2",'3'=>"3",'4'=>"4",'5'=>"5",'6'=>"6", 
    '7'=>"7",'8'=>"8",'9'=>"9",'10'=>"A",'11'=>"B",'12'=>"C",'13'=>"D",'14'=>"E",'15'=>"F");
    //Binary values
    $hexBinValues= array('0'=>"0000",'1'=>"0001",'2'=>"0010",'3'=>"0011",'4'=>"0100",'5'=>"0101",'6'=>"0110", 
        '7'=>"0111",'8'=>"1000",'9'=>"1001",'A'=>"1010",'B'=>"1011",'C'=>"1100",'D'=>"1101",'E'=>"1110",'F'=>"1111");
   
    $binHexValues= array('0000'=>"0",'0001'=>"1",'0010'=>"2",'0011'=>"3",'0100'=>"4",'0101'=>"5",'0110'=>"6", 
    '0111'=>"7",'1000'=>"8",'1001'=>"9",'1010'=>"A",'1011'=>"B",'1100'=>"C",'1101'=>"D",'1110'=>"E",'1111'=>"F");
?>

<html>   
    <head>
        <title>Calculator</title>
        <style>
            body {
                background-color:beige;
            }

            table {
                table-layout:fixed;
                width:70%;
                font-size:50px;
            }

            td {
                text-align:center;
            }

            button {
                width:150px;
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

            a {
                text-decoration:none;
                color:black;
            }
        </style>

        <script>
            function changeBGcolor() {
                BGcolor = document.getElementById("BGcolor").value;
                document.body.style.backgroundColor = BGcolor;
                localStorage.setItem("BG", BGcolor);
            }

            function changeBTNcolor() {
                BTNcolor = document.getElementById("BTNcolor").value;
                Array.from(document.querySelectorAll('button')).map(function(button) {
                    button.style.backgroundColor = BTNcolor;
                })
                localStorage.setItem("buttonBG",BTNcolor);
            }

            function changeTXTcolor() {
                TXTcolor = document.getElementById("TXTcolor").value;
                Array.from(document.querySelectorAll('button')).map(function(button) {
                    button.style.color = TXTcolor;
                })
                Array.from(document.querySelectorAll('a')).map(function(button) {
                    button.style.color = TXTcolor;
                })
                localStorage.setItem("TXT", TXTcolor);

            }

            function loadColors() {
                document.body.style.backgroundColor = localStorage.getItem("BG")

                Array.from(document.querySelectorAll('button')).map(function(button) {
                    button.style.backgroundColor = localStorage.getItem("buttonBG");
                })

                Array.from(document.querySelectorAll('button')).map(function(button) {
                    button.style.color = localStorage.getItem("TXT");
                })
            }

        </script>

    </head>

    <body onload="loadColors()">
        <?php
            if(isset($_POST["clear"])) {
                $_SESSION["result"] = "Cleared";
            }

            // If the current value is 0 replace the 0 with the next input
            //Changeed from 0 to "clear" for binary input
            if($_SESSION["result"] == "Cleared") {
                if(isset($_POST["0"]) && $_SESSION["result"]!=0) {        //For binary conversions
                    $_SESSION["result"] = 0;
                }
                else if(isset($_POST["0"]) && $_SESSION["result"]=0) {        //For binary conversions
                    $_SESSION["result"] .= 0;
                }
                else if(isset($_POST["1"]) && $_SESSION["result"]=="Cleared") {
                    $_SESSION["result"] = 1;
                }
                else if(isset($_POST["1"]) && $_SESSION["result"]==0)
                {
                    $_SESSION["result"] .= 1;
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
                }
                else if(isset($_POST["A"])) {
                    $_SESSION["result"] = "A";
                } else if(isset($_POST["B"])) {
                    $_SESSION["result"] = "B";
                } else if(isset($_POST["C"])) {
                    $_SESSION["result"] = "C";
                } else if(isset($_POST["D"])) {
                    $_SESSION["result"] = "D";
                } else if(isset($_POST["E"])) {
                    $_SESSION["result"] = "E";
                } else if(isset($_POST["F"])) {
                    $_SESSION["result"] = "F";}  
                else if(isset($_POST["+"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "+";
                } else if(isset($_POST["-"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "-";
                } else if(isset($_POST["*"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "*";
                } else if(isset($_POST["/"])) {
                    $_SESSION["result"] = $_SESSION["result"] .=  "/";
                } else if(isset($_POST["dec"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= ".";
                } else if(isset($_POST["^"])) {
                    $_SESSION["result"] = $_SESSION["result"] .=  "^";
                } else if(isset($_POST["sin"])) {
                    $_SESSION["result"] = "sin(" . $_SESSION["result"];
                } else if(isset($_POST["cos"])) {
                    $_SESSION["result"] = "cos(" . $_SESSION["result"];
                } else if(isset($_POST["tan"])) {
                    $_SESSION["result"] = "tan(" . $_SESSION["result"];
                } else if(isset($_POST["sqrt"])) {
                    $_SESSION["result"] = "sqrt(" . $_SESSION["result"];
                }

            // Otherwise, place the new input next to the current string
            } else {
                if(isset($_POST["0"])) {
                    $_SESSION["result"] .= 0;
                }
                else if(isset($_POST["1"])) {
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
                }  else if(isset($_POST["A"])) {
                    $_SESSION["result"] .= "A";
                } else if(isset($_POST["B"])) {
                    $_SESSION["result"] .= "B";
                } else if(isset($_POST["C"])) {
                    $_SESSION["result"] .= "C";
                } else if(isset($_POST["D"])) {
                    $_SESSION["result"] .= "D";
                } else if(isset($_POST["E"])) {
                    $_SESSION["result"] .= "E";
                } else if(isset($_POST["F"])) {
                    $_SESSION["result"] .= "F"; } 
                else if(isset($_POST["+"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "+";
                } else if(isset($_POST["-"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "-";
                } else if(isset($_POST["*"])) {
                    $_SESSION["result"] = $_SESSION["result"] .= "*";
                } else if(isset($_POST["/"])) {
                    $_SESSION["result"] = $_SESSION["result"] .=  "/";
                } else if(isset($_POST["^"])) {
                    $_SESSION["result"] = $_SESSION["result"] .=  "^";
                } else if(isset($_POST["back"])) {
                    $_SESSION["result"] = substr($_SESSION["result"], 0, strlen($_SESSION["result"]) - 1);
                } else if(isset($_POST["dec"])) {
                    $_SESSION["result"] = $_SESSION["result"] .=  ".";
                } else if(isset($_POST["inverse"])) {
                    if(preg_match("|[0]|",$_SESSION["result"]) || preg_match("|[0-1]|",$_SESSION["result"])  || preg_match("|[A-Z].*|",$_SESSION["result"]))
                    {
                        $_SESSION["result"]= "Error: Divide by zero or non-base-10 input";
                    }
                    else{
                        array_push($_SESSION["history"], $_SESSION["result"]);
                        $_SESSION["result"] = 1 / $_SESSION["result"];
                        array_push($_SESSION["history_results"], $_SESSION["result"]);
                    }
                } else if(isset($_POST["sin"])) {
                    $_SESSION["result"] = "sin(" . $_SESSION["result"];
                } else if(isset($_POST["cos"])) {
                    $_SESSION["result"] = "cos(" . $_SESSION["result"];
                } else if(isset($_POST["tan"])) {
                    $_SESSION["result"] = "tan(" . $_SESSION["result"];
                } else if(isset($_POST["sqrt"])) {
                    $_SESSION["result"] = "sqrt(" . $_SESSION["result"];
                } else if(isset($_POST["neg"])) {
                    if((preg_match("|[0-1]|",$_SESSION["result"]) || preg_match("|[A-Z0-9].*|",$_SESSION["result"])) && strlen(strval($_SESSION["result"]))>0)
                    {
                        $temp=$_SESSION["result"];
                        $_SESSION["result"]= "-".$temp;
                    }
                    else{
                        $_SESSION["result"] = -1 * $_SESSION["result"];   
                    }
                }
            }


            //If conversion buttons are pressed
            if(isset($_POST["convBinToDec"])) 
            {
                $resultStr= strval($_SESSION["result"]);   //Temp val for result, $_SESSION[result][x] was throwing an error
                $isNeg=FALSE;                               //Boolean for negative value in conversions
                if($resultStr[0]=="-")  //Check if negative
                {
                    $isNeg=TRUE;
                    $tempResult=substr($resultStr,1,strlen($resultStr));
                    $resultStr=$tempResult;
                }

                //Checks for proper input, binary
                if(preg_match("|[0-1]|",$resultStr))
                {
                    if(intval($resultStr)<2)
                    {
                        array_push($_SESSION["history"],$resultStr);           //Append to history
                        $_SESSION["result"]=$resultStr;
                        $strResult= "In Decimal:  ".$resultStr;
                        array_push($_SESSION["history_results"],$strResult);           //Append to history
                    }
                    else{
                        //Check length for 4 proper bits
                        if(strlen($resultStr)==2)
                        {
                            $temp="00".$resultStr;
                            $resultStr=$temp;
                        }
                        else if(strlen($resultStr)==3)
                        {
                            $temp="0".$resultStr;
                            $resultStr=$temp;
                        }
                        
                        //Calculate Binary To Decimal
                        $decFromBin=0;
                        for($j=0; $j < strlen($resultStr); $j++)           //Loop through input and calculate each digit
                        {
                            $pow = intval(strlen($resultStr)-1)-$j;        //calculate exponent 2^x, x being digit of input for each number
                            $decFromBin += intval(strval($resultStr[$j]))*pow(2,$pow);      //Takes each binary digit and multilies it by 2^
                        }
                        if($isNeg)
                        {
                            $_SESSION["result"]=-1*$decFromBin;                              //Set the result
                            $strResult= "In Decimal: ".$_SESSION["result"];               //String for result 
                            array_push($_SESSION["history"], "-".$resultStr);
                            array_push($_SESSION["history_results"],$strResult);           //Append to history
                            $isNeg=FALSE;                                                  //Reset negative bool
                        }
                        else{
                            $_SESSION["result"]=$decFromBin;                              //Set the result
                            $strResult= "In Decimal: ".$_SESSION["result"];               //String for result
                            array_push($_SESSION["history"], $resultStr); 
                            array_push($_SESSION["history_results"],$strResult);           //Append to history
                        }
                    }
                }
                else  //Wrong input
                {
                    $_SESSION["result"]= "Error: Non-binary number input";
                }
            }
            else if(isset($_POST["convBinToHex"]))
            {
                $resultStr= strval($_SESSION["result"]);   //Temp val for result, $_SESSION[result][x] was throwing an error
                $isNeg=FALSE;                               //Boolean for negative value in conversions
                if($resultStr[0]=="-")  //Check if negative
                {
                    $isNeg=TRUE;
                    $tempResult=substr($resultStr,1,strlen($resultStr));
                    $resultStr=$tempResult;
                }

                if(preg_match("|[0-1]|",$resultStr))
                {
                    //Calculate Binary To Hexadecimal
                    if(intval($resultStr) < 2)                     //Binary numbers of 0 or 1 are the same in Hex and Dec 
                    {
                        $_SESSION["result"]=$resultStr;
                        array_push($_SESSION["history"],$_SESSION["result"]); 
                        $strResult= "In Decimal:  ".$_SESSION["result"];
                        array_push($_SESSION["history_results"],$strResult); 
                    }
                    else{
                        if(strlen($resultStr)==2)
                        {
                            $temp="00".$_SESSION["result"];
                            $resultStr=$temp;
                        }
                        else if(strlen($resultStr)==3)
                        {
                            $temp="0".$_SESSION["result"];
                            $resultStr=$temp;
                        }
                        
                        $hexFromBin="";
                        $decFromBin=0;
                        for($j=0; $j < strlen($resultStr); $j++)           //Loop through input and calculate decimal number first
                        {
                            $pow = intval(strlen($resultStr)-1)-$j;        //calculate exponent 2^x, x being digit of input for each number
                            $decFromBin += intval(strval($resultStr[$j]))*pow(2,$pow);      //Takes each binary digit and multilies it by 2^
                        }
                        
                        $divRemain=array();                     //Array for division remainders in calculating decimal
                        while($decFromBin > 0)                 //While greater than 0, find remainder of division by 16 and continue dividing by 16
                        {
                            if($decFromBin < 1)                 //To help terminate, if less than 1 means no more remainders, so break
                            {
                                break;
                            }
                            array_push($divRemain,($decFromBin%16));
                            $decFromBin=$decFromBin/16;
                        }
                        for($i=count($divRemain)-1;$i>=0;$i--)                   //Number in hex is remainders backwards
                        {   
                            $hexFromBin.= $hexValues[$divRemain[$i]];    //Finds correct hex representation based on remainder
                        }
                        if($isNeg)
                        {
                            $_SESSION["result"]="-".$hexFromBin;                              //Set the result
                            $strResult= "In Hex: ".$_SESSION["result"];               //String for result 
                            array_push($_SESSION["history"], "-".$resultStr);
                            array_push($_SESSION["history_results"],$strResult);           //Append to history
                            $isNeg=FALSE;                                                  //Reset negative bool
                        }
                        else{
                            $_SESSION["result"]=$hexFromBin;                              //Set the result
                            $strResult= "In Hex: ".$_SESSION["result"];               //String for result
                            array_push($_SESSION["history"], $resultStr); 
                            array_push($_SESSION["history_results"],$strResult);           //Append to history
                        }
                    }
                }
                else  //Wrong input
                {
                    $_SESSION["result"]= "Error: Non-binary number input";
                }
            }
            else if(isset($_POST["convDecToBin"]))
            {
                $resultStr=strval($_SESSION["result"]);
                $isNeg=FALSE;
                if(strval($resultStr[0])=="-")  //Check if negative
                {
                    $isNeg=TRUE;
                    $resultStr=intval(substr($resultStr,1,strlen($resultStr)));
                }
                if(preg_match("|[0-9]|",$resultStr))
                {
                    array_push($_SESSION["history"], $_SESSION["result"]);
                    $binFromDec="";
                    if($resultStr<2)                       //If input is 0 or 1, return them. Else calculate binary
                    {
                        if($isNeg){
                            $_SESSION["result"]="-".$resultStr;}
                        else{
                            $_SESSION["result"]=$resultStr;
                        }
                    }
                    else{
                        while($resultStr > 0)                      //While input greater than 2, find remainder of it divided by 2 and then divide number by 2
                        {
                            $binFromDec.=strval($resultStr%2);
                            $resultStr=$resultStr/2;
                            if($resultStr < 1)                     //If statement to terminate when 0, some numbers it wasnt terminating
                            {
                                break;
                            }
                        }
                        $binReverse="";                                     //Binary output is remainders in reverse order
                        for($i=strlen($binFromDec)-1;$i>=0;$i--)            //Reverse remainder string for output
                        {
                            $binReverse.=$binFromDec[$i];
                        }
                    }
                    if($isNeg)
                    {
                        $_SESSION["result"]="-".$binReverse;
                        $strResult="In Binary: ".$_SESSION["result"];
                        $isNeg=FALSE;
                    }
                    else{
                        $strResult="In Binary: ".$_SESSION["result"];
                    }
                    array_push($_SESSION["history_results"], $strResult);
                }
                else{
                    $_SESSION["result"]="Error: Non-decimal number input";
                }
            } 
            else if(isset($_POST["convDecToHex"]))
            {
                $resultStr=strval($_SESSION["result"]);
                $isNeg=FALSE;
                if(strval($resultStr[0])=="-")  //Check if negative
                {
                    $isNeg=TRUE;
                    $resultStr=intval(substr($resultStr,1,strlen($resultStr)));
                }
                if(preg_match("|[0-9]|",$resultStr))
                {
                    array_push($_SESSION["history"], $_SESSION["result"]);
                    $divRemain=array();
                    $hexFromDec="";
                    if($resultStr < 10)                       //If input is less than 10, return them. Else calculate hex
                    {
                        if($isNeg){
                            $_SESSION["result"]="-".$resultStr;}
                        else{
                            $_SESSION["result"]=$resultStr;
                        }
                    }
                    else{
                        while($resultStr > 0)                              //While greater than 0, find remainder of division by 16 and continue dividing by 16
                        {
                            if($resultStr < 1)
                            {
                                break;
                            }
                            array_push($divRemain,($resultStr%16));
                            $resultStr=$resultStr/16;
                        }
                        for($i=count($divRemain)-1;$i>=0;$i--)                   //Number in hex is remainders backwards
                        {   
                            $hexFromDec.= $hexValues[$divRemain[$i]];    //Finds correct hex representation based on remainder
                        }
                    }
                    if($isNeg)
                    {
                        $_SESSION["result"]="-".$hexFromDec;
                        $strResult="In Hex: ".$_SESSION["result"];
                        $isNeg=FALSE;
                    }
                    else{
                        $strResult="In Hex: ".$_SESSION["result"];
                    }
                    array_push($_SESSION["history_results"],$strResult);
                }
                else{
                    $_SESSION["result"]="Error: Non-decimal number input";
                }
            }
            else if(isset($_POST["convHexToDec"])) 
            {
                $resultStr= $_SESSION["result"];   //Temp val for result, $_SESSION[result][x] was throwing an error
                $isNeg=FALSE;
                if(strval($resultStr[0])=="-")  //Check if negative
                {
                    $isNeg=TRUE;
                    $resultStr=substr($resultStr,1,strlen($resultStr));
                }
                if(preg_match("|[A-Z0-9].*|",$resultStr))
                {
                    array_push($_SESSION["history"], $_SESSION["result"]);
                    if($resultStr<2)                       //If input is 0 or 1, return them. Else calculate binary
                    {
                        if($isNeg){
                            $_SESSION["result"]="-".$resultStr;}
                        else{
                            $_SESSION["result"]=$resultStr;
                        }
                    }
                    else{
                        $decFromHex=0;
                        for($i=0; $i < strlen($resultStr); $i++)
                        {
                            $pow = intval(strlen($resultStr)-1)-$i;        //calculate exponent 2^pow 
                            $decFromHex += strpos($hexValuesStr,$resultStr[$i])*pow(16,$pow);
                        }
                    }
                    if($isNeg)
                    {
                        $_SESSION["result"]=-1*$decFromHex;
                        $strResult="In Decimal: ".$_SESSION["result"];
                        $isNeg=FALSE;
                    }
                    else{
                        $_SESSION["result"]=$decFromHex;
                        $strResult="In Decimal: ".$_SESSION["result"];
                    }
                    array_push($_SESSION["history_results"],$strResult);
                }
                else  //Wrong input
                {
                    $_SESSION["result"]= "Error: Non-hexadecimal input";
                }
                            
            }
            else if(isset($_POST["convHexToBin"]))
            {
                $resultStr= $_SESSION["result"];   //Temp val for result, $_SESSION[result][x] was throwing an error
                $isNeg=FALSE;
                if(strval($resultStr[0])=="-")  //Check if negative
                {
                    $isNeg=TRUE;
                    $resultStr=substr($resultStr,1,strlen($resultStr));
                }
                if(preg_match("|[A-Z0-9].*|",$resultStr))
                {
                    array_push($_SESSION["history"], $_SESSION["result"]);
                    $binFromHex="";
                    for($i=0; $i < strlen($resultStr); $i++)
                    {
                        $binFromHex .= $hexBinValues[$resultStr[$i]];
                    }
                    if($isNeg)
                    {
                        $_SESSION["result"]="-".$binFromHex;
                        $strResult="In Binary: ".$_SESSION["result"];
                        $isNeg=FALSE;
                    }
                    else{
                        $_SESSION["result"]=$binFromHex;
                        $strResult="In Binary: ".$_SESSION["result"];
                    }
                    array_push($_SESSION["history_results"], $strResult);
                }
                else  //Wrong input
                {
                    $_SESSION["result"]= "Error: Non-hexadecimal input";
                }
            }

            
            // If button pressed is "="
            if(isset($_POST["="])) {
                if(preg_match("|[0-1]|",$_SESSION["result"])  || preg_match("|[A-Z].*|",$_SESSION["result"]))
                {
                    $_SESSION["result"]= "Error: Non-base-10 input";
                }
                else{
                // Store current result value to history
                array_push($_SESSION["history"], $_SESSION["result"]);

                $array = str_split($_SESSION["result"]);

                // Find proper calculation
                for($i = 0; $i < count($array); $i++) {
                    if($array[$i] == "+") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        if($second_half != null) {
                            $_SESSION["result"] = $first_half + $second_half;
                        } else {
                            $_SESSION["result"] = "Error: no second value";
                        }

                        break;
                    } else if($array[$i] == "-" && $array[0] != "-") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        if(is_numeric($second_half)) {
                            $_SESSION["result"] = $first_half - $second_half;
                        } else {
                            $_SESSION["result"] = "Error: no second value";
                        }
                    } else if($i != 0 && $array[$i] == "-" && $array[0] == "-" && is_numeric($array[$i - 1])) {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        if(is_numeric($second_half)) {
                            $_SESSION["result"] = $first_half - $second_half;
                        } else {
                            $_SESSION["result"] = "Error: no second value";
                        }
                    } else if($array[$i] == "*") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        if(is_numeric($second_half)) {
                            $_SESSION["result"] = $first_half * $second_half;
                        } else {
                            $_SESSION["result"] = "Error: no second value";
                        }

                        break;
                    } else if($array[$i] == "/") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        if($second_half == 0) {
                            $_SESSION["result"] = "Error: divide by 0";
                        } else if(!is_numeric($second_half)) {
                            $_SESSION["result"] = "Error: no second value";
                        } else {
                            $_SESSION["result"] = $first_half / $second_half;
                        }

                        break;
                    } else if($array[$i] == "^") {
                        $first_half = substr($_SESSION["result"], 0, $i);
                        $second_half = substr($_SESSION["result"], $i + 1, strlen($_SESSION["result"]));
                        if(is_numeric($second_half)) {
                            $_SESSION["result"] = pow($first_half, $second_half);
                        } else {
                            $_SESSION["result"] = "Error: no second value";
                        }
                    } else if(str_contains($_SESSION["result"], "sin")) {
                        $val = intval(substr($_SESSION["result"], 4));
                        if(is_numeric($val)) {
                            $_SESSION["result"] = sin($val);
                        } else {
                            $_SESSION["result"] = "Error: no value input";
                        }
                    } else if(str_contains($_SESSION["result"], "cos")) {
                        $val = intval(substr($_SESSION["result"], 4));
                        if(is_numeric($val)) {
                            $_SESSION["result"] = cos($val);
                        } else {
                            $_SESSION["result"] = "Error: no value input";
                        }
                    } else if(str_contains($_SESSION["result"], "tan")) {
                        $val = intval(substr($_SESSION["result"], 4));
                        if(is_numeric($val)) {
                            $_SESSION["result"] = tan($val);
                        } else {
                            $_SESSION["result"] = "Error: no value input";
                        }
                    } else if(str_contains($_SESSION["result"], "sqrt")) {
                        $val = intval(substr($_SESSION["result"], 5));
                        if(is_numeric($val)) {
                            if($val >= 0) {
                                $_SESSION["result"] = sqrt($val);
                            } else {
                                $_SESSION["result"] = "Error: cannot find sqrt of negative";
                            }
                        } else {
                            $_SESSION["result"] = "Error: no value input";
                        }
                    }
                }

                // After math is complete, push result into history results
                array_push($_SESSION["history_results"], $_SESSION["result"]);
            }
            }
        ?>

        <center>
            <!-- Each time any button is pressed, the form is submitted with the value 
            of the given button being reloaded into this page as it refreshes -->
            <form action="calculator.php" method="post">
                <table style = "height:100%">
                    <tr>
                        <td colspan="7" class="label">
                            <?php
                                echo $_SESSION["result"];
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td><button type="submit" name="dec" id="dec">.</button></td>
                        <td><button type="submit" name="7" id="7">7</button></td>
                        <td><button type="submit" name="8" id="8">8</button></td>
                        <td><button type="submit" name="9" id="9">9</button></td>
                        <td><button type="submit" name="sin" id="sin">sin</button></td>
                        <td><button type="submit" name="*" id="*">*</button></td>
                        <td><button type="submit" name="A" id="A">A</button></td>
                    </tr>
                    
                    <tr>
                        <td><button type="submit" name="sqrt" id="sqrt">sqrt</button></td>
                        <td><button type="submit" name="4" id="4">4</button></td>
                        <td><button type="submit" name="5" id="5">5</button></td>
                        <td><button type="submit" name="6" id="6">6</button></td>
                        <td><button type="submit" name="cos" id="cos">cos</button></td>
                        <td><button type="submit" name="-" id="-">-</button></td>
                        <td><button type="submit" name="B" id="B">B</button></td>
                    </tr>

                    <tr>
                        <td><button type="submit" name="^" id="^">^</button></td>
                        <td><button type="submit" name="1" id="1">1</button></td>
                        <td><button type="submit" name="2" id="2">2</button></td>
                        <td><button type="submit" name="3" id="3">3</button></td>
                        <td><button type="submit" name="tan" id="tan">tan</button></td>
                        <td><button type="submit" name="+" id="+">+</button></td>
                        <td><button type="submit" name="C" id="C">C</button></td>
                    </tr>

                    <tr>
                        <td><button type="submit" name="inverse" id="inverse">1/x</button></td>
                        <td><button type="submit" name="clear" id="clear">Clear</button></td>
                        <td><button type="submit" name="0" id="0">0</button></td>
                        <td><button type="submit" name="back" id="back"><-</button></td>
                        <td><button type="submit" name="=" id="=">=</button></td>
                        <td><button type="submit" name="/" id="/">/</button></td>
                        <td><button type="submit" name="D" id="D">D</button></td>
                        
                        
                    </tr>

                    <tr>
                        <td colspan="2"><button style="width:100%" type="submit" name="convDecToBin" id="convDecToBin">Convert Decimal To Binary</button></td>
                        <td colspan="2"><button style="width:100%" type="submit" name="convBinToDec" id="convBinToDec">Convert Binary To Decimal</button></td>
                        <td colspan="2"><button style="width:100%" type="submit" name="convBinToHex" id="convBinToHex">Convert Binary To Hexadecimal</button></td>
                        <td><button type="submit" name="E" id="E">E</button></td>
                    </tr>

                    <tr>
                        <td colspan="2"><button style="width:100%;" type="submit" name="convHexToBin" id="convHexToBin">Convert Hexadecimal To Binary</button></td>
                        <td colspan="2"><button style="width:100%;" type="submit" name="convHexToDec" id="convHexToDec">Convert Hexadecimal To Decimal</button></td>
                        <td colspan="2"><button style="width:100%;" type="submit" name="convDecToHex" id="convDecToHex">Convert Decimal To Hexadecimal</button></td>
                        <td><button type="submit" name="F" id="F">F</button></td>
                    </tr>

                    <tr>
                        <td colspan="6" class="label"><button style="width:100%"><a href="history.php" target="_blank">history</a></button></td>
                        <td><button type="submit" name="neg" id="neg">+/-</button></td>
                    </tr>

                    <tr>
                        <td colspan="2"><button type="button" style="width:100%" onclick="changeBGcolor()">BG Color <input type="color" value="#F5F5DC" id='BGcolor'></button></td>
                        <td colspan="3"><button type="button" style="width:100%" onclick="changeBTNcolor()">Button Color <input type="color" value="#bfbfbf" id='BTNcolor'></button></td>
                        <td colspan="2"><button type="button" style="width:100%" onclick="changeTXTcolor()">Text Color <input type="color" value="#000000" id='TXTcolor'></button></td>
                    </tr>
                </table>
            </form>
        </center>
    </body>
</html>