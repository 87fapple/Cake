<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" class="navbar-brand"></a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
            <?php
                $urls = array(
                    'Main' => '/Cake/public/CMS/main.php',
                    // …
                );
                
                foreach ($urls as $name => $url) {
                    print '<li ' . (($currentPage === $name) ? ' class="active" ': '') . '><a href="' . $url . '">' . $name . '</a></li>';
                }
            ?>
        </ul>
        </div>
    </div>
</nav>