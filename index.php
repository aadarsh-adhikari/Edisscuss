
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css"> 

    <title>Edisscuss</title>
</head>
<body>
    <?php require_once('nav.php') ;
    require_once ('connect.php');
    ?>
    <div class="whole">
    <div class="jumbotron">
            <h2>Rules</h2>
            <p>No Spam / Advertising / Self-promote in the forums,
                Do not post copyright-infringing material,
                Do not post “offensive” posts, links or images,
                Do not cross post questions,
                Remain respectful of other members at all times.</P>
            <a href="#" class="btn">Learn More</a>
        </div>
    </div>
    <h1>Browse category</h1>
       <?php 
     $sql = "SELECT * FROM `topics`";
     $result = mysqli_query($conn , $sql);
     echo "<div class='content'>";
     while ($row = mysqli_fetch_assoc($result)){
     $catname =$row['category_name'];
     $catdes =$row['category_des'];
     $date = $row['date'];
     $catid = $row['id'];
      echo " 
        <div class='card'>
            <div class='cardcontent'>
            <img src='graduation.jpg' alt='Avatar' style='width:100%' draggable='false'>
            <div class='container'>
               <h4><a href='thread.php?catid=".$catid. "'> <b>$catname </b><a/></h4>
               <p>" .substr($catdes ,0 ,80) . "... <a href='thread.php?catid=".$catid. "'>read more</a></p><br>
               <date>posted date:$date</date><br><br>
           </div></div>


        </div>" ;
     
      }
      
    echo '</div>';
   ?>
       
      
</body>
</html>