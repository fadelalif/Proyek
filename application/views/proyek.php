<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Lokasi</title>
</head>

<body>
    <h1>Daftar Proyek</h1>
    <a href="<?php echo site_url('proyek/create'); ?>">Tambah Proyek Baru</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Proyek</th>
            <th>Client</th>
            <th>Tgl Mulai</th>
            <th>Tgl Selesai</th>
            <th>Pimpinan Proyek</th>
            <th>Lokasi</th>
            <th>Action</th>
        </tr>
        <?php foreach ($proyek as $p): ?>
            <tr>
                <td><?php echo $p['id']; ?></td>
                <td><?php echo $p['namaProyek']; ?></td>
                <td><?php echo $p['client']; ?></td>
                <td><?php echo $p['tglMulai']; ?></td>
                <td><?php echo $p['tglSelesai']; ?></td>
                <td><?php echo $p['pimpinanProyek']; ?></td>
                <td><?php echo $p['lokasi']['namaLokasi']; ?></td>
                <td>
                    <a href="<?php echo site_url('proyek/edit/' . $p['id']); ?>">Edit</a> |
                    <a href="<?php echo site_url('proyek/delete/' . $p['id']); ?>"
                        onclick="return confirm('Are you sure?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h1><?php echo isset($lokasi) ? 'Edit' : 'Tambah'; ?> Lokasi</h1>
    <form method="post" action="">
        <label>Nama Lokasi:</label><br>
        <input type="text" name="namaLokasi"
            value="<?php echo isset($lokasi['namaLokasi']) ? $lokasi['namaLokasi'] : ''; ?>"><br>
        <label>Negara:</label><br>
        <input type="text" name="negara" value="<?php echo isset($lokasi['negara']) ? $lokasi['negara'] : ''; ?>"><br>
        <label>Provinsi:</label><br>
        <input type="text" name="provinsi"
            value="<?php echo isset($lokasi['provinsi']) ? $lokasi['provinsi'] : ''; ?>"><br>
        <label>Kota:</label><br>
        <input type="text" name="kota" value="<?php echo isset($lokasi['kota']) ? $lokasi['kota'] : ''; ?>"><br><br>
        <input type="submit" name="submit" value="<?php echo isset($lokasi) ? 'Update' : 'Simpan'; ?>">
    </form>

    <h1><?php echo isset($proyek) ? 'Edit' : 'Tambah'; ?> Proyek</h1>
    <form method="post" action="">
        <label>Nama Proyek:</label><br>
        <input type="text" name="namaProyek"
            value="<?php echo isset($proyek['namaProyek']) ? $proyek['namaProyek'] : ''; ?>"><br>
        <label>Client:</label><br>
        <input type="text" name="client" value="<?php echo isset($proyek['client']) ? $proyek['client'] : ''; ?>"><br>
        <label>Tanggal Mulai:</label><br>
        <input type="date" name="tglMulai"
            value="<?php echo isset($proyek['tglMulai']) ? $proyek['tglMulai'] : ''; ?>"><br>
        <label>Tanggal Selesai:</label><br>
        <input type="date" name="tglSelesai"
            value="<?php echo isset($proyek['tglSelesai']) ? $proyek['tglSelesai'] : ''; ?>"><br>
        <label>Pimpinan Proyek:</label><br>
        <input type="text" name="pimpinanProyek"
            value="<?php echo isset($proyek['pimpinanProyek']) ? $proyek['pimpinanProyek'] : ''; ?>"><br>
        <label>Lokasi:</label><br>
        <select name="lokasiId">
            <?php foreach ($lokasi as $l): ?>
                <option value="<?php echo $l['id']; ?>" <?php echo isset($proyek['lokasiId']) && $proyek['lokasiId'] == $l['id'] ? 'selected' : ''; ?>>
                    <?php echo $l['namaLokasi']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
        <label>Keterangan:</label><br>
        <textarea
            name="keterangan"><?php echo isset($proyek['keterangan']) ? $proyek['keterangan'] : ''; ?></textarea><br><br>
        <input type="submit" name="submit" value="<?php echo isset($proyek) ? 'Update' : 'Simpan'; ?>">
    </form>
</body>

</html>