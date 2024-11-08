<?php

class Main
{
    public function display()
    {
        while (true) {
            echo "Select an option:\n1. Add Employee\n2. View All Employees\n3. Quit\n";
            $choice = trim(readline("Enter your choice (1, 2, or 3): "));

            if ($choice == '1') {
                $this->addEmployee();
            } elseif ($choice == '2') {
                echo "All Employees:" . PHP_EOL;
                Employee::printAllEmployees();
            } elseif ($choice == '3') {
                echo "Exiting program." . PHP_EOL;
                break;
            } else {
                echo "Invalid choice. Please enter 1, 2, or 3." . PHP_EOL;
            }
            echo PHP_EOL;
        }
    }

    private function addEmployee()
    {
        do {
            // Prompt the user for employee details
            echo "Enter employee role (Manager/Developer): ";
            $role = trim(readline());

            echo "Enter employee name: ";
            $name = trim(readline());

            echo "Enter employee age: ";
            $age = (int) trim(readline());

            echo "Enter employee department: ";
            $department = trim(readline());

            // Create the appropriate employee object based on role
            if (strtolower($role) == 'manager') {
                new Manager($name, $age, $department);
            } elseif (strtolower($role) == 'developer') {
                new Developer($name, $age, $department);
            } else {
                echo "Invalid role. Please enter either 'Manager' or 'Developer'." . PHP_EOL;
                continue; // Repeat the loop if the role is invalid
            }

            // Ask if the user wants to add another employee or quit
            echo "Would you like to add another employee? (yes/no): ";
            $continue = strtolower(trim(readline()));

            echo PHP_EOL;
        } while ($continue == 'yes');
    }
}
