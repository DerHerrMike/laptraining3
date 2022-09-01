<?php
$page_name = 'Login';
include __DIR__ . '/inc/header.php';
include __DIR__ . '/classes/userClass.php';

?>

    <div class="content">

        <form action="#" method="post">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="login_btn">Login!</button>
        </form>
    </div>

<?php
if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $user = new User();
    try {
        $user->login($email, $password);
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}

include __DIR__ . '/inc/footer.php';