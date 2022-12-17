<?php
//create_cat.php
include 'connect.php';
include 'header.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //the form hasn't been posted yet, display it
    echo 
    '<form method="post" action="">
        Category name: <input type="text" name="cat_name" />
        Category description: <textarea name="cat_description" /></textarea>
        <input type="submit" value="Add category" />
     </form>';
}
else
{
    //the form has been posted, so save it
    $query = "INSERT INTO categories(cat_name, cat_description) VALUES(:cat_name, :cat_description)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':cat_name', $_POST['cat_name']);
    $stmt->bindParam(':cat_description', $_POST['cat_description']);
    $result = $stmt->execute();
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error: ' . $stmt->errorCode();
    }
    else
    {
        echo 'New category successfully added.';
    }
}
include 'footer.php';
?>