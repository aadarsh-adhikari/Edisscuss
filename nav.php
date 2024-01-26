<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edisscuss</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css"> 
</head>
<body>
    <nav>
        <div>Edisscuss</div>
        <div>
        <?php
if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true){
  $logedin =true;
}
else{
    $logedin =false;
}
      echo "<a href='index.php' class='Home'>Home</a>";
       if(!$logedin){
        echo "<a href='login.php' class='login'>Login</a>
        <a href='signup.php' class='signup'>Sign Up</a>";
        
       }           
            if($logedin){
                echo "<a href='logout.php' class='logout'>logout </a>
                <b>Welcome</b>  <b>". $_SESSION['username'] ."</b>";
            }
            ?>

        </div>
    </nav>
    </div>
</body>
</html>
