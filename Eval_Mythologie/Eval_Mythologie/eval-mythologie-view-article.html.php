<?php
session_start();
include_once "bddMythologie/bddManager.php"; 
include_once "bddMythologie/eval-mythologie-bdd.php";
$article = $_GET['title'];
$data = selectArticle($article, $db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <title>Eval Mythologie</title>
</head>
<body>
<?php include_once "eval-mythologie-header.html.php";?>

<div class="card mb-3">
    <img class="card-img-top" src="images/<?= $data[0]->img_article?>" alt="<?=htmlspecialchars($data[0]->title_article) ?>" style="width: 400px; height: 600px;">
    <div class="card-body">
        <h5 class="card-title"><?=htmlspecialchars($data[0]->title_article);  ?></h5>
        <p class="card-text"><?=htmlspecialchars($data[0]->contenus_article) ?></p>
        <p class="card-text"><small class="text-muted">Date de publication: <?=$data[0]->date_article?></small></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>