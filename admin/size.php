<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sizes</title>
    <?php
        require_once 'sidebar.php';
    ?>

    <div class="container">
        <?php
            $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
            echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a>';
        ?>
    </div>

    <?php
        require_once 'footer.php';
    ?>