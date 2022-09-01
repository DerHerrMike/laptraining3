<?php
$page_name = 'Order';
if (!isset($_SESSION['logged_in'])) {
    die('You must be logged in to view this page!');
}
include __DIR__ . '/inc/header.php';
?>

    <div class="content">

        <form action="" method="post">
            <input type="text"  name="first_name"  placeholder="First name" required>
            <input type="text"  name="last_name"  placeholder="Last name" required>
            <input type="text"  name="street"  placeholder="Street" required>
            <input type="text"  name="number"  placeholder="Number" required>
            <input type="text"  name="zip"  placeholder="zip code" required>
            <input type="text"  name="city"  placeholder="City" required>
            <input type="text"  name="country"  placeholder="Country" required>
            <button type="submit"  name="invoice_data-btn">Register!</button>
        </form>
        <?php
        if (isset($_POST['invoice_data-btn'])) {
            $firstname = $_POST['first_name'];
            $lastname = $_POST['last_name'];
            $street = $_POST['street'];
            $number = $_POST['number'];
            $zip = $_POST['zip'];
            $city = $_POST['city'];
            $country = $_POST['country'];

            include __DIR__ . "/classes/userClass.php";
            try {
                $user = new User();
                $user->insertInvoiceData($firstname,$lastname,$street, $number, $zip, $city, $country);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        ?>
    </div>
<?php
include 'inc/footer.php';
