<?php 
    namespace App\Class;

    class vet{
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

        private array $animals = [];

        public function getSpecificAnimal(int $id){
            return $this->animals[$id];
        }

        public function getAllAnimals(){
            return $this->animals;
        }

        public function addAnimal($animalId){
            array_push($this->animals, $animalId);
        }

        /////////////////

        public function __construct(string $name, string $lastname){
            $this->name = $name;
            $this->lastname = $lastname;
        }

        /////////////////

        public function listInfo(){
            return $vet = ['name' => $this->name, 'lastName' => $this->lastname];
        }
    }
?>