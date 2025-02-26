<?php 
    echo "<h1>Date: 26-02-25</h2><br>";
    
    echo "<br>";

    // While Loop
    echo "<h2>While loop :    </h2><br>";
    // using continue
    $i = 0;
    while ($i < 10){
        $i++;
        if ($i == 4) continue;
        echo "$i ";
    }
    echo "<br>";
    // using break
    $i = 0;
    while ($i < 10){
        if ($i == 4) break;
        echo "$i ";
        $i++;
    }
    
    echo "<br>";
    // Do While Loop
    echo "<h2>Do While loop :    </h2><br>";
    $i = 0;
    do{
        $i++;
        if ($i == 1) continue;
        echo "$i ";

    }
    while ($i < 10);
    echo "<br>";

    // For Loop
    echo "<h2>For loop :    </h2><br>";
    // using break
    for ($i = 0; $i <= 10; $i++){
        if ($i == 3) break;
        echo "$i ";
    }    
    echo "<br>";

    // increament by 10
    for ($i = 10; $i <= 100; $i += 10){
        echo "$i ";
    }    
    echo "<br>";
    
    // Foreach Loop
    echo "<h2>Foreach loop :    </h2><br>";
    $colors = array("red", "green", "blue");
    foreach ($colors as $i){
        echo "$i ";
    }
    echo "<br>";

    // Keys and Values    
    echo "<h3>Keys and Values in foreach loop :    </h3><br>";
    $number = array("ab"=>"10", "bc"=>"20", "cd"=>"30");
    foreach ($number as $x => $y){
        echo "$x : $y <br>";
    }
    echo "<br>";

    // foreach Loop on Objects
    echo "<h3>foreach Loop on Objects :    </h3><br>";
    class Car{
        public $color;
        public $model;
        public function __construct($color, $model){
            $this->color = $color;
            $this->model = $model;
        }
    }
    $myCar = new Car("Red", "BMW");
    foreach ($myCar as $x => $y){
        echo "$x : $y <br>";
    }
    echo "<br>";

    // Foreach Byref
    echo "<h3>Foreach Byref :    </h3><br>";
    $colors = array("red", "green", "blue", "yellow");
    foreach($colors as $x){
        if ($x == "blue") $x = "Pink";
        echo "$x ";
    }
    echo "<br>";
    var_dump($colors);
    echo "<br>";
    
    // Alternative Syntax
    echo "<h3>foreach Loop on Objects :    </h3><br>";
    
    $colors = array("red", "green", "blue", "yellow");
    foreach ($colors as $x):
        echo "$x , ";
    endforeach;    
    echo "<br>";

    // PHP Functions
    echo "<h2>PHP Functions : </h2><br>";
    function myMessage(){
        echo "Hello World!";
    }
    myMessage();    
    echo "<br>";

    // PHP Function Arguments
    echo "<h3>PHP Function Arguments</h3><br>";
    function welcome($name){
        echo "Welcome $name!";
    }
    welcome("Abc");
    echo "<br>";
    welcome("Bcd");    
    echo "<br>";
    
    function Greetings($name, $location){
        echo "Welcome $name at $location";
    }
    Greetings("Abc", "Mymensingh");    
    echo "<br>";

    // PHP Default Argument Value
    echo "<h3> PHP Default Argument Value : </h3>";
    function setHight($minHight = 160){
        echo " The hight is : $minHight cm";
    }
    setHight(170);    
    echo "<br>";
    setHight(); // default value call in the function
    echo "<br>";
    setHight(190);    
    echo "<br>";

    // Returning values
    echo "<h3> Returning values : </h3>";
    function sum($x, $y){
        $z = $x + $y;
        return $z;
    }
    echo "sum of 5 and 10 is ". sum(5, 10) .".<br>"; 
    echo "<br>";

    //Passing Arguments by Reference
    // here we use & this special carecter in the peramiter
    echo "<h3>Passing Arguments by Reference : <h3>";
    function add_five(&$value){
        $value += 5;
    }
    $num = 2;
    add_five($num);
    echo $num;    
    echo "<br>";
    
    // Variable Number of Arguments
    /*
        By using this ... operator in front of the function parameter,
        the function accepts an unknown number of arguments.
        This is also called a variadic function.
    */
    // The variadic function argument becomes an array.
    // You can only have one argument with variable length, and it has to be the last argument.
    // The variadic argument must be the last argument
    echo "<h3>Variable Number of Arguments : </h3>";
    
    function sumNumbers(...$x){
        $sum = 0;
        $len = count($x);
        for ($i = 0; $i < $len; $i++){
            $sum += $x[$i];
        }
        return $sum;
    }
    $a = sumNumbers(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    echo "Sum of 1 to 10 is $a";
    echo "<br>";

    // multiple perameters with a varidadic argument
    function myFamily($lastName, ...$firstName){
        $text = "";
        $lenth = count($firstName);
        for ($i = 0; $i < $lenth; $i++){
            $text = $text. "Hi, $firstName[$i] $lastName. <br>";
        }
        return $text;
    }
    $names = myFamily("A", "AB", "BC", "CD");
    echo $names;    
    echo "<br>";

    //PHP is a Loosely Typed Language
    // without using strict
    /*
    Without strict_types=1, PHP automatically converts "2" to 2 (loose typing).
    With strict_types=1, passing "2" (a string) instead of 2 (an integer) will cause a TypeError called Fatal Error.
    */
    echo "<h3>without using strict : </h3>";
    function addNumber(int $a, int $b){
        return $a + $b;
    }
    echo addNumber(5, "5");
    
    echo "<br>";
    
    function addNumbers(float $a, float $b) : float{
        return $a + $b;
    }
    echo addNumbers(1.1, 2.2);    
    echo "<br>";

    /*
    In PHP, there are three types of arrays:
        1. Indexed arrays - Arrays with a numeric index
        2. Associative arrays - Arrays with named keys
        3. Multidimensional arrays - Arrays containing one or more arrays
    */
    echo "<h2>Array : </h2>";
    //Call the function from the array elements
    echo "<h3>Call the function from array elements</h3>";
    function myFunction(){
        echo "Calling this function from the array";
    }
    $myArray = array("BMW", 15, ["apple", "banana"], "myFunction");
    $myArray[3]();    
    echo "<br>";

    // Array push
    echo "<h3>Array push </h3>";
    $cars = array("BMW", "Toyota", "Volvo");
    var_dump($cars);
    echo "<br>";
    echo "<br>";
    array_push($cars, "Ford");
    var_dump($cars);    
    echo "<br>";
    
    //PHP Associative Arrays
    //Associative arrays are arrays that use named keys that you assign to them
    //To access an array item you can refer to the key name
    echo "<h3>PHP Associative Arrays : </h3>";
    
    $cars = array("BMW"=>1, "Toyota"=>2, "Volvo"=>3);
    echo $cars["BMW"] . "<br>";
    foreach ($cars as $x => $y){
        echo "$x : $y <br>";
    }
    echo "<br>";
    echo $cars["BMW"] = 20;
    echo "<br>";
    foreach ($cars as $x => $y){
        echo "$x : $y <br>";
    }    
    echo "<br>";

    // Update Array Items in a Foreach Loop
    echo "<h3>Update Array Items in a Foreach Loop</h3>";
    $cars = ["Volvo", "BMW", "Toyota"];
    echo "<br>";
    foreach ($cars as $x){
        echo "$x ";
    }    
    unset($x);
    echo "<br>";
    foreach ($cars as &$i){
        $i = "Ford";
    }
    unset($i);
    echo "<br>";
    foreach ($cars as $x){
        echo "$x ";
    }   
    unset($x);    
    echo "<br>";

    // Remove Array Element
    // array_shift() function removes the first item of an array
    //array_pop() function removes the last item of an array

    echo "<h3>Remove Array element : </h3>";
    // remove array element using array_splice
    $cars = array("Volvo", "BMW", "Toyota");
    array_splice($cars, 0, 1);
    echo "<br>";
    foreach ($cars as $x){
        echo "$x ";
    }   
    unset($x);    
    echo "<br>";
    // remove array element using unset
    $cars = array("Volvo", "BMW", "Toyota");
    unset($cars[2]);
    echo "<br>";
    foreach ($cars as $x){
        echo "$x ";
    }   
    unset($x);     
    echo "<br>";

    //array_diff() function to remove items from an associative array
    $cars = array("brand" => "Ford", "model" => "Mustang", "year" => 1964);
    $newArray = array_diff($cars, ["Ford"]);
    echo "<br>";
    foreach ($newArray as $x){
        echo "$x ";
    }   
    unset($x);      
    echo "<br>";
    
    //PHP Sorting Arrays
    echo "<h3>PHP Sorting Arrays : </h3>"; 
    // ascending order sorting   
    $cars = array("Volvo", "BMW", "Toyota");
    sort($cars);
    echo "<br>";
    echo "Sorting in the alphabatic order : ";
    foreach ($cars as $x){
        echo " $x";
    }   
    unset($x);    
    echo "<br>";

    $num1 = [1, 0, 2, 3, 9, 4];
    sort($num1);
    echo "<br>";
    foreach ($num1 as $x){
        echo "$x ";
    }   
    unset($x);    
    echo "<br>";

    //descending order sorting
    $cars = array("Volvo", "BMW", "Toyota");
    rsort($cars);
    echo "<br>";
    foreach ($cars as $x){
        echo "$x ";
    }   
    unset($x);     
    echo "<br>";

    // PHP Associative Arrays sorting
    echo "<h3>PHP Associative Arrays Sorting</h3>";
    
    // (Ascending Order), According to Value - asort()
    $age = array("Peter"=>"95", "Ben"=>"37", "Joe"=>"43");
    asort($age);
    echo "<br>";
    foreach ($age as $x => $y){
        echo "key : $x => Value : $y <br>";
    }   
    unset($x, $y);      
    echo "<br>";

    //(Ascending Order), According to Key - ksort()
    $age = array("Peter"=>"95", "Ben"=>"37", "Joe"=>"43");
    ksort($age);
    echo "<br>";
    foreach ($age as $x => $y){
        echo "key : $x => Value : $y <br>";
    }   
    unset($x, $y);      
    echo "<br>";

    // 2 dimensional array
    echo "<h3>two dimensional array : </h3>";

    $cars = array(
        array("volvo", 1, 2),
        array("BMW", 3, 4, 5),
        array("Ford", 10, 15)
    );
    $fullSize = sizeof($cars);
    for ($i = 0; $i < $fullSize; $i++){
        echo "<ul>";
        for ($j = 0; $j < sizeof($cars[$i]); $j++){
            echo "<li>". $cars[$i][$j]. "</li>";
        }
        echo "</ul>";
    }
    
    echo "<br>";

    // 3 dimensional array
    echo "<h3>Three dimensional array : </h3>";

    $cars = array(
        array("volvo", 1, 2, array(1, 2)),
        array("BMW", 3, 4, 5, array(3)),
        array("Ford", 10, 15, array(4,7,8))
    );
    $fullSize = sizeof($cars);
    for ($i = 0; $i < $fullSize; $i++){
        echo "<ul>";
        for ($j = 0; $j < sizeof($cars[$i]); $j++){
            if (is_array($cars[$i][$j])){
                echo "<li><ul>";
                for ($k = 0; $k < sizeof($cars[$i][$j]); $k++){
                    echo "<li>". $cars[$i][$j][$k]. "</li>";
                }
                echo "</ul></li>";
            }
            else{
                echo "<li>" . $cars[$i][$j] . "</li>";
            }
        }
        echo "</ul>";
    }
    
    echo "<br>";    
    echo "<br>";

    //PHP Global Variables
    echo "<h2>PHP Global Variables : </h2>";
    // we can make a variable global by using global keyword
    // or $GLOBALS keyword

    $x = 10;
    
    function my(){
        global $x;
        echo "call by using global keyword : $x <br>";
    }    
    echo 'call by using  $GLOBALS  keyword : '. $GLOBALS['x'] ." <br>";
    my();
    echo "<br>";

    // PHP - $_SERVER
    echo '<h3>PHP - $_SERVER : </h3>';
    
    echo $_SERVER['PHP_SELF'];
    echo "<br>";
    echo $_SERVER['SERVER_NAME'];
    echo "<br>";
    echo $_SERVER['HTTP_HOST'];
    echo "<br>";
    echo $_SERVER['HTTP_REFERER']; // give the full URL where it is opening
    echo "<br>";
    echo $_SERVER['HTTP_USER_AGENT'];
    echo "<br>";
    echo $_SERVER['SCRIPT_NAME'];
    echo "<br>";

    // $_REQUEST is an array containing data from $_GET, $_POST, and $_COOKIE
    // POST request are usually data submitted from an HTML form.
    
    echo '<h3>PHP - $_REQUEST : </h3>';

?>

<!DOCTYPE html>
<html lang="en">
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        First Name: <input type="text" name="fname">
        Last Name : <input type="text" name="lname">
        <input type="submit">
        <br>
        <br>
    </form>
    <a href="?object=php&web=W3School.com">Text $GET</a>
        <br>
        <br>

    
<?php
    $object = htmlspecialchars($_GET['object'] ?? '');
    $web = htmlspecialchars($_GET['web'] ?? '');

    if(!empty($object) && !empty($web)){
        echo "Study $object at $web <br>";
    }
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $firstName = htmlspecialchars($_REQUEST['fname'] ?? '');
        $lastName = htmlspecialchars($_REQUEST['lname'] ?? '');
        if (empty($firstName) && empty($lastName)){
            echo "Both name is empty";
        }
        else{
            echo "Welcome <b>$firstName $lastName</b>!";
        }
    }

    echo "<br>";
    echo '<h3>PHP - $_GET : </h3>';
    
?>
</body>
</html>  

<!DOCTYPE html>
<html lang="en">
<body>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Name : <input type="text" name="abc"><br>
        E-mail : <input type="text" name="email"><br>
        <input type="submit">
    </form>

    <?php
        if (isset($_GET["abc"]) && isset($_GET["email"])){
            $nam1 = htmlspecialchars($_GET["abc"]);
            $email = htmlspecialchars($_GET["email"]);
            
            echo "Welcome ". $nam1 . "<br>";
            echo "Your email address is ". $email . "<br>";
        }
        else{
            echo "Fill up the box";
        }
        //PHP Form
        echo "<h2>PHP Form</h2>";        
        echo "<h3>PHP Form Handling using get</h3>";
    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<body>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Name : <input type="text" name="nam2">
        Address: <input type="text" name="address1">
        <input type="submit">
    </form>
    <?php
        echo "<br>";
        //PHP Form Handling using get        
        if (isset($_GET["nam2"]) && isset($_GET["address1"])){
            $name9 = htmlspecialchars($_GET["nam2"]);
            $add = htmlspecialchars($_GET["address1"]);

            echo "Welcome ". $name9 . "! <br>";        
            echo "Your address is ". $add;
        }
        else{
            echo "Fill up the form 1st";
        }

        echo "<br>";

        echo "<br>";

        echo "<br>";

        echo "<br>";
    ?>
</body>
</html>
