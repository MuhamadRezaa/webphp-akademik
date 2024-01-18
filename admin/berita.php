<?php
include("../koneksi.php");

$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
<div class="row">
    <div class="col-lg-12">
        <h2>List Berita</h2>
        <a href="index.php?p=berita&aksi=input" class="btn btn-primary mb-3">Tambah Data Berita</a>
        <table class="table table-bordered" id="tabel-berita">
            <thead>
                <tr class="table-primary">
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Judul</th>
                    <th>Tgl dibuat</th>
                    <th>User</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $tampil=mysqli_query($db, "SELECT * FROM berita INNER JOIN kategori WHERE berita.kategori_id = kategori.id");
                        if ($data=mysqli_num_rows($tampil) != 0) {
                        $no=1;
                        while ($data=mysqli_fetch_array($tampil)) {
                    ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['nama_kategori']; ?></td>
                    <td><?php echo $data['judul']; ?></td>
                    <td><?php echo $data['date_created']; ?></td>
                    <td><?php echo $data['user_id']; ?></td>

                    <td>
                        <?php if($_SESSION['level'] == 'admin'){ ?>
                        <a href="proses_berita.php?proses=delete&id_hapus=<?= $data['id_berita'] ?>"
                            onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus</a>
                        <?php } ?>
                        <a href="index.php?p=berita&aksi=edit&id_edit=<?= $data['id_berita'] ?>"
                            class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                <?php
                            $no++;
                        }
                    }
                        ?>
            </tbody>
        </table>

    </div>
</div>
<?php
        break;
    case 'input' :
?>
<div class="row">
    <div class="col-lg-6">
        <h1>Form Berita</h1>
        <form action="proses_berita.php?proses=insert" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" id="" class="form-select">
                    <option value="">--Pilih Kategori--</option>
                    <?php
                                $kategori=mysqli_query($db,"SELECT * FROM kategori");
                                while ($data_kategori=mysqli_fetch_array($kategori)) {
                                    echo "<option value=".$data_kategori['id'].">".$data_kategori['nama_kategori']."</option>";
                                }
                            ?>

                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul">
            </div>
            <div class="mb-3">
                <label class="form-label">Upload gambar</label>
                <input type="file" class="form-control" name="gambar">
            </div>
            <div class="mb-3">
                <label class="form-label">Isi Berita</label>
                <textarea class="form-control" rows="10" name="isi_berita"></textarea>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                <input class="btn btn-warning" type="reset" name="reset" value="Reset">
            </div>
        </form>
    </div>
</div>
<?php
        break;
        case 'edit' :

            $edit=mysqli_query($db, "SELECT * FROM berita WHERE id_berita='$_GET[id_edit]'");
            $data=mysqli_fetch_array($edit);
            
?>
<div class="row">
    <div class="col-lg-6">
        <h1>Form Edit Berita</h1>
        <form action="proses_berita.php?proses=update" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Id</label>
                <input type="text" class="form-control" name="id" disabled value="<?= $data['id_berita']; ?>">
                <input type="hidden" class="form-control" name="id_edit" value="<?=$data['id_berita']?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-select">
                    <option value="">--Pilih Kategori--</option>
                    <?php
                    $kategori = mysqli_query($db, "SELECT * FROM kategori");
                    while ($data_kategori = mysqli_fetch_array($kategori)) {
                        $selected = ($data_kategori['id'] == $data['kategori_id']) ? 'selected' : '';
                        echo "<option value=".$data_kategori['id']." $selected>".$data_kategori['nama_kategori']."</option>";
                    }
                ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" value="<?=$data['judul']?>">
            </div>

            <div class="d-flex flex-column mb-3">
                <label class="form-label">Gambar Saat Ini</label>
                <img src="images/<?=$data['gambar']?>" alt="Gambar Default" class="img-thumbnail">
                <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Gambar</label>
                <input type="file" class="form-control" name="gambar">
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Berita</label>
                <textarea class="form-control" rows="10" name="isi_berita"><?=$data['isi_berita']?></textarea>
            </div>

            <div class="mb-3">
                <input class="btn btn-primary" type="submit" name="submit" value="Update">
                <input class="btn btn-warning" type="reset" name="reset" value="Reset">
            </div>
        </form>
    </div>

</div>
<?php
            break;
}
?>