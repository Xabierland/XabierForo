<?php
include 'connect.php';
include 'header.php';
 
echo '<h3>Registrarse</h3><br>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    #Muestra el formulario de registro
    echo 
    '<form method="post" action="register.php">
        <label for="username">Nombre de usuario:</label><br>
        <input type="text" name="user_name" id="user_name" required><br>

        <label for="email">Correo electrónico:</label><br>
        <input type="email" name="user_email" id="user_email" required><br>
        
        <label for="password">Contraseña:</label><br>
        <input type="password" name="user_pass" id="user_pass" required><br>
        
        <label for="password">Confirma contraseña:</label><br>
        <input type="password" name="user_pass_check" id="user_pass_check" required><br>

        <br><input type="submit" value="Registrarse" />
     </form>';
}
else
{
    if($_POST['user_pass']!=$_POST['user_pass_check'])
    {
        echo "Las contraseña no son iguales.";
    }
    else
    {
        // Sanitizar los datos enviados
        $username = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['user_pass'];
        
        // Verificar si el nombre de usuario o el correo electrónico ya existen
        $query = "SELECT * FROM users WHERE user_name = :username OR user_email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                         
        if($user)
        {
            $error_message = 'El nombre de usuario o el correo electrónico ya están en uso';
        } 
        else 
        {
            // Hashear la contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
            // Preparar la consulta
            $query = "INSERT INTO users (user_name, user_email, user_pass, user_date, user_level) VALUES (:username, :email, :password, now(), 0)";
            $stmt = $conn->prepare($query);
            // Vincular los parámetros
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password_hash);
            // Ejecutar la consulta
            $stmt->execute();
    
            $success_message = 'Usuario creado correctamente';
        }
        if(isset($error_message)){echo $error_message;}
        if(isset($success_message)){echo $success_message;}
    }
}
 
include 'footer.php';
?>