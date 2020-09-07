<?php
class Nationalite{
    /**
     * numero du nationalité
     *
     * @var int
     */
    private $num;
    /**
     * nom du nationalité
     *
     * @var string
     */
    private $libelle;
    
    /**
     * num nationalite (clé étrangère) relié à num de Nationalite
     *
     * @var int
     */
    private $numContinent;
    
    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->num;
    }

    /**
     * lit le libellé
     *
     * @return string
     */
    public function getLibelle() : string
    {
        return $this->libelle;
    }

   /**
    * écrit dans le libellé
    *
    * @param string $libelle
    * @return self
    */
    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * renvoie l'objet continent associé
     *
     * @return Continent
     */
    public function getNumContinent() : Continent
    {
        return Continent::findById($this->numContinent);
    }

    /**
     * ecrit le num continent
     *
     * @param Continent $continent
     * @return self
     */
    public function setNumContinent(Continent $continent) : self
    {
        $this->numContinent = $continent->getNum();

        return $this;
    }
    /**
     * Retourne l'ensemble des nationalites
     *
     * @return Nationalite[] tableau d'objet nationalite
     */
    public static function findAll() :array
    {
        $req=MonPdo::getInstance()->prepare('select n.num, n.libelle as "libNation", c.libelle as "libContinent" from nationalite n, continent c where n.numContinent=c.num');
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * Trouve un nationalite par son num
     *
     * @param integer $id numéro du nationalite
     * @return Nationalite objet nationalite trouver
     */
    public static function findById(int $id) :Nationalite
    {
        $req=MonPdo::getInstance()->prepare("Select * from nationalite where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Nationalite');
        $req->bindParam(':id', $id);
        $req->execute();
        $lesResultats=$req->fetch();
        return $lesResultats;
    }

    /**
     * Permet d'ajouter un nationalite
     *
     * @param Nationalite $nationalite nationalite à ajouter
     * @return integer resultat (1 si l'opération a réussi, 0 sinon)
     */
    public static function add(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into nationalite(libelle,numContinent) values(:libelle, :numContinent)");
        $req->bindParam(':libelle', $nationalite->getLibelle());
        $req->bindParam(':numContinent', $nationalite->getNumContinent());
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de modifier un nationalite
     *
     * @param Nationalite $nationalite nationalite à modifier
     * @return integer resultat (1 si l'opération a réussi, 0 sinon)
     */
    public static function update(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id");
        $req->bindParam(':id', $nationalite->getNum());
        $req->bindParam(':libelle', $nationalite->getLibelle());
        $req->bindParam(':numContinent', $nationalite->getNumContinent());
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de supprimer un nationalite
     *
     * @param Nationalite $nationalite
     * @return integer
     */
    public static function delete(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id");
        $req->bindParam(':id', $nationalite->getNum());
        $nb=$req->execute();
        return $nb;
    }

    
}


?>