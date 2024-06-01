<html>
    <body>
        <?php echo "Hello world<br>";
        $a = 10;
        $b = 20;
        $sum = $a + $b;
        echo $sum; echo "<br>";
        for($i=0;$i<2;$i++){
            echo "$i<br>";
        }
        $arr=array(1,2,3,4,5);
        foreach($arr as $i){
            echo "$i<br>";
        }
        $j = 3;
        while($j>0){
            echo "$j<br>";
            $j--;
        }
        $condition = true;

        if ($condition) {
            echo "Condition is true";
        } else {
            echo "Condition is false";
        }
        echo "<br>";
        for ($i = 1; $i <= 5; $i++) {
            echo "Iteration $i<br>";
        }
        echo "<br>";
        $day = "Monday";
        switch ($day) {
            case "Monday":
                echo "It's Monday.";
                break;
            case "Tuesday":
                echo "It's Tuesday.";
                break;
            default:
                echo "It's not Monday or Tuesday.";
        }
        $num = 5;
        $factorial = 1;  
        for ($x=$num; $x>=1; $x--)   
        {  
            $factorial = $factorial * $x;  
        }  
        echo "Factorial of $num is $factorial";
        define("enter","you entered in hell!!!!");
        echo constant("enter");
        $num1=20;
        $num2=15;
        $num3=22;
        if($num1>$num2 && $num1>$num3){
            echo $num1;
        }
        else{
            if($num2>$num1 && $num2>$num3){
            echo $num2;
        }
        else
          echo $num3;
        }

        ?>
</body>
</html>
