<?php
include 'connect.php';
session_start();
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    $query = "SELECT topic_by FROM topics WHERE topic_id=:topic_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':topic_id', $_GET['id']);
    $stmt->execute();
    $id = $stmt->fetch();

    if($_SESSION['user_level']==1 or $_SESSION['user_id']==$id['topic_by'])
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            echo 
            '
            <form method="post" action="borrar_topic.php?id=' . $_GET['id'] . '">
                <input type="submit" value="Borrar tema"/><br>
            </form>
            ';
        }
        else
        {
            $query = "DELETE FROM topics WHERE topic_id=:topic_id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':topic_id', $_GET['id']);
            $stmt->execute();

            header("location:index.php");
        }
    }
}
else
{
    echo "Debes tener una cuenta de administrador o haber creado el tema para borrarlo";
}
?>