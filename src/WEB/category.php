<?php
include 'connect.php';
include 'header.php';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    $query = "SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id=:cat_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cat_id', $_GET['id']);
    $stmt->execute();
    $categoria = $stmt->fetch();

    echo "<h3>Temas de la categoria \"" . $categoria['cat_name'] . "\"</h3><br>";
    echo $categoria['cat_description'];
    include 'borrar_cat.php';

    $query = "SELECT topic_id, topic_subject, topic_date FROM topics WHERE topic_cat=:cat_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cat_id', $_GET['id']);
    $stmt->execute();
    $topics = $stmt->fetchAll();

    if(!$topics)
    {
        echo "No existen temas todavia.";
    }
    else
    {
        echo 
        '<table border="1">
        <tr>
        <th>Topicos</th>
        <th>Creado a</th>
        </tr>'; 
        foreach($topics as $topic)
        {
            echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="topic.php?id=' . $topic['topic_id'] . '">' . $topic['topic_subject'] . '</a><h3>';
                echo '</td>';
                echo '<td class="rightpart">';
                    echo date('d-m-Y', strtotime($topic['topic_date']));
                echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}
else
{
    echo "Debes de crear una cuenta para ver el contenido del foro.";
}

include 'footer.php';
?>