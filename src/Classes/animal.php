<?php 
    namespace App\Class;

    class animal{
        private string $name;

        public function getName(){
            return $this->name;
        }

        public function setName(string $name){
            $this->name = $name;
        }

        /////////////////

        private string $species;

        public function getSpecies(){
            return $this->species;
        }

        public function setSpecies(string $species){
            $this->species = $species;
        }

        /////////////////

        private int $age;

        public function getAge(){
            return $this->age;
        }

        public function setAge(int $age){
            $this->age = $age;
        }

        /////////////////

        private int $owner;

        public function getOwner(){
            return $this->owner;
        }

        public function setOwner(int $ownerId){
            $this->owner = $ownerId;
        }

        /////////////////

        public function __construct(string $name, string $species, int $age, int $ownerId){
            $this->name = $name;
            $this->species = $species;
            $this->age = $age;
            $this->owner = $ownerId;
        }

        /////////////////

        public function returnInfo(){
            return $animal = ['name' => $this->name, 'species' => $this->species, 'age' => $this->age, 'owner' => $this->owner];
        }
    }
?>