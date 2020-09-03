<?php
include 'header.php';

$action=$_GET['action']; //soit ajouter ou modifier
if ($action == "Modifier") {
    $num=$_GET['num'];
    include 'connexionPdo.php';
    $req=$monPdo ->prepare('select * from nationalite where num= :num');
    $req->setFetchMode(PDO::FETCH_OBJ);
    $req->bindParam(':num', $num);
    $req->execute();
    $laNationalite=$req->fetch();
}
?>

<main role="main" class="pt-3" style="margin-top: 4rem">
<div class="container mt-3">
<h2 class="text-center">
    <?php echo $action?> une nationalité
</h2>
    <form action="valideFormNationalite.php?action=<?php echo $action?>" method="POST" class="col-md-6 offset-md-3 border border-warning p-3 rounded">
    <div class="form-group">
        <label for="libelle">Libellé</label>
        <input type="text" placeholder="Saisir le libellé" name="libelle" id="libelle" class="form-control" value="<?php if($action == "Modifier") {echo $laNationalite->libelle;}?>">

    </div>
    <input type="hidden" id="num" name="num" value="<?php if($action == "Modifier") {echo $laNationalite->num;} ?>">
    <div class="row">
        <div class="col"><a href="listeNationalites.php" class="btn btn-warning btn-block">Revenir à la liste</a></div>
        <div class="col"><button type="submit" class="btn btn-success btn-block"><?php echo $action?></button></div>
    </div>
    </form>
</div>
</main>

<?php
include 'footer.php';
?>
