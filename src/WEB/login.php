<?php
include 'connect.php';
include 'header.php';
 
echo '<h3>Iniciar sesión</h3><br>';
 
#COMPRUEBA SI UNA SESION ESTA INICIADA
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo 'You are already signed in, you can <a href="signout.php">sign out</a> if you want.';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        #Muestra el formulario de login
        echo 
        '<form method="post" action="login.php">
            <label for="username">Nombre de usuario:</label><br>
            <input type="text" name="user_name" id="user_name" required><br>

            <label for="password">Contraseña:</label><br>
            <input type="password" name="user_pass" id="user_pass" required><br>

            <br><input type="submit" value="Iniciar sesión" />
         </form>';
    }
    else
    {
        // Sanitizar los datos enviados
        $username = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
        $password = $_POST['user_pass'];
        
        // Preparar la consulta
        $query = "SELECT * FROM users WHERE user_name = :username";
        $stmt = $conn->prepare($query);
        // Vincular los parámetros
        $stmt->bindParam(':username', $username);
        // Ejecutar la consulta
        $stmt->execute();
        // Obtener el resultado
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($user)
        {
            if(password_verify($password, $user['user_pass']))
            {
                $_SESSION['signed_in'] = true;
                    
                $_SESSION['user_id']    = $user['user_id'];
                $_SESSION['user_name']  = $user['user_name'];
                $_SESSION['user_level'] = $user['user_level'];
                
                header("Location: index.php");
                exit;
            }
            else
            {
                $error_message = 'Nombre de usuario o contraseña incorrectos';
            }
        }
        else
        {
            $error_message = 'Nombre de usuario o contraseña incorrectos';
        }
        echo $error_message;
    }
}
include 'footer.php';
?>