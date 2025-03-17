<?php

require_once 'Commun/classes/sorts.php';
require_once 'Commun/classes/techniques.php';

class BasePersonnage {
    protected $id;
    protected $nom;
    protected $clan;
    protected $image;
    protected $description;
    protected $orientation;

    public function __construct($nom, $db) {
        $this->nom = $nom;
        $this->loadBaseAttributes($db);
    }

    protected function loadBaseAttributes($db) {
        $requete = $db->executeSQL('SELECT id, clan, image, description, orientation FROM personnages WHERE nom = ?', [$this->nom])[0];
        $this->clan = $requete['clan'];
        $this->image = $requete['image'];
        $this->description = nl2br($requete['description']);
        $this->orientation = $requete['orientation'];
        $this->id = $requete['id'];
    }

    public function getId() {
        return $this->id;
    }
    public function getNom() {
        return $this->nom;
    }

    public function getClan() {
        return $this->clan;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setClan($clan) {
        $this->clan = $clan;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}

class Personnage extends BasePersonnage {
    private $statistiques;
    private $maitrises;
    private $comps;
    private $metiers;
    private $sorts;
    private $techniques;

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

        $metiers = $db->executeSQL('SELECT * FROM metier WHERE nom = ?', [$this->nom])[0];
        unset($metiers['nom']);
        unset($metiers['id']);
        unset($metiers['modifiedAt']);
        unset($metiers['createdAt']);
        $this->metiers = $metiers;

        $sorts = $db->executeSQL('SELECT sorts.id, joueur, sorts.nom, core, inventeur, cout, cooldown, cast, degats, typeDegats, conditions, effet, description FROM sorts_par_joueurs JOIN sorts ON sorts_par_joueurs.sort = sorts.nom WHERE joueur = ?', [$this->nom]);
        $sortsArray = [];
        foreach ($sorts as $value) {
            array_push($sortsArray, new Sorts($value));
        }
        $this->sorts = $sortsArray;

        $techniques = $db->executeSQL('SELECT techniques.id, joueur, techniques.nom, inventeur, cout, cooldown, degats, typeDegats, conditions, effet, description, carac FROM techniques_par_joueurs JOIN techniques ON techniques_par_joueurs.technique = techniques.nom WHERE joueur = ?', [$this->nom]);
        $techniquesArray = [];
        foreach ($techniques as $value) {
            array_push($techniquesArray, new Techniques($value));
        }
        $this->techniques = $techniquesArray;
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

    public function getMetiers() {
        return $this->metiers;
    }

    public function setMetiers($metiers) {
        $this->metiers = $metiers;
    }

    public function getSorts() {
        return $this->sorts;
    }

    public function getTechniques(){
        return $this->techniques;
    }
}

class Joueurs extends Personnage {
    private $objets;
    private $feats;

    public function __construct($nom, $db) {
        parent::__construct($nom, $db);
        $this->loadObjets($db);	
        $this->loadFeats($db);
    }

    private function loadObjets($db){
        $this->objets = $db->executeSQL('SELECT objets.id, catégorie, rareté, objets.nom, poids, description FROM objets JOIN inventaires ON objets.nom = inventaires.nom WHERE appartenance = ?', [$this->nom])[0];
    }

    private function loadFeats($db){
        $this->feats = $db->executeSQL('SELECT nom, description, pallier, carac, feats_id FROM feats_for_players JOIN feats ON feats_for_players.feats_id = feats.nom WHERE players_id = ?', [$this->nom]);
    }

    public function getObjets() {
        return $this->objets;
    }

    public function getFeats() {
        return $this->feats;
    }
}

?>