<?php


class Navbar {
    
    public static function buildNav(){
        
        $left = ["Home"=>"index.php"];
        $right = ["Cart" => "cart.php","Products" => "Produks.php"];
                
        if(isset($_SESSION['login_user'])){
            $right = array_merge($right,[$_SESSION['login_user']=>"#","Log out"=>"logout.php"]);
        } else {
            $right = array_merge($right,["Create Account"=>"creat_aucount.php","Login"=>"login.php"]);
        }
        
        $page = explode('/',$_SERVER['PHP_SELF'])[2];
        
        
        
        $navbar = '<nav class="navbar navbar-expand-lg navbar-dark">';
            $navbar .= '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
                $navbar .= '<span class="navbar-toggler-icon"></span>';
            $navbar .= '</button>';
            $navbar .= '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
                $navbar .='<ul class="navbar-nav mr-auto">';
                    
                    foreach ($left as $key => $value) {
                        if($page === $value){
                            $navbar .='<li class="nav-item active">';
                        } else {
                            $navbar .='<li class="nav-item">';
                        }
                        
                            $navbar .='<a class="nav-link" href="/A_Z_Webshop/'.$value.'">'.$key.'<span class="sr-only">(current)</span></a>';
                        $navbar .='</li>';
                        }
                        $navbar .= '<li class="nav-item" >';
                            $navbar .='<form class="form-inline" method="GET" action="Produks.php">';
                            $navbar .='<input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">';
                            $navbar .='<button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>';
                            $navbar .='</form>';
                        $navbar .= '</li>';
                $navbar .='</ul>';
                $navbar .='<ul class="navbar-nav my-2 my-lg-0">';
                    foreach ($right as $key => $value) {
                        if($page === $value){
                            $navbar .='<li class="nav-item active">';
                        } else {
                            $navbar .='<li class="nav-item">';
                        }
                        
                            $navbar .='<a class="nav-link" href="/A_Z_Webshop/'.$value.'">'.$key.'<span class="sr-only">(current)</span></a>';
                        $navbar .='</li>';     
                    }
                $navbar .='</ul>';
            $navbar .='</div>';
        $navbar .='</nav>';
        
        return $navbar;
    }
}
