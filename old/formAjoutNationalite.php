<?php
include 'header.php';
?>

<main role="main" class="pt-3" style="margin-top: 4rem">
<div class="container mt-3">
<h2 class="text-center">
    Ajouter une nationalité
</h2>
    <form action="valideAjoutNationalite.php" method="POST" class="col-md-6 offset-md-3 border border-warning p-3 rounded">
    <div class="form-group">
        <label for="libelle">Libellé</label>
        <input type="text" placeholder="Saisir le libellé" name="libelle" id="libelle" class="form-control">

    </div>
    <div class="row">
        <div class="col"><a href="listeNationalites.php" class="btn btn-warning btn-block">Revenir à la liste</a></div>
        <div class="col"><button type="submit" class="btn btn-success btn-block">Ajouter</button></div>
    </div>
    </form>
</div>
</main>

<?php
include 'footer.php';
?>
