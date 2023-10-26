<?php
// creat a class personnage with attribut
class Personnage {
    protected $name;
    protected $damage;
    protected $mana;
    protected $hp;
    private $maxHealth;

    protected $isDefending = false;

    public function __construct($N, $D, $H){
        $this->name = $N;
        $this->damage = $D;
        $this->mana = 0;
        $this->hp = $H;
        $this->maxHealth = $H;
    }

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
}

class Hero extends Personnage{
    private $level;
    private $xp;
    private $dragonBall = 0;

    public function __construct($N, $D, $H){
        parent::__construct($N, $D, $H);
        $this->level = 0;
        $this->xp = 0;
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

    public function setLevel($newLevel){
        $this->level = $newLevel;
    }
    public function setXp($newXp){
        $this->xp = $newXp;
    }
    public function setDragonBall($newDragonBall){
        $this->dragonBall = $newDragonBall;
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

class Game {
    private $player;
    private $dragonBallQuestManager;
    private $currentEnemy;
    
    public function __construct(){
        $this->dragonBallQuestManager = new DragonBallQuestManager;
        $this->launchGame();
    }
    
    public function stringBuffer($string){
        ob_start();
        $buffer = str_repeat("", 1); // fill the buffer

        $len = strlen($string);
        $sleep = 0.0005; // sleep between output chars

        for($i=0; $i < $len; $i++) {
            echo $buffer . $string[$i];
            ob_flush();
            flush();
            usleep($sleep * 1000000);
        }
        ob_end_clean();
    }

    public function launchGame(){
        $this->createQuests();
        $this->createEnemies();
        
        //choose between start new game, launch a save, and close game
        echo "                                               ";
        $string = "Welcome ingame\n"; // text to change
        $this->stringBuffer($string);
        $choice = readline("                                                                          | ");
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

    public function createEnigmas(){
        $enigmas = [
            ["",3],
            ["",3],
            ["",3],
            ["",3],
            ["",3],
            ["",3],
            ["",3],
            ["",3]
        ];
        return $enigmas;
    }
    
    // CREATE NEW PLAYER - only available at game start
    public function createPlayer(){
        echo "\n                                               ";
        $string = "BIENVENUE! Tu es mort et dans ma grande bontée j'ai décidé de te réincarner...\n";
        $this->stringBuffer($string);
        
        $created = false;
        do{
            $name = (string)readline("                                                                          | ");
            if(strlen($name)==0){
                echo "\n                                          Your name cannot be registered in our Hero, please retry.\n";
            }else{
                $this->player = new Hero ($name, 12, 15);
                $created = true;
            }
        } while ($created == false);
        $string = "Tu t'appelles " . $this->player->getName() . " et tu aura donc " . $this->player->getDamage() . " de dégâts, tu aura " . $this->player->getMana() . " de mana, et tu aura " . $this->player->getHp() . " de vie.\n";
        $this->stringBuffer($string);
        readline("\nPress enter to continue : ");
        popen("cls", "w");
        $this->mainMenu();
    }

    // ----- PLAYER MAIN MENU - access everything
    public function mainMenu(){
        popen("cls", "w");
        echo "\n                                               ";
        $string = "Welcome in game " . $this->player->getName(); // text to change - main menu of actions
        // Fight for the DragonBall
        // Get your Stats
        // Save your Game
        // Give up search (quit)
        $this->stringBuffer($string);
        $choice = (string)readline("\n                                                                          | ");
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
            case 4 : 
                return $this->quitGame();
                break;
            default :
                return $this->mainMenu();
                break;
        }
    }

    // ----- SAVE HANDLING
    public function loadGame(){
        
    }
    public function saveGame(){
        
    }



    // ----- FIGHT 
    public function searchDragonBall(){
        $quest = $this->dragonBallQuestManager->getCollectionQuest()[$this->player->getDragonBall()];
        echo "\n                                               ";
        $string = $quest->getTitle() . "\n\n" . $quest->getDescription();
        $this->stringBuffer($string);
        readline("\nPress enter to continue : ");
        popen("cls", "w");

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
        $string = "A fight starts !";
        $this->stringBuffer($string);
        // sleep
        // écran qui fade in
        $this->fightMenu();
    }

    public function playerDeath(){
        echo "\n                                               ";
        $string = "You ded bro LOSER";
        $this->stringBuffer($string);
        readline("\nPress enter to continue : ");
        $this->resetStats();
        return $this->mainMenu();
    }

    public function playerWinQuest(){
        echo "\n                                               ";
        $string = "You earned this DragonBall !\n*you got DragonBall " . ($this->player->getDragonBall()+1);
        $this->player->setDragonBall($this->player->getDragonBall()+1);
        $this->stringBuffer($string);
        readline("\nPress enter to continue : ");
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
        $this->currentEnemy->setIsDefending(false);
        
        $string = "\n\nVotre vie : " . $this->player->getHp() . "\nVie de l'ennemi : " . $this->currentEnemy->getHp() ."\nVoulez vous\n\n1-attaquer\n2-se défendre\n3-utiliser votre super attaque\n";
        $this->stringBuffer($string);
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

        if($rand >= 2){
            $damage = $this->player->getDamage();
        } else{
            echo "you missed the attack and did only half damage";
            $damage = floor($this->player->getDamage() / 2);
            // $this->player->setHP() --;
        }
        if($this->currentEnemy->getIsDefending()== true){
            $this->currentEnemy->setHp($this->currentEnemy->getHp() - floor($damage/2) );
            $string = "\nYou did" . $damage ." damage !\n";
        }else{
            $this->currentEnemy->setHp($this->currentEnemy->getHp() - $damage );
            $string = "\nYou did" . $damage ." damage !\n";
            $this->player->setMana($this->player->getMana() + 3);
        }
        
        $this->stringBuffer($string);
        readline("\nPress enter to continue : ");
        return $this->enemyTurn();
    }

    public function playerDefend(){
        $string = "\nYou chose to defend !\n";
        $this->stringBuffer($string);

        $this->player->setIsDefending(true);
        readline("\nPress enter to continue : ");
        return $this->enemyTurn();
    }

    public function playerPower(){
        $string = "\nYou chose to use your power !\n";
        $this->stringBuffer($string);
        readline("\nPress enter to continue : ");

        return $this->enemyTurn();
    }

    public function enemyTurn(){
        if($this->currentEnemy->getHp()<=0){
            return $this->checkFight();
        }
        
        $string = "\nIt's your enemy's turn !\n";
        $this->stringBuffer($string);

        $this->currentEnemy->setIsDefending(false);
        
        readline("\nPress enter to continue : ");
        
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
            $string = "\nYou took" . floor($this->currentEnemy->getDamage()/2 ) ." damage !\n";
        }else{
            $this->player->setHp($this->player->getHp() - $this->currentEnemy->getDamage() );
            $string = "\nYou took" . $this->currentEnemy->getDamage() ." damage !\n";
            $this->player->setMana($this->player->getMana() + 3);
        }
        $this->stringBuffer($string);
        $string = "You won !";
        readline("\nPress enter to continue : ");
        $this->checkFight();
    }

    public function enemyDefend(){
        $this->currentEnemy->setIsDefending(true);
        $string = "\nThe enemy has chosen to defend himself !\n";
        $this->stringBuffer($string);
        readline("\nPress enter to continue : ");
        $this->checkFight();
    }

    public function enemyPower(){
        $string = "\nThe enemy has chosen to use his power !\n";
        $this->stringBuffer($string);
        readline("\nPress enter to continue : ");
        $this->checkFight();
    }

    public function checkFight(){
        if($this->currentEnemy->getHp()<=0){
            $string = "You won !";
            $this->stringBuffer($string);
            readline("\nPress enter to continue : ");
            return false;
        }
        if($this->player->getHp()<=0){
            $string = "You lost !";
            $this->stringBuffer($string);
            readline("\nPress enter to continue : ");
            return $this->mainMenu();
        }
        return $this->fightMenu();
    }

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
            "Goku",
            "Shenron",
            "Kamehameha",
            "Vegeta",
            "Dragon Balls",
            "Frost Demons",
            "Akira Toriyama"
        ];
        
        $collection= [];
        for($i = 1; $i <=7; $i++){
            $question = new Question($questions[$i-1], $option[$i-1], $answer[$i-1]);
            array_push($collection, $question);
        }
        return $collection;
    }

    public function doEnigma($question){
        $question->getReponses()[i];
    }


    // ----- STATS
    public function getStats(){
        $statP = $this->player;
        $string = "Here you are in a player's stats.\n\nName of hero : " . $statP->getName() . "\n\nHP of hero : " . $statP->getHp() . "\n\nDamage of hero : " . $statP->getDamage() . "\n\nMana of hero : " . $statP->getMana() . "\n\n";
        $this->stringBuffer($string);
        readline("\nPress enter to return on main : ");
        popen("cls", "w");
        $this->mainMenu();
    }

    // ----- LEAVE GAME
    public function quitGame(){
        exit();
    }
}


$game = new Game;
?>