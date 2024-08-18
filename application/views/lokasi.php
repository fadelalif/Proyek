<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi</title>
</head>

<body>
    <h1>Daftar Lokasi</h1>
    <a href="<?php echo site_url('lokasi/create'); ?>">Tambah Lokasi Baru</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Lokasi</th>
            <th>Negara</th>
            <th>Provinsi</th>
            <th>Kota</th>
            <th>Action</th>
        </tr>
        <?php foreach ($lokasi as $l): ?>
            <tr>
                <td><?php echo $l['id']; ?></td>
                <td><?php echo $l['namaLokasi']; ?></td>
                <td><?php echo $l['negara']; ?></td>
                <td><?php echo $l['provinsi']; ?></td>
                <td><?php echo $l['kota']; ?></td>
                <td>
                    <a href="<?php echo site_url('lokasi/edit/' . $l['id']); ?>">Edit</a> |
                    <a href="<?php echo site_url('lokasi/delete/' . $l['id']); ?>"
                        onclick="return confirm('Are you sure?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>