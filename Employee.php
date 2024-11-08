<?php

require_once 'Person.php';

abstract class Employee extends Person
{
    private $company;

    public function __construct($name, $address, $age, $company)
    {
        parent::__construct($name, $address, $age);
        $this->company = $company;
    }

    abstract public function earning();

    public function __toString()
    {
        return parent::__toString() . ", Company: {$this->company}, Earnings: " . number_format($this->earning(), 2);
    }
}
