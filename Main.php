<?php

require_once 'Roster.php';
require_once 'CommissionEmployee.php';
require_once 'HourlyEmployee.php';
require_once 'PieceWorker.php';
class Main
{
    private Roster $roster;
    private $size;
    private bool $repeat;

    public function __construct()
    {
        $this->roster = new Roster();
        $this->repeat = true;
    }

    public function clear()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            system('cls');  // Windows
        } else {
            system('clear');  // Unix/Linux/MacOS
        }
    }

    public function getRosterSize()
    {
        while (true) {
            $size = readline("Enter the size of the roster: ");
            if (is_numeric($size) && $size > 0) {
                return (int) $size;
            } else {
                echo "Invalid input. Please enter a positive number.\n";
            }
        }
    }

    public function startMenu()
    {
        $this->size = $this->getRosterSize();

        $this->display();
    }

    public function display()
    {
        while ($this->repeat) {
            echo "Current Roster Size: {$this->size}\n";
            echo "[1] Add Employee\n";
            echo "[2] Delete Employee\n";
            echo "[3] Other Menu\n";
            echo "[0] Exit\n";
            $choice = readline("Pick from the menu: ");

            switch ($choice) {
                case 1:
                    return $this->addMenu();
                case 2:
                    return $this->deleteMenu();
                case 3:
                    return $this->otherMenu();
                case 0:
                    $this->exitProgram();
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    readline("Press \"Enter\" key to continue...");
                    $this->display();
            }
        }
    }

    public function exitProgram()
    {
        echo "Exiting the program...\n";
        $this->repeat = false;
    }

    public function addMenu()
    {
        $validInput = false;  // Flag to track if the input is valid

        while (!$validInput) {
            $name = readline("Enter name: ");
            $address = readline("Enter address: ");
            $age = readline("Enter age: ");
            $company = readline("Enter company name: ");

            // Assuming age is an integer, and it should be a positive number
            if (!is_numeric($age) || $age <= 0) {
                echo "Invalid age. Please enter a valid number greater than zero.\n";
                continue; // Prompt the user again
            }

            $this->employeeType($name, $address, $age, $company);
            $validInput = true;  // If input is valid, exit the loop
        }

        $this->repeat();
    }

    public function deleteMenu()
    {
        $this->clear();
        echo "Delete Employee Menu:\n";

        // Display all employees for reference
        $this->roster->displayAllEmployee();

        // Prompt user to enter the index of the employee they want to delete
        $index = (int)readline("Enter the index of the employee you want to delete: ");

        // Call the Roster class method to delete the employee
        $success = $this->roster->removeEmployee($index);

        if ($success) {
            echo "Employee at index $index has been removed successfully.\n";
        } else {
            echo "Failed to remove employee. Invalid index.\n";
        }

        readline("Press \"Enter\" key to continue...");
        $this->deleteMenu();
    }

    public function employeeType($name, $address, $age, $company)
    {
        $validInput = false;  // Flag to track if the input is valid

        while (!$validInput) {
            $employeeType = readline("[1] Commission Employee     [2] Hourly Employee     [3] Piece Worker: ");

            switch ($employeeType) {
                case 1:
                    $this->addOnCommissionEmployee($name, $address, $age, $company);
                    $validInput = true;  // Exit the loop
                    break;
                case 2:
                    $this->addOnHourlyEmployee($name, $address, $age, $company);
                    $validInput = true;  // Exit the loop
                    break;
                case 3:
                    $this->addOnPieceWorker($name, $address, $age, $company);
                    $validInput = true;  // Exit the loop
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    // Continue prompting the user until they provide a valid choice
            }
        }
    }
    public function addOnCommissionEmployee($name, $address, $age, $company)
    {
        $salary = readline("Enter Regular Salary: ");
        $totalSales = readline("Enter # of items: ");
        $commissionRate = readline("Enter commission (%): ");
        $employee = new CommissionEmployee($name, $address, $age, $company, $salary, $totalSales, $commissionRate);
        $this->roster->addEmployee($employee);
        $this->repeat();
    }

    public function addOnHourlyEmployee($name, $address, $age, $company)
    {
        $hoursWorked = readline("Enter hours worked: ");
        $hourlyRate = readline("Enter hourly rate: ");
        $employee = new HourlyEmployee($name, $address, $age, $company, $hoursWorked, $hourlyRate);
        $this->roster->addEmployee($employee);
        $this->repeat();
    }

    public function addOnPieceWorker($name, $address, $age, $company)
    {
        $pieceProduced = readline("Enter # of items: ");
        $wagePerPiece = readline("Enter wage per items: ");
        $employee = new PieceWorker($name, $address, $age, $company, $pieceProduced, $wagePerPiece);
        $this->roster->addEmployee($employee);
        $this->repeat();
    }

    public function repeat()
    {
        echo "Employee Added!\n";
        if ($this->roster->count() < $this->size) {
            $c = readline("Add more ? (y to continue): ");
            readline("Press \"Enter\" key to continue...");
            if (strtolower($c) == 'y')
                $this->addMenu();
            else
                $this->display();
        } else {
            echo "Roster is Full\n";
            readline("Press \"Enter\" key to continue...");
            $this->display();
        }
    }

    public function otherMenu()
    {
        $this->clear();
        echo "[1] Display";
        echo "[2] Count";
        echo "[3] Payroll";
        echo "[0] Exit";
        $choice = readline("Select Menu: ");

        switch ($choice) {
            case 1:
                return $this->displayMenu();
            case 2:
                return $this->countMenu();
            case 3:
                return $this->payrollMenu();
            case 0:
                return $this->display();
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->otherMenu();
        }
    }

    public function displayMenu()
    {
        $this->clear();
        echo "[1] Display All Employee";
        echo "[2] Display Commission Employee";
        echo "[3] Display Hourly Employee";
        echo "[4] Display Piece Worker";
        echo "[0] Return";
        $displayChoice = readline("Select Menu: ");
        switch ($displayChoice) {
            case 1:
                return $this->roster->displayAllEmployee();
            case 2:
                return $this->roster->displayCommissionEmployee();
            case 3:
                return $this->roster->displayHourlyEmployee();
            case 4:
                return $this->roster->displayPieceWorker();
            case 0:
                return $this->otherMenu();
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->displayMenu();
        }
    }

    public function countMenu()
    {
        $this->clear();
        echo "[1] Count All Employee";
        echo "[2] Count Commission Employee";
        echo "[3] Count Hourly Employee";
        echo "[4] Count Piece Worker";
        echo "[0] Return";
        $countChoice = readline("Select Menu: ");
        switch ($countChoice) {
            case 1:
                return $this->countAllEmployees();
            case 2:
                return $this->countCommissionEmployees();
            case 3:
                return $this->countHourlyEmployees();
            case 4:
                return $this->countPieceWorkers();
            case 0:
                return $this->otherMenu();
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->countMenu();
        }
    }

    public function countAllEmployees()
    {
        $count = $this->roster->countEmployee();
        echo "Total Employees: $count\n";
    }

    public function countCommissionEmployees()
    {
        $count = $this->roster->countEmployee("CommissionEmployee");
        echo "Total Commission Employees: $count\n";
    }

    public function countHourlyEmployees()
    {
        $count = $this->roster->countEmployee("HourlyEmployee");
        echo "Total Hourly Employees: $count\n";
    }

    public function countPieceWorkers()
    {
        $count = $this->roster->countEmployee("PieceWorker");
        echo "Total Piece Workers: $count\n";
    }

    public function payrollMenu()
    {
        echo "Payroll Menu\n";

        if (empty($this->employee)) {
            echo "No employees to display.\n";
            return;
        }

        foreach ($this->roster->getEmployees() as $index => $emp) {
            // Assuming $emp is either a PieceWorker or HourlyEmployee object
            echo "Employee: " . $emp->getName() . "\n";
            echo "Earnings: " . $emp->earning() . "\n";  // Call the earnings method for each employee
        }
    }
}
