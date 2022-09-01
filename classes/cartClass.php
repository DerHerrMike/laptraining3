<?php

include_once __DIR__ . '/../inc/connection.php';

class Cart extends Connection
{

    public function addItemToCart($user_id, $prod_id, $prod_name, $prod_price, $quantity)
    {
        $sql = "SELECT * FROM cart WHERE user_id = ? AND prod_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $prod_id]);
        $count = $stmt->fetch();

        if ($count == 0) {

            $sql = 'INSERT INTO cart (user_id, prod_id, prod_name, prod_price, quantity) VALUES (?,?, ?, ?, ?)';
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$user_id, $prod_id, $prod_name, $prod_price, $quantity]);
            echo 'Item added successfully';
        } else {
            $sql = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND prod_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$quantity,$user_id, $prod_id]);
            echo 'Quantity updated';
        }

    }

    public function removeItemFromCart($user_id, $prod_id)
    {
        $sql = 'DELETE FROM cart WHERE user_id = ? AND prod_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $prod_id]);
    }

    public function getCartItems($user_id)
    {
        $sql = 'SELECT * FROM cart WHERE user_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id]);

        $grandTotal = 0;
        while ($result = $stmt->fetch()) {
            $total_price = $result['quantity'] * $result['prod_price'];
            $grandTotal = $grandTotal + $total_price;

            echo '
        <tr>
            <td> ' . $result['prod_name'] . '</td>
            <td>' . $result['prod_price'] . '</td>
            <td>' . $result['quantity'] . '</td>
            <td>EUR ' . $total_price . '</td>
        </tr>
        ';
        }
        echo '<tr>
                <td> Grand Total: </td>
              <td></td>
              <td></td>  
                <td>EUR ' . $grandTotal . '</td>

';

    }

    public function updateCartItemQuantity($user_id, $prod_id)
    {
        $sql = 'UPDATE cart SET quantity = ? WHERE user_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $prod_id]);
    }
}