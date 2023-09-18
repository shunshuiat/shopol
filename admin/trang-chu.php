<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php  require_once 'link.php' ;?>
</head>

<body>
    <div style="display: flex; flex-direction: row;">
        <?php
        require_once 'navigation.php';
        ?>
        <?php
            echo "<h1 style=\"text-align: center\">Welcome<span style=\"color: red;\">" . $_SESSION["username"] . "</span></h1>";
        ?>
    </div>

</body>

</html>