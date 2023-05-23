<?php 

class Vehicle {

    // Dans une composition, les composants sont indispensables à la création du composite
    // Le composite ne peut pas exister sans ses composants
    // Les instances des composants NE PEUVENT PAS ETRE NULL
    private Chassis $chassis;
    private Engine $engine;


    public function __construct( ) {
        $this->chassis = new Chassis();
        $this->engine = new Engine();
        echo "Voiture créée <br>";
   }

   public function __destruct() {
        echo "Voiture détruite <br>";
   }

}

class Chassis {
    public function __destruct() {
        echo "Chassis détruit <br>";
   }
}

class Engine {
    public function __destruct() {
        echo "Moteur détruit <br>";
   }
}


$vehicle = new Vehicle( );

// destruction du véhicule

unset($vehicle);


