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
        return $this->name = $name;
    }

    public function __toString()
    {
        return "\nName: {$this->name}\n Address: {$this->address}\n Age: {$this->age}";
    }
}
