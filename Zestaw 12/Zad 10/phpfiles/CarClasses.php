<?php

class Car
{
    protected $key;
    protected $model;
    protected $price;
    protected $exchangeRate;

    /**
     * @param $model
     * @param $price
     * @param $exchangeRate
     */
    public function __construct($model, $price, $exchangeRate)
    {
        $this->model = $model;
        $this->price = $price;
        $this->exchangeRate = $exchangeRate;
        $this->key = intval(time()*(49/48)*121) - 210500000000 - 1716000000;

    }

    public function getKey(): int
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @param mixed $exchangeRate
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    public function value()
    {
        return $this->price * $this->exchangeRate;
    }

    public function __toString()
    {
        return "Model: <b>$this->model</b><br>
                Price: <b>$this->price</b> <i>EURO</i><br>
                Exchange Rate: <b>$this->exchangeRate</b> <i>PLN</i>";
    }


}

class NewCar extends Car
{
    protected $alarm;
    protected $radio;
    protected $climatronic;

    public function __construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic)
    {
        parent::__construct($model, $price, $exchangeRate);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->climatronic = $climatronic;
    }


    /**
     * @return mixed
     */
    public function getAlarm()
    {
        return $this->alarm;
    }

    /**
     * @param mixed $alarm
     */
    public function setAlarm($alarm)
    {
        $this->alarm = $alarm;
    }

    /**
     * @return mixed
     */
    public function getRadio()
    {
        return $this->radio;
    }

    /**
     * @param mixed $radio
     */
    public function setRadio($radio)
    {
        $this->radio = $radio;
    }

    /**
     * @return mixed
     */
    public function getClimatronic()
    {
        return $this->climatronic;
    }

    /**
     * @param mixed $climatronic
     */
    public function setClimatronic($climatronic)
    {
        $this->climatronic = $climatronic;
    }

    public function Value()
    {
        $valuePercentage = 1.0;
        if ($this->alarm)
            $valuePercentage += 0.05;

        if ($this->radio)
            $valuePercentage += 0.075;

        if ($this->climatronic)
            $valuePercentage += 0.1;

        return parent::value() * $valuePercentage;
    }

    public function __toString()
    {
        $arr = array('No', 'No', 'No');
        if ($this->alarm)
            $arr[0] = 'Yes';

        if ($this->radio)
            $arr[1] = 'Yes';

        if ($this->climatronic)
            $arr[2] = 'Yes';

        return parent::__toString() .
            "<br>Alarm: <b>$arr[0]</b>
             <br>Radio: <b>$arr[1]</b>
             <br></b>Climatronic: <b>$arr[2]</b>";
    }


}

class InsuranceCar extends NewCar
{
    private $firstOwner;
    private $years;

    /**
     * @param $years
     * @param $firstOwner
     */
    public function __construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic, $firstOwner, $years)
    {
        parent::__construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic);
        $this->years = $years;
        $this->firstOwner = $firstOwner;
    }

    /**
     * @return mixed
     */
    public function getFirstOwner()
    {
        return $this->firstOwner;
    }

    /**
     * @param mixed $firstOwner
     */
    public function setFirstOwner($firstOwner)
    {
        $this->firstOwner = $firstOwner;
    }

    /**
     * @return mixed
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @param mixed $years
     */
    public function setYears($years)
    {
        $this->years = $years;
    }

    public function Value()
    {
        if ($this->firstOwner){
            return parent::Value()*(1 - (0.01 * $this->years));
        }
        return parent::Value();
    }

    public function __toString()
    {
        return parent::__toString() .
            "<br>First Owner: <b>" . ($this->firstOwner ? "Yes" : "No") . "</b>" .
            "<br>Years: <b>" . $this->years . "</b>";
    }


}
?>