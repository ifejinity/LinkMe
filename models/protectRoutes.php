<?php
    class ProtectRoutes {
        // check if there's a user logged in
        public function user() {
            if(isset($_SESSION["username"])) {
                header("Location: ./contacts.php");
            }
        }
        // check if there's a user logged in
        public function guest() {
            if(!isset($_SESSION["username"])) {
                header("Location: ./index.php");
            }
        }
        //check if there's a contact data to edit that belongs to current user
        public function savedContactData($conn, $user) {
            if(isset($_SESSION["contact"]) && isset($_SESSION["username"])) { 
                // assigning value for conn variable
                $conn = $conn->getConnection();
                // assigning value for contact variable 
                $contact = $_SESSION["contact"];
                // set user username value equal to username of current user
                $user->setUsername($_SESSION["username"]);
                // get user id of user username
                $userId = $user->getUserId();
                // validate if the contact data belongs to current user
                $sql = $conn->prepare("SELECT * from contacts_tb WHERE contact_id = ? and users_id = ?");
                $sql->bind_param("ii", $contact["contact_id"], $userId);
                $sql->execute();
                $result = $sql->get_result();
                // if not
                if($result->num_rows == 0) {
                    header("Location: ./contacts.php");
                }
                $sql->close();
            } else {
                header("Location: ./contacts.php");
            }
        }
    }
?>