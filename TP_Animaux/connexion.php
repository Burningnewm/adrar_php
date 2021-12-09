<?php 
session_start()
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
<?php 
    include 'bdd.php';
?>
<?php
  if(isset($_POST['username'], $_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM utilisateurs WHERE user_pseudo = :username";
    $req= $db->prepare($sql);
    $result = $req->execute([
      ":username"=>$username,
    ]);
    $data = $req->fetch(PDO::FETCH_OBJ);
  
    if($data){
      if(password_verify($password, $data->user_pwd)){
      $_SESSION['username']=$username;
      $name = 'username';
      header("Location: index.php");
      if($_POST['checkbox']){
        setcookie($name, $username, time() + (3600 * 24 * 7), null, null, true, true);
      } 
      }
      else{
        ?>
          <div class="alert alert-warning" role="alert">
          Password incorrecte!!!
          </div>
          <?php   
        }
    }
    else{
      ?>
      <div class="alert alert-warning" role="alert">
        Utilisateur inexistant!!!
      </div>
      <?php    
    }
    
    }
      ?>    
    
  

<form method="POST" class="mt-7 containerConnexion">
  <div class=" mb-3">
    <label for="username">Pseudo</label>
    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Entrez votre pseudo" name="username" required>
  </div>
  <div class=" mb-3">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
  </div>
  <div class=" mb-3">
    <input type="checkbox" class="form-check-input" id="checkbox" name="checkbox">
    <label class="form-check-label" for="checkbox">rester connecté</label>
  </div>
  <button type="submit" class="btn btn-primary mb-3">Submit</button><br>
  <a href="inscription.php">Pas encore inscris? Inscivez-vous</a>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>