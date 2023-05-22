<?php

class Group {
    private array $students = [];
    public function __construct(
        private string $name
    ) {

    }

    

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addStudent(Student $student): bool
    {
        if(!in_array($student, $this->students, true)){
            $this->students[] = $student;
            return true;
        }
        return false;
    }

    public function removeStudent(Student $student): bool {
        $key = array_search($student, $this->students, true);

        if($key !== false){
            unset($this->students[$key]);
            return true;
        }
        return false;
    }

    public function getStudents():array {
        return $this->students;
    }

    public function setStudents(array $students):self{

        //on n'oublie pas de vider la collection
        $this->students = [];

        foreach($students as $student){
            $this->addStudent($student);
        }

        return $this;
    }
}


class Student {

    public function __construct(
        private string $name,
        private int $age
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
}