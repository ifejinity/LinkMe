<?php
    class Users Extends Person {
        private $connection;
        public $username;
        public $password;
        public $passwordConfirm;

        // set connection within the users class
        public function __construct($conn) {
            $this->connection = $conn->getConnection();
        }
        // set username
        public function setUsername($username) {
            $this->username = $username;
        }
        // set password
        public function setPassword($password) {
            $this->password = $password;
        }
        // set password confirmation
        public function setPasswordConfirmation($passwordConfirm) {
            $this->passwordConfirm = $passwordConfirm;
        }
        // create user
        public function createUser($validate) {
            $sql = $this->connection->prepare("INSERT INTO users_tb (fullname, username, password) VALUES (?, ?, ?)");
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $sql->bind_param("sss", $this->fullname, $this->username, $hashedPassword);
            // get error messages
            $errorMessages = $validate->errorMessages;
            // validate status
            if($validate->getStatus()){
                $sql->execute();
                $message =  "success";
                $data = [$message, $errorMessages];
                echo json_encode($data);
            } else {
                $message =  "failed";
                $data = [$message, $errorMessages];
                echo json_encode($data);
            }
            $sql->close();
        }
        // login user
        public function loginUser() {
            $sql = $this->connection->prepare("SELECT * FROM users_tb WHERE username = ?");
            $sql->bind_param("s", $this->username);
            $sql->execute();
            $result = $sql->get_result();
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $hashedPassword = $row["password"];
                }
                if(password_verify($this->password, $hashedPassword)) {
                    $_SESSION["username"] = $this->username;
                    echo "success";
                } else {
                    echo "Incorrect Password!";
                }
            } else {
                echo "Incorrect Password and Username!";
            }
            $sql->close();
        }
        // logout user
        public function logoutUser() {
            session_start();
            session_unset();
            session_destroy();
            header("Location: ./index.php");
        }
        // get user id
        public function getUserId() {
            $sql = $this->connection->prepare("SELECT users_id FROM users_tb WHERE username = ?");
            $sql->bind_param("s", $this->username);
            $sql->execute();
            $result = $sql->get_result();
            while($row = $result->fetch_assoc()) {
                return $row["users_id"];
            }
            $sql->close();
        }
    }
?>