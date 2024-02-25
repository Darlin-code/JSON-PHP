<?php
    $pdo = new PDO("mysql:host=localhost; dbname=test_json;", "root", "Darlin_123");
    if (isset($_GET["update"])) {
        $query = "SELECT * FROM users;";
        $pre = $pdo -> prepare($query);
        $pre -> execute();
        $array = array();
        while($result = $pre -> fetch(PDO::FETCH_ASSOC)) {
            array_push($array, $result);
        }
        file_put_contents("data/data.json", json_encode($array));
        header("Location: index.php");
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicando el uso del .json</title>
    <style>
        th, td {
            border: 1px solid #000; 
            padding: 5px;
        }

        th {
            background-color: #000;
            color: #fff;
        }

        td {
            text-align: center;
        }
    </style>
</head>
<body>
    <a href="index.php?update">Actualizar</a>
    <hr><table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Contraseña</th>
        </tr>
        <?php
            $data = json_decode(file_get_contents("data/data.json"), true);
            $cantidad = count($data);

            for ($i = 0; $i < $cantidad; $i++) { ?>
                <tr>
                    <td><?= $data[$i]["user_id"] ?></td>
                    <td><?= $data[$i]["name"] ?></td>
                    <td><?= $data[$i]["email"] ?></td>
                    <td><?= $data[$i]["password"] ?></td>
                </tr>
            <?php }
        ?>
    </table>
</body>
</html>