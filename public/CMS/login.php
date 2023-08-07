<?php session_start(); /* Starts the session */
        
        /* Check Login form submitted */        
        if(isset($_POST['Submit'])){
                /* Define username and associated password array */
                $logins = array('admin@mail' => 'admin');
                
                /* Check and assign submitted Username and Password to new variable */
                $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
                $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
                
                /* Check Username and Password existence in defined array */            
                if (isset($logins[$Username]) && $logins[$Username] == $Password){
                        /* Success: Set session variables and redirect to Protected page  */
                        $_SESSION['UserData']['Username']=$logins[$Username];
                        header("location:main.php");
                        exit;
                } else {
                        /*Unsuccessful attempt: Set error message */
                        $msg="<span style='color:red'>*登入失敗</span>";
                }
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management System</title>
    <link rel="stylesheet" href="../../resources/css/CMS_css/login1.css">
</head>

<body>
    <div class="center">
        <h1>後台管理系統</h1>
        <form action="" method="post" name="Login_Form">
            <div class="textBox">
                <input type="text" id="Username" name="Username" required>
                <span></span>
                <label>帳號</label>
            </div>
            <div class="textBox">
                <input type="password" id="Password" name="Password" required>
                <span></span>
                <label>密碼</label>
            </div>
            <div class="pass">忘記密碼</div>
            <input type="submit" name="Submit" value="登入" id="login">
            <?php if(isset($msg)){?>
                <center>
                    <?php echo $msg;?>
                </center>                
            <?php } ?> 
        </form>

    </div>
</body>

</html>