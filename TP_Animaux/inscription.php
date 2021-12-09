<?php 
session_start();
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
if(isset($_POST['username'], $_POST['password'], $_POST['passwordConfirm'], $_POST['email'])){
  if ($_POST['password'] == $_POST['passwordConfirm']){
    $username1 = $_POST['username'];
    $mail = $_POST['email'];
    $sql = "SELECT * FROM utilisateurs WHERE user_pseudo = :username OR user_mail = :mailuser";
    $req= $db->prepare($sql);
    $result = $req->execute([
      ":username"=>$username1,
      ":mailuser"=>$mail
    ]);
    $data = $req->fetch(PDO::FETCH_OBJ);
    if(empty($data)){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password = password_hash($password, PASSWORD_DEFAULT);
  $addUser = "INSERT INTO utilisateurs (user_pseudo, user_pwd, user_mail) VALUES (:pseudouser, :pwduser, :mailuser)";
  $req = $db->prepare($addUser);
  $result = $req->execute([
    ":pseudouser"=>$username,
    ":mailuser"=>$email,
    ":pwduser"=>$password
  ]);
  $_SESSION['username']=$username;
      header("Location: index.php");
}
else{
  ?>
        <div class="alert alert-warning" role="alert">
        Utilisateur éxistant!!!
        </div>
        <?php 
}
  }
else{
  ?>
        <div class="alert alert-warning" role="alert">
        Vos mots de passe de correspondent pas!!!
        </div>
        <?php 
}
}
elseif(!isset($_POST['username'], $_POST['password'], $_POST['passwordConfirm'], $_POST['email']) && isset($_POST['submit'])){
  ?>
        <div class="alert alert-danger" role="alert">
        Tous les champs doivent etre remplis!!!
        </div>
        <?php 
}
?>
<form method="POST"   class="mt-7 containerConnexion">
  <div class=" mb-3">
    <label for="username">Pseudo</label>
    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Entrez" name="username" required>
  </div>
  <div class=" mb-3">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
 required>
  </div>
  <div class=" mb-3">
    <label for="passwordConfirm">Confirmez votre Password</label>
    <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Password Confirmation" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
 required>
  </div>
  <div class=" mb-3">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Entrez" required>
  </div>
  <button type="submit" class="btn btn-primary mb-3" name="submit">Submit</button><br>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>