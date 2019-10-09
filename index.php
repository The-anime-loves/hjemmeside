<?php
    session_start();
    require 'class/navbar.php'
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/A_Z_Webshop/css/index.css">
        <link rel="stylesheet" type="text/css" href="/A_Z_Webshop/css/navbar.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            echo Navbar::buildNav();
        ?>
        <div class="container">
            <img src="/A_Z_Webshop/img/index/webshop_welcomeside.png" >
        </div>
        <?php
            require 'html/foot.html';
        ?>
    </body>
</html>
