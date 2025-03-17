<?php


class BaseMonstre {
    protected $nom;
    protected $image;
    protected $effet;
    protected $description;
    protected $id;
    protected $orientation;
    protected $visibility_effect;

    public function __construct($nom, $db) {
        $this->nom = $nom;
        $this->loadBaseAttributes($db);
    }

    protected function loadBaseAttributes($db) {
        $requete = $db->executeSQL('SELECT id, visibility_effect, image, effet, description, orientation FROM monstres WHERE nom = ?', [$this->nom])[0];
        $this->effet = nl2br($requete['effet']);
        $this->image = $requete['image'];
        $this->description = nl2br($requete['description']);
        $this->id = $requete['id'];
        $this->orientation = strtolower($requete['orientation']);
        $this->visibility_effect = $requete['visibility_effect'];
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEffet() {
        return $this->effet;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setEffet($effet) {
        $this->effet = $effet;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getVisibility_effect() {
        return $this->visibility_effect;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}

class Monstre extends BaseMonstre {
    private $statistiques;
    private $maitrises;
    private $comps;

    public function __construct($nom, $db) {
        parent::__construct($nom, $db);
        $this->loadAdvancedAttributes($db);
    }

    private function loadAdvancedAttributes($db) {
        $stats = $db->executeSQL('SELECT * FROM stats WHERE nom = ?', [$this->nom])[0];
        $force = ["force" => $stats['strength']];
        $stats = $force + $stats;
        unset($stats['strength']);
        unset($stats['nom']);
        unset($stats['id']);
        unset($stats['modifiedAt']);
        unset($stats['createdAt']);

        $this->statistiques = $stats;

        $maitrises = $db->executeSQL('SELECT * FROM maitrise WHERE nom = ?', [$this->nom])[0];
        unset($maitrises['nom']);
        unset($maitrises['id']);
        unset($maitrises['modifiedAt']);
        unset($maitrises['createdAt']);
        $this->maitrises = $maitrises;

        $comps = $db->executeSQL('SELECT * FROM compétences WHERE nom = ?', [$this->nom])[0];
        unset($comps['nom']);
        unset($comps['id']);
        unset($comps['modifiedAt']);
        unset($comps['createdAt']);
        $this->comps = $comps;
    }

    public function getStatistiques() {
        return $this->statistiques;
    }

    public function setStatistiques($statistiques) {
        $this->statistiques = $statistiques;
    }

    public function getMaitrises() {
        return $this->maitrises;
    }

    public function setMaitrises($maitrises) {
        $this->maitrises = $maitrises;
    }

    public function getComps() {
        return $this->comps;
    }

    public function setComps($comps) {
        $this->comps = $comps;
    }
}
?>