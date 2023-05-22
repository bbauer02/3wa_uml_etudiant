<?php 

class waiter {

    const MAX_TABLES = 4;
    public function __construct(private array $tables = [])
    {

    }

    public function addTable(table $table): bool
    {
        if(count($this->tables) === self::MAX_TABLES){
            throw new Exception("Le nombre maximum de tables est atteint");
        }


        if(!in_array($table, $this->tables, true) ){
            $this->tables[] = $table;
            return true;
        }
        return false;
    }
}


class table {

}