<?php

class AnimeTabel {
    
    public static function buildAnimeTabel(){
        
        
        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $bind = ["%$search%", "$search%","$search%"];
            $sql = "SELECT name, img, rating FROM amine WHERE name LIKE ?";
        } else {
            $sql = "SELECT name, img, rating FROM anime";
        }
        
        $mySQL = new MySQL();
        
        $stat = $mySQL->dbc->prepare($sql);
        if(isset($bind)){
            $stat->execute($bind);
        } else {
            $stat->execute();
        }
        
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        
        
        $anime = '<div class="container">';
            if(isset($_GET["search"])){
                $anime .='<a href="Produks.php">Reset Search</a>';
            }
            $anime .= '<table class="table table-hover">';
                $anime .='<thead class="thead-dark">';
                    $anime .='<tr>';
                        $anime .='<th>img</th>';
                        $anime .='<th>Name</th>'; 
                        $anime .='<th>Rating</th>';
                    $anime .='</tr>';
                $anime .='</thead>';
                $anime .='<tbody>';
                
                for ($i = 0; $i< count($result); $i++){
                    $anime .='<tr>';
                        //$anime .='<th scope="row">'.(1+$i).'</th>';
                        $anime .='<td width="25%"><img width="50%" src="img/product/'.$result[$i]["img"].'"></td>';
                        $anime .='<td width="30%">'.$result[$i]["name"].'</td>';
                        $anime .='<td>'.$result[$i]["brand_name"].'</td>';
                        $anime .='<td>'.$result[$i]["type_name"].'</td>';
                        $anime .='<td>'.$result[$i]["product_price"].' kr</td>';
                        $anime .='<td>';
                            $anime .= '<form action="cart.php" method="POST">';
                                $anime .= '<input type="hidden" name="product_id" value="'.$result[$i]["serial_number"].'">';
                                $anime .='<button type="submit" name="Add_product">Add</button>';
                            $anime .= '</form>';
                        $anime .= '</td>';
                    $anime .='</tr>';
                }
                $anime .='</tbody>';
            $anime.='</table>';
        $anime .='</div>"';
        return $anime;
    } 
}