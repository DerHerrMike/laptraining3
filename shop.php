<?php
$page_name = 'Shop';

include __DIR__ . '/inc/header.php';
include 'classes/productClass.php';
if($_SESSION['logged_in'] == false) {
    echo "<div>You have to be logged in to see this page!</div>";
    header("Refresh:2; Location:login.php");
}
?>
<div class="content">
    <article>
        <h2>Shop</h2>
        <br><br>
    </article>

    <div class="container">
        <table style="background: white; border: 1px solid #ccc; border-radius: 3px; padding: 10px;">

            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>Details</th>

            </tr>

            <?php $product = new Product();
            $product->getProducts();
            ?>
            </table>
        <br><br>
        </div>
    </div>

<?php

include __DIR__ . '/inc/footer.php';
