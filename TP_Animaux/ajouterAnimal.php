<?php 
session_start();
if(isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/style.css" rel="stylesheet">
    <link href="assets/reset.css" rel="stylesheet">
    <title>Consulter les animaux</title>
</head>
<body>
    <?php include 'header.php';
    include 'bdd.php'?>
    <section class="containerAnimaux">
<form action="" method="POST" enctype="multipart/form-data" id="formUpload">
    <div class=" input-group mb-3">
    <input type="text" class="form-control" name="title">
    </div>
    <div class="input-group mb-3">
    <input type="text" name="description">
    </div>
    <div class=" input-group mb-3">
    <input type="file" class="form-control" name="userfile">
    </div>
    <div class="input-group">
    <input type="submit" class="btn btn-primary" value="upload">
    </div>
  </form>
  </section>
  <?php
    
    if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_FILES["userfile"])){
        $ext = pathinfo($_FILES['userfile']['name']);
        $file_allowed = ["jpg", "png"];
        $errors = [];
        $req = $db->prepare("SELECT * FROM animal WHERE animal_nom = :animalnom");
        $req->execute([
        ":animalnom"=>$_POST['title']
        ]);
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        if(!empty($data)){
            $errors[] = "Nom déjà existant";
        }
        if($_FILES["userfile"]["size"] > 1000000){
        $errors[] = "fichier trop gros";
        }
        if($_FILES["userfile"]["size"] != 0){
        if($ext['extension'] != $file_allowed[0] && $ext['extension'] != $file_allowed[1]){
            $errors[] = "mauvais fichier de format";
        }
        }
        else{
            $errors[]= "veuillez ajouter un fichier";
        }
        if (empty($errors)){
            $insert = "INSERT INTO animal ( animal_nom, animal_description, animal_image) VALUES ( :animalnom, :animalDesc, :animalImages)";
            $req = $db->prepare($insert);
            $result = $req->execute([
                ":animalnom"=>$_POST['title'],
                ":animalDesc"=>$_POST['description'],
                ":animalImages"=>$_POST['title'].'.jpg'
            ]);
            move_uploaded_file($_FILES["userfile"]["tmp_name"], 'assets/' . $_POST['title'].'.jpg');
        }
        else{
            foreach($errors as $value){
                echo $value . "<br>";
            }
        }
    
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
else{
    $url = "connexion.php";
    header("Location: $url");
}
?> 
