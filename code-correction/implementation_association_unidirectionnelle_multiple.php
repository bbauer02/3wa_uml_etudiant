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
    private array $technicians = [];



    public function __construct(string $registerNumber) {
        $this->registerNumber = $registerNumber; 
    } 
    
    public function getRegisterNumber(): string {
        return $this->registerNumber;
    }

    public function setRegisterNumber(string $registerNumber): void {
        $this->registerNumber = $registerNumber;
    }

    public function getTechnicians(): array {
        return $this->technicians;
    }

    public function addTechnician(Technician $technician): bool {
        if(!in_array($technician, $this->technicians, true)) {
            $this->technicians[] = $technician;
            return true;
        }
        
        return false;
    }

    public function removeTechnician(Technician $technician): bool {
        $index = array_search($technician, $this->technicians, true);
        if($index !== false) {
            unset($this->technicians[$index]);
            return true;
        }
        
        return false;
    }

    public function removeAllTechnicians(): void {
        $this->technicians = [];
    }

    public function __toString(): string {
        $string = "\nJe suis le véhicule immatriculé {$this->registerNumber} ";
        if (count($this->technicians) === 0) {
            $string .= "\nJe ne suis associé à aucun technicien";

        } else {
            foreach($this->technicians as $technician) {
                $string .= "\n - {$technician->getName()} ";
            }
        }
        return $string;
    }

}


$vehicleAAAA = new Vehicle('AAAA');
$paul = new Technician('Paul');
$sofien = new Technician('Sofien');
$anna = new Technician('Anna');

//affectation de plusieurs techniciens
$vehicleAAAA->addTechnician($paul);
$vehicleAAAA->addTechnician($sofien);
$vehicleAAAA->addTechnician($anna);

echo $vehicleAAAA;
