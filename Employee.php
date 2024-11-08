<?php

// Abstract class Employee
abstract class Employee
{
    // Static array to store employee instances
    private static $employeeList = [];

    protected $name;
    protected $age;
    protected $department;

    public function __construct($name, $age, $department)
    {
        $this->name = $name;
        $this->age = $age;
        $this->department = $department;
        self::$employeeList[] = $this; // Add instance to the static list
    }

    // Abstract method to be implemented by subclasses
    abstract public function work();

    // Method to get employee details as a string
    public function __toString()
    {
        return "Name: {$this->name}, Age: {$this->age}, Department: {$this->department}" . PHP_EOL;
    }

    // Static method to print all stored employees
    public static function printAllEmployees()
    {
        foreach (self::$employeeList as $employee) {
            echo $employee . PHP_EOL;
            echo "Work: " . $employee->work() . PHP_EOL;
        }
    }
}

// Subclass Manager extends Employee
class Manager extends Employee
{
    public function work()
    {
        return "Managing the team and overseeing projects.";
    }
}

// Subclass Developer extends Employee
class Developer extends Employee
{
    public function work()
    {
        return "Writing code and debugging.";
    }
}

// Menu class to handle user interaction


// Run the Menu

