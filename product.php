<?php
$page_name = 'Product View';

include __DIR__ . '/inc/header.php';

include 'classes/productClass.php';

include 'classes/CartClass.php';

if ($_SESSION['logged_in'] == false) {
    echo "<div>You have to be logged in to see this page!</div>";
    header("Refresh:2; Location:login.php");
}
$product_id = $_GET['pid'];
$user_id = $_SESSION['user_id'];
$product = new Product();

?>
    <div class="content">
        <br><br>
        <article>
            <h2>Product Details</h2>
        </article>
        <br><br>

        <div class="container_small">
            <table style="background: white; border: 1px solid #ccc; border-radius: 3px; padding: 2px;">
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>

                <?php
                $product->getOneProduct($product_id);
                ?>

            </table>
        </div>
        <br><br>
    </div>
<?php
if (isset($_POST['add_btn'])) {
    $prod_name = $_POST['name'];
    $prod_price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $cart = new Cart();
    try {

        $cart->addItemToCart($user_id, $product_id, $prod_name, $prod_price, $quantity);
//not sure if this works for more than one item: header('Refresh:2; URL:cart.php?uid=' . $user_id . '&prod_name=' . $prod_name . '&prod_price=' . $prod_price . '&quantity=' . $quantity);
    } catch (Exception $e) {
        print  $e->getMessage();
    }


}
include __DIR__ . '/inc/footer.php';