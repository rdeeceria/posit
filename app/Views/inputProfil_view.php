<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= esc($judul); ?></title>
</head>
<body>
    <form action=<?= $action; ?> method="post">
    <?= csrf_field() ?>
    <?php if (empty($row)): ?>
        <p>Nama <input type="text" name="nama"></p>
        <p>Berat <input type="text" name="berat"></p>
        <p>Tinggi <input type="text" name="tinggi"></p>
        <p>BMI <input type="text" name="bmi"></p>
    <?php else: ?>
        <p>Nama <input type="text" name="nama" value="<?= $row['nama']; ?>"></p>
        <p>Berat <input type="text" name="berat" value="<?= $row['berat']; ?>"></p>
        <p>Tinggi <input type="text" name="tinggi" value="<?= $row['tinggi']; ?>"></p>
        <p>BMI <input type="text" name="bmi" value="<?= $row['bmi']; ?>"></p>
    <?php endif; ?>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>