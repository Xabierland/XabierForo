<?php
//create_cat.php
include 'connect.php';
include 'header.php';

echo '<h3>Crear categoria</h3><br>';

if($_SESSION['user_level']==1)
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        #Muestra el formulario para crear una categoria
        echo 
        '<form method="post" action="create_cat.php">
            <label for="ncat">Nombre de la categoria:</label><br>
            <input type="text" name="cat_name" /> <br>

            <label for="dcat">Descripcion de la categoria:</label><br>
            <textarea name="cat_description" /></textarea><br>

            <br><input type="submit" value="Añadir categoria"/>
        </form>';
    }
    else
    {
        $query = "INSERT INTO categories(cat_name, cat_description) VALUES(:cat_name, :cat_description)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cat_name', $_POST['cat_name']);
        $stmt->bindParam(':cat_description', $_POST['cat_description']);
        $result = $stmt->execute();
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
    echo 'Debes tener una cuenta de administracion para abrir una categoria.';
}
include 'footer.php';
?>