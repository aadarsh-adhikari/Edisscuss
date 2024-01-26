<?php

    $error = false ;
    $sucessfull =false;
    $exists =false;
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    include "connect.php";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $existssql = "SELECT * FROM  `user` WHERE username = '$username' ";
    $result = mysqli_query($conn , $existssql);
    $numexitsrow =mysqli_num_rows($result);
    if($numexitsrow > 0){
        $exists =true;
    }
    else{
        $exists =false;
        if(($password ==$cpassword) ){
            $hash = password_hash($password , PASSWORD_DEFAULT);
            $sql ="INSERT INTO `user` (`username`, `password`, `date`) VALUES ( '$username', '$hash', current_timestamp()) ";
            $result = mysqli_query($conn ,$sql);
            if($result){
             $sucessfull =true;
             header("Location: login.php");
             exit();
            }
        }
         else {
        $error = true;
         }
    }

}

?>
<?php 
    require "nav.php"
    ?>
    <?php
    if($exists){
        echo"<h1> username exits</h1>";
    }
    if($error){
        echo "<h1>password doesnot matches";
    }
    ?>
<div class="formcontainer">
    <form action="signup.php" method="post">
        <h2>Sign Up</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"  required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" maxlength="50" required>
        <label for="cpassword">Confirm Password:</label>
        <input type="password" id="cpassword" name="cpassword" maxlength="50" required>

        <button class="sign" type="submit">Sign Up</button>
    </form>
</div>
