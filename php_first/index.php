<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tp1</title>
</head>
<body>
    <?php 
    echo "<h1>Hello World</h1>";
    define("URL", '<a href="https://www.google.fr">Google</a>');
    echo URL."</br>";
    $number = 18;
    echo $number ." ". gettype($number)."</br>";
    $boolean = true;
    echo $boolean ." ". gettype($boolean)."</br>";
    $phrase = "Je suis un gros demon";
    echo $phrase ." ". gettype($phrase)."</br>";
    $nul = null;
    echo $nul ." ". gettype($nul)."</br>";
    $virgule= 18.4;
    echo $virgule ." ". gettype($virgule)."</br>";
    var_dump($number, $boolean, $phrase, $nul, $virgule);
    $a=10;
    $b=2;
    $c = $a;
    $a = $b;
    $b = $c;
    $d = $a / $b;
    var_dump($d); 
    function tab($tab){
        if (!is_array($tab)){
            echo "Ceci n'est pas un tableau";
        }
        elseif(!empty($tab)){
            foreach ($tab as $value) {
                if (is_string($value)){
                    return "Ceci est un tableau de strings";
                }
            }
            echo max($tab);
        }
        else{
            echo "ceci est un tableau vide";
        }
    };
    $vide = ["ceci est un tableau vide"];
$_array= [1,2,3,4,5,6,7,9,10,8];
    echo tab($_array). "</br>";
    echo tab($vide). "</br>";
    echo tab($a). "</br>";
    echo tab($phrase). "</br>";

    function dynamic($_string, $_tableau){
        if (empty($_string) || empty($_tableau)){
            return;
        }
        $list = null;
        $list.= "<ul>" .  $_string ;
        foreach($_tableau as $value){
            $list.= "<li>" . $value . "</li>";
        }
        $list.=  "</ul>";
        return $list;  
    };
    echo dynamic("stagiaires", ["stagiaires","stagiaires","stagiaires","stagiaires","stagiaires","stagiaires"]);
    echo dynamic($a, $_array);

    

    ?>
</body>
</html>