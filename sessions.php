<?php
    session_start();
    $_SESSION['favourite_colour'] = 'blue';
    echo "Session variables are set<br>";
    echo "Ypur favourite color is: ". $_SESSION['favourite_colour'];
    echo "<br>";
    setcookie('favourite_color', 'blue', time() + 86400);
    echo "Cookies are set<br>";
    echo "Cookie favourite color: ". $_COOKIE['favourite_color'];
    if(isset($_COOKIE['favourite_color'])){
        echo "<br>Cookie set"; 
    }
    else{
        echo "<br>Cookie not set";
    }
    //setcookie('favourite_color','',time()-3600);
    echo "<br>Cookie deleted <br>";
    if(count($_COOKIE)>0){
        echo "<br> Cookie enabled<br>";
    }
    else{
        echo "<br>Cookie disabled";
    }

    print_r($_SESSION);

    session_unset();
    session_destroy();
?>