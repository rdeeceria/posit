<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= esc($judul); ?></title>
</head>
<body>
<a href="profil/inputProfil">Tambah</a>
<?php if (! empty($profil)): ?>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Berat</th>
                <th>Tinggi</th>
                <th>BMI</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach( $profil as $row ): ?>
            <tr>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['berat']; ?></td>
                <td><?= $row['tinggi']; ?></td>
                <td><?= $row['bmi']; ?></td>
                <td>
                    <a href="profil/inputProfil/<?= $row['id'];?>">Edit</a>
                    <a href="profil/deleteProfil/<?= $row['id'];?>">Del</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <h3>Tidak Ada Data</h3>
    <p>Data Masih Kosong, Silahkan Tambah Data.</p>
<?php endif ; ?>
</body>
</html>