<?php

include 'db.php';
$db = new Database();



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db->InsertUser($_POST['email'], $_POST['password']);
        echo "Data inserted";
    } catch (Exception $e) {
        echo "Failed: " . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <input type="email" name="email" placeholder="email">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="knop">

        <table border="8">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
            <tr>
                <?php $user = $db->SelectIf(1); ?>
                <td>
                    <?php echo $user['ID']; ?>
                </td>
                <td>
                    <?php echo $user['email']; ?>
                </td>
                <td>
                    <?php echo $user['password']; ?>
                </td>

            </tr>

            <tr>
                <?php
                $user = $db->SelectIf();
                foreach ($user as $use) { ?>
                    <td>
                        <?php echo $use['ID']; ?>
                    </td>
                    <td>
                        <?php echo $use['email']; ?>
                    </td>
                    <td>
                        <?php echo $use['password']; ?>
                    </td>
                    <td><button>delete</button></td>
                    <td><button>edit</button></td>
                </tr>
            <?php } ?>

        </table>

    </form>
</body>