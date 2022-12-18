<?php
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        echo 
        '
        <form method="post" action="topic.php?id=' . $_GET['id'] . '">
            <label for="reply">Respuesta:</label><br>
            <textarea name="reply-content"></textarea><br>

            <br><input type="submit" value="Responder"/>
        </form>
        ';
    }
    else
    {
        $query = "INSERT INTO posts(post_content, post_date, post_topic, post_by) VALUES(:post_content, now(), :topic_id, :user_id)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':post_content', $_POST['reply-content']);
        $stmt->bindParam(':topic_id', $_GET['id']);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->execute();

        header('Location: topic.php?id=' . $_GET['id']);
    }
}
else
{
    echo "Debes de crear una cuenta para ver el contenido del foro.";
}
?>