
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edisscuss</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0 auto 0 auto;
    }

    section{
        margin: 4%;
    }

    .jumbotron {
        background-color: #3498db;
        color: #000000;
        text-align: center;
        padding: 30px 20px;
        margin: 20px auto 0 auto;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
    }

    .jumbotron h1 {
        margin-bottom: 20px;
        letter-spacing: 2px;

    }

    .jumbotron p {
        font-size: 1em;
        line-height: 1.6;
        margin-top: 20px;
        margin-bottom: 20px;


    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 1.2em;
        text-decoration: none;
        color: #ffffff;
        background-color: #2c3e50;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #1a252f;
    }

    hr {
        margin: 8px;
        height: 2px;
    }
 
    .media-object {
    display: flex;
    align-items: center;
    justify-content:flex-start;
    flex-wrap:wrap;
    margin-top: 30px;
    padding: 20px;
    border: 1px solid red;
    width: 70%;
    }
    .media-object img {
        border-radius: 50%;
        max-width: 70px;
        margin-right: 20px;
    }

    .userproblem p {
        margin-top:8px;
        font-size: 20px;
    }
   
    .userproblem .ans {
        margin-top: 10px;
        font-size: 15px;
    }
    a{
        text-decoration:none;
        color:black;
    }
    a:hover{
        color:blue;
    }
    .formcontent{
        display:flex;
        justify-content:center;
        margin: 40px 0 40px 0;
        
    }
    form {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 500px;
        }

        label {
            display: block;
            margin-top:10px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea{
            margin-bottom:16px;
        }
        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1a252f;
        }

        .error-message {
            color: red;
            margin-bottom: 16px;
        }
        .welcome{
            margin-top:40px;
        }
        .media-object .comment {
    background-color: #007bff;
    width:100%
    color: #ffffff;
    padding: 8px 12px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    display: inline-block;
    border-radius: 4px;
    outline: none; 
    margin:8px;

}

.media-object .comment:hover {
    background-color: #0056b3;
}


    </style>
</head>
<body>
    <?php require_once('nav.php') ;
        require_once ('connect.php');
    ?>
   <section>
   <div class=whole>
     <?php
    $id = $_GET['catid'];
    $sql = " SELECT * FROM `topics` WHERE id =$id  ";
    $result = mysqli_query($conn , $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)){
        $name = $row['category_name'];
    
    }
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $problemtitle =$_POST['problemTitle'];
    $problemdescription =$_POST['problemDescription'];
// Replace < with &lt; and > with &gt;
   $problemtitle = str_replace(['<', '>'], ['&lt;', '&gt;'], $problemtitle);
   $problemdescription = str_replace(['<', '>'], ['&lt;', '&gt;'], $problemdescription);
    $userid = $_SESSION['username'];
    $id = $_GET['catid'];
    $sql ="INSERT INTO `thread` (`thread_title`, `thread_des`, `thread_cat_id`, `thread_user_id`, `time`) VALUES ( '$problemtitle', '$problemdescription', '$id', '$userid', current_timestamp())";
    $result = mysqli_query($conn , $sql);
    
    
    }
    ?>
    <h1 class='welcome'>welcome to <?php echo $name ?> Disscussion </h1>
    <?php
    if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true){
    
    echo' <div class="formcontent">
    <form action="'. $_SERVER["REQUEST_URI"].'"method="post">
        <h1>Ask a questions</h1>
           <label for="problemTitle">Problem Title:</label>
           <input type="text" id="problemTitle" name="problemTitle" required maxlength="50">
           <span class="error-message">(Title should be short)</span>
       
           <label for="problemDescription">Problem Description:</label>
           <textarea id="problemDescription" name="problemDescription" rows="4" required></textarea>
   
           <button type="submit">Submit</button>
       </form>
    </div>';
    }
    else{
        echo"<div class='notlogedin'>
        <P style='text-align:center; font-size:20px; margin:20px;'>You are not logedin.Please<a href='login.php' style='text-decoration:underline; color:skyblue;'' class='login'>Login</a> to start a disscussion</p>
        </div>";
    }
    
    ?>
        <h1 class="browse">Browse Questions</h1>
         <div class="postcontent" style="display: flex;flex-direction: column;flex-wrap: wrap;align-items: flex-start;align-content: center;">
         <?php
    $id = $_GET['catid'];
    $sql = " SELECT * FROM `thread`  WHERE thread_cat_id =$id ORDER BY `thread`.`thread_id` DESC " ;
    $result = mysqli_query($conn , $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)){
        $noresult =false;
        $id =$row['thread_id'];
        $title =$row['thread_title'];
        $des =$row['thread_des'];
        $userid =$row['thread_user_id'];
        echo ' <div class="media-object">
        <img src="img_avatar.png" alt="Media Object Image">
        <div class="userproblem">
        <p class="username"><b>Posted by/ ' .$userid . '</b></p>
            <p class="ques"><a href="threadcontent.php?thread_id='.$id.'">' .$title .'</a></p>
            <p class="ans">'.$des.'</p>
         
        </div>
        <a href="threadcontent.php?thread_id='.$id.'" style=" display: contents; "> <button class="comment"> comment</button></a>
    </div>';
    }
    if($noresult){
        echo "be the first one to post";
    }
    ?>

 </div>
</div>
   </section>
<?php
    include "footer.html";
    ?>
</body>
</html>
