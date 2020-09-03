<?php
include 'header.php';
include 'connexionPdo.php';
$libelle=$_POST["libelle"];

$req=$monPdo->prepare("insert into nationalite(libelle) values(:libelle)");
$req->bindParam(':libelle', $libelle);
$nb=$req->execute();

?>

<main role="main" class="pt-3" style="margin-top: 4rem">
<div class="container mt-3">
    <?php
        if ($nb=1) {
            echo '<div class="alert alert-success col-md-3" role="alert">
            La nationalité a bien été ajoutée
            </div>';
        }
        else {
            echo '<div class="alert alert-danger" role="alert">
            La nationalité n\'a pas bien été ajoutée !
            </div>';
        }
    ?>
    <a href="listeNationalites.php" class='btn btn-primary'>Revenir à la liste</a>
</div>
</main>

<?php
include 'footer.php';
?>
