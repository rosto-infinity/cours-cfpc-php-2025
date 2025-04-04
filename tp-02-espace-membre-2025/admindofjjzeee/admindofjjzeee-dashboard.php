<?php
session_start();
require_once "database.php";


if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;  
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TUTO PHP</title>
  <!-- Intégration de Tailwind CSS v4 -->
  <link rel="stylesheet" href="src/output.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50">
   Admin
</body>

</html>
