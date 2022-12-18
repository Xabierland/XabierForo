<?php
include 'connect.php';
include 'header.php';
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    if($_SESSION['user_level']==1)
    {
        echo "Proximamente";
    }
    else
    {
        echo "Debes tener una cuenta de administrador";
    }
}
else
{
    echo "Debes tener una cuenta";
}
include 'footer.php';
?>