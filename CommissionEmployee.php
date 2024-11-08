<?php

require_once 'Employee.php';
class CommissionEmployee extends Employee
{
    private $salary;
    private $totalSales;
    private $commissionRate;

    public function __construct($name, $address, $age, $company, $salary, $totalSales, $commissionRate)
    {
        parent::__construct($name, $address, $age, $company);
        $this->salary = $salary;
        $this->totalSales = $totalSales;
        $this->commissionRate = $commissionRate;
    }

    public function earning()
    {
        return $this->salary + ($this->totalSales * $this->commissionRate);
    }

    public function __toString()
    {
        return parent::__toString() . "\nSalary: {$this->salary}\nTotal Sales: " . number_format($this->totalSales, 2) . "\nCommission Rate: " . number_format($this->commissionRate * 100, 2) . "%";
    }
}
