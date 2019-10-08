<?php
session_start();

require 'php/conn.php';

// checker om bruger er logget ind
if(!isset($_SESSION['admin'])){
    header("location:index.php");

// ellers check om bruger er elev og sende dem væk hvis de er
}elseif ($_SESSION['admin'] !== 1) {
    header("location:elevintra.php");
}

$msg = "";
// checker om create news er blevet trykket på
if(isset($_POST['create_news'])){
    
    $my_title=$_POST['title'];
    $my_body=$_POST['body'];
    
    // inseter data i news og binder værdier til sql sætning
    $mysql = "INSERT INTO news(title,body) VALUES (:title,:body)";
    // klargøre $mysql statementet
    $stmt = $conn->prepare($mysql);
    // vi eksekvere $stmt og binder bruger indtastede værdier
    $executed = $stmt->execute(array("title"=>$my_title,"body"=>$my_body));
    
    // checker om $stmt var succesfuld
    if ($executed){
        $msg = "Du har succesfuldt oprettet en nyhed";
    }else{
        $msg = "Kan ikke tilføje nyhed";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/lave_nyheder.css" type="text/css" rel="stylesheet">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="main">
            <?php echo $msg; ?>
            <form method="POST">
                <label for="title">Title på nyheden:</label>
                <input type="text" id="title" name="title" placeholder="Skriv en title" required="required">
                <label for="body">Body:</label>
                <textarea id="body" name="body" placeholder="Skriv nyheden" style="height:200px" required="required"></textarea>
                <input type="submit" name="create_news" value="Lav nyhed">
                <div class="elevintra">
                    <a href="elevintra.php">Gå tilbage til elevintra</a>
                </div>
            </form>
        </div>
    </body>
</html>