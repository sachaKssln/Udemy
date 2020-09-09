<?php
include 'header.php';
include 'connexionPdo.php';

$libelle="";
$continentSel="tous";

$texteReq = 'select n.num, n.libelle as "libNation", c.libelle as "libContinent" from nationalite n, continent c where n.numContinent=c.num';
if (!empty($_GET)) {
  $libelle=$_GET['libelle'];
  $continentSel=$_GET['continent'];
  if ($libelle != "") {
    $texteReq .= " and n.libelle like '%".$libelle."%'";
  }
  if ($_GET['continent'] != "Tous") {
    $continentSel .= " and c.num =".$continentSel;
  }
}
$req=$monPdo ->prepare($texteReq);
$req->setFetchMode(PDO::FETCH_OBJ);
$req->execute();
$lesNationalites=$req->fetchAll();

$reqContinent=$monPdo ->prepare('select * from continent');
$reqContinent->setFetchMode(PDO::FETCH_OBJ);
$reqContinent->execute();
$lesContinents=$reqContinent->fetchAll();

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
  <form action="" method="get" class="border border-primary rounded p-3">
    <div class="row">
      <div class="col">
      <input type="text" placeholder="Saisir le libellé" name="libelle" id="libelle" class="form-control" value="<?php echo $libelle ?>">
      </div>
      <div class="col">
      <select name="continent" class="form-control">
        <?php
            echo "<option value='tous'>Tous les continents</option>";
            foreach ($lesContinents as $continent) {
                $selection=$continent->num == $continentSel ? 'selected' : '';
                echo "<option value='".$continent->num."' ".$selection.">".$continent->libelle."</option>";
            }
            ?>
        </select>
      </div>
      <div class="col">
            <input type="submit" class="btn btn-success btn-block"></button>
      </div>
    </div>
  </form>
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
