<?php
    session_start();
    
    require 'class/navbar.php';
    require 'class/mySQL.php';
    
    if (isset($_POST['create'])){

        $mySQL = new MySQL();
        // username and password sent from form 
        $my_username = $_POST['username'];
        $my_password = $_POST['password'];
        $my_confirm = $_POST['confirm'];
        
        if(empty($my_username) || empty($my_password) || empty($my_confirm)){
            $msg = "<h5> One of the fields is empty </h5>";
        } else {
            if ($my_password === $my_confirm){
                if(strlen($my_username) >= 3 
                && strlen($my_password) >= 3 
                && strlen($my_username) <= 20){
                    
                    $sthandler = $mySQL->dbc->prepare("SELECT username FROM users WHERE username = ?");
                    $sthandler->execute([$my_username]);
                    
                    if($sthandler->rowCount() > 0){
                        $msg = "<h5 class='fejl'>Username already exists</h5>";
                    } else {
                        
                        //hash the password
                        $hashpassword = password_hash($my_password, PASSWORD_DEFAULT);
                        //inserst the hash password and username into the database
                        $sql = "INSERT INTO users (username,password) values (?, ?) ";

                        $stmt = $mySQL->dbc->prepare($sql);
                        
                        $result = $stmt->execute([$my_username, $hashpassword]);
                        
                        if ($result === TRUE) {
                            $msg = "<h5 class='fejl'>New User created successfully</h5>";
                        } else {
                            $msg = "<h5 class='fejl'> This username is allrede in use </h5>";
                        }
                    }
                    
                    
                } else {
                   $msg = "<h5 class='fejl'>Username or Password is under 3 character long or username is more then 20 characters </h5>";
                }
                $mySQL->dbc = null;
            } else {
                $msg = "<h5 class='fejl'> passwords doesn't match </h5>";    
            }
        }
           
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="gihub/css/navbar.css">
        <link rel="stylesheet" type="text/css" href="css/cerat_aucount.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            echo Navbar::buildNav();
        ?>
        <div class="createbox">
            <?php
                if (isset($msg)){
                    echo $msg;
                }
            ?>
            <h1>Create account</h1>
            <form method="POST">
                <p>Username</p>
                <input type="text" name="username" placeholder="Enter Username">
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter Password">
                <input type="password" name="confirm" placeholder="Confirm">
                <input type="submit" name="create" value="Create">   
                <a href="login.php">login</a>
            </form>
        </div>
        <?php
            require 'html/foot.html';
        ?>
    </body>
</html>
