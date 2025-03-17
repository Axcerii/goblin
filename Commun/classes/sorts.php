<?php

class Sorts{
    protected $id;
    protected $nom;
    protected $core;
    protected $inventeur;
    protected $cout;
    protected $cooldown;
    protected $cast;
    protected $degats;
    protected $typeDegats;
    protected $conditions;
    protected $effet;
    protected $description;
    protected $color;

    public function __construct($array) {
        $this->nom = $array['nom'];
        $this->core = $array['core'];
        $this->inventeur = $array['inventeur'];
        $this->cout = $array['cout'];
        $this->cooldown = $array['cooldown'];
        $this->cast = $array['cast'];
        $this->degats = $array['degats'];
        $this->typeDegats = $array['typeDegats'];
        $this->conditions = $array['conditions'];
        $this->effet = $array['effet'];
        $this->description = $array['description'];
        $this->color = $this->__trouverCouleur($this->core);
    }

    private function __trouverCouleur($chaine) {
        $tableauCouleurs = [
            'feu' => ["#ba3434", "#000000"],
            'eau' => ["#01b8bf", "#000000"],
            'air' => ["#64ea78", '#000000'],
            'divin' => ["#c6a119", '#000000'],
            'foudre' => ["#4258af", '#ffffff'],
            'nature' => ["#25562b", '#ffffff']
        ];
        foreach ($tableauCouleurs as $mot => $couleur) {
            if (strpos(strtolower($chaine), strtolower($mot)) !== false) {
                return $couleur;
            }
        }
    
        return ['#1b1b1b', '#ffffff'];
    }
    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getCore() {
        return $this->core;
    }
    
    public function getInventeur() {
        return $this->inventeur;
    }
    
    public function getCout() {
        return $this->cout;
    }
    
    public function getCooldown() {
        return $this->cooldown;
    }
    
    public function getCast() {
        return $this->cast;
    }
    
    public function getDegats() {
        return $this->degats;
    }
    
    public function getTypeDegats() {
        return $this->typeDegats;
    }
    
    public function getConditions() {
        return $this->conditions;
    }
    
    public function getEffet() {
        return $this->effet;
    }
    
    public function getDescription() {
        return $this->description;
    }

    public function getAll(){
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'core' => $this->core,
            'inventeur' => $this->inventeur,
            'cout' => $this->cout,
            'cooldown' => $this->cooldown,
            'cast' => $this->cast,
            'degats' => $this->degats,
            'typeDegats' => $this->typeDegats,
            'conditions' => $this->conditions,
            'effet' => $this->effet,
            'description' => $this->description
        ];
    }

    public function displaySort(){
        
            $premiereLettre = strtolower($this->typeDegats[0]);
            $voyelles = ['a', 'e', 'i', 'o', 'u', 'y'];
        
            if (in_array($premiereLettre, $voyelles)) {
                $article = "d'";
            } else {
                $article = "de";
            }

        echo "
            <div class='sort-card'>
                <div class='sort-card-inner'>
                    <div class='sort-card-front' style='background-color: ".$this->color[0].";'>
                        <p class='sort-name'>$this->nom</p>
                    </div>
                    <div class='sort-card-back' style='background-color: ".$this->color[0]."; color: ".$this->color[1]."'>
                        <div class='card-p-container'>
                            <p>$this->core</p>
                            <p>Créé par : $this->inventeur</p>
                            <p>Coût : $this->cout</p>
                            <p>Recharge : $this->cooldown</p>
                            <p>Cast : $this->cast</p>
                            <p>Dégâts : $this->degats $article $this->typeDegats</p>
                            <br>
                            <p>Condition : $this->conditions</p>
                            <br>
                            <p>Effet : $this->effet</p>
                            <br>
                            <p>Description : $this->description</p>
                        </div>
                    </div>
                </div>
            </div>";
    }
}

?>