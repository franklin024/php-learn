<?php 

class Compute2number {
    public int $num1;
    public int $num2;
    public function __construct(int $num1, int $num2) {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function sum(){
        return $this->num1 + $this->num2;
    }
}