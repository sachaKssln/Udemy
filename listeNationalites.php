<?php
include 'header.php';
include 'connexionPdo.php';
$req=$monPdo ->prepare('select * from nationalite');
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$lesNationalites=$req->fetchAll();

?>

<main role="main" class="pt-3" style="margin-top: 4rem">
<div class="container">
<div class="row">
<div class="col-9">

    <h2>
        liste nationalités
    </h2>
</div>
<div class="col-3"><a href="formNationalite.php?action=Ajouter" class='btn btn-success'><i class="fas fa-plus-circle"></i> Créer une nationalité</a></div>
</div>
<table class="table table-striped table-dark table-hover" >
  <thead>
    <tr class="d-flex">
      <th scope="col" class="col-md-2">Numéro</th>
      <th scope="col" class="col-md-8">Libellé</th>
      <th scope="col" class="col-md-2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach ($lesNationalites as $nationalite) {
            echo '<tr class="d-flex">';
            echo "<td class='col-md-2'>$nationalite->num</td>";
            echo "<td class='col-md-8'>$nationalite->libelle</td>";
            echo '<td class="col-md-2"><a href="formNationalite.php?action=Modifier&num='.$nationalite->num.'" class="btn btn-primary"><i class="fas fa-pen"></i></a>
            <a href="supprimerNationalite.php?num='.$nationalite->num.'" class="btn btn-danger"><i class="fas fa-trash"></i></a>
            
            </td>';
            echo '</tr>';
        }
    ?>
  </tbody>
</table>
</div>
</main>

<?php
include 'footer.php';
?>
