<?php

require_once 'Employee.php';

class HourlyEmployee extends Employee
{
    private $hoursWorked;
    private $hourlyRate;

    public function __construct($name, $address, $age, $company, $hoursWorked, $hourlyRate)
    {
        parent::__construct($name, $address, $age, $company);
        $this->hoursWorked = $hoursWorked;
        $this->hourlyRate = $hourlyRate;
    }

    public function earning()
    {
        return $this->hoursWorked * $this->hourlyRate;
    }

    public function __toString()
    {
        return parent::__toString() . "\nHours Worked: {$this->hoursWorked} \nHourly Rate: " . number_format($this->hourlyRate, 2);
    }
}
