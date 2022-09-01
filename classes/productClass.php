<?php
include_once __DIR__ . '/../inc/connection.php';


class Product extends Connection
{

    public function getProducts()
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            if ($row['status'] == 1) {
                echo "
                <tr>
                    <td>" . $row['name'] . "</td> 
                    <td><img class='image' src='../ressources/" . $row['image'] . "'</td> 
                    <td> EUR " . $row['price'] . "</td> 
                    <td><a href='product.php?pid=" . $row['id'] . "'>see more</a></td>
                </tr>
                ";
            }
        }
    }

    public function getOneProduct($id)
    {
        $sql = "SELECT * FROM product WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        if ($result) {
            echo "
                <tr>
                <td>" . $result['name'] . "</td> 
                <td><img class='image' src='../ressources/" . $result['image'] . "'</td>
                <td>" . $result['description'] . "</td> 
                <td> EUR " . $result['price'] . "</td>
                <td>
                    <form action='#' method='post'>
                        <input type='hidden' name='name' value='" . $result['name'] . "'>
                        <input type='hidden' name='price' value='" . $result['price'] . "'>
                        <input type='number' name='quantity'>
                        <button type='submit' name='add_btn'>Add to Cart</button>
                    </form>
                </td>
                </tr>        
        ";
        }

    }
}