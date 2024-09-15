<?php
abstract class Shape{
    abstract public function area();
    abstract public function information();
}

class  Circle extends Shape{
    private $radius;
    public function __construct($radius){
        $this->radius = $radius;
    }
    public function area() {
        return pi() * ($this->radius ** 2);
    }

    public function information() {
        return "Circle with radius {$this->radius} has an area of " . $this->area() . ".";
    }
}

class  Rectangle extends Shape{
    private $height;
    private $width;
    public function __construct($height, $width) {
        $this->height = $height;
        $this->width = $width;
    }
    public function area() {
        return $this->width * $this->height;
    }

    public function information() {
        return "Rectangle with width {$this->width} and height {$this->height} has an area of " . $this->area() . ".";
    }
}

$circle = new Circle(15);
$rectangle = new Rectangle(9, 5);

echo "Circle: ".$circle->information();
echo "\n";
echo "Rectangle: ".$rectangle->information();