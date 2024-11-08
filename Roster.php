<?php

require_once 'Employee.php';
class Roster
{
    private $employee = [];

    public function getEmployees(): array
    {
        return $this->employee;
    }
    public function addEmployee(Employee $employee)
    {
        $this->employee[] = $employee;
        echo "Employee Added!";
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
            echo "Invalid index: $index\n"; // Handle invalid index
            return false;
        }
    }

    public function countEmployee(string $type = ""): int
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

    public function displayAllEmployee(): void
    {
        if (empty($this->employee)) {
            echo "No employees in the roster.\n";
        } else {
            foreach ($this->employee as $index => $employee) {
                echo "Index $index: " . $employee . "\n";
            }
        }
    }

    public function displayCommissionEmployee(): void
    {
        $found = false;
        foreach ($this->employee as $index => $employee) {
            if ($employee instanceof CommissionEmployee) {
                echo "Index $index: " . $employee . "\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No Commission Employees found.\n";
        }
    }

    public function displayHourlyEmployee(): void
    {
        $found = false;
        foreach ($this->employee as $index => $employee) {
            if ($employee instanceof HourlyEmployee) {
                echo "Index $index: " . $employee . "\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No Hourly Employees found.\n";
        }
    }

    public function displayPieceWorker(): void
    {
        $found = false;
        foreach ($this->employee as $index => $employee) {
            if ($employee instanceof PieceWorker) {
                echo "Index $index: " . $employee . "\n";
                $found = true;
            }
        }
        if (!$found) {
            echo "No Piece Workers found.\n";
        }
    }

    public function displayAllPayrolls()
    {
        if ($this->countEmployee() == 0) {
            echo "No employees in the roster.\n";
        } else {
            foreach ($this->getEmployees() as $index => $employee) {
                echo "Employee $index: " . $employee->getName() . " - Earnings: " . $employee->earnings() . "\n";
            }
        }
    }
}
