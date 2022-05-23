<?php 
    namespace App\Class;

    class owner{
        private string $name;

        public function getName(){
            return $this->name;
        }

        public function setName(string $name){
            $this->name = $name;
        }

        /////////////////

        private string $lastname;

        public function getLastName(){
            return $this->lastname;
        }

        public function setLastName($lastname){
            $this->lastname = $lastname;
        }

        /////////////////

        public function __construct(string $name, string $lastname){
            $this->name = $name;
            $this->lastname = $lastname;
        }

        public function returnInfo(){
            return array('name' => $this->name, 'lastName' => $this->lastname);
        }
    }
?>
