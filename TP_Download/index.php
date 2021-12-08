<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salut</title>
</head>
<body>
    <h1>Heloo</h1>
       
    
   <?php 
   
   $fichiers = scandir("fichiers");
   function fichier($fichier){
   echo "<form action='/TP_Download/index' method='POST'>";   
   echo "<label for='fichier'>Fichier</label>";
   echo "<select name='cheatcode'>";
    foreach($fichier as $value){
        
        if($value!== "." && $value!== ".."){
       echo "<option value=".$value.">". str_replace( ["_", ".txt" ] , " ", ucfirst($value)) . "</option>";
        }
    }
    echo "</select>";
    echo "<input type='submit' value='Télécharger'>";
    echo "</form>";
}
?>
</body>
</html>
<?php
echo fichier($fichiers);
if(isset($_POST["cheatcode"])){
    header('content-type: text/plain');
    header("Content-Disposition: attachment; filename=".$_POST["cheatcode"]);
    // require("fichiers/".$_POST["cheatcode"]);
    ob_clean();
    readfile("fichiers/".$_POST["cheatcode"]);
    
};
?>

