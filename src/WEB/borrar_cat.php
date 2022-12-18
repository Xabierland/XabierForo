<?php
include 'connect.php';
session_start();
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    if($_SESSION['user_level']==1)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            echo 
            '
            <form method="post" action="borrar_cat.php?id=' . $_GET['id'] . '">
                <input type="submit" value="Borrar categoria"/><br>
            </form>
            ';
        }
        else
        {
            $query = "DELETE FROM categories WHERE cat_id=:cat_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':cat_id', $_GET['id']);
            $stmt->execute();

            header("location:index.php");
        }
    }
}
else
{
    echo "Debes tener una cuenta de administrador para borrar una categoria.";
}
?>