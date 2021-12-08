
 <?php
session_start();
      
      
      if(isset($_GET['deco']) && $_GET['deco'] == 'ok'){
        unset($_SESSION['login']);
      }
      
    if(!empty($_POST['login']) && !empty($_POST['pwd'])){
        $login = "moi";
      $passwd= "123456";
        if($login == $_POST['login'] && $passwd == $_POST['pwd']){
            $_SESSION['login'] = 'moi';
            $_SESSION['password'] = '123456';
            echo "bien joué";
        }
        else{
            echo " mauvais username ou passeord";
        }
            
    }
    if (!empty($_SESSION['login'])){
        echo "bien joué";
        echo "<a href='connexion.php?deco=ok'>Se Déconnecter</a>";

    }
    else{
            echo '<Form action="" method="POST">
            <label for="text">Votre pseudo</label>
            <input type="text" name="login">
            <label for="password">Votre mot de passe</label>
            <input type="password" name="pwd" >
            <input type="submit"  value="Se connecter">
        </Form>';
        }
?>