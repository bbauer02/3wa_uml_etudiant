<?php

class Technician {

    public function __construct(
        private string $name
    ) {
      
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }
}


class Vehicle {
    private string $registerNumber;
    private ?Technician $technician = null;


    public function __construct(string $registerNumber) {
        $this->registerNumber = $registerNumber; 
    } 
    
    public function getRegisterNumber(): string {
        return $this->registerNumber;
    }

    public function setRegisterNumber(string $registerNumber): void {
        $this->registerNumber = $registerNumber;
    }

    public function getTechnician(): ?Technician {
        return $this->technician;
    }

    public function setTechnician(?Technician $technician): Vehicle {
        $this->technician = $technician;
        return $this;
    }

    public function __toString(): string {
        $string = "Je suis le véhicule immatriculé {$this->registerNumber} ";
        if ($this->technician != null) {
            $string .= "et je suis confié au technicien {$this->technician->getName()}";
        } else {
            $string .= "et je n'ai pas de technicien";
        }
        return $string;
    }
}



$vehiculeAAAA = new Vehicle("AAAA");
$paul = new Technician("Paul");

$vehiculeAAAA->setTechnician($paul);

echo $vehiculeAAAA;