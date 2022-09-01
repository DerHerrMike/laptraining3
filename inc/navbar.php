<nav>
    <header class="site-header">
        <div class="site-identity">
            <h1><a href="index.php">LAP Webshop</a></h1>
        </div>
        <nav class="site-navigation">
            <ul class="nav">
                <?php if (!isset($_SESSION['logged_in'])){
                ?>
                <li class="li"><a href="shop.php">Shop</a></li>
                <li class="li"><a href="register.php">Registration</a></li>
                <li class="li"><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <?php } else{
    if (isset($_SESSION['logged_in']) && $_SESSION['user_role'] == 1){
    ?>
    <li class="li"><a href="products_admin.php">Product Management</a></li>
    <li class="li"><a href="users.php">User Management</a></li>
    <li class="li"><a href="shop.php">Shop View</a></li>
    <li class="li"><a href="cart.php">Cart</a></li>
    <li class="li"><a href="logout.php">Logout</a></li>
    </ul>
</nav>
</header>
<?php } else { ?>
    <li class="li"><a href="shop.php">Shop</a></li>
    <li class="li"><a href="cart.php">Cart</a></li>
    <li class="li"><a href="logout.php">Logout</a></li>
    </ul>
    </nav>
    </header>
    <?php
}
} ?>
</nav>
