<?php

require_once 'Employee.php';
class Roster
{
    private $employee = [];
    public function getEmployees()
    {
        return $this->employee;
    }
    public function addEmployee(Employee $employee)
    {
        return $this->employee[] = $employee;
    }

    public function count()
    {
        return count($this->employee);
    }

    public function removeEmployee($index)
    {
        if (isset($this->employee[$index])) {
            unset($this->employee[$index]);
            $this->employee = array_values($this->employee);
            echo "Employee removed at index: $index\n";
            return true;
        } else {
            echo "Invalid index: $index\n";
            return false;
        }
    }

    private function displayEmployeesByType($type)
    {
        $found = false;
        foreach ($this->employee as $index => $employee) {
            if ($employee instanceof $type) {
                echo "Employee: #$index\n";
                echo "Name: " . $employee->getName() . "\n";
                echo "Age: " . $employee->getAge() . "\n";
                echo "Company: " . $employee->getCompany() . "\n";
                echo "Type: " . get_class($employee) . "\n\n";
                $found = true;
            }
            if (!$found) {
                echo "No employees of type $type found.\n";
            }
        }
    }

    public function countEmployee(string $type = "")
    {
        if ($type === "") {
            return count($this->employee);
        }

        $count = 0;
        foreach ($this->employee as $employee) {
            if (get_class($employee) === $type) {
                $count++;
            }
        }
        return $count;
    }

    public function displayAllEmployee()
    {
        if (empty($this->employee)) {
            echo "No employees in the roster.\n";
        } else {
            foreach ($this->employee as $index => $employee) {
                echo "Employee #$index\n";
                echo "Name: " . $employee->getName() . "\n";
                echo "Age: " . $employee->getAge() . "\n";
                echo "Company: " . $employee->getCompany() . "\n";
                echo "Type: " . get_class($employee) . "\n\n";
            }
        }
    }

    public function displayCommissionEmployee()
    {
        $this->displayEmployeesByType(CommissionEmployee::class);
    }

    public function displayHourlyEmployee()
    {
        $this->displayEmployeesByType(HourlyEmployee::class);
    }

    public function displayPieceWorker()
    {
        $this->displayEmployeesByType(PieceWorker::class);
    }

    public function countAllEmployees()
    {
        echo "Total Employees: " . $this->countEmployee() . "\n";
    }

    public function countCommissionEmployees()
    {
        echo "Total Commission Employees: " . $this->countEmployee(CommissionEmployee::class) . "\n";
    }

    public function countHourlyEmployees()
    {
        echo "Total Hourly Employees: " . $this->countEmployee(HourlyEmployee::class) . "\n";
    }

    public function countPieceWorkers()
    {
        echo "Total Piece Workers: " . $this->countEmployee(PieceWorker::class) . "\n";
    }

    public function displayAllPayrolls()
    {
        if ($this->countEmployee() == 0) {
            echo "No employees in the roster.\n";
        } else {
            foreach ($this->getEmployees() as $index => $employee) {
                echo "\nEmployee $index: " . $employee->__toString() . "\n\n";
            }
        }
    }
}
