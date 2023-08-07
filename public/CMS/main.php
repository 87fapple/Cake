<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php");
        exit;
}
?>

<?php $title = 'CMS Main'; ?>
<?php $metaTags = 'tag1 tag2'; ?>
<?php $currentPage = 'main'; ?>
<?php require_once(__DIR__.'/head.php'); ?>
<?php require_once(__DIR__.'/navbar.php'); ?>
<body>
    <h1>Index Page, Home has an active class</h1>
    Congratulation! You have logged into password protected page. <a href="logout.php">Click here</a> to Logout.
</body>