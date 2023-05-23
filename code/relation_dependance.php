<?php





class A {

    public function doSomething() {
        echo 'something';
    }
}


class B {
    public function __construct() {
        
    }


    public function doSomethingElse(A $a) {
        $a->doSomething();
    }
}
$a = new A();
$b = new B();
$b->doSomethingElse($a);




















class Customer {
    private ?string $name;
    private int $id;
}

class CustomerManager {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=garage', 'root', '');
    }

    public function read(int $id) : ?Customer {
        $pdoStatement = $this->pdo->prepare('SELECT * FROM customer WHERE id = :id');
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();
        return $pdoStatement->fetchObject('Customer');
    }

    public function update(Customer $customer) : bool {
        $pdoStatement = $this->pdo->prepare('UPDATE customer SET name = :name WHERE id = :id');
        $pdoStatement->bindValue(':name', $customer->getName(), PDO::PARAM_STR);
        $pdoStatement->bindValue(':id', $customer->getId(), PDO::PARAM_INT);
        return $pdoStatement->execute();
    }




}