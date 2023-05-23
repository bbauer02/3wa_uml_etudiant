<?php


class Technician  {
    public function __construct(
        private array $subordinates = [],
        private ?Technician $superior = null
    ) {
        
    }

    public function addSubordinate(Technician $technician): bool {
        if(!in_array($technician, $this->subordinates, true)) {
            $this->subordinates[] = $technician;
            $technician->setSuperior($this);
            return true;
        }

        return false;
    }

    public function removeSubordinate(Technician $technician): bool {
        $key = array_search($technician, $this->subordinates, true);
        if($key !== false) {
            unset($this->subordinates[$key]);
            $technician->setSuperior(null);
            return true;
        }

        return false;
    }

    public function setSuperior(?Technician $technician): void {
        $this->superior = $technician;
    }   

    public function getSuperior(): ?Technician {
        return $this->superior;
    }
    




}