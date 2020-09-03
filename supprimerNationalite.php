<?php
include 'header.php';
include 'connexionPdo.php';
$num=$_GET['num'];

    $req=$monPdo->prepare("delete from nationalite where num = :num");
    $req->bindParam(':num', $num);
    $nb=$req->execute();


?>

<main role="main" class="pt-3" style="margin-top: 4rem">
<div class="container mt-3">
    <?php
        $message = $action == "Modifier" ? "modifiée" : "ajoutée";
        if ($nb=1) {
            echo '<div class="alert alert-success col-md-3" role="alert">
            La nationalité a bien été suprimée
            </div>';
        }
        else {
            echo '<div class="alert alert-danger" role="alert">
            La nationalité n\'a pas bien été suprimée !
            </div>';
        }
    ?>
    <a href="listeNationalites.php" class='btn btn-primary'>Revenir à la liste</a>
</div>
</main>

<?php
include 'footer.php';
?>
