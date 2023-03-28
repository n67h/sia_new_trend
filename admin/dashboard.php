<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php
        require_once 'sidebar.php';
    ?>

    <div class="container">
        <?php
            $escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
            echo '<a href="' . $escaped_url . '">' . $escaped_url . '</a><br>';

            // get the current url
            $url =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            // parse url
            $parts = parse_url($url);
            // fetch all the sub folders in url
            $path_parts = explode('/', $parts['path']);
            echo $path = $path_parts[0] . '<br>';
            echo $path = $path_parts[1] . '<br>';
            echo $path = $path_parts[2] . '<br>';
            echo $path = $path_parts[3] . '<br>';

        ?>
    </div>

    <?php
        require_once 'footer.php';
    ?>