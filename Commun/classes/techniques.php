<?php

class Techniques{
    protected $id;
    protected $nom;
    protected $inventeur;
    protected $cout;
    protected $cooldown;
    protected $degats;
    protected $typeDegats;
    protected $conditions;
    protected $effet;
    protected $description;
    protected $carac;
    protected $color;

    public function __construct($array) {
        $this->nom = $array['nom'];
        $this->inventeur = $array['inventeur'];
        $this->cout = $array['cout'];
        $this->cooldown = $array['cooldown'];
        $this->degats = $array['degats'];
        $this->typeDegats = $array['typeDegats'];
        $this->conditions = $array['conditions'];
        $this->effet = $array['effet'];
        $this->description = $array['description'];
        $this->carac = $array['carac'];
        $this->color = $this->__loadColor();
    }

    private function __loadColor(){
        $array = [
            'force' => ['rgb(230, 86, 86)', '#000000'],
            'dextérité' => ['rgb(48, 138, 48)', '#000000'],
            'endurance' => ['#1b1b1b', '#ffffff'],
            'intelligence' => ['rgb(54, 45, 189)', '#ffffff'], 
            'charisme' => ['rgb(161, 87, 145)','#ffffff'],
            'dévotion' => ['rgb(224, 155, 52)', '#000000'],
            'sagesse' => ['#B2A4D4', '#000000']
        ];

        if(isset($array[strtolower($this->carac)])){
            return $array[strtolower($this->carac)];
        }
        else{
            return ["#1b1b1b", "#ffffff"];
        }
    }

    public function getId() {
        return $this->id;
    }
    
    public function getNom() {
        return $this->nom;
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

    public function displayTechnique(){
        
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
                    <div class='technique-card-front' style='background-color: ".$this->color[0]."';>
                        <p class='sort-name'>$this->nom</p>
                    </div>
                    <div class='sort-card-back' style='background-color: ".$this->color[0]."; color: ".$this->color[1]."'>
                        <div clas='card-p-container'>
                            <p>Créé par : $this->inventeur</p>
                            <p>Coût : $this->cout</p>
                            <p>Recharge : $this->cooldown</p>
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