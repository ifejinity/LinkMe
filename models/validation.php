<?php
    class Validation Extends Connection {
        public $errorMessages = ["fullname"=>"", "username"=>"", "password"=>"", "contactNumber"=>"", "emailAddress"=>"", "address"=>""];
        private $status = true;
        private $userId;
        
        // validate fullname
        public function validateFullname($object) {
            if($object->fullname === ""){
                $this->errorMessages["fullname"] = "Fullname is required!";
                $this->status = false;
            } elseif (strlen($object->fullname) > 50 || strlen($object->fullname) < 6) {
                $this->errorMessages["fullname"] = "Fullname should have minimum of 6 or maximum of 50 characters";
                $this->status = false;
            }
        }
        // validate username
        public function validateUsername($object) {
            if($object->username === ""){
                $this->errorMessages["username"] = "Username is required!";
                $this->status = false;
            } elseif (strlen($object->username) > 15 || strlen($object->username) < 6) {
                $this->errorMessages["username"] = "Username should have minimum of 6 or maximum of 14 characters";
                $this->status = false;
            }
        }
        // validate address
        public function validateAddress($object) {
            if($object->address === ""){
                $this->errorMessages["address"] = "Address is required!";
                $this->status = false;
            } elseif (strlen($object->address) < 6 || strlen($object->address) > 120) {
                $this->errorMessages["address"] = "Address should have minimum of 6 or maximum of 120 characters!";
                $this->status = false;
            }
        }
        // validate email
        public function validateEmail($object) {
            if($object->emailAddress === ""){
                $this->errorMessages["emailAddress"] = "Email is required!";
                $this->status = false;
            } elseif (strlen($object->emailAddress) > 50 || strlen($object->emailAddress) < 6) {
                $this->errorMessages["emailAddress"] = "Email should have minimum of 3 or maximum of 50 characters";
                $this->status = false;
            } else if(!filter_var($object->emailAddress, FILTER_VALIDATE_EMAIL)) {
                $this->errorMessages["emailAddress"] = "Invalid email address!";
                $this->status = false;
            }
        }
        // validate email if already taken
        public function uniqueEmail($object) {
            $sql = $this->connection->prepare("SELECT * FROM contacts_tb WHERE email_address = ?");
            $this->userId = $object2->getUserId();
            $sql->bind_param("s",  $object->emailAddress, $this->userId);
            $sql->execute();
            $result = $sql->get_result();
                if($result->num_rows > 0) {
                    $this->errorMessages["emailAddress"] = "Email address is already taken";
                    $this->status = false;
                }
            $sql->close();
        }
        // validate username if already taken
        public function uniqueUsername($object) {
            $sql = $this->connection->prepare("SELECT * FROM users_tb WHERE username = ?");
            $sql->bind_param("s",  $object->username);
            $sql->execute();
            $result = $sql->get_result();
                if($result->num_rows > 0) {
                    $this->errorMessages["username"] = "Username is already taken";
                    $this->status = false;
                }
            $sql->close();
        }
        // validate password
        public function validatePassword($object) {
            if($object->password != $object->passwordConfirm) {
                $this->errorMessages["password"] = "Password confirmation failed!";
                $this->status = false;
            } elseif ($object->password == "") {
                $this->errorMessages["password"] = "Password is required!";
                $this->status = false;
            } elseif ($object->password < 6) {
                $this->errorMessages["password"] = "Password should contain more than 6 characters!";
                $this->status = false;
            }
        }
        // validate mobile number
        public function validateContactNumber($object) {
            if( $object->contactNumber === "") {
                $this->errorMessages["contactNumber"] = "Contact number is required!";
                $this->status = false;
            } else if (!preg_match('/^(?:\+63|0)9\d{9}$/', $object->contactNumber)) {
                $this->errorMessages["contactNumber"] = "Invalid contact number!";
                $this->status = false;
            }
        }
        // get status
        public function getStatus() {
            return $this->status;
        }
    }
?>  