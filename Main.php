<?php

class Main
{
    public function clear()
    {
        system('clear');
    }
    public function display()
    {

        while (true) {
            $this->clear();
            echo "*** Employee Rooster Menu ***";
            echo "[1] Add Employee";
            echo "[2] Delete Employee";
            echo "[3] Other menu";
            echo "[0] Exit";
            // echo "Select an option:\n1. Add Employee\n2. View All Employees\n3. Quit\n";
            $choice = trim(readline("Pick from the menu: "));

            switch ($choice) {
                case 1:
                    return $this->addEmployee();
                case 2:
                    // return $this->deleteEmployee();
                    break;
                case 3:
                    return $this->otherMenu();
                case 4:
                    // exit menu;
                    break;
                default:
                    echo "Invalid choice. Please enter 1,2, or 3." . PHP_EOL;
                    break;
            }
            echo PHP_EOL;
        }
    }

    private function addEmployee()
    {
        do {
            echo "Add Employee\n---Employee Details";
            // Prompt the user for employee details
            $name = readline("Enter name: ");
            $address = readline("Enter address: ");
            $company = readline("Enter company name: ");
            $age = readline("Enter age: ");
            $department = readline("[1] Comission Employee   [2] Hourly Employee   [3] Place workerType of Employee: ");

            switch ($department) {
                case 1:
                    $salary = readline("Enter regular salary: ");
                    $items = readline("Enter # of items: ");
                    $commission = readline("Enter commission (%): ");
                    echo "Employee Added!";
                    break;
                case 2:
                    $hours = readline("Enter hours worked: ");
                    $rate = readline("Enter rate: ");
                    echo "Employee Added";
                    break;
                case 3:
                    $items = readline("Enter # of items: ");
                    $wage = readline("Enter wage per items: ");
                    echo "Employee Added";
                    break;
                default:
                    echo "Invalid choice. Please enter 1,2, or 3." . PHP_EOL;
                    break;
            }

            // Ask if the user wants to add another employee or quit
            echo "Add more ? (y to continue): ";
            $continue = strtolower(trim(readline()));

            echo PHP_EOL;
        } while ($continue == 'y');
    }

    public function otherMenu()
    {
        echo "[1] Display";
        echo "[2] Count";
        echo "[3] Payroll";
        echo "[0] Return";
        $menu = readline("Select Menu: ");

        switch ($menu) {
            case 1:
                // Display
                break;
            case 2:
                return $this->countMenu();
            case 3:
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
        $menu = readline("Select Menu: ");

        switch ($menu) {
            case 1:
        }
    }
}
