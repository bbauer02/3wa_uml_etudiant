<?php 

class Vehicle {
    public function __construct(
        private array $technicians = []
    ) {

        $this->setTechnicians($technicians);
        
    }

    public function addTechnician(Technician $technician) : bool {
        if(!in_array($technician, $this->technicians)) {
            $this->technicians[] = $technician;
            $technician->addVehicle($this);

            return true;
        }

        return false;
    }

    public function removeTechnician(Technician $technician) : bool {
        $key = array_search($technician, $this->technicians);

        if($key !== false) {
            $technician->removeVehicle($this);
            // $this->technicians[$key]->removeVehicle($this);
            unset($this->technicians[$key]);
            

            return true;
        }

        return false;
    }

    public function setTechnicians(array $technicians) : self {
        
        
        foreach($this->technicians as $technician) {
            $technician->removeVehicle($this);
        }
          
        foreach($technicians as $technician) {
           if(!$technician instanceof Technician) {
               throw new Exception('Invalid technician');
           }
           $this->addTechnician($technician);
           $technician->addVehicle($this);
       }

       return $this;
    }

    public function getTechnicians() : array {
        return $this->technicians;
    }
}

class Technician {
    public function __construct(
        private array $vehicles = []
    ) {
            
            $this->setVehicles($vehicles);
    }

    public function addVehicle(Vehicle $vehicle) : bool {
        if(!in_array($vehicle, $this->vehicles)) {
            $this->vehicles[] = $vehicle;

            return true;
        }

        return false;
    }

    public function removeVehicle(Vehicle $vehicle) : bool {
        $key = array_search($vehicle, $this->vehicles);

        if($key !== false) {
            unset($this->vehicles[$key]);

            return true;
        }

        return false;
    }

    public function setVehicles(array $vehicles) : self {
        foreach($vehicles as $vehicle) {
            if(!$vehicle instanceof Vehicle) {
                throw new Exception('Invalid vehicle');
            }
            $this->addVehicle($vehicle);
        }
        return $this;
    }

    public function getVehicles() : array {
        return $this->vehicles;
    }

}

class Intervention {
    public function __construct(        
        private string $descriptionIntervention,
        private bool $isResolved,
        
        private Vehicule $vehicule,
        private Technicien $technicien
        ) {

    }

    public function getTechnicien() : Technicien {
        return $this->technicien;
    }

    public function setTechnicien(Technicien $technicien) : self {
        $this->technicien = $technicien;

        return $this;
    }
    

    public function getVehicule() : Vehicule {
        return $this->vehicule;
    }

    public function setVehicule(Vehicule $vehicule) : self {
        $this->vehicule = $vehicule;

        return $this;
    }

    public function getDescriptionIntervention() : string {
        return $this->descriptionIntervention;
    }

    public function getIsResolved() : bool {
        return $this->isResolved;
    }

    public function setIsResolved(bool $isResolved) : self {
        $this->isResolved = $isResolved;

        return $this;
    }

    public function setDescriptionIntervention(string $descriptionIntervention) : self {
        $this->descriptionIntervention = $descriptionIntervention;

        return $this;
    }




}