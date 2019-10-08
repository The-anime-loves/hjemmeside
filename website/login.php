<?php
    session_start();
    
    require 'class/navbar.php';
    require 'class/mySQL.php';

    if (isset($_POST['login'])){

        $mySQL = new MySQL();

        $error = "Your Login Name or Password is invalid";
        // username and password sent from form 
        $my_username = $_POST['username'];
        $my_password = $_POST['password']; 

        $sql = "SELECT password FROM users WHERE username = ? ";

        $stmt = $mySQL->dbc->prepare($sql);
        $stmt->execute([$my_username]);


        if($stmt->columnCount() > 0){
            $password1=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if(isset($password1[0])){
                // If result matched $myusername and $mypassword, table row must be 1 row
                if(password_verify($my_password, $password1[0]['password'])) {
                    $_SESSION['login_user'] = $my_username;

                    header("location: index.php");
                }
            }

        }

    }
            

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/A_Z_Webshop/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            echo Navbar::buildNav();
        ?>
        <div class="loginbox">
            <h1>Login Here</h1>
            <?php
                if (isset($error)){
                    echo $error;
                }
            ?>
            <form action="" method="POST">
                <p>Username</p>
                <input type="text" name="username" placeholder="Enter Username">
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter Password">
                <input type="submit" name="login" value="Login">
                <a href="creat_aucount.php">Don't have an account</a>

            </form>
        </div>
        <?php
            require 'html/foot.html';
        ?>
    </body>
</html>
