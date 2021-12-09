<?php
include 'bdd.php';
$animal= $_REQUEST['nom'];
$sql2 = "SELECT * FROM animal WHERE animal_nom = :animal";
    $req = $db->prepare($sql2);
    $result = $req->execute([
        ":animal"=>$animal,
    ]);
    $data = $req->fetch(PDO::FETCH_OBJ);
    $animalFile = $data->animal_image;
    $sql3 = "DELETE FROM animal WHERE animal_nom =:animal";
        $request = $db->prepare($sql3);
        $result= $request->execute([":animal"=>$_REQUEST['nom']]);
        unlink('assets/'.$animalFile);
?>