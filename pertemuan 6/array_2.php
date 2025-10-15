<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }
        table {
            border-collapse: collapse;
            margin: 40px auto;
            width: 400px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        th, td {
            padding: 12px 18px;
            text-align: left;
        }
        th {
            background: #007bff;
            color: #fff;
            font-size: 1.1em;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        tr:hover {
            background: #e9ecef;
        }
        td:first-child {
            font-weight: bold;
            color: #007bff;
            width: 40%;
        }
    </style>
</head>
<body>
    <?php
        $dosen = [
            'nama' => 'Fajar Manusia Ikan',
            'domisili' => 'Malang',
            'kelamin' => 'pria'
        ];
    ?>
    <table border="1">
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
        <?php
            foreach($dosen as $key => $data){
        ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $data ?></td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>