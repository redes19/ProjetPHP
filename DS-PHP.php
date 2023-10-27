<?php
// creat a class personnage with attribut
class Personnage {
    // we use protected for better accessibility for children
    protected $name;
    protected $damage;
    protected $mana = 0;
    protected $hp;
    private $maxHealth;
    private $molecularAttack = false;

    protected $isDefending = false;

    public function __construct($N, $D, $H){
        $this->name = $N;
        $this->damage = $D;
        $this->hp = $H;
        $this->maxHealth = $H;
    }

    // creat a getter and setter
    public function getName(){
        return $this->name;
    }
    public function getDamage(){
        return $this->damage;
    }
    public function getMana(){
        return $this->mana;
    }
    public function getHp(){
        return $this->hp;
    }
    public function getIsDefending(){
        return $this->isDefending;
    }
    public function getMaxHealth(){
        return $this->maxHealth;
    }
    public function getMolecularAttack(){
        return $this->molecularAttack;
    }
    
    public function setName($newName){
        $this->name = $newName;
    }
    public function setDamage($newDamage){
        $this->damage = $newDamage;
    }
    public function setMana($newMana){
        $this->mana = $newMana;
    }
    public function setHp($newHp){
        $this->hp = $newHp;
    }
    public function setIsDefending($newisDefending){
        $this->isDefending = $newisDefending;
    }
    public function setMaxHealth($m){
        $this->maxHealth = $m;
    }
    public function setMolecularAttack($bool){
        $this->molecularAttack = $bool;
    }
}

class Hero extends Personnage{
    private $level = 0;
    private $xp = 0 ;
    private $dragonBall = 0;
    private $powerList = [];

    public function __construct($N, $D, $H){
        parent::__construct($N, $D, $H);
    }

    public function getLevel(){
        return $this->level;
    }
    public function getXp(){
        return $this->xp;
    }
    public function getDragonBall(){
        return $this->dragonBall;
    }
    public function getPowerList(){
        return $this->powerList;
    }

    public function setLevel($newLevel){
        $this->level = $newLevel;
    }
    public function setXp($newXp){
        $this->xp = $newXp;
    }
    public function setDragonBall($newDragonBall){
        $this->dragonBall = $newDragonBall;
    }
    public function setPowerList($p){
        $this->powerList = $p;
    }

    public function addPower($p){
        array_push($this->powerList, $p);
    }
}

class Villain extends Personnage{

    public function __construct($N, $D, $H){
        parent::__construct($N, $D, $H);
    }
}

class DragonBallQuestManager{
    private $collectionQuest = [];

    public function getCollectionQuest(){
        return $this->collectionQuest;
    }
    public function getIdIndex(){
        return $this->idIndex;
    }

    public function setCollectionQuest($c){
        $this->collectionQuest = $c;
    }
    public function addQuest($q){
        array_push($this->collectionQuest, $q);
    }
}

class DragonBallQuest {
    private $title;
    private $description;
    private $enemy1;
    private $enemy2;
    private $enigma;

    public function __construct($t, $d, $e1, $e2, $e){
        $this->title = $t;
        $this->description = $d;
        $this->enemy1 = new Villain ($e1[0], $e1[2], $e1[1]);
        $this->enemy2 = new Villain ($e2[0], $e2[2], $e2[1]);
        $this->enigma = $e;
    }

    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }

    public function getEnemy1(){
        return $this->enemy1;
    }
    public function getEnemy2(){
        return $this->enemy2;
    }
    public function getEnigma(){
        return $this->enigma;
    }

    public function setTitle($t){
        $this->title = $t;
    }
    public function setDescription($d){
        $this->description = $d;
    }
    public function setEnemy1($e){
        $this->enemy1 = $e;
    }
    public function setEnemy2($e){
        $this->enemy2 = $e;
    }
    public function setEnigma($e){
        $this->enigma = $e;
    }
}

class Question{
    private $question;
    private $option = [];
    private $goodOption;

    public function __construct($Q, $O, $GO){
        $this->question = $Q;
        $this->option = $O;
        $this->goodOption = $GO;
    }

    public function getQuestion(){
        return $this->question;
    }
    public function getOption(){
        return $this->option;
    }
    public function getGoodOption(){
        return $this->goodOption;
    }

    public function setQuestion($newquestion){
        $this->question = $newquestion;
    }
    public function setOption($newOption){
        $this->option = $newOption;
    }
    public function setGoodOption($newGoodOption){
        $this->goodOption = $newGoodOption;
    }

}

class GraphicalManager{
    private $game;
    public function __construct($g){
        $this->game = $g;
    }
    function hideCursor($stream = STDOUT) {
        fprintf($stream, "\033[?25l"); // hide cursor
        register_shutdown_function(function() use($stream) {
            fprintf($stream, "\033[?25h"); //show cursor
        });
    }

function gameStartScreen(){
        popen("cls","w");
        $string = "
    _____________________________________________________________________________________________________________________________________________
    |⠀⠀⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⣷⣶⣤⣄⡀⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀                                                                
    |⠀⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠸⣿⣿⣿⣿⣷⡒⢄⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀                                                                 
    |⠀⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢹⣿⣿⣿⣿⣿⣆⠙⡄⠀⠐⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀                                                                 
    |⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⣤⣤⣤⣤⣤⣤⣤⣤⣤⠤⢄⡀⠀⠀⣿⣿⣿⣿⣿⣿⡆⠘⡄⠀⡆⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀                                                               
    |⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠈⠙⢿⣿⣿⣿⣿⣿⣿⣿⣦⡈⠒⢄⢸⣿⣿⣿⣿⣿⣿⡀⠱⠀⡇⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀                                                             
    |⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠻⣿⣿⣿⣿⣿⣿⣿⣦⠀⠱⣿⣿⣿⣿⣿⣿⣇⠀⢃⡇⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀                                                               
    |⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠘⢿⣿⣿⣿⣿⣿⣿⣷⡄⣹⣿⣿⣿⣿⣿⣿⣶⣾⣿⣶⣤⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀                                                               
    |⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣀⣀⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⡀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀                                                              
    |⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⢀⣠⣴⣶⣿⣭⣍⡉⠙⢻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
    |⠀⠀   ⠀⠀⠀⠀⠀⢀⣠⣶⣿⣿⣿⣿⣿⣿⣿⣿⣷⣦⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
    |⠀⠀   ⠀⠀⠀⠀⠀⠉⠉⠛⠻⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡷⢂⣓⣶⣶⣶⣶⣤⣤⣄⣀⠀⠀⠀⠀⠀⠀⠀⠀        
    |⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠙⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⢿⣿⣿⣿⠟⢀⣴⢿⣿⣿⣿⠟⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠿⠛⠋⠉⠀⠀⠀⠀⠀⠀⠀  ⠀⠀  ⠀⠀      ⠀⠀     EXAMEN PHP POO
    |⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠤⠤⠤⠤⠙⣻⣿⣿⣿⣿⣿⣿⣾⣿⣿⡏⣠⠟⡉⣾⣿⣿⠋⡠⠊⣿⡟⣹⣿⢿⣿⣿⣿⠿⠛⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀       ⠀⠀  ⠀⠀  ⠀⠀    ‾‾‾‾‾‾‾‾‾‾‾‾‾‾
    |⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⢀⣠⣤⣶⣤⣭⣤⣼⣿⢛⣿⣿⣿⣿⣻⣿⣿⠇⠐⢀⣿⣿⡷⠋⠀⢠⣿⣺⣿⣿⢺⣿⣋⣉⣉⣩⣴⣶⣤⣤⣄⠀⠀⠀⠀⠀⠀⠀⠀
    |⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠉⠛⠻⠿⣿⣿⣿⣇⢻⣿⣿⡿⠿⣿⣯⡀⠀⢸⣿⠋⢀⣠⣶⠿⠿⢿⡿⠈⣾⣿⣿⣿⣿⡿⠿⠛⠋⠁⠀⠀⠀⠀⠀⠀⠀⠀⠀    ⠀⠀  ⠀⠀    ⠀⠀    DEVOIR FAIT PAR 
    |⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠙⠻⢧⡸⣿⣿⣿⠀⠃⠻⠟⢦⢾⢣⠶⠿⠏⠀⠰⠀⣼⡇⣸⣿⣿⠟⠉⠀⠀⢀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀   
    |⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⣴⣾⣶⣽⣿⡟⠓⠒⠀⠀⡀⠀⠠⠤⠬⠉⠁⣰⣥⣾⣿⣿⣶⣶⣷⡶⠄⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀  ⠀⠀  ⠀⠀  LORIS LAURENTI ET MAXIME BEERNAERT
    |⠀⠀⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠉⠉⠉⠉⠹⠟⣿⣿⡄⠀⠀⠠⡇⠀⠀⠀⠀⠀⢠⡟⠛⠛⠋⠉⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
    |⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣠⠋⠹⣷⣄⠀⠐⣊⣀⠀⠀⢀⡴⠁⠣⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
    |⠀⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣀⣤⣀⠤⠊⢁⡸⠀⣆⠹⣿⣧⣀⠀⠀⡠⠖⡑⠁⠀⠀⠀⠑⢄⣀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
    |⠀   ⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⣰⣦⣶⣿⣿⣟⣁⣤⣾⠟⠁⢀⣿⣆⠹⡆⠻⣿⠉⢀⠜⡰⠀⠀⠈⠑⢦⡀⠈⢾⠑⡾⠲⣄⠀⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
    |⠀   ⠀⠀⠀⠀⠀⠀⠀⣀⣤⣶⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⡿⠖⠒⠚⠛⠛⠢⠽⢄⣘⣤⡎⠠⠿⠂⠀⠠⠴⠶⢉⡭⠃⢸⠃⠀⣿⣿⣿⠡⣀⠀⠀⠀⠀⠀⠀⠀⠀⠀
    |   ⠀⠀⠀⠀⠀⡤⠶⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣋⠁⠀⠀⠀⠀⠀⢹⡇⠀⠀⠀⠀⠒⠢⣤⠔⠁⠀⢀⡏⠀⠀⢸⣿⣿⠀⢻⡟⠑⠢⢄⡀⠀⠀⠀⠀                      press enter_
    |   ⠀⠀⠀⠀⢸⠀⠀⠀⡀⠉⠛⢿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣄⣀⣀⡀⠀⢸⣷⡀⣀⣀⡠⠔⠊⠀⠀⢀⣠⡞⠀⠀⠀⢸⣿⡿⠀⠘⠀⠀⠀⠀⠈⠑⢤⠀⠀
    |⠀⠀   ⢀⣴⣿⡀⠀⠀⡇⠀⠀⠀⠈⣿⣿⣿⣿⣿⣿⣿⣿⣝⡛⠿⢿⣷⣦⣄⡀⠈⠉⠉⠁⠀⠀⠀⢀⣠⣴⣾⣿⡿⠁⠀⠀⠀⢸⡿⠁⠀⠀⠀⠀⠀⠀⠀⠀⡜⠀⠀
    |   ⠀⢀⣾⣿⣿⡇⠀⢰⣷⠀⢀⠀⠀⢹⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣶⣦⣭⣍⣉⣉⠀⢀⣀⣤⣶⣾⣿⣿⣿⢿⠿⠁⠀⠀⠀⠀⠘⠀⠀⠀⠀⠀⠀⠀⠀⠀⡰⠉⢦⠀
    |   ⢀⣼⣿⣿⡿⢱⠀⢸⣿⡀⢸⣧⡀⠀⢿⣿⣿⠿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⡭⠖⠁⠀⡠⠂⠀⠀⠀⠀⠀⠀⠀⠀⢠⠀⠀⠀⢠⠃⠀⠈⣀
    |   ⢸⣿⣿⣿⡇⠀⢧⢸⣿⣇⢸⣿⣷⡀⠈⣿⣿⣇⠈⠛⢿⣿⣿⣿⣿⣿⣿⠿⠿⠿⠿⠿⠿⠟⡻⠟⠉⠀⠀⡠⠊⠀⢠⠀⠀⠀⠀⠀⠀⠀⠀⣾⡄⠀⢠⣿⠔⠁⠀⢸
    |   ⠈⣿⣿⣿⣷⡀⠀⢻⣿⣿⡜⣿⣿⣷⡀⠈⢿⣿⡄⠀⠀⠈⠛⠿⣿⣿⣿⣷⣶⣶⣶⡶⠖⠉⠀⣀⣤⡶⠋⠀⣠⣶⡏⠀⠀⠀⠀⠀⠀⠀⢰⣿⣧⣶⣿⣿⠖⡠⠖⠁
    |   ⠀⣿⣿⣷⣌⡛⠶⣼⣿⣿⣷⣿⣿⣿⣿⡄⠈⢻⣷⠀⣄⡀⠀⠀⠀⠈⠉⠛⠛⠛⠁⣀⣤⣶⣾⠟⠋⠀⣠⣾⣿⡟⠀⠀⠀⠀⠀⠀⠀⠀⣿⣿⣿⣿⣿⠷⠊⠀⢰⠀
    |   ⢰⣿⣿⠀⠈⢉⡶⢿⣿⣿⣿⣿⣿⣿⣿⣿⣆⠀⠙⢇⠈⢿⣶⣦⣤⣀⣀⣠⣤⣶⣿⣿⡿⠛⠁⢀⣤⣾⣿⣿⡿⠁⠀⠀⠀⠀⠀⠀⠀⣸⣿⡿⠿⠋⠙⠒⠄⠀⠉⡄
    |   ⣿⣿⡏⠀⠀⠁⠀⠀⠀⠉⠉⠙⢻⣿⣿⣿⣿⣷⡀⠀⠀⠀⠻⣿⣿⣿⣿⣿⠿⠿⠛⠁⠀⣀⣴⣿⣿⣿⣿⠟⠀⠀⠀⠀⠀⠀⠀⠀⢠⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠰
    |
    ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾";
        echo $string;
        readline();
        // $this->fightScreen();
}
function fightScreen($text){
        popen("cls","w");
        $string = "    _______________________________________________________________________________________________________________________________________________________
     
    #########################################(                                                                            ,#%          ,%#%                                  
                                           ,/&%                                                                      *((((//(#@      *,#%**%                                \n             ";   
        $string .= $this->game->getCurrentEnemy()->getName();
        for($i=0;$i<=(30-(strlen($this->game->getCurrentEnemy()->getName())));$i++){
            $string .= " ";
        }
        $string .= ",&#                                                                    .#///////((#(&    .%/*,,*#                                
                                            ,&#                                                                    .(/////((%#((&    .#,*#                                   
                HP : ";
        $string .= $this->game->getCurrentEnemy()->getHp();
        for($i=0;$i<=(22-(strlen($this->game->getCurrentEnemy()->getHp())));$i++){
            $string .= " ";
        }
        $string .= ".&#                                                                    .(/#**/& #((@  .,./  ,                                    
                                            .&#                                                                      *,,((/*%#/,,,  ,**%*                                    
                Mana : ";
    
        $string .= $this->game->getCurrentEnemy()->getMana();
        for($i=0;$i<=(19-(strlen($this->game->getCurrentEnemy()->getMana())));$i++){
            $string .= " ";
        }
        $string .= ".#.&#                                                                    .*/, &&/*#,  ,/%,(                                        
                                          . */,&#                                                           /,#./(   (*.,  .      &                                            
                                          .,/&###/                                                        .,*,*&,  *,.,.        .&                                            
    ##############################################(                                                      .*/#@*,.*,.*@*        .&                                            
    #################################################(                                                        .#,//&  .,        &                                            
                                                                                                                     .,.   ,,,  **                                          
                                                                                            ,.,    ,    .,,,,,  ,,,,#///#(*/**/(&#,,  ,,,,,    .,  . ,                      
                                                                                . ,.,.,,  ,,,    ,  ,            .%(////%/,@(///(@            ,,  ,    *,,  
                                                                          .,,,.,,,                              .(/(/*#@   .(%*/(/@              .          
                                                                   ,,,,                      .                 *&&(##@      @(#(#(&                         
                         .@%#@@@.#,                            .,,,,,        ,  .,  .,              .,  ,  ,,  ,%(((&,      .@(((%#  ,,  ,.,,              
                      .&&&####&&#&&%#@                         .,,,,,,                                          .&&&%##,      .%##%%&/                                      
                    .(#&#((#(##(((#######&%/                    .,,,,,,  .,                    ,  .,           ((*#%*,         /#%**(           ,  .,                      
                   /&%%###########%%,,,./%*,                       .,,,,,,,,,.,,  .,        .,  .,                                                ,  .,      
                   .@@%###########%,    .,                                 .,,,,,,,,,,,.,,,.,,,      .,    ,,      ,,  ,,      ,,  ,,      ,    .,      .,,
                   @&#########%@/%#  , @//                                         .,,,,,,,,,,,,,,,,,,,,  ,,,,.,,,,,,,,,,,,,,,,,,,,,,.,,,,  ,,,,,,,,,,,,,,,      
                   .@@%#####%%&*%@%%    .,,                                                        ,,,,,,,,,,,,,,,,(#%&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                   .*%@&###@@%&*#@@%     ,,                                                                       /%%                                                 
                       %@@@@@@@@%%%,    *                                                                          (&.                   
                       .@@@@@@@@(*/%@%@##                                                                           (&.      ";
    
        $string .= $this->game->getPlayer()->getName() ."\n                         .%////(/**@,,,,                                                                            .(&.            
                   .((%&%***/**/(/**##%%/,                                                                          .(&.        HP : " . $this->game->getPlayer()->getHp() ."
                 .@,**,(%%%%%%%%%%%%%/      *                                                                       .(&.         
               . (*/#(*%%%%%%%%%%%%./,/,    . @                                                                     .(&.        Mana : " . $this->game->getPlayer()->getMana() ."
               .#/**/(*%%%%%%%%%%%%./,,%%%(%*,*(                                                                    .(&.                                                 
             .*(/////((%%%%%%%%%%%%%*/*/#*(%(%,*#                                                                   (&.                                                 
              .(*///// /&%%%%%%%%%%%%%%/*#@#,,,,    &*                                                             *(#&*                                                 
            ,@**/////   (%%%%%%%%%%%%%%%%%%&&/,,,,    #/                                                     .(###########**,#*#//,*########################
         ,%/(//***&/   ,%%%%%%%%%%%%%%%%%%#,*%*,,,,,/*(                                                /##############,,,#*(/*((###(((((((((((((((((((((((((
    ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
                                                                                                            \n                                  ";
        $string .= $text[0];
        for($i=0;$i<=(68-(strlen($text[0])));$i++){
            $string .= " ";
        }
        
        for($j=0; $j<(count($text)-1);$j++){
            $string .= "                                                                  
                                                                                                             
                                       ";
            $string .= ($j+1) . ". " . $text[$j+1];
            for($i=0;$i<=(60-(strlen($text[$j+1])));$i++){
                $string .= " ";
            }
            
        }
        $string .= "     
                                                                                                            ";

    echo $string;
}
}

class Power {
    private $title;
    private $description;
    private $ingameDescription;
    private $manaCost;

    public function __construct($t,$d, $igD,$m){
        $this->title = $t;
        $this->description = $d;
        $this->ingameDescription = $igD;
        $this->manaCost = $m;
    }

    public function getTitle(){
        return $this->title;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getIngameDescription(){
        return $this->ingameDescription;
    }
    public function getManaCost(){
        return $this->manaCost;
    }

    public function setTitle($t){
        $this->title = $t;
    }
    public function setDescription($d){
        $this->description = $d;
    }
    public function setIngameDescription($igD){
        $this->ingameDescription = $igD;
    }
    public function setManaCost($m){
        $this->manaCost = $m;
    }
}

class Game {
    private $player;
    private $dragonBallQuestManager ;
    private $currentEnemy = null;
    private $graphicalManager;
    private $collectionPower = [];

    public function __construct(){
        $this->dragonBallQuestManager = new DragonBallQuestManager;
        $this->graphicalManager = new GraphicalManager($this);
        $this->graphicalManager->hideCursor();
        $this->launchGame();
    }

    public function getPlayer(){
        return $this->player;
    }
    public function getCurrentEnemy(){
        return $this->currentEnemy;
    }
    
    public function stringBuffer($string){
        ob_start();
        $buffer = str_repeat("", 1); // fill the buffer

        $len = strlen($string);
        $sleep = 1; // sleep between output chars

        for($i=0; $i < $len; $i++) {
            echo $buffer . $string[$i];
            ob_flush();
            flush();
            usleep($sleep);
        }
        ob_end_clean();
    }

    public function launchGame(){
        $this->createQuests();
        $this->createEnemies();
        $this->createPower();

        $this->graphicalManager->gameStartScreen();

        //choose between start new game, launch a save, and close game
        popen("cls","w");
        echo "\n\n\n\n\n                                                                          ";
        $string = "Welcome ingame\n"; 
        $this->stringBuffer($string);
        echo "\n\n\n\n\n                                                          1. Create a new Hero to get the 7 Dragon Balls\n\n\n\n                                                                          2. Load a save\n\n\n\n                                                                           3. Quit Game\n\n\n\n";
        $choice = readline("\n\n                                                                               ");
        switch($choice){
            case 1 : 
                return $this->createPlayer();
                break;
            case 2 :
                return $this->loadGame();
                break;
            case 3 : 
                return $this->quitGame();
                break;
        }
    }    

    // ----- LAUNCH A NEW FILE GAME
    public function createQuests(){
        $title = [
            "The Mystical Adventure of the Dragon Ball of Earth",
            "The Celestial Pursuit of the Dragon Ball of Namek",
            "The Fiery Odyssey for the Dragon Ball of Fire",
            "The Aquatic Expedition to Retrieve the Dragon Ball of Water",
            "The Ethereal Journey for the Dragon Ball of the Sky",
            "The Shadowy Quest for the Dragon Ball of Darkness",
            "The Celestial Challenge to Claim the Dragon Ball of the Stars"
        ];
        $description = [
            "Legend has it that the first Dragon Ball, scattered across the vast plains of Earth, grants its bearer one wish when all seven are united. Follow the path of ancient scrolls and prophecies, decipher riddles, and overcome treacherous terrain to unearth this first relic, protected by nature's secrets and guarded by cunning creatures.",
            "In the cosmic expanse of Namek, where mystical energies converge, a single Dragon Ball hides, shrouded by the mysteries of a distant world. Brave the perils of this alien landscape, navigate through the perilous rifts of power struggles, and unlock the key to this sacred artifact, guarded fiercely by intergalactic forces.",
            "As whispers of a Dragon Ball enshrouded in flames spread, embark on an expedition across scorching deserts and volcanic wastelands. Dodge fiery tempests and face trials of resilience, for this fiery orb is said to be guarded by a mythical beast, its rage rivaling the intensity of the sun itself.",
            "Dive deep into the depths of the boundless ocean, where an ancient aquatic civilization protects a Dragon Ball hidden in the abyssal trenches. Confront colossal sea creatures, master the forces of the tides, and unveil the secrets of this liquid gem, rumored to grant unimaginable powers to the one who claims it.",
            "Ascend to the lofty heights of ethereal peaks, where clouds and thunderstorms guard the ethereal Dragon Ball. Traverse through gusty winds and surmount the tests of aerial prowess, as ancient winged guardians challenge those who dare to reach for this elusive relic, promising unparalleled dominion over the heavens.",
            "Venture into the heart of the realm of shadows, where darkness consumes all light and an enigmatic Dragon Ball lies concealed. Confront malevolent entities and unravel the enigmas of the night, for this sinister sphere bestows unimaginable power to those who can harness its ominous energies.",
            "Across the boundless cosmic void, seek the elusive Dragon Ball hidden within the constellations. Maneuver through asteroid belts and navigate celestial bodies, as the ancient guardians of the cosmos test the mettle of the intrepid adventurer, offering the chance to mold destiny itself with the wish-granting power of the stars."
        ];
        $enemies = $this->createEnemies();
        $enigmas = $this->createEnigmas();
        for($i=1;$i<=7;$i++){
            $quest = new DragonBallQuest($title[$i-1], $description[$i-1], $enemies[(2*$i)-2], $enemies[(2*$i)-1], $enigmas[$i-1]);
            $this->dragonBallQuestManager->addQuest($quest);
        }

    }

    // CREATE ENEMIES
    public function createEnemies(){
        $enemies = [
            ["Freezer", 10, 10, "Téléportation"],
            ["Cellule", 10, 10, "Kienzan"],
            ["Majin Buu", 10, 10, "Taiyoken"],
            ["Vegeta", 10, 10, "Kamehameha"],
            ["Napa", 10, 10, "Makankosappo"],
            ["Raditz", 10, 10, "Vol"],
            ["Broly", 10, 10, "Ultimate Gohan"],
            ["Glacière", 10, 10, "glace"],
            ["Dr Gero", 10, 10, "hypnose"],
            ["Zamasu", 10, 10, "Saut dans le temps"],
            ["Babidi", 10, 10, "power"],
            ["Dabura", 10, 10, "Vol"],
            ["Ail Jr.", 10, 10, "hypnose"],
            ["Turles", 10, 10, "absorption d'énergie"],
            ["Capitaine Ginyu", 10, 10, "absorption d'énergie"]
        ];
        return $enemies;
    }
    
    // CREATE NEW PLAYER - only available at game start
    public function createPlayer(){
        popen("cls", "w");
        echo "\n\n\n                                                                         ";
        $string = "Character Creation : \n\n\n";
        $this->stringBuffer($string);

        echo "\n\n\n\n\n                                                      ";
        $string = "You are a resilient Saiyan warrior with a mysterious past,\n";
        $this->stringBuffer($string);
        
        echo "\n\n\n                                                      ";
        $string = "wielding untapped potential and a relentless determination\n";
        $this->stringBuffer($string);
         
        echo "\n\n\n                                        ";
        $string = "to uncover the secrets of his lineage while mastering the legendary art of Ki manipulation\n";
        $this->stringBuffer($string);

        $created = false;
        do{
            echo "\n\n\n\n\n                                                                        ";
            $string = "Enter your name, Hero :\n";
            $this->stringBuffer($string);

            echo "\n\n\n                                                                                 ";
            $name = (string)readline();
            if(strlen($name)==0){
                echo "\n                                                    Your name cannot be registered in our Hero list, please retry.\n";
            }else{
                $this->player = new Hero ($name, 12, 15);
                $this->player->addPower($this->collectionPower[0]);
                $created = true;
            }
        } while ($created == false);
        popen("cls", "w");
        echo "\n\n\n\n\n\n\n\n\n                                                      ";
        $string = "Your name is " . $this->player->getName() . ", you deal " . $this->player->getDamage() . " Damage and have " . $this->player->getHp() . " Health Points.\n";
        $this->stringBuffer($string);
        readline("\n\n\n\n                                                                          Press enter to continue_");
        popen("cls", "w");
        $this->mainMenu();
    }

    // ----- PLAYER MAIN MENU - access everything
    public function mainMenu(){
        popen("cls", "w");
        echo "\n\n\n\n\n\n\n                                                                      ";
        $string = "Welcome in game, " . $this->player->getName();
        $this->stringBuffer($string);
        
        echo "\n\n\n\n\n\n\n                                                                  1. Search for the Dragon Balls\n\n\n\n                                                                       2. Watch your stats\n\n\n\n                                                                        3. Save your game\n\n\n\n                                                                        4. Visit Sensei\n\n\n\n                                                                          5. Quit Game";
        
        $this->checkEnd();

        echo "\n\n\n\n\n\n\n                                                                                 ";
        $choice = (string)readline();
        switch ($choice) {
            case 1 : 
                return $this->searchDragonBall();
                break;
            case 2 :
                return $this->getStats();
                break;
            case 3 : 
                return $this->saveGame();
                break;
                case 4:
                    return $this->SenseiShop();
                    break;
            case 5 : 
                return $this->quitGame();
                break;
            default :
                return $this->mainMenu();
                break;
        }
    }


    // ----- SAVE HANDLING
    public function loadGame(){
        // choose a savefile to load
        echo "See accessible SaveFiles :\n";

        //we show the list of savefiles available
        $saveLines = file("savenames.txt");
        for($index=0;$index<count($saveLines);$index++) {
            echo "  ".($index+1).". ".$saveLines[$index];
        }
        
        // we read the infos
        $choice = readline("\nChoose the SaveFile to load : ");
        if($choice>0 && $choice <=count($saveLines)) {
            $name = $saveLines[$choice-1].".txt";
            $name = str_replace(array("\r", "\n"), '', $name);
            $objData = file($name);
            // we get the player info on the next line
            $charData = unserialize($objData[0]);

            //and start the game with the infos we got
            $this->player = $charData;
            return $this->mainMenu();
        }elseif($choice==""){
            return $this->launchGame();
        }else{
            echo "\nLe name de save n'est pas valide. Recommencez.\n\n\n\n";
            return $this->loadGame();
        }
    }
    public function saveGame(){
        // offer to name save
        $name = (string)readline("Name the SaveFile : ");
        $nameCheck = $name."\n";
        $saveLines = file("savenames.txt");
        foreach($saveLines as $saveName){
            echo $saveName . " = " . $nameCheck ." ?";
            if ($nameCheck == $saveName){
                echo "\n\n\nThe SaveFile name is already taken, please choose another name.\n";
                return $this->saveGame();
            }
            if($name == ""){
                echo "\n\n\nThe SaveFile name is empty, please choose a name.\n";
                return $this->saveGame();
            }
        }
        // sleep(10000);

        //serialize the player infos
        $charData = serialize($this->player);
        //write the infos on a named save (above)
        $fp = fopen($name.".txt", "w");
        fwrite($fp, $charData);
        fclose($fp);
        
        // we write the named file in another file for easy access to a lot of customly named savefiles
        $saveNames = fopen("savenames.txt","a");
        fwrite($saveNames, $name);
        fwrite($saveNames, "\n");
        fclose($saveNames);
        return $this->mainMenu();
    }



    // ----- FIGHT 
    public function searchDragonBall(){
        popen("cls", "w");

        $quest = $this->dragonBallQuestManager->getCollectionQuest()[$this->player->getDragonBall()];
        echo "\n\n\n\n\n                                                        ";
        $string = $quest->getTitle() . "\n\n\n\n\n" . $quest->getDescription();
        $this->stringBuffer($string);
        readline("\n\n\n\n                                                                                                                  Press enter to continue_");

        $this->resetStats();
        $this->currentEnemy = $quest->getEnemy1();
        $this->resetEnemyStats();
        $this->fightTransition();
        if($this->player->getHp()<=0){
            return $this->playerDeath();
        }
        $this->doEnigma($quest->getEnigma());
        $this->currentEnemy = $quest->getEnemy2();
        $this->resetEnemyStats();
        $this->fightTransition();
        if($this->player->getHp()<=0){
            return $this->playerDeath();
        }
        $this->currentEnemy = null;
        $this->playerWinQuest();
    }

    public function fightTransition(){
        popen("cls","w");
        $string = "\n\n\n\n\n\n                                                                               A fight starts !";
        $this->stringBuffer($string);
        usleep(1500000);
        $this->fightMenu();
    }

    public function playerDeath(){
        echo "\n                                               ";
        $string = "You ded bro LOSER";
        $this->stringBuffer($string);
        readline("\nPress enter to continue_");
        $this->resetStats();
        return $this->mainMenu();
    }

    public function playerWinQuest(){
        echo "\n                                                            ";
        $string = "You earned this DragonBall !";
        $this->stringBuffer($string);
        echo "\n\n                                                               ";
        $string = "*you got DragonBall " . ($this->player->getDragonBall()+1);
        $this->stringBuffer($string);

        $this->player->setDragonBall($this->player->getDragonBall()+1);
        if( $this->player->getDragonBall() < count($this->collectionPower)){
            echo "\n\n                                           ";
            $string = "You also discovered a new ability : " . $this->collectionPower[$this->player->getDragonBall()]->getTitle() . " ! \n";
            $this->stringBuffer($string);
            $this->player->addPower($this->collectionPower[$this->player->getDragonBall()]);
        }
        echo "\n                                                               ";
        readline("Press enter to continue_");
        $this->resetStats();
        return $this->mainMenu();
    }

    public function resetStats(){
        $this->player->setHp($this->player->getMaxHealth());
        $this->player->setMana(0);
    }
    
    public function resetEnemyStats(){
        $this->currentEnemy->setHp($this->currentEnemy->getMaxHealth());
        $this->currentEnemy->setMana(0);
    }

    public function fightMenu(){
        $this->player->setIsDefending(false);
        
        $text = ["Your Turn ! What will you do ?", "Attack ! ( " . $this->player->getDamage() ." damage)" , "Defend ! (get half-damage)", "Use a Special Ability !"];
        $this->graphicalManager->fightScreen($text);


        $choice = readline(" ");
        switch ($choice) {
            case 1:
                $this->playerAttack();
                break;
            case 2:
                $this->playerDefend();
                break;
            case 3:
                $this->playerPower();
                break;
            default :
                $this->fightMenu();
                break;
        }
    }

    public function playerAttack(){
        $rand = rand(1, 10);
        $string = "";
        if($rand >= 2){
            $damage = $this->player->getDamage();
        } else{
            $string .= "You missed your attack and did only half damage ! ";
            $damage = floor($this->player->getDamage() / 2);
            // $this->player->setHP() --;
        }
        if($this->player->getMolecularAttack()==true){
            $damage *= 2;
        }
        if($this->currentEnemy->getIsDefending() == true){
            $this->currentEnemy->setHp($this->currentEnemy->getHp() - floor($damage/2) );
            $string .= "You did " . floor($damage/2) ." damage !";
        }else{
            $this->currentEnemy->setHp($this->currentEnemy->getHp() - $damage );
            $string .= "You did " . $damage ." damage !";
            $this->player->setMana($this->player->getMana() + 10);
            $this->currentEnemy->setMana($this->currentEnemy->getMana() + 10);
        }
        $text = [$string];
        $this->graphicalManager->fightScreen($text);
        readline();
        $this->player->setMolecularAttack(false);
        return $this->enemyTurn();
    }

    public function playerDefend(){
        $this->player->setIsDefending(true);
        $text = ["You chose to defend !"];
        $this->graphicalManager->fightScreen($text);
        readline();
        return $this->enemyTurn();
    }

    public function playerPower(){  
        $text = ["You chose to use your powers ! Current Mana : " . $this->player->getMana()];
        foreach($this->player->getPowerList() as $key => $power){
            $string = $power->getTitle() . " : " . $power->getIngameDescription() . " - " . $power->getManaCost() . " Mana Cost";
            array_push($text, $string);
        }
        $this->graphicalManager->fightScreen($text);
        $index = readline();

        if(is_int($index) && isset($this->player->getPowerList()[$index-1]) && $this->player->getMana()>=$this->player->getPowerList()[$index-1]->getManaCost()){
            switch($this->player->getPowerList()[$index-1]->getTitle()){
                case "Ki Absorption" :
                    $this->currentEnemy->setHp($this->currentEnemy->getHp() - 10);
                    $this->player->setHp($this->player->getHp() + 10);
                    $text = "You did 10 damage and gained 10 HP !";
                    break;
                case "Temporal Manipulation" :
                    $text = [" "];
                    if($this->player->getMolecularAttack()==true){
                        $damage = $this->player->getDamage()*2;
                    }else{
                        $damage = $this->player->getDamage();
                    }
                    for($i=0;$i<=1;$i++){
                        if($this->currentEnemy->getIsDefending()== true){
                            $this->currentEnemy->setHp($this->currentEnemy->getHp() - floor($damage/2) );
                            $string = "You did" . $damage ." damage !";
                        }else{
                            $this->currentEnemy->setHp($this->currentEnemy->getHp() - $damage );
                            $string = "You did" . $damage ." damage !";
                            $this->player->setMana($this->player->getMana() + 3);
                        }
                        array_push($text, $string);
                        $this->player->setMolecularAttack(false);
                    }
                    break;
                case "Molecular Control" :
                    $text = "You prepare yourself for your next attack !";
                    $this->player->setMolecularAttack(true);
                    break;
                case "Matter Absorption" :
                    $text = "You healed yourself 30 HP !";
                    $this->player->setHp($this->player->getHp() + 30);
                    break;
                case "Kamehameha" :
                    $this->currentEnemy->setHp($this->currentEnemy->getHp() - 50);
                    $text = "You dealt an amazing 50 damage !";
                    break;
            }
            $this->graphicalManager->fightScreen($string);

        }elseif($index == ""){
            return $this->fightMenu();
        }else{
            return $this->playerPower();
        }
        return $this->enemyTurn();
    }

    public function enemyTurn(){
        if($this->currentEnemy->getHp()<=0){
            return $this->checkFight();
        }
        
        $text = ["It is ".$this->currentEnemy->getName()."'s turn !"];
        $this->graphicalManager->fightScreen($text);
        readline();
        
        $this->currentEnemy->setIsDefending(false);
        
        $choice = rand(1,10);
        if($this->currentEnemy->getMana() > 49 && $choice>=8 ){
            return $this->enemyPower();
        }elseif($choice<8 && $choice>6){
            return $this->enemyDefend();
        }else{
            return $this->enemyAttack();
        }
    }
    
    public function enemyAttack(){
        if($this->player->getIsDefending()== true){
            $this->player->setHp($this->player->getHp() - floor($this->currentEnemy->getDamage()/2 ) );
            $string = "\nYou took " . floor($this->currentEnemy->getDamage()/2 ) ." damage !\n";
        }else{
            $this->player->setHp($this->player->getHp() - $this->currentEnemy->getDamage() );
            $string = "\nYou took " . $this->currentEnemy->getDamage() ." damage !\n";
            $this->player->setMana($this->player->getMana() + 10);
            $this->currentEnemy->setMana($this->currentEnemy->getMana() + 10);
        }
        $text = [$string];
        $this->graphicalManager->fightScreen($text);
        readline();
        
        $this->checkFight();
    }

    public function enemyDefend(){
        $this->currentEnemy->setIsDefending(true);
        $text = [$this->currentEnemy->getName() . " has chosen to defend himself !"];
        $this->graphicalManager->fightScreen($text);
        readline();
        $this->checkFight();
    }

    public function enemyPower(){
        $text = [$this->currentEnemy->getName() . " has chosen to use his powers !", "Looks like he acted like a Magicarp : his special power do nothing !", "(Enemies powers not implemented to get to the endgame faster)"];
        $this->graphicalManager->fightScreen($text);
        readline("\nPress enter to continue_");
        $this->checkFight();
    }

    // This function is used to check whether the enemy is dead or not, in order to continue the game and redirect the player to another function.
    public function checkFight(){
        if($this->currentEnemy->getHp()<=0){
            $xp = $this->currentEnemy->getMaxHealth() * 2;
            $text = ["You Won ! + " .$xp . "XP" ];
            $this->graphicalManager->fightScreen($text);
            readline();
            return false;
        }
        if($this->player->getHp()<=0){
            $text = ["You Lost ! "];
            $this->graphicalManager->fightScreen($text);
            readline();
            return $this->mainMenu();
        }
        return $this->fightMenu();
    }

    // This function allows us to stock questions, options and answers to create enigmas.
    public function createEnigmas(){
        $questions = [
            "Who is the protagonist of the Dragon Ball series, known for his signature spiky hairstyle and his quest for the Dragon Balls?",
            "What is the name of the wish-granting dragon that is summoned when all seven Dragon Balls are collected?",
            "Which of these techniques involves concentrating one's inner energy and releasing it as a powerful blast?",
            "Who is Goku's longtime friend and rival, initially introduced as an antagonist but later becomes one of the main heroes?",
            "What are the objects of immense power that, when gathered, can grant any wish to the one who collects them all?",
            "Which powerful alien race does Frieza belong to, known for their ruthless nature and powerful transformations?",
            "Who is the creator of the Dragon Ball series, responsible for the original manga that inspired the anime adaptation?"
        ];
        $option = [
            ["Vegeta", "Gohan", "Goku",  "Piccolo"],
            ["Frieza", "Shenron", "Cell", "Majin Buu"],
            ["Kamehameha", "Spirit Bomb", "Destructo Disc", "Solar Flare"],
            ["Krillin", "Yamcha", "Tien", "Vegeta"],
            ["Dragon Pearls", "Mystic Crystals", "Infinity Stones", "Dragon Balls"],
            ["Saiyans", "Namekians", "Majins", "Frost Demons"],
            ["Hayao Miyazaki", "Masashi Kishimoto", "Akira Toriyama", "Eiichiro Oda"]
        ];

        $answer = [
            "goku",
            "vhenron",
            "kamehameha",
            "vegeta",
            "dragon balls",
            "frost demons",
            "akira toriyama"
        ];
        
        // We stock array information in a collection that we call up to display the information we want. 
        $collection= [];
        for($i = 1; $i <=7; $i++){
            $question = new Question($questions[$i-1], $option[$i-1], $answer[$i-1]);
            array_push($collection, $question);
        }
        return $collection;
    }

    public function doEnigma($question){
        $string = "After this intensive battle, I propose a little riddle to recover a little life.\n\nQuestion : " . $question->getQuestion() ."\n\nYou can choose : \n";
        $this->stringBuffer($string);
        
        for($i=1;$i<=4;$i++){
            echo "\n" . $i. ". " . $question->getOption()[$i-1] . " \n";
        }
        $choice = strtolower(readline("Choose your answer : "));
        if($choice == $question->getGoodOption()){
            $this->player->setHp($this->player->getHp() + 30);
            $string2 = "Good answer, your health has increase by 30hp.\n\n";
            $this->stringBuffer($string2);
        } else {
            $string2 = "Bad answer!!\n\n";
            $this->stringBuffer($string2);
        }

        readline("Press enter to continue_");
        popen("cls", "w");
    
    }

    public function createPower(){
        $powerList = [
            ["Ki Absorption","Your character can absorb and manipulate the energy of other living beings, enhancing their own power and weakening their opponents.","Steal life from your enemy.",20],
            ["Temporal Manipulation","Ability to control and manipulate time, enabling your character to speed up, for a short period.", "You attack twice.",30],
            ["Molecular Control","Capability to manipulate the structure of matter at the molecular level, allowing your character to living beings at will.", "More damage next attack.",20],
            ["Matter Absorption","Ability to absorb and assimilate matter, granting your character temporary invulnerability and the capacity to grow stronger with each absorbed substance.", "Heal some HP",30],
            ["Kamehameha","The Kamehameha is a signature Dragon Ball energy attack where the user concentrates their inner energy into their cupped hands before releasing a powerful, blue energy wave with devastating force.", "Do massive damage.",60]
        ];
        for($i=0;$i<(count($powerList));$i++){
            $power = new Power ($powerList[$i][0],$powerList[$i][1],$powerList[$i][2],$powerList[$i][3]);
            array_push($this->collectionPower, $power);
        }
    }

    // ----- STATS
    public function getStats(){
        popen("cls", "w");
        echo "\n\n\n                                                                            ";
        $string = "Your stats.\n\n";
        $this->stringBuffer($string);

        echo "\n\n                                                                        ";
        $string = "Name of hero : " . $this->player->getName(). "\n\n";
        $this->stringBuffer($string);

        echo "\n\n                                                                        ";
        $string = "Health of hero : " . $this->player->getHp() . "\n\n";
        $this->stringBuffer($string);

        echo "\n\n                                                                        ";
        $string = "Experience of hero : " . $this->player->getXp() . "\n\n";
        $this->stringBuffer($string);

        echo "\n\n                                                                        ";
        $string = "Dragon ball of hero : " . $this->player->getDragonBall() . "\n\n";
        $this->stringBuffer($string);

        echo "\n\n                                                                        ";
        $string = "Damage of hero : " . $this->player->getDamage() . "\n\n";
        $this->stringBuffer($string);

        echo "\n\n                                                                              ";
        $string = "Powers : "; 
        $this->stringBuffer($string);

        foreach($this->player->getPowerList() as $key => $power){
            echo "\n                       ";
            $string =($key+1) . ". " . $power->getTitle() . " - " . $power->getDescription();
            $this->stringBuffer($string);
            echo "\n";
        }

        readline("\nPress enter to return on main : ");
        $this->mainMenu();
    }

    public function checkEnd(){
        if( $this->player->getDragonBall() == 7 ){
            popen("cls", "w");
            echo "\n                                          ";
            $string = $this->player->getName().", you have finished all the quests...";
            $this->stringBuffer($string);
            echo "\n                                      ";
            $string = "All the Dragon Balls are in your hands ( ( ͡❛ ͜ʖ ͡❛) ) , you gained ultimate power in this universe.";
            $this->stringBuffer($string);
            echo "\n                                          ";
            $string = "Hopefully, you will use it with care... Goodbye !";
            $this->stringBuffer($string);
            sleep(20);
            return $this->launchGame(); 
        }
    }

    public function SenseiShop(){
        popen("cls", "w");
        echo "\n\n\n\n\n                                                                    ";
        $string = "Sensei is here to help you train.";
        $this->stringBuffer($string);

        echo "\n\n\n                                                           ";
        $string = "You can exchange XP earned in combat with upgrades.";
        $this->stringBuffer($string);
    

        echo "\n\n\n\n                                                                          ";
        $string = "1. Increase Health";
        $this->stringBuffer($string);


        echo "\n\n\n                                                                          ";
        $string = "2. Increase Damage";
        $this->stringBuffer($string);

        $choice = readline("\n\n\n                                                                         Choose your option :\n");
        switch($choice){
            case 1 : 
                if($this->player->getXp()>=20){
                    $string = "\n\nYou increased your Health ! \n";
                    $this->player->setMaxHealth($this->player->getMaxHealth()+5);
                    $this->player->setHp($this->player->getMaxHealth());
                    $this->stringBuffer($string);
                    $this->player->setXp($this->player->getXp() - 20);
                    readline();
                    return $this->mainMenu();
                }else{
                    $string = "\n\nSensei can train you, but you don't have enough XP !\n";
                    $this->stringBuffer($string);
                    readline();
                    return $this->SenseiShop();
                }
                break;
            case 2 : 
                if($this->player->getXp()>=20){
                    $string = "\n\nYou increased your Damage output ! \n";
                    $this->player->setDamage($this->player->getDamage()+2);
                    $this->stringBuffer($string);
                    $this->player->setXp($this->player->getXp() - 20);
                    readline();
                    return $this->mainMenu();
                }else{
                    $string = "\n\nSensei can train you, but you don't have enough XP !\n";
                    $this->stringBuffer($string);
                    readline();
                    return $this->SenseiShop();
                }
                break;
            case "" :
                return $this->mainMenu();
            default :
                $string = "Sensei hasn't understood your choice, speak clearer (he is a bit deaf)";
                $this->stringBuffer($string);
                readline();
                return $this->SenseiShop();
                break;
        }
    }

    // ----- LEAVE GAME
    public function quitGame(){
        exit();
    }
}


$game = new Game;
?>
