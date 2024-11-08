<?php

class Person
{
    private $name;
    private $address;
    private $age;

    public function __construct($name, $address, $age)
    {
        $this->name = $name;
        $this->address = $address;
        $this->age = $age;
    }
    public function getName($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return "Name: {$this->name}, Address: {$this->address}, Age: {$this->age}";
    }
}
