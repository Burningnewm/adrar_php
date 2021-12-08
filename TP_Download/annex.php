    <?php include "index.php"; ?>
    <form action="annex.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="userfile">
    <input type="submit" value="upload">
    </form>
    <?php
    
    
    if (!empty($_FILES["userfile"])){
        $ext = pathinfo($_FILES['userfile']['name']);
    $file_allowed = ["txt"];
    $errors = [];
    $fichier = str_replace(' ', '_',strtolower($_FILES["userfile"]["name"]));
    
        if($_FILES["userfile"]["size"] > 1000000){
        $errors[] = "fichier trop gros";
        }
        if($ext['extension'] != $file_allowed[0]){
            $errors[] = "mauvais fichier de format";
        }
        if (empty($errors)){
            
            $path = "fichiers/" . $fichier;
            if(move_uploaded_file($_FILES["userfile"]["tmp_name"], $path)){
                echo "bien joué " . $_FILES["userfile"]["name"] ." a été uploadé";
            }
        }
        else{
            foreach($errors as $value){
                echo $value . "<br>";
            }
        }
    
}
    


?>