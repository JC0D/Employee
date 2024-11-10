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
        // Check if the index is valid
        if (isset($this->employee[$index])) {
            unset($this->employee[$index]); // Unset the employee at the specified index
            echo "Employee removed at index: $index\n";
            return true;
        } else {
            echo "Invalid index: $index\n";
            return false;
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
                echo "Index $index: " . $employee . "\n\n";
            }
        }
    }

    public function displayCommissionEmployee()
    {
        $found = false;
        foreach ($this->employee as $index => $employee) {
            if ($employee instanceof CommissionEmployee) {
                echo "Index $index: " . $employee . "\n\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No Commission Employees found.\n";
        }
    }

    public function displayHourlyEmployee()
    {
        $found = false;
        foreach ($this->employee as $index => $employee) {
            if ($employee instanceof HourlyEmployee) {
                echo "Index $index: " . $employee . "\n\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No Hourly Employees found.\n";
        }
    }

    public function displayPieceWorker()
    {
        $found = false;
        foreach ($this->employee as $index => $employee) {
            if ($employee instanceof PieceWorker) {
                echo "Index $index: " . $employee . "\n\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No Piece Workers found.\n";
        }
    }

    public function countAllEmployees()
    {
        $count = $this->countEmployee();
        echo "Total Employees: $count\n";
    }

    public function countCommissionEmployees()
    {
        $count = $this->countEmployee("CommissionEmployee");
        echo "Total Commission Employees: $count\n";
    }

    public function countHourlyEmployees()
    {
        $count = $this->countEmployee("HourlyEmployee");
        echo "Total Hourly Employees: $count\n";
    }

    public function countPieceWorkers()
    {
        $count = $this->countEmployee("PieceWorker");
        echo "Total Piece Workers: $count\n";
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
