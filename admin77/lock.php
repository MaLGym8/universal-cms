<?php


if(!$_SESSION["loginAdmin"])
{
    echo'<body>
    <div class="loginAdmin">
    <form  method="post" name="login" data-form-name="auth">
        Логин:<br /><input  autocomplete="username" type="text" name="login"/><br />
        Пароль:<br /><input autocomplete="current-password" type="password" name="passwd"/><br />
        <input type="submit" name="send" value="Отправить"/>
    </form>
    </div></body>
    ';
    
    $user = mysql_fetch_array(mysql_query("SELECT * FROM options WHERE user='".htmlspecialchars(stripslashes($_POST["login"]))."' and pass='".htmlspecialchars(stripslashes($_POST['passwd']))."' LIMIT 1"));
    
    if($user)
    {
        $_SESSION["loginAdmin"] = $_POST["login"];
        $_SESSION["typeAdmin"] = $user["type"];
        echo'<script>window.location="index.php"</script>';
    }
    
    exit();
}
if($_GET["page"]=="logout")
{
    unset($_SESSION["loginAdmin"]);
    unset($_SESSION["typeAdmin"]);
    echo'<script>window.location="index.php"</script>';
}
?>