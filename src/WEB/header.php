<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Xabier personal forum." />
    <meta name="keywords" content="put, keywords, here" />
    <title>XabierForum</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<h1>XabierForum</h1>
    <div id="wrapper">
        <div id="menu">
            <?php
            session_start();
                if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
                {
                    echo '<a class="item" href="index.php">Home</a>';
                    echo '<a class="item" href="create_topic.php">Crear tema</a>';
                    if($_SESSION['user_level']==1)
                    {
                        echo '<a class="item" href="create_cat.php">Crear categoria</a>';
                        echo '<a class="item" href="admin.php">Administracion</a>';
                    }
                    echo '<div id="userbar">';
                        echo 'Hola ' . $_SESSION['user_name'] . '.  <a href="signout.php">Cierra sesión</a>';
                    echo '</div>';
                }
                else
                {
                    echo '<a class="item" href="index.php">Home</a>';
                    echo '<div id="userbar">';
                        echo '<a href="login.php">Iniciar sesión</a> o <a href="register.php">crear una cuenta</a>.';
                    echo '</div>';
                }
            ?>
        </div>
    <div id="content">