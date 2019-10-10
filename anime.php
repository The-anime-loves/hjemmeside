<?php
    session_start();    
    require 'class/navbar.php';
    require 'class/productTabel.php';
    require 'class/mySQL.php';
    
    
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/navbar.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        echo Navbar::buildNav();
        ?>
        <?php
        echo AnimeTabel::buildAnimeTabel();
        ?>
        <?php
            require 'html/foot.html';
        ?>
    </body>
</html>
