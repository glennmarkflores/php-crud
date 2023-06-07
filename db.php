<?php

    class Database {
        private $dsn = "mysql:host=localhost;dbname=crud";
        private $user = "root";
        private $pass = "";
        public $conn;

        public function __construct() {
            try {
                $this->conn = new PDO($this->dsn, $this->user, $this->pass);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function insert($fname, $lname, $email, $phone) {
            $sql = "INSERT INTO users(first_name, last_name, email, phone) 
            VALUES(:fname, :lname, :email, :phone)";

            $statement = $this->conn->prepare($sql);
            $statement->execute([
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'phone' => $phone
            ]);

            return true;
        }

        public function read() {
            $data = array();
            $sql = "SELECT * FROM users";
            $statement = $this->conn->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $row) {
                $data[] = $row;
            }

            return $data;
        }

        public function getUserById($id) {
            $sql = "SELECT * FROM users WHERE id = :id";
            $statement = $this->conn->prepare($sql);
            $statement->execute([
                'id' => $id
            ]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function update($id, $fname, $lname, $email, $phone) {
            $sql = "UPDATE users SET 
            first_name = :fname,
            last_name = :lname,
            email = :email,
            phone = :phone
            WHERE id = :id";

            $statement = $this->conn->prepare($sql);
            $statement->execute([
                'fname' => $fname,
                'lname' => $lname,
                'email' => $email,
                'phone' => $phone,
                'id' => $id
            ]);

            return true;
        }

        public function delete($id) {
            $sql = "DELETE FROM users WHERE id = :id";
            $statement = $this->conn->prepare($sql);
            $statement->execute([
                'id' => $id
            ]);

            return true;
        }

        public function totalRowCount() {
            $sql = "SELECT * FROM users";
            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $total_rows = $statement->rowCount();
            return $total_rows;
        }

    }
?>