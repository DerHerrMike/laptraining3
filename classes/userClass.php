<?php
include_once __DIR__ . '/../inc/connection.php';


class User extends Connection
{
    /**
     * @throws Exception
     */
    public function register($email, $password, $password_confirmation)
    {


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Please enter a valid email address.');
        }
        if (strlen($password) < 4) {
            throw new Exception('Password must be at least 4 characters long');
        }

        if ($password != $password_confirmation) {
            echo "Passwords do not match. Please try again.";
            return false;
        } else {
            $sql = "SELECT * FROM user WHERE email= ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                throw new Exception('Email already exists');
            } else {
                $sql = "INSERT INTO user (email, password) VALUES (?,?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$email, $password]);
                echo "Registration successful";
                header("Refresh:2; url=login.php");
            }

        }
    }

    /**
     * @throws Exception
     */
    public function login($email, $password)
    {

        $sql = "SELECT * FROM user WHERE email =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch();

        if ($stmt->rowCount() == 0) {
            echo "Email not found";
        } else {
            if ($result['password'] != $password) {
                echo "Passwords do not match.";
            } else {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['logged_in'] = true;
                $_SESSION['user_role'] = $result['role'];
                echo "Login successful, you will be redirected shortly.";
                header("Refresh:2; url=shop.php?uid=" . $_SESSION['user_id'] . "");
            }
        }
    }

    public function insertInvoiceData($firstname, $lastname, $street, $number, $zip, $city, $country)
    {
        $sql = "INSERT INTO user (first_name, last_name,street, number, zip, city, country) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$firstname, $lastname, $street, $number, $zip, $city, $country]);
        echo "Invoice data created successfully";
        header("Refresh:2; url=invoice.php");
    }
}
