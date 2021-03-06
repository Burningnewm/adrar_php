<?php 
session_start();
if(isset($_SESSION['username']) || isset($_COOKIE['username'])){
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
    <section class="containerAnimaux">
    <?php
    $sql = "SELECT * FROM animal";
    $req = $db->query($sql);
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    foreach ($data as $animal) {
    ?>
        <ul class="animaux" id="<?=$animal->animal_nom?>">
            <p class="cross" id="<?=$animal->animal_nom?>">x</p>
            <li>
                <h2><?= htmlspecialchars($animal->animal_nom)  ?></h2>
            </li>
            <li>
                <p><?= htmlspecialchars($animal->animal_description)  ?></p>
            </li>
            <li>
                <img src='assets/<?= $animal->animal_image ?>'>
            </li>
        </ul>
    <?php
    };
    ?>
    </section>
    <script src="main.js" type="text/javascript"></script>
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