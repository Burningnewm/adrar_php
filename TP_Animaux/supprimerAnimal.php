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
    include 'bdd.php';
    ?>
    <?php
    $sql2 = "SELECT * FROM animal";
    $req = $db->prepare($sql2);
    $result = $req->execute();
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    $succes = false;
    if(isset($_POST['animauxDataList'])){
        foreach($data as $animal){
            if($_POST['animauxDataList'] == $animal->animal_nom){
                $succes = true;
            }
        }
    }
    if(!empty($_POST['animauxDataList'])){
        $sql3 = "DELETE FROM animal WHERE animal_nom =:animal";
        $request = $db->prepare($sql3);
        $result= $request->execute([":animal"=>$_POST['animauxDataList']]);
        if($succes == true){
        ?>
        <div class="alert alert-success" role="alert">
        L'animal a été supprimé!!!
        </div>
        <?php 
        }
        else{
        ?>
        <div class="alert alert-danger" role="alert">
        l'animal sélectionné n'existe pas!!!
        </div>
        <?php
        }  
    }       
        ?>
    <section class="containerAnimaux">
        <form action="" method="POST">
            <label for="animauxDataList" class="form-label">Liste des animaux</label>
            <input class="form-control" list="datalistOptions" id="animauxDataList" placeholder="Recherchez les animaux..." name="animauxDataList">
            <datalist id="datalistOptions">
            <?php
            foreach($data as $animal){
                ?>
                    <option value='<?=htmlspecialchars($animal->animal_nom)?>'><?= htmlspecialchars($animal->animal_description) ?></option>
                <?php
                }
                ?>
            </datalist>
            <input type="submit" value="Supprimer" class="btn btn-primary">
        </form>
    </section>
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