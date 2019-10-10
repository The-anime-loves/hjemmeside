<?php

class ProductTabel {
    
    public static function buildProductTabel(){
        
        
        if(isset($_GET["search"])){
            $search = $_GET["search"];
            $bind = ["%$search%", "$search%","$search%"];
            $sql = "SELECT * FROM computers_view WHERE name LIKE ? OR brand_name LIKE ? OR type_name LIKE ?";
        } else {
            $sql = "SELECT * FROM computers_view";
        }
        
        $mySQL = new MySQL();
        
        $stat = $mySQL->dbc->prepare($sql);
        if(isset($bind)){
            $stat->execute($bind);
        } else {
            $stat->execute();
        }
        
        $result = $stat->fetchAll(PDO::FETCH_ASSOC);
        
        
        $productTabel = '<div class="container">';
            if(isset($_GET["search"])){
                $productTabel .='<a href="Produks.php">Reset Search</a>';
            }
            $productTabel .= '<table class="table table-hover">';
                $productTabel .='<thead class="thead-dark">';
                    $productTabel .='<tr>';
                        $productTabel .='<th>img</th>';
                        $productTabel .='<th>Name</th>'; 
                        $productTabel .='<th>see</th>';
                    $productTabel .='</tr>';
                $productTabel .='</thead>';
                $productTabel .='<tbody>';
                
                for ($i = 0; $i< count($result); $i++){
                    $productTabel .='<tr>';
                        //$productTabel .='<th scope="row">'.(1+$i).'</th>';
                        $productTabel .='<td width="25%"><img width="50%" src="img/product/'.$result[$i]["img"].'"></td>';
                        $productTabel .='<td width="30%">'.$result[$i]["name"].'</td>';
                        $productTabel .='<td>'.$result[$i]["brand_name"].'</td>';
                        $productTabel .='<td>'.$result[$i]["type_name"].'</td>';
                        $productTabel .='<td>'.$result[$i]["product_price"].' kr</td>';
                        $productTabel .='<td>';
                            $productTabel .= '<form action="cart.php" method="POST">';
                                $productTabel .= '<input type="hidden" name="product_id" value="'.$result[$i]["serial_number"].'">';
                                $productTabel .='<button type="submit" name="Add_product">Add</button>';
                            $productTabel .= '</form>';
                        $productTabel .= '</td>';
                    $productTabel .='</tr>';
                }
                $productTabel .='</tbody>';
            $productTabel.='</table>';
        $productTabel .='</div>"';
        return $productTabel;
    } 
}