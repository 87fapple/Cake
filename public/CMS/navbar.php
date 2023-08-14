<link rel="stylesheet" href="./CMS_css/side_navbar.css">

<div class="head_nav">
	<ul>
		<li><span class="material-symbols-outlined">person</span>您好 <?php echo $_SESSION['UserData']['Username']; ?></li>
		<li><a href="logout.php"><span class="material-symbols-outlined">logout</span>登出</a></li>
	</ul>
</div>

<nav class="sidebar">
    <div class="nav_icon">
        <a href="./home.php"></a>
    </div>
    <hr>
    <ul>
        <?php
            $urls = array(
                '首頁' => '/Cake/public/CMS/home.php',
                '首頁管理' => '/Cake/public/CMS/mgt_home.php',
                '產品管理' => '/Cake/public/CMS/mgt_product.php',
                '預約管理' => '/Cake/public/CMS/mgt_reserve.php',
                // …
            );
            
            foreach ($urls as $name => $url) {
                print '<li ' . (($currentPage === $name)) . '>
                    <a href="' . $url . '">' . $name . '</a></li>';
            }
        ?>
    </ul> 
</nav>