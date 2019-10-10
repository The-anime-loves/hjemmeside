<?php
session_start();

require 'config/database.php';

// checker om bruger er logget ind
//if(!isset($_SESSION['admin'])){
//    header("location:index.php");

// ellers check om bruger er elev og sende dem væk hvis de er
//}elseif ($_SESSION['admin'] !== 1) {
//    header("location:elevintra.php");
//}

$msg = "";
// checker om create news er blevet trykket på
if(isset($_POST['create_news'])){
    
    $my_title=$_POST['title'];
    $my_img=$_POST['img'];
    $my_resume=$_post['resume'];
    $my_rating=$_post['rating'];
    
    // inseter data i news og binder værdier til sql sætning
    $mysql = "INSERT INTO create_anime(title,img,resume,rating) VALUES (:title,:img,:resume,:rating)";
    // klargøre $mysql statementet
    $stmt = $conn->prepare($mysql);
    // vi eksekvere $stmt og binder bruger indtastede værdier
    $executed = $stmt->execute(array("title"=>$my_title,"img"=>$my_img,"resume"=>$my_resume,"rating"=>$my_rating));
    
    // checker om $stmt var succesfuld
    if ($executed){
        $msg = "You have succesfully made a recommended anime";
    }else{
        $msg = "wasn't able too create the recommendtation";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/Recommend_anime.css" type="text/css" rel="stylesheet">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="main">
            <?php echo $msg; ?>
            <form method="POST">
                <label for="title">Title on the anime:</label>
                <input type="text" id="title" name="title" placeholder="Write the title" required="required">
                <label for="img">Picture of the anime:</label>
                <input type="file" name="picture"><br>
                <label for="resume">Resume:</label>
                <textarea id="resume" name="resume" placeholder="Write a resume" style="height:200px" required="required"></textarea>
                <label for="rating">Rating</label>
                <input type="number" name="rating">
                <input type="submit" name="create_news" value="Recommed the anime">
                <div class="elevintra">
                    <a href="index.php"></a>
                </div>
            </form>
        </div>
    </body>
</html>