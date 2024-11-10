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
        pclose(popen("cls", "w"));
    }

    public function startMenu()
    {
        $this->size = $this->getRosterSize();
        $this->display();
    }

    public function getRosterSize()
    {
        while (true) {
            $size = readline("Enter the size of the roster: ");
            if (is_numeric($size) && $size > 0) {
                return $size;
            } else {
                echo "Invalid input. Please enter a positive number.\n";
            }
        }
    }

    public function display()
    {
        while ($this->repeat) {
            $this->clear();
            echo "Current Roster Size: {$this->size}\n";
            echo "[1] Add Employee\n";
            echo "[2] Delete Employee\n";
            echo "[3] Other Menu\n";
            echo "[0] Exit\n";
            $choice = readline("Pick from the menu: ");

            switch ($choice) {
                case 1:
                    $this->addMenu();
                    break;
                case 2:
                    $this->deleteMenu();
                    break;
                case 3:
                    $this->otherMenu();
                    break;
                case 0:
                    $this->exitProgram();
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
                    readline("Press \"Enter\" key to continue...");
                    $this->display();
                    break;
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
        $validInput = false;

        while (!$validInput) {
            $this->clear();
            $name = readline("Enter name: ");
            $address = readline("Enter address: ");
            $age = readline("Enter age: ");
            $company = readline("Enter company name: ");
            if (!is_numeric($age) || $age <= 0) {
                echo "Invalid age. Please enter a valid number greater than zero.\n";
                continue;
            }
            $this->employeeType($name, $address, $age, $company);
            $validInput = true;
        }

        $this->addMore();
    }

    public function deleteMenu()
    {
        $this->clear();
        echo "Delete Employee Menu:\n";
        $this->roster->displayAllEmployee();
        $index = readline("Enter the index of the employee you want to delete: ");
        $this->roster->removeEmployee($index);
        readline("Press \"Enter\" key to continue...");
        $this->display();
    }

    public function employeeType($name, $address, $age, $company)
    {
        $validInput = false;

        while (!$validInput) {
            $employeeType = readline("[1] Commission Employee     [2] Hourly Employee     [3] Piece Worker: ");

            switch ($employeeType) {
                case 1:
                    $this->addOnCommissionEmployee($name, $address, $age, $company);
                    $validInput = true;
                    break;
                case 2:
                    $this->addOnHourlyEmployee($name, $address, $age, $company);
                    $validInput = true;
                    break;
                case 3:
                    $this->addOnPieceWorker($name, $address, $age, $company);
                    $validInput = true;
                    break;
                default:
                    echo "Invalid input. Please try again.\n";
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
        $this->addMore();
    }

    public function addOnHourlyEmployee($name, $address, $age, $company)
    {
        $hoursWorked = readline("Enter hours worked: ");
        $hourlyRate = readline("Enter hourly rate: ");
        $employee = new HourlyEmployee($name, $address, $age, $company, $hoursWorked, $hourlyRate);
        $this->roster->addEmployee($employee);
        $this->addMore();
    }

    public function addOnPieceWorker($name, $address, $age, $company)
    {
        $pieceProduced = readline("Enter # of items: ");
        $wagePerPiece = readline("Enter wage per items: ");
        $employee = new PieceWorker($name, $address, $age, $company, $pieceProduced, $wagePerPiece);
        $this->roster->addEmployee($employee);
        $this->addMore();
    }

    public function addMore()
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
        echo "[1] Display\n";
        echo "[2] Count\n";
        echo "[3] Payroll\n";
        echo "[0] Exit\n";
        $choice = readline("Select Menu: ");

        switch ($choice) {
            case 1:
                $this->displayMenu();
                break;
            case 2:
                $this->countMenu();
                break;
            case 3:
                $this->payrollMenu();
                break;
            case 0:
                $this->display();
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->otherMenu();
                break;
        }
    }

    public function displayMenu()
    {
        $this->clear();
        echo "[1] Display All Employee\n";
        echo "[2] Display Commission Employee\n";
        echo "[3] Display Hourly Employee\n";
        echo "[4] Display Piece Worker\n";
        echo "[0] Return\n";
        $displayChoice = readline("Select Menu: ");
        switch ($displayChoice) {
            case 1:
                $this->roster->displayAllEmployee();
                readline("Press \"Enter\" key to continue...");
                $this->displayMenu();
                break;
            case 2:
                $this->roster->displayCommissionEmployee();
                readline("Press \"Enter\" key to continue...");
                $this->displayMenu();
                break;
            case 3:
                $this->roster->displayHourlyEmployee();
                readline("Press \"Enter\" key to continue...");
                $this->displayMenu();
                break;
            case 4:
                $this->roster->displayPieceWorker();
                readline("Press \"Enter\" key to continue...");
                $this->displayMenu();
                break;
            case 0:
                $this->otherMenu();
                break;
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->displayMenu();
                break;
        }
    }

    public function countMenu()
    {
        $this->clear();
        echo "[1] Count All Employee\n";
        echo "[2] Count Commission Employee\n";
        echo "[3] Count Hourly Employee\n";
        echo "[4] Count Piece Worker\n";
        echo "[0] Return\n";
        $countChoice = readline("Select Menu: ");
        switch ($countChoice) {
            case 1:
                $this->roster->countAllEmployees();
                readline("Press \"Enter\" key to continue...");
                $this->countMenu();
                break;
            case 2:
                $this->roster->countCommissionEmployees();
                readline("Press \"Enter\" key to continue...");
                $this->countMenu();
                break;
            case 3:
                $this->roster->countHourlyEmployees();
                readline("Press \"Enter\" key to continue...");
                $this->countMenu();
                break;
            case 4:
                $this->roster->countPieceWorkers();
                readline("Press \"Enter\" key to continue...");
                $this->countMenu();
                break;
            case 0:
                return $this->otherMenu();
            default:
                echo "Invalid input. Please try again.\n";
                readline("Press \"Enter\" key to continue...");
                $this->countMenu();
                break;
        }
    }

    public function payrollMenu()
    {
        echo "Payroll Menu\n";
        $this->roster->displayAllPayrolls();
        readline("Press \"Enter\" key to continue...");
        $this->otherMenu();
    }
}
