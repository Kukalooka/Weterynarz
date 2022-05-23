<?php 
    namespace App\Class;

    class logwizyt{
        private string $date;

        public function getDate(){
            return $this->date;
        }

        public function setDate($date){
            $date_arr  = explode('/', $date);
            if (checkdate($date_arr[0], $date_arr[1], $date_arr[2])) {
                $this->date = $date;
            }
        }

        private int $vetId;

        public function getVetId(){
            return $this->vetId;
        }

        private int $animalId;

        public function getAnimalId(){
            return $this->animalId;
        }

        public function __construct(string $date, int $vetId, int $animalId){
            $this->date = $date;
            $this->vetId = $vetId;
            $this->animalId = $animalId;
        }
    }
?>