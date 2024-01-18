<?php
include("../koneksi.php");

$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
   <div class="row">
            <div class="col-lg-12">
                <h2>List Kategori</h2>
                <a href="index.php?p=kategori&aksi=input" class="btn btn-primary mb-3" >Tambah Data Kategori</a>
                <table class="table table-bordered" id="tabel-mahasiswa">
                    <thead>
                        <tr class="table-primary">
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $tampil=mysqli_query($db, "SELECT * FROM kategori");
                        $no=1;
                        while ($data=mysqli_fetch_array($tampil)) {
                    ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nama_kategori']; ?></td>
                                <td><?php echo $data['keterangan']; ?></td>
                                
                                <td>
                                    <?php if($_SESSION['level'] == 'admin'){ ?>
                                    <a href="proses_kategori.php?proses=delete&id_hapus=<?= $data['id'] ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus</a>
                                    <?php } ?>
                                    <a href="index.php?p=kategori&aksi=edit&id_edit=<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                            <?php
                            $no++;
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
                <h1>Form Mahasiswa</h1>
                <form action="proses_kategori.php?proses=insert" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control"rows="3" name="keterangan"></textarea>
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

            $edit=mysqli_query($db, "SELECT * FROM kategori WHERE id='$_GET[id_edit]'");
            $data=mysqli_fetch_array($edit);
            
?>  
<div class="row">
            <div class="col-lg-6">
                <h1>Edit Kategori</h1>
                <form action="proses_kategori.php?proses=update" method="post"> 
                    <div class="mb-3">
                        <label class="form-label">id</label>
                        <input type="text" class="form-control" name="id" disabled value="<?php echo $data['id']; ?>">
                        <input type="hidden" class="form-control" name="id_edit"  value="<?php echo $data['id']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" value="<?=$data['nama_kategori'] ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control"rows="3" name="keterangan"><?=$data['keterangan'] ?></textarea>
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
     
   