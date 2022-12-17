<?php
    //create_cat.php
    include 'connect.php';
    include 'header.php';
    
    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
    {
        // Preparar la consulta SQL
        $stmt = $conn->prepare("SELECT cat_id, cat_name, cat_description FROM categories");

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado como un conjunto de filas
        $result = $stmt->fetchAll();

        if (count($result) == 0) 
        {
            echo 'No categories defined yet.';
        } 
        else 
        {
            // Preparar la tabla
            echo '<table border="1">
                <tr>
                    <th>Category</th>
                    <th>Last topic</th>
                </tr>'; 
                
            // Recorrer cada fila del resultado
            foreach ($result as $row) 
            {               
                echo '<tr>';
                    echo '<td class="leftpart">';
                        echo '<h3><a href="category.php?id">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                    echo '</td>';
                    echo '<td class="rightpart">';
                        echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
                    echo '</td>';
                echo '</tr>';
            }
        }
    }
    else
    {
        echo "Debes de crear una cuenta para ver el contenido del foro.";
    }   
    
    include 'footer.php';
?>