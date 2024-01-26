
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

    a {
        text-decoration: none;
        color: black;
    }
    .media-object {
    display: flex;
    align-items: center;
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

    a:hover , a .login{
        color: blue;
    }
    

    .formcontent {
        display: flex;
        justify-content: center;
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
        margin-top: 10px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }
  
    </style>
</head>

<body>
    <?php require_once('nav.php') ;
        require_once ('connect.php');
        
    ?>
    <?php 
        if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true){

    echo '<div class="formcontent">
    <form action= "'.$_SERVER["REQUEST_URI"].'" method="post">
        <h1>Submit your answer</h1>

        <label for="comment">Add a comment:</label>
        <textarea id="comment" name="comment" rows="4" required></textarea>

        <button type="submit">Post comment</button>
    </form>
</div>';
        }
        else{
            echo"<div class='notlogedin'>
            <P style='text-align:center; font-size:20px; margin:20px;'>You are not logedin.Please<a href='login.php' style='text-decoration:underline; color:skyblue;'' class='login'>Login</a> to start a disscussion</p>
            </div>";
        }

 ?>
    
    <h1>Disscussion</h1>
    <div class="postcontent"
        style="display: flex;flex-direction: column;flex-wrap: wrap;align-items: flex-start;align-content: center;">
        <?php
    
    $id = $_GET['thread_id'];
    $sql = "SELECT * FROM `comment`  WHERE thread_id =$id ORDER BY `comment`.`comment_id` DESC ";
    $result = mysqli_query($conn , $sql);
    $noresult = true;
    while ($row = mysqli_fetch_assoc($result)) {
        $noresult = false;
        $commid = $row['comment_id'];
        $content = $row['comment_content'];
        $userid = $row['comment_by'];
        echo '<div class="media-object">
            <img src="img_avatar.png" alt="Media Object Image">
            <div class="userproblem">
                <p class="username"><b>Posted by/ ' .$userid . '</b></p>
                <p class="ans">' . $content . ' </p>
            </div>
        </div>';
    }
    if($noresult){
        echo "be the first one to post";
    }
    ?>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $comment = $_POST['comment'];
        $commentedBy = $_SESSION['username'];
        $sql = "INSERT INTO `comment` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) 
                VALUES ('$comment', '$id', '$commentedBy', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } 
    ?>


</body>

</html>