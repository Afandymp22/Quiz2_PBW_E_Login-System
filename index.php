<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html> 
<html> 
  
<head> 
    <title>HTML Redirect</title> 
</head> 
  
<body> 
    <h1 style="text-align:center;color:green;"> 
         Hello User 
    </h1> 

    <h3 style="text-align:center;color:green;"> <a href="logout.php">Logout</a></h3> 
      
    <p style="text-align:center;"> 
        <a href="https://www.youtube.com/watch?v=oHg5SJYRHA0">Check This Out</a> 
    </p> 
    <p style="text-align:center;"> 
        <a href="https://github.com/Afandymp22">Link Github Afandy Maulana Pangestu</a> 
    </p>    
    
</body> 
  
</html> 