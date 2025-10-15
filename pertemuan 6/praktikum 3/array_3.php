<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $movie = [
            ['Avangers : infinity War', 2018, 8.7],
            ['The Avanger', 2012, 8.1],
            ['Iron Man', 2008, 7.9]
        ];
    ?>
    <h2>Multidimensional Array</h2>
    <table>
        <tr>
            <th>Judul Film</th>
            <th>Tahun</th>
            <th>Rating</th>
        </tr>
        <?php
            foreach($movie as $data){
        ?>
            <tr>
                <?php
                    foreach($data as $value){
                ?>
                    <td><?= $value ?></td>
                <?php
                    }
                ?>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>