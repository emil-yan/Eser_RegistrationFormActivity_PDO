<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Variables</title>
</head>
<body>
    <h1>Testing GET/POST Variables</h1>
    <?php
    echo "<h2>GET Variables:</h2>";
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";

    echo "<h2>POST Variables:</h2>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    ?>
    <p>Use this file to check if your form submissions or URL parameters are being passed correctly.</p>
</body>
</html>