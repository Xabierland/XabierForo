<?php
include 'connect.php';
include 'header.php';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    $query = "SELECT topic_subject FROM topics WHERE topic_id=:topic_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':topic_id', $_GET['id']);
    $stmt->execute();
    $topic = $stmt->fetch();

    $query = "SELECT users.user_name, posts.post_content FROM posts LEFT JOIN users ON posts.post_by = users.user_id WHERE posts.post_topic=:topic_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':topic_id', $_GET['id']);
    $stmt->execute();
    $datas = $stmt->fetchAll();

    if(!$datas)
    {
        echo "Aqui no hay nada.";
    }
    else
    {
        echo 
        '
        <table border="1">
        <caption>' . $topic['topic_subject'] . '</caption>
        <tr>
        <th>Usuario</th>
        <th>Mensaje</th>
        </tr>';
        foreach($datas as $data)
        {
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo $data['user_name'];
                echo '</td>';
                echo '<td class="rightpart">';
                    echo $data['post_content'];
                echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
        include 'reply.php';
    }
}
else
{
    echo "Debes de crear una cuenta para ver el contenido del foro.";
}
include 'footer.php';
?>