<?php
include 'header.php';
include 'connexionPdo.php';
$action=$_GET['action'];
$libelle=$_POST["libelle"];
$continent=$_POST["continent"];
$num=$_POST["num"];

if ($action == "Modifier") {
    $req=$monPdo->prepare("update nationalite set libelle = :libelle, numContinent= :continent where num = :num");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':num', $num);
    $req->bindParam(':continent', $continent);
}else {
    $req=$monPdo->prepare("insert into nationalite(libelle, numContinent) values(:libelle, :continent)");
    $req->bindParam(':libelle', $libelle);
    $req->bindParam(':continent', $continent);
}
$nb=$req->execute();


?>

<main role="main" class="pt-3" style="margin-top: 4rem">
<div class="container mt-3">
    <?php
        $message = $action == "Modifier" ? "modifiée" : "ajoutée";
        if ($nb=1) {
            echo '<div class="alert alert-success col-md-3" role="alert">
            La nationalité a bien été '.$message.'
            </div>';
        }
        else {
            echo '<div class="alert alert-danger" role="alert">
            La nationalité n\'a pas bien été '.$message.' !
            </div>';
        }
    ?>
    <a href="listeNationalites.php" class='btn btn-primary'>Revenir à la liste</a>
</div>
</main>

<?php
include 'footer.php';
?>
