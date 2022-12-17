<?php
//create_cat.php
include 'connect.php';
include 'header.php';

echo '<h3>Crear tema</h3><br>';

    if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
    {
        if($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            // Preparar la consulta
            $query = "SELECT cat_name, cat_id FROM categories";
            $stmt = $conn->prepare($query);
            // Ejecutar la consulta
            $stmt->execute();
            // Obtener el resultado como un conjunto de filas
            $categorias = $stmt->fetchAll();
            #Muestra el formulario para crear una categoria
            echo 
            "<form method='post' action='create_topic.php'>
                <label for='ntop'>Nombre del tema:</label><br>
                <input type='text' name='top_name' /> <br>

                <label for='cat'>Categoria:</label><br>
                <select name='cat'>";
                foreach($categorias as $categoria)
                {
                    echo "<option value='" . $categoria['cat_id'] . "'>" . $categoria['cat_name'] ."</option>";
                }
            echo
                "</select><br>

                <label for='mtop'>Mensaje:</label><br>
                <textarea name='top_description'/></textarea><br>

                <br><input type='submit' value='Añadir tema'/>
            </form>";
        }
        else
        {
            $query = "INSERT INTO topics(topic_subject, topic_date, topic_cat, topic_by) VALUES(:top_name, now(), :cat, :user_id)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':top_name', $_POST['top_name']);
            $stmt->bindParam(':cat', $_POST['cat']);
            $stmt->bindParam(':user_id', $_SESSION['user_id']);
            $result=$stmt->execute();
            if(!$result)
            {
                echo 'Error: ' . $stmt->errorCode();
            }
            else
            {
                echo 'Categoria añadida correctamente.';
            }
        }
    }
    else
    {
        echo 'Debes iniciar sesion para abrir un tema.';
    }

include 'footer.php';
?>