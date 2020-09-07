<?php
$hostnom = 'host=localhost';
$usernom = 'root';
$password = '';
$bdd = 'biblio';

try {
    $monPdo = new PDO("mysql:$hostnom;dbname=$bdd;charset=utf8", $usernom, $password);
    //ligne pour afficher les erreurs sql(à retirer si mis en ligne)
    $monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    $monPdo = null;
}
?>