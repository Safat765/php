<?php
    # keywords, classes, functions, and user-defined functions are not case-sensitive.
    # all variable names are case-sensitive!

    echo "<h1>Hello World </h1><br>";

    Echo "hi <br>"; # echo and Echo are the same thing

    // single line comment

    # single line comment

    /* multi line
    comments use to ignore parts of a code line*/

    $x = 5 /* + 10 */ + 5;
    echo "The sum is $x here <br>";

    $num1 = 10;
    $num2 = 20;
    echo "The sum of num1 and num2 is $num1 + $num2 <br>";
    $result = $num1 + $num2;
    echo "The sum of num1 and num2 is $result <br>";
    echo "<br>";
    echo "<br>";

    $float = 49.8;
    $char = "abc";
    $name = "Abcdef";
    
    // ver_dump use to see the data Type and also show the length of the string
    echo "<h2>ver_dump :<br> </h2>";

    var_dump($result);
    echo "<br>";
    var_dump($float);
    echo "<br>";
    var_dump($char);
    echo "<br>";
    var_dump($name);
    echo "<br>";
    var_dump("John");
    echo "<br>";
    var_dump(3.14);
    echo "<br>";
    var_dump(true);
    echo "<br>";
    var_dump([2, 3, 56]);
    echo "<br>";
    var_dump(NULL);
    echo "<br>";
    echo "<br>";

    // Assign Multiple Values    
    echo "<h2>Assign Multiple Values :<br> </h2>";

    $x = $y = $z = "Dog";
    echo "$x <br> $y <br> $z";


    /* PHP has three different variable scopes
        1. Local
        2. Global
        3. Static
    */
    // 1. Local
    echo "<h2>Local variable :<br> </h2>";
    function LocalVariable(){
        $number = 5;
        echo "<p>Local variable number is showing $number</p> <br>";
    }
    echo "<p>Local variable number is calling outside of the function showing $number</p> <br>";
    LocalVariable();

    // 2. Global    
    echo "<h2>Global variable :<br> </h2>";
    $number1 = 10;
    function GlobalVariable(){
        echo "<p>Global variable number is showing inside function $number1</p> <br>";
    }
    GlobalVariable();
    echo "<p>Global variable number is showing Outside function $number1</p> <br>";

    // 3. Static
    echo "<h2>Static variable :<br> </h2>";
    function StaticVariable(){
        static $number2 = 0;
        echo " $number2 <br>";
        $number2++;
    }
    StaticVariable();
    StaticVariable();
    StaticVariable();
    StaticVariable();
    echo "<br>";
    echo "<br>";

    // Global Keyword    
    echo "<h2>Global Keyword :<br> </h2>";
    $x = 10;
    $y = 20;
    echo "y = $y <br>";
    function sum(){
        global $x, $y;
        $y = $x + $y;
    }
    echo "y = $y <br>";
    sum();
    echo "y = $y <br>"; // After call sum function the global variable works
    echo "<br>";

    // PHP stores all global variables in an array called $GLOBALS[index]
    echo "<h2>Global variables in an array call :<br> </h2>";
    $x1 = 10;
    $y1 = 20;
    echo "y1 = $y1 <br>";
    function GlobalArray(){
        $GLOBALS['y1'] = $GLOBALS['x1'] + $GLOBALS['y1'];
    }
    echo "y1 = $y1 <br>";
    GlobalArray();
    echo "y1 = $y1 <br>";


    // echo and print
    echo "<h2>echo and print :<br> </h2>";
    /*
    The differences are small between echo and print
    echo has no return value while print has a return value of 1 so it can be used in expressions
    echo can take multiple parameters while print can take one argument
    echo is marginally faster than print
    */

    // double quotes, variables can be inserted to the string
    // Double quoted string literals perform operations for special characters
    echo "<h3>Double quotes :<br> </h3>";
    $txt1 = "double quotes";
    echo "<p>$txt1</p>";

    $x = "John";
    echo "Hello $x";

    // single quotes, variables have to be inserted using the . operator
    // Single quoted strings does not perform such actions, it returns the string like it was written
    echo "<h3>Single quotes :<br> </h3>";
    $txt2 = "single quotes";
    echo "<p>$txt2</p>";
    
    $x = "John";
    echo 'Hello $x';

    // PHP object
    echo "<h2>PHP object :<br> </h2>";

    class car{
        public $model;
        public $color;
        public function __construct($color, $model){
            $this->color = $color;
            $this->model = $model;
        }
        public function massage(){
            return "My car is a . $this->color . "and" . $this->model.";
        }
    }
    $myCar = new car("red", "volvo");
    var_dump($myCar);
    echo "<br>";
    echo "<br>";

    // Change Data Type
    echo "<h2>Change Data Type :<br> </h2>";
    $x = 5;
    var_dump($x);
    echo "<br>";
    $x = (string) $x;
    var_dump($x);

     
    echo "<h2>String :<br> </h2>";

    echo strlen("Hello world!"); // string length
    echo "<br>";
    echo str_word_count("Hello World"); // word count
    echo "<br>";
    echo strpos("Hello World", "o"); // find alphabet or word and return the index of the searching word or aplabet's 1st index value
    echo "<br>";
    
    $x = "Hello World";
    echo strtoupper($x); // Upper case convert
    echo "<br>";
    echo strtolower($x); // Lower Case convert
    echo "<br>";
    echo str_replace("World", "abc", $x); // replace word
    echo "<br>";
    echo strrev($x); // reverse string
    echo "<br>";
    echo trim($x); // remove white space (before or after) main text 
    echo "<br>";

    $y = explode(" ", $x);
    print_r($y); // string to array convert

    echo "<br>";
    var_dump($y);
    
    echo "<br>";
    // string Concatanation
    $a = "Hello";
    $b = "World";
    $c = $a . $b;
    echo $c; 
    echo "<br>";

    $c = $a . " " . $b;
    echo $c;

    echo "<br>";
    $d = "$a $b";
    echo $d;
    
    echo "<br>";
    $a = 5;
    $b = 10;
    $c = "$a . $b";
    echo $c;    
    echo "<br>";
    $c = "$a$b";
    echo $c;
    echo "<br>";
    // slicing string
    echo "<h3>Slicing String :<br> </h3>";
    echo substr($x, 6, 2);
    echo "<br>";
    echo substr($x, 6);    
    echo "<br>";
    echo substr($x, -5, 3);    
    echo "<br>";
    echo substr($x, -5, -3);      
    echo "<br>";    
    echo substr($x, 5, -3);   
    echo "<br>";

    // Escape Character
    echo "<h3>Escape Character :<br> </h3>";
    $x = "Hello how \"are\" you";
    echo $x;

    
    /*
    There are three main numeric types in PHP
        1. Integer
        2. Float
        3. Number String
    PHP has two more data types used for numbers
        1. Infinity
        2. NaN
    */    
    echo "<h2>PHP Numbers :<br> </h2>";

    $x = 10;
    var_dump(is_int($x));
    echo "<br>";
    $x = 10.3;
    var_dump(is_int($x));
    echo "<br>";
    var_dump(is_float($x));
    echo "<br>";

    // Cast float to int
    $x = 23465.768;
    $intCast = (int)$x;
    echo $intCast;

    echo "<br>";

    // Cast string to int
    $x = "23465.768";
    $intCast = (int)$x;
    echo $intCast;

    // PHP Math
    echo "<h2>PHP Math :<br> </h2>";
    
    echo "The value of pi is ". pi(); // pi value
    echo "<br>";
    echo(min(0, 150, 30, 20, -8, -200)); // min value
    echo "<br>";
    echo(max(0, 150, 30, 20, -8, -200)); // max value
    echo "<br>";
    echo abs(-8.9); // abstract value
    echo "<br>";
    echo (sqrt(64)); // Square root
    echo "<br>";
    echo round(0.60); // round above .5
    echo "<br>";
    echo round(0.49); // round bellow .5
    echo "<br>";
    echo rand();
    echo "<br>";
    echo rand(1, 10);
    echo "<br>";
    

    // PHP Constants
    echo "<h2>PHP Constants: </h2><br>";
    /*
        const cannot be created inside another block scope
        define can be created inside another block scope.
     */
    define("Greeting", "Welcome to ABC");
    echo Greeting; 
    echo "<br>";
    const MYCAR = "Volvo";
    echo MYCAR;    
    echo "<br>";

    // create an Array constant using the define()
    define("cars",[
        "Toyota",
        "BMW",
        "Volvo"
    ]);
    echo cars[0];    
    echo "<br>";

    // IF Else elseif
    echo "<h2>if else elseif: </h2><br>";

    $x = "Hello World";
    $y = "Hello";

    if ($x === $y){
        echo 'x and y are identical';
    }
    else{
        echo 'x and y are not identical';
    }
    
    echo "<br>";

    // Short Hand if
    echo "<h3>Short Hand if : </h3><br>";
    $a = 10;

    if ($a > 5) $b = "Hello";
    echo $b;
    echo "<br>";

    // Short Hand if else
    echo "<h3>Short Hand if else: </h3><br>";
    
    $a = 10;
    $b = $a < 15 ? "Hello" : "Good Bye";
    echo "$b <br>";
    $b = $a > 10 ? "Hello" : "Good Bye";
    echo "$b <br>";

    // nasted if
    $a = 10;
    
    if ($a > 8){
        echo "a is gretter then 8 ";
        if ($a < 20){
            echo "and a is less then 20 <br>";
        }
        else{
            echo "and a is gretter then 20 <br>";
        }
    }
    else{
        echo "a is less then 8 <br>";
    }

    echo "<br>";

    
    // PHP switch Statement
    echo "<h2>PHP switch Statement: </h2><br>";

    $day = "abc";

    switch ($day){
        case "Sunday":
            echo "The day is Sunday <br>";
        break;
        case "Monday":
            echo "The day is Monday <br>";
        break;
        case "Tuesday":
            echo "The day is Tuesday <br>";
        break;
        case "Wednesday":
            echo "The day is Wednesday <br>";
        break;
        case "Thursday":
            echo "The day is Thuesday <br>";
        break;
        case "Friday":
            echo "The day is Fiday <br>";
        break;
        case "Saturday":
            echo "The day is Saturday <br>";
        break;
        default:
            echo "The day is not exist <br>";
    }
    
    echo "<br>";
    // Common Code Blocks in switch
    echo "<h2>Common Code Blocks in switch: </h2><br>";

    $day = 9;

    switch ($day){
        case 1:
        case 2:
        case 3:
        case 4:
            echo "The day is good";
        break;
        case 5:
            echo "It feels good";
        break;
        default:
            echo "Something going wrong";
    }        
    
    echo "<br>";
    // while loop
    echo "<h2>While Loop: </h2><br>";

    $i = 1;
    while ($i < 6){
        echo "$i ";
        $i++;
    }    
    echo "<br>";

    $i = 0;
    while ($i < 6){
        if ($i == 4) break;
        echo "$i ";
        $i++;
    }
    echo "<br>";
    
    $i = 0;
    while ($i < 6){
        $i++;
        if ($i == 4) continue;
        echo "$i ";
    }   
    echo "<br>";

    
    $i = 0;
    while ($i < 6):
        echo "$i ";
        $i++;
    endwhile;
    
    echo "<br>";

    // do while Loop    
    echo "<h2>Do While Loop: </h2><br>";
    $i = 1;

    do {
        if ($i == 3) break;
        echo "$i ";
        $i++;
    }
    while ($i < 10);
    echo "<br>";
    
    $i = 0;
    do{
        $i++;
        if ($i == 3) continue;
        echo "$i ";
    }
    while ($i < 10);
    echo "<br>";
    
    echo "<br>";
    
    echo "<br>";
    
    echo "<br>";
    
    echo "<br>";
    
    echo "<br>";
?>