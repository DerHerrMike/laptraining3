<?php
$page_name = 'Registration';
$_SESSION['logged_in'] = false;
include __DIR__ . '/inc/header.php';
?>

    <div class="content">

        <form action="" method="post">
            <input type="email" name="email" placeholder="Email address" required>
            <input type="password"  name="password" placeholder="Password" required>
            <input type="password"  name="password_confirm" placeholder="Confirm password" required>
            <button type="submit"  name="regbtn">Register!</button>
        </form>
        <?php
        if (isset($_POST['regbtn'])) {
            $email = $_POST['email'];
            $password = sha1($_POST['password']);
            $password_confirm = sha1($_POST['password_confirm']);


            include __DIR__ . "/classes/userClass.php";
            try {
                $user = new User();
                $user->register($email, $password, $password_confirm);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        ?>
    </div>
<?php
include 'inc/footer.php';
