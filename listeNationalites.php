<?php
include 'header.php';
include 'connexionPdo.php';
$req=$monPdo ->prepare('select n.num, n.libelle as "libNation", c.libelle as "libContinent" from nationalite n, continent c where n.numContinent=c.num');
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$lesNationalites=$req->fetchAll();
if (!empty($_SESSION['message'])) {
  $mesMessages=$_SESSION['message'];
  foreach ($mesMessages as $key => $message) {
    echo '
    <div class="container pt-5">
    <div class="alert alert-'.$key.' alert-dismissible fade show" role="alert">'.$message.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  </div>';
  }
  $_SESSION['message']=[];
}
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
      <th scope="col" class="col-md-5">Libellé</th>
      <th scope="col" class="col-md-3">Continent</th>
      <th scope="col" class="col-md-2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
        foreach ($lesNationalites as $nationalite) {
            echo '<tr class="d-flex">';
            echo "<td class='col-md-2'>$nationalite->num</td>";
            echo "<td class='col-md-5'>$nationalite->libNation</td>";
            echo "<td class='col-md-3'>$nationalite->libContinent</td>";
            echo '<td class="col-md-2"><a href="formNationalite.php?action=Modifier&num='.$nationalite->num.'" class="btn btn-primary"><i class="fas fa-pen"></i></a>
            <a href="#modalDelete"  data-toggle="modal" data-message="Êtes vous sûr de vouloir supprimer la nationalité?" data-suppression="supprimerNationalite.php?num='.$nationalite->num.'" class="btn btn-danger"><i class="fas fa-trash"></i></a>
            
            </td>';
            //supprimerNationalite.php?num='.$nationalite->num.'
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
