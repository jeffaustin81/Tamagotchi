<?php
    class Tamagotchi
    {
        private $name;
        private $food;
        private $play;
        private $sleep;

        function __construct($name = '', $food = 50, $play = 50, $sleep = 50)
        {
            $this->name = $name;
            $this->food = $food;
            $this->play = $play;
            $this->sleep = $sleep;
        }

        function setName($name)
        {
            $this->name = $name;
        }

        function getName()
        {
            return $this->name;
        }


        function setFood($food)
        {
            $this->food = $food;
        }

        function getFood()
        {
            return $this->food;
        }

        function setPlay($play)
        {
            $this->play = $play;
        }

        function getPlay()
        {
            return $this->play;
        }

        function setSleep($sleep)
        {
            $this->sleep = $sleep;
        }

        function getSleep()
        {
            return $this->sleep;
        }

        function save()
        {
            array_push($_SESSION['state_of_tamagotchi'], $this);
        }

        function checkDeath()
        {
            if(($this->food == 0) || ($this->play == 0) || ($this->sleep == 0)) {
                return true;
            }

            return false;
        }

        static function getAll()
        {
            return $_SESSION['state_of_tamagotchi'];
        }

        static function deleteAll()
        {
            $_SESSION['state_of_tamagotchi'] = array();
        }

    }
?>
