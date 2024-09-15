<?php
class Animal {
    public function makeSound() {
        return "This is animal sound";
    }
}

class Dog extends Animal{
    public function makeSound() {
        return "This is Dog sound";
    }
}
class Cat extends Animal{
    public function makeSound() {
        return "This is Cat sound";
    }
}

$animal = new Animal();
echo $animal->makeSound();  // Output: This is animal sound
echo "\n";

$dog = new Dog();
echo $dog->makeSound();  // Output: This is Dog sound
echo "\n";

$cat = new Cat();
echo $cat->makeSound();  // Output: This is Cat sound
