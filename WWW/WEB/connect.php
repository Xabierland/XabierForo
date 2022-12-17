<?php
   $host = 'db';
   $dbname = 'foro';
   $username = 'admin';
   $password = 'admin';

   try {
      $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      // Establecer el modo de error PDO a excepción
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch(PDOException $e) 
   {
      echo 'Error de conexión: ' . $e->getMessage();
   }
?>