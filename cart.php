<?php
$page_name = 'Cart';

include __DIR__ . '/inc/header.php';

include 'classes/CartClass.php';

if ($_SESSION['logged_in'] == false) {
    echo "<div>You have to be logged in to see this page!</div>";
    header("Refresh:2; Location:login.php");
}
?>
 <div class="content">
        <br><br>
        <article>
            <h2>Cart Overview</h2>
        </article>
        <br><br>

        <div class="container_small">
            <table style="background: white; border: 1px solid #ccc; border-radius: 3px; padding: 2px;">
                <tr>
                    <th>Name</th>
                    <th>Price per unit</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>

                <?php
                $cart = new Cart();
                $result=$cart->getCartItems($_SESSION['user_id']);
                ?>

            </table>
        </div>
        <br><br>
    </div>