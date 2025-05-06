<?php
class Car {
    private static $count = 0;
    private $model;
    private $price;
    private $exchangeRate;
    public static $objectsArray = array();

    public function __construct($model, $price, $exchangeRate) {
        $this->model = $model;
        $this->price = $price;
        $this->exchangeRate = $exchangeRate;
        self::$count++;
        self::$objectsArray[] = $this;
    }

    public static function getCount() {
        return self::$count;
    }

    public static function getObjectsArray() {
        return self::$objectsArray;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setExchangeRate($exchangeRate) {
        $this->exchangeRate = $exchangeRate;
    }

    public function getModel() {
        return $this->model;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getExchangeRate() {
        return $this->exchangeRate;
    }

    public function value() {
        return $this->price * $this->exchangeRate;
    }

    public function __toString() {
        return "Model: " . $this->model . ", Price: " . $this->price . " EURO, Exchange Rate: " . $this->exchangeRate . " PLN";
    }
}

class NewCar extends Car {
    private $alarm;
    private $radio;
    private $climatronic;

    public function __construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic) {
        parent::__construct($model, $price, $exchangeRate);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->climatronic = $climatronic;
    }

    public function value() {
        $value = parent::value();
        $percentageRatio = 1.0;
        if ($this->alarm) {
            $percentageRatio += 0.05;
        }
        if ($this->radio) {
            $percentageRatio += 0.075;
        }
        if ($this->climatronic) {
            $percentageRatio += 0.1;
        }
        return $value * $percentageRatio;
    }

    public function getAlarm() {
        return $this->alarm;
    }

    public function setAlarm($alarm) {
        $this->alarm = $alarm;
    }

    public function getRadio() {
        return $this->radio;
    }

    public function setRadio($radio) {
        $this->radio = $radio;
    }

    public function getClimatronic() {
        return $this->climatronic;
    }

    public function setClimatronic($climatronic) {
        $this->climatronic = $climatronic;
    }

    public function __toString() {
        return parent::__toString() . ", Alarm: " . ($this->alarm ? "Yes" : "No") . ", Radio: " . ($this->radio ? "Yes" : "No") . ", Climatronic: " . ($this->climatronic ? "Yes" : "No");
    }
}

class InsuranceCar extends NewCar {
    private $firstOwner;
    private $years;

    public function __construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic, $firstOwner, $years) {
        parent::__construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic);
        $this->firstOwner = $firstOwner;
        $this->years = $years;
    }

    public function getFirstOwner() {
        return $this->firstOwner;
    }

    public function setFirstOwner($firstOwner) {
        $this->firstOwner = $firstOwner;
    }

    public function getYears() {
        return $this->years;
    }

    public function setYears($years) {
        $this->years = $years;
    }

    public function value() {
        $value = parent::value();
        $value -= $value * ($this->years * 0.01);
        if ($this->firstOwner) {
            $value *= 0.95;
        }
        return $value;
    }

    public function __toString() {
        return parent::__toString() . ", First Owner: " . ($this->firstOwner ? "Yes" : "No") . ", Years: " . $this->years;
    }
}

?>
