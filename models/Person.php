<?php
    class Person {
        public $fullname;
        public $contactNumber;
        public $emailAddress;
        public $address;

         // set fullname
        public function setFullname($fullname) {
            $this->fullname = $fullname;
        }
        // set contact contact number
        public function setContactNumber($contactNumber) {
            $this->contactNumber = $contactNumber;
        }
        // set contact email address
        public function setEmailAddress($emailAddress) {
            $this->emailAddress = $emailAddress;
        }
        // set contact address
        public function setAddress($address) {
            $this->address = $address;
        }
    }
?>