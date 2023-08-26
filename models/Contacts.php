<?php
    class Contacts Extends Person {
        private $connection;
        public $contactId;

        // set connection within the contacts class
        public function __construct($conn) {
            $this->connection = $conn->getConnection();
        }
        // set contact id
        public function setContactId($contactId) {
            $this->contactId = $contactId;
        }
        // create contact
        public function createContacts($user, $validate) {
            $sql = $this->connection->prepare("INSERT INTO contacts_tb (fullname, contact_number, email_address, address, users_id) VALUES (?, ?, ?, ?, ?)");
            $userId = $user->getUserId();
            $sql->bind_param("ssssi", $this->fullname, $this->contactNumber, $this->emailAddress, $this->address, $userId);
            // get error messages
            $errorMessages = $validate->errorMessages;
            // declare an array variable
            $result = [];
            // validate status
            if($validate->getStatus()){
                $sql->execute();
                $message =  "Contact Added!";
                // get all contacts
                $contactsData = $this->getAllContacts($user);
                while ($row = $contactsData->fetch_assoc()) {
                    $result[] = ["fullname" => $row["fullname"], 
                                "contactNumber" => $row["contact_number"], 
                                "emailAddress" => $row["email_address"], 
                                "address" => $row["address"], 
                                "contactId" => $row["contact_id"]];
                }
                $data = [$message, $errorMessages, $result];
                echo json_encode($data);
            } else {
                $message =  "Failed to add contact!";
                $data = [$message, $errorMessages, $result];
                echo json_encode($data);
            }
        }
        // get all contacts
        public function getAllContacts($user) {
            $sql = $this->connection->prepare("SELECT * FROM contacts_tb WHERE users_id = ?");
            $this->userId = $user->getUserId();
            $sql->bind_param("i", $this->userId);
            $sql->execute();
            $result = $sql->get_result();
            return $result;
        }
        // search contacts by name 
        public function searchContacts($user) {
            $sql = $this->connection->prepare("SELECT * FROM contacts_tb WHERE fullname LIKE ? AND users_id = ?");
            $searchTerm = $this->fullname . "%";
            $userId = $user->getUserId();
            $sql->bind_param("si", $searchTerm, $userId);
            $sql->execute();
            $result = $sql->get_result();
            $data = [];
            while($row = $result->fetch_assoc()) {
                $data[] = ["fullname"=>$row["fullname"], "contactNumber"=>$row["contact_number"], "emailAddress"=>$row["email_address"], "address"=>$row["address"], "contactId"=>$row["contact_id"]];
            }
            echo json_encode($data);
        }
        // delete contacts
        public function deleteContacts() {
            $sql = $this->connection->prepare("SELECT * FROM contacts_tb WHERE contact_id = ?");
            $sql->bind_param("i", $this->contactId);
            $sql->execute();
            $result = $sql->get_result();
            if($result->num_rows > 0) {
                $sql->close();
                $sql = $this->connection->prepare("DELETE FROM contacts_tb WHERE contact_id = ?");
                $sql->bind_param("i", $this->contactId);
                if($sql->execute()) {
                    unset($_SESSION["contact"]);
                    echo "success";
                }
            } else {
                echo "failed";
            }
            $sql->close();
        }
        // get edit contact
        public function getContactData() {
            $sql = $this->connection->prepare("SELECT * FROM contacts_tb WHERE contact_id = ?");
            $sql->bind_param("i", $this->contactId);
            $sql->execute();
            $result = $sql->get_result();
            while ($row = $result->fetch_assoc()) {
                $contactId = $row["contact_id"];
                $fullname = $row["fullname"];
                $contactNumber = $row["contact_number"];
                $emailAddress = $row["email_address"];
                $address = $row["address"];
            }
            $sql->close();
            return $contact = ["contact_id"=>$contactId, "fullname" => $fullname, "contact_number"=>$contactNumber, "email_address"=>$emailAddress, "address"=>$address];
        }
        // save changes to contact
        public function saveEdit($validate) {
            $sql = $this->connection->prepare("UPDATE contacts_tb SET fullname = ?, contact_number = ?, email_address = ?, address = ? WHERE contact_id = ?");
            $sql->bind_param("ssssi", $this->fullname, $this->contactNumber, $this->emailAddress, $this->address, $this->contactId);
            // get error messages
            $errorMessages = $validate->errorMessages;
            // validate status
            if($validate->getStatus()){
                $sql->execute();
                $message =  "success";
                $data = [$message, $errorMessages];
                $_SESSION["contact"] = ["fullname"=>$this->fullname, "contact_number"=>$this->contactNumber, "email_address"=>$this->emailAddress, "address"=>$this->address, "contact_id"=>$this->contactId];
                echo json_encode($data);
            } else {
                $message =  "failed";
                $data = [$message, $errorMessages];
                echo json_encode($data);
            }
        }
        
    }
?>