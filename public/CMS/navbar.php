<link rel="stylesheet" href="./CMS_css/side_navbar.css">
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>


<nav class="sidebar">
    <h2>Addmin</h2>
    <hr>
    <ul>
        <?php
            $urls = array(
                'Home' => '/Cake/public/CMS/home.php',
                // …
            );
            
            foreach ($urls as $name => $url) {
                print '<li ' . (($currentPage === $name)) . '><a href="' . $url . '"><i class="fas fa-' . $name .'"></i>' . $name . '</a></li>';
            }
        ?>
    </ul> 
</nav>