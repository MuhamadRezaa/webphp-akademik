<?php
include("../koneksi.php");
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
   <div class="row">
            <div class="col-lg-12">
                <h2>List Data Program Studi</h2>
                <a href="index.php?p=prodi&aksi=input" class="btn btn-primary mb-3" >Tambah Data Program Studi</a>
                <table class="table table-bordered" id="tabel-prodi">
                    <thead>
                        <tr class="table-primary">
                            <th>Id</th>
                            <th>Nama Prodi</th>
                            <th>Jenjang Studi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                        $tampil=mysqli_query($db,"SELECT * FROM prodi");
                        while ($data=mysqli_fetch_array($tampil)) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $data['id']; ?></td>
                                <td><?php echo $data['nama_prodi']; ?></td>
                                <td><?php echo $data['jenjang_studi']; ?></td>
                                <td><?php echo $data['keterangan']; ?></td>
                                <td>
                                    <?php if($_SESSION['level'] == 'admin') { ?>
                                        <a href="proses_prodi.php?proses=delete&id_hapus=<?= $data['id'] ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus</a>
                                    <?php } ?>
                                    <a href="index.php?p=prodi&aksi=edit&id_edit=<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                        }
                    ?>        
                </table>
                    
            </div>
        </div>
<?php
        break;
    case 'input' :
?>
<div class="row">
            <div class="col-lg-6">
                <h1>Form Program Studi</h1>
                <form action="proses_prodi.php?proses=insert" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" name="namaProdi">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenjang Studi</label>
                        <input type="text" class="form-control" name="jenjangStudi">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-primary" type="submit" name="submit" value="Proses">
                        <input class="btn btn-warning" type="reset" name="reset" value="Reset">
                    </div>
                </form>
            </div>
</div>
<?php
        break;
        case 'edit' :

            $edit=mysqli_query($db, "SELECT * FROM prodi WHERE id='$_GET[id_edit]'");
            $data=mysqli_fetch_array($edit);
?>  
<div class="row">
            <div class="col-lg-6">
                <h1>Edit Data Mahasiswa</h1>
                <form action="proses_prodi.php?proses=update" method="post">
                    <div class="mb-3">
                        <label class="form-label">ID</label>
                        <input type="text" class="form-control" name="id" disabled value="<?php echo $data['id']; ?>">
                        <input type="hidden" class="form-control" name="id_edit"  value="<?php echo $data['id']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" name="namaProdi" value="<?php echo $data['nama_prodi']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenjang Studi</label>
                        <input type="text" class="form-control" name="jenjangStudi" value="<?php echo $data['jenjang_studi']; ?>">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" name="keterangan"><?= $data['keterangan']; ?></textarea>
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
     
   