<?php

class Employee{
    private $name;
    private $salary;
    private $bonus;
    public function __construct($name){
        $this->name = $name;
    }
    public function setSalary($salary){
        $this->salary = $salary;
    }
    public function setBonus($bonus=0){
        $this->bonus = $bonus;
    }
    public function getName(){
        return "Employee Name: ".$this->name;
    }
    public function getSalary(){
        return "Employee Salary: ".$this->salary;
    }
    public function getBonus(){
        return "Employee Bonus: ".$this->bonus;
    }
}

$employee = new Employee("Abdul Karim");
$employee->setSalary(5000);
$employee->setBonus(1000);
echo $employee->getName()."\n";
echo $employee->getSalary()."\n";
echo $employee->getBonus()."\n";