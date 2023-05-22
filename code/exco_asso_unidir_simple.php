<?php

class Group {
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


class Student {

    public function __construct(
        private string $name,
        private int $age,
        private ?Group $group = null
    ) {
        
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getAge(): int {
        return $this->age;
    }

    public function setAge(int $age): void {
        $this->age = $age;
    }

    public function getGroup(): ?Group {
        return $this->group;
    }

    public function setGroup(?Group $group): void {
        $this->group = $group;
    }   

}