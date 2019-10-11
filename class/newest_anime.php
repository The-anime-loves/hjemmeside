<?php
class New_anime{
    
    public static function newAnime(){
        // henter database connection
        require 'mySQL.php';
        
        $mySQL = new MySQL();
        
        // selecter data fra databasen
        $sql = "SELECT title,img,rating FROM anime ORDER BY id DESC LIMIT 6";
        // klargøre $sql statement 
        $stmt = $mySQL->dbc->prepare($sql);
        // eksekvere $stmt variablen
        $stmt->execute();

        // henter data fra $stmt forspørgelsen
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // checker om der er data i databasen
        if (count($data) > 0){
            $anime = "";

            // køre igennem dataen og lave nyheds html
            foreach($data as $row){
                $anime .= '<div class="new_anime">'; 
                    $anime .= '<h3>'. $row['title']. '</h3>';
                    $anime .= ($row['img']);
                    $anime .= ($row['rating']);
                $anime .= '</div>';
                $anime .= '<br>'; 
            }

        }
    }
}
?>