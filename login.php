<?php
    $error = false ;
    $login =false;
if($_SERVER['REQUEST_METHOD'] == "POST"){
    include "connect.php";
    $username = $_POST['username'];
    $password = $_POST['password'];   
    $sql = "SELECT * FROM  `user` WHERE username = '$username'";
    $result = mysqli_query($conn , $sql);
    $numexitsrow =mysqli_num_rows($result);
    if($numexitsrow ==1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
            $login=true;
            session_start();
            $_SESSION['logedin'] =true;
            $_SESSION['username']= $username;
            header("Location: index.php");
            exit();
            }
            else{
                $error =true;
            }

        }
     }
    else{
        $error = true;
         }
    }
?>
<?php include "nav.php"; ?>
<?php
   if($error){
    echo "something is wrong";
   }
   ?>
<div class="container">
    <form action="login.php" method="post">
        <h2>Login</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</div>

