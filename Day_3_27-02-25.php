<?php
    declare (strict_types = 1); // for this unwanted type conversion will not be happend
    //Call by Reference
    echo "<h3>Call by Reference : </h3> \n";

    /*  $var1 is an alias or reference of $var, 
        it means any change in its value will also change the value of $var, 
        and vice versa
    */

    $var = "Hello";
    $var1 = &$var;

    $var1 = "Hello World";
    echo "var=$var var1=$var1 <br>";

    $var = "How are you?";
    echo "var=$var var1=$var1 <br>";
    echo "<br>";

    function Change_name(&$nm){
        echo "Initially the name is $nm <br>";
        $nm = "$nm". "_new";
        echo "The function change the name $nm <br>";
    }
    $name = "Abc";
    echo "My namne is $name <br>";
    Change_name($name);
    echo "Now my name is $name <br>";
    echo "<br>";
    
    // returning multiple value using array
    echo "<h3>Returning multiple value using array : </h3> \n";
    function raiseto($x){
        $sqr = $x**2;
        $cub = $x**3;

        $ret = ["squ" => $sqr, "cunb" => $cub];
        return $ret;
    }
    $a = 5;
    $value = raiseto($a);
    echo "Square of $a is : ". $value['squ']. "<br>";
    echo "Cube of $a is : ". $value['cunb']. "<br>";

    // Array_map
    echo "<h3>Returning multiple value using array : </h3> \n";
    function Square($num){
        return $num * $num;
    }
    $arr = [1, 2, 3, 4, 5];
    $square = array_map('square', $arr);
    foreach ($square as $a){
        echo "$a ";
    }
    echo "<br>";
    echo "<br>";

    // Call_User_Func
    echo "<h3>Call_User_Func : </h3> \n";
    function square1($number1){
        return $number1 * $number1;
    }
    $arr = [1, 2, 3, 4, 5];
    foreach ($arr as $a){
        echo "Square of $a : ". call_user_func('square1', $a). "<br>";
    }

    // Passing function
    echo "<h3>Pass Callback to User-defined Function : </h3> <br>";
    function myfunction($function, $number){
        $number = $function($number);
        return $number;
    }
    function squa($number){
        return $number ** 2;
    }
    function cube($number){
        return $number ** 3;
    }
    $x = 5;
    $square = myfunction('cube', $x);
    $cube = myfunction('cube', $x);

    echo "Square of $x = $square <br>";
    echo "Cube of $x = $cube <br>";
    echo "<br>";

    // Recursive Functions
    
    function factorial($n){
        if ($n == 1){
            echo $n. "<br>";
            return 1;
        }
        else{
            echo "$n * ";
            return $n * factorial($n-1);
        }
    }
    echo "Factorial of 5 = " . factorial(5) . "<br>";


    echo "<br>";
    // use strict_type at the top to avoid unwanted type conversion
    function addition(int $x, int $y) {
        echo "First number: $x Second number: $y Addition: " . $x+$y;
    }
    $x=10;
    $y=20;
    addition($x, $y);
    echo "<br>";
    // Union Types
    echo "<h3>Union Types : </h3>";
    function addition2(int|float $x, int|float $y){
       echo "First number: $x Second number: $y Addition: " . $x+$y;
    }
    $x = 10.2;
    $y = 10;
    addition2($x, $y);
    echo "<br>";
    // Type-hinting in Class
    echo "<h3>Type-hinting in Class : </h3>";

    class Student{
        public string $name;
        public int $age;

        public function __construct($name, $age){
            $this->name = $name;
            $this->age = $age;
        }
        public function displayStudent(){
            echo "Name : $this->name <br> Age : $this->age <br>";
        }
    }
    $s1 = new student("Abc", 10);
    $s1 -> displayStudent();
    echo "<br>";

    // Anonymous Function
    echo "<h3>Anonymous Function : </h3>";
    $add = function ($a, $b){
        return "a => $a and b => $b addition => ". $a + $b;
    };
    echo $add(2, 3);
    echo "<br>";
    echo "<br>";
    
    //Anonymous Function as a Callback
    echo "<h3>Anonymous Function as a Callback</h3>";

    $arr = [1, 2, 4, 5];
    array_walk($arr, function($n){
        $s = 0;
        for ($i = 0; $i <= $n; $i++){
            $s += $i;
        }
        echo "Number : $n Sum is $s <br>";
    });
    echo "<br>";

    //Anonymous Function as Closure
    echo "<h3>Anonymous Function as Closure</h3>";

    $maxMark = 300;
    $percent = function($mark) use ($maxMark){
        return $mark*100/$maxMark;
    };
    $m = 250;
    echo "Marks = $m Percentage = " . $percent($m). "%";
    echo "<br>";

    //Arrow Function
    echo "<h3>Arrow Function</h3>";

    $add = fn ($a, $b) => $a + $b;

    $x = 10;
    $b = 20;
    echo "x -> $x y -> $y Addition -> ". $add($x, $b);
    echo "<br>";

    $maxMark = 300;
    $percent1 = fn ($mark) => $mark*100/$maxMark;
    $m = 250;
    echo "Marks = $m Percentage = " . $percent1($m);

    echo "<br>";
    echo "<br>";

    // OOP
    echo "<h2>OOP</h2>";

    // Class is a bluprint for creating object
    // Object is an instance of a class
    /*
        Use constructors to initialize object properties.
        Use destructors to free up resources or perform cleanup tasks.
    */

    class Abc{
        public $name;
        public function __construct($name){
            $this->name = $name;
        }
        public function AbcDisplay(){
            echo "Welcome {$this->name} <br>";
        }
        public function __destruct(){
            echo "The name {$this->name} is being destroyed <br>";
        }
    }
    $aaa = new Abc("XYZ");
    $aaa -> AbcDisplay();
    unset($aaa);
    echo "<br>";

    //PHP Access Modifiers
    /*
        Public: Accessible from anywhere.
        Protected: Accessible within the class and its subclasses.
        Private: Accessible only within the class itself.
    */
    echo "<h3>PHP Access Modifiers</h3>";
    // Public

    class ExamplePublic{
        public $name = "John";
        public function greetings(){
            return "Hello {$this -> name} calling name from public<br>";
        }
    }
    $publicObject = new ExamplePublic();
    echo $publicObject -> greetings();
    echo "<br>";
    echo "<br>";

    // Protected
    class ProtectedParentClass{
        protected $age = 30;
        protected function greetings(){
            return "Hello calling name from Parent Classe <br>";
        }
    }
    class ProtecedChildClass extends ProtectedParentClass{
        public function showAge(){
            return $this -> age;
        }
        public function callingGreetings(){
            return $this->greetings();
        }
    }
    $child = new ProtecedChildClass();
    echo $child -> showAge();
    echo "<br>";
    echo $child -> callingGreetings();
    echo "<br>";
    echo "<br>";

    // Inharitace
    class myClass{
        public function hello(){
            echo "Hello from the parent class <br>";
        }
        public function thanks(){
            echo "Thanks from the parent class <br>";
        }
    }
    class newclass extends myclass {
       public function Thanks() {
          echo "Thank you from the child class <br>";
       }
    }

    $parent = new myClass;
    $parent->hello();
    $parent->thanks();

    echo "<br>";

    $child = new newclass;
    $child->hello();
    $child->thanks();
    $child->Thanks();
    echo "<br>";
    echo "<br>";

    // PHP – Class Constants
    /*
        constants define as const keyword
        Once defined, a class constant cannot be changed or undefined.
        Class constants are accessed using the scope resolution operator ::
    */
    echo "<h3>Class Constants</h3>";

    const x = 22;
    const y = 7;

    class square{
        const PI = x/y;
        var $sides = 5;
        function area(){
            $area = $this->sides**2*self::PI;
            return $area;
        }
    }
    $s1 = new square;
    echo "PI = " . square::PI . "<br>";
    echo "area = " . $s1->area() . "<br>";
    echo "<br>";

    // Abstract Classes
    echo "<h3>Abstract Classes</h3>";
    // Abstract means something incomplete
    // abstract class serves as a blueprint for other classes
    /*
        It can contain both
            1. Abstract Method
                -> Methods without a body
                -> cannot declare an object of this abstract class
                -> Abstract class can hold properties, abstract method
                -> Abstract method has no body defination
                -> The class members may be of public, private or protected type
                -> If any method in a class is abstract, the class itself must be an abstract class
                -> If a class inharit an abstract class then the  clild class must have to implement the abstract method
            2. Concrete Method  
                -> Normal Methods/Functions
    */

    abstract class Animal{
        // abstract method
        abstract public function makeSound();

        // Concrete Method
        public function sleep(){
            echo "Sleeping....<br>";
        }
    }
    class Dog extends Animal{
        public function makeSound(){
            echo "Bark...! <br>";
        }
    }
    $dog = new Dog;
    $dog -> makeSound();
    $dog -> sleep();
    echo "<br>";
    echo "<br>";
    
    /* Interfaces
        -> interface do not have any body
        -> no functionality is defined in the interface
        -> A concrete class has to implement the methods in the interface
        -> when a class implements an interface, it must provide the functionality for all methods in the interface
        -> The keyword "interface" is used in place of class
        -> All the methods declared in the interface must be defined, with the same number and type of arguments and return value
        -> The keyword for childe class is implements
    */
    echo "<h3>Interfaces : </h3>";

    interface AnimalInterface{
        public function makeSound();
        public function sleep();
    }

    class DogInterface implements AnimalInterface{
        public function makeSound(){
            return "Bark..!";
        }
        public function sleep(){
            return "Sleep......!";
        }
    }

    $Dog1 = new DogInterface;
    echo $Dog1->makeSound();
    echo "<br>";
    echo $Dog1->sleep();
    echo "<br>";
    echo "<br>";

    // PHP does support having a child class that extends one parent class, and implementing one or more interfaces

    class marks{
        protected int $num1, $num2;

        public function __construct($num1, $num2){
            $this->num1 = $num1;
            $this->num2 = $num2;
        }
    }
    interface percent{
        public function percent();
    }
    class student1 extends marks implements percent{
        public function percent(){
            return (($this->num1+$this->num2)*100)/200;
        }
    }
    $s1 = new student1(80, 90);
    echo "Percentage of marks : " . $s1->percent();
    echo "<br>";
    echo "<br>";

    // PHP Traits
    // method override possible
    // we can use multiple traits in a class.
    // Sometimes, more two traits might have same name of the function then we use "insteadof" keyword
    echo "<h3>php Trait</h3>";
    trait addition{
        function add($x, $y){
            return $x+$y;
        }
    }
    trait multiplication{
        function multiply($x, $y){
            return $x*$y;
        }
    }

    class numbers{
        use addition, multiplication;
        private int $n1, $n2;
        function __construct($n1, $n2){
            $this->n1 = $n1;
            $this->n2 = $n2;
        }
        function calculate(){
            $arr = [$this->add($this->n1, $this->n2), $this->multiply($this->n1, $this->n2)];
            return $arr;
        }
    }

    $numObj = new numbers(10, 20);
    $result = $numObj->calculate();
    echo "Addition : {$result[0]} <br>";
    echo "Multiplicatio : {$result[1]} <br>";
    echo "<br>";
    echo "<br>";


    // Overriding Trait Function
    echo "<h3>Overriding Trait Function</h3>";

    trait mytrait {
        public function sayHello() {
           echo 'Hello World!';
        }
        public function sayHi() {
           echo 'Hi World!';
        }
     }
  
     class myclass1 {
        use mytrait;
        public function sayHello() {
           echo 'Hello PHP!';
        }
     }
  
     $o = new myclass1();
     $o->sayHello();
     echo "<br>";
     $o->sayHi();
    echo "<br>";
    echo "<br>";

    // Insteadof Keyword
    echo "<h3>Trait Function Insteadof Keyword</h3>";

    trait mytrait1{
        public function sayHello(){
            echo "Hello php <br>";
        }
    }
    trait mytrait2{
        public function sayHello(){
            echo "Hello World <br>";
        }
    }

    class myClassTrait{
        use mytrait1, mytrait2{
            mytrait2::sayHello insteadof mytrait1;
        }
    }
    $o = new myClassTrait();
    $o->sayHello();
    echo "<br>";
    echo "<br>";

    // Aliasing a Trait Function    
    echo "<h3>Aliasing a Trait Function</h3>";

    trait oldTrait {
        public function sayHello() {
           echo 'Hello World! <br>';
        }
    }
  
    trait newtrait {
        public function sayHello() {
           echo 'Hello PHP! <br>';
        }
    }
  
    class myTraits {
        use oldTrait, newtrait{
            oldTrait::sayHello as Hello;
            newtrait::sayHello insteadof oldTrait;
        }
    }
  
     $o = new myTraits();
     $o->Hello();
     $o->sayHello();
    echo "<br>";
    echo "<br>";
