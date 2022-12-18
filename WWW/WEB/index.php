<?php
    //create_cat.php
    include 'connect.php';
    include 'header.php';
    
    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
    {
        // Preparar la consulta SQL
        $stmt = $conn->prepare("SELECT cat_id, cat_name, cat_description FROM categories");
        $stmt->execute();
        $categorias = $stmt->fetchAll();

        if (count($categorias) == 0) 
        {
            echo 'No existen categorias.';
        } 
        else 
        {
            // Preparar la tabla
            echo 
            '<table border="1">
            <tr>
            <th>Categorias</th>
            <th>Ultimo topico</th>
            </tr>'; 
                
            // Recorrer cada fila del$categoriasado
            foreach ($categorias as $categoria) 
            {               
                $stmt = $conn->prepare("SELECT * from topics WHERE topic_cat=:cat_id order by topic_id desc LIMIT 1");
                $stmt->bindParam(':cat_id', $categoria['cat_id']);
                $stmt->execute();
                $topico = $stmt->fetch();

                if(!$topico)
                {
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="category.php?id=' . $categoria['cat_id'] . '">' . $categoria['cat_name'] . '</a></h3>' . $categoria['cat_description'];
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo 'No existen temas todavia.';
                        echo '</td>';
                    echo '</tr>';
                }
                else
                {
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="category.php?id=' . $categoria['cat_id'] . '">' . $categoria['cat_name'] . '</a></h3>' . $categoria['cat_description'];
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo '<a href="topic.php?id=' . $topico['topic_id'] . '">' . $topico['topic_subject'] . '</a></h3>';
                        echo '</td>';
                    echo '</tr>';
                }
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