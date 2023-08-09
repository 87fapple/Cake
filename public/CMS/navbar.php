<link rel="stylesheet" href="./CMS_css/side_navbar.css">

<div class="head_nav">
	<ul>
		<li><span class="material-symbols-outlined">person</span>您好 <?php echo $_SESSION['UserData']['Username']; ?></li>
		<li><a href="logout.php"><span class="material-symbols-outlined">logout</span>登出</a></li>
	</ul>
</div>

<nav class="sidebar">
    <a href="./home.php"><img src="../../image/icon-noBorder-whiteFont.png"></a>
    <hr>
    <ul>
        <?php
            $urls = array(
                '首頁' => '/Cake/public/CMS/home.php',
                '訂單管理' => '/Cake/public/CMS/order_overview.php',
                // …
            );
            
            foreach ($urls as $name => $url) {
                print '<li ' . (($currentPage === $name)) . '>
                    <a href="' . $url . '">' . $name . '</a></li>';
            }
        ?>
    </ul> 
</nav>