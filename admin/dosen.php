<?php
include("../koneksi.php");
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
   <div class="row">
            <div class="col-lg-12">
                <h2>List Data Dosen</h2>
                <a href="index.php?p=dosen&aksi=input" class="btn btn-primary mb-3" >Tambah Data Dosen</a>
                <table class="table table-bordered" id="tabel-dosen">
                    <thead>
                        <tr class="table-primary">
                            <th>NIP</th>
                            <th>Nama Dosen</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Hobi</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                        $tampil=mysqli_query($db,"SELECT * FROM dosen");
                        while ($data=mysqli_fetch_array($tampil)) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $data['nip']; ?></td>
                                <td><?php echo $data['nama_dosen']; ?></td>
                                <td><?php echo $data['jenis_kelamin']; ?></td>
                                <td><?php echo $data['email']; ?></td>
                                <td><?php echo $data['no_telp']; ?></td>
                                <td><?php echo $data['hobi']; ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td>
                                    <?php if($_SESSION['level'] == 'admin') { ?>
                                        <a href="proses_dosen.php?proses=delete&nip_hapus=<?= $data['nip'] ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus</a>
                                    <?php } ?>
                                    <a href="index.php?p=dosen&aksi=edit&nip_edit=<?= $data['nip'] ?>" class="btn btn-warning">Edit</a>
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
            <h1>Form Dosen</h1>
                <form action="proses_dosen.php?proses=insert" method="post">
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="number" class="form-control" name="nip">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Jenis Kelamin</label>
                    </div>
                    <div class="mb-3">
                        <input type="radio" class="form-check-input" name="jekel" value="L" checked> Laki-laki
                        <input type="radio" class="form-check-input" name="jekel" value="P"> Perempuan
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" name="notelp">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Hobi</label>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="form-check-input" name="hobi[]" value="Membaca"> Membaca
                        <input type="checkbox" class="form-check-input" name="hobi[]" value="Olahraga"> Olahraga
                        <input type="checkbox" class="form-check-input" name="hobi[]" value="Travelling"> Travelling
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
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

            $edit=mysqli_query($db, "SELECT * FROM dosen WHERE nip='$_GET[nip_edit]'");
            $data=mysqli_fetch_array($edit);
?>  
<div class="row">
            <div class="col-lg-6">
            <h1>Edit Data Dosen</h1>
                <form action="proses_dosen.php?proses=update" method="post">
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control" name="nip" disabled value="<?php echo $data['nip']; ?>">
                        <input type="hidden" class="form-control" name="nip_edit" value="<?php echo $data['nip']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" name="nama"  value="<?php echo $data['nama_dosen']; ?>">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Jenis Kelamin</label>
                    </div>
                    <div class="mb-3">
                        <input type="radio" class="form-check-input" name="jekel" value="L" <?php echo ($data['jenis_kelamin'] == 'L') ? 'checked' : ''; ?>> Laki-laki
                        <input type="radio" class="form-check-input" name="jekel" value="P" <?php echo ($data['jenis_kelamin'] == 'P') ? 'checked' : ''; ?>> Perempuan
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"  value="<?php echo $data['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="number" class="form-control" name="notelp"  value="<?php echo $data['no_telp']; ?>">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Hobi</label>
                    </div>
                    <div class="mb-3">
                        <?php
                            $hobies=explode(",", $data['hobi']);
                        ?>
                        <input type="checkbox" class="form-check-input" name="hobi[]" value="Membaca" <?php echo (in_array('Membaca', $hobies)) ? 'checked' : ''; ?>> Membaca
                        <input type="checkbox" class="form-check-input" name="hobi[]" value="Olahraga" <?php echo (in_array('Olahraga', $hobies)) ? 'checked' : ''; ?>> Olahraga
                        <input type="checkbox" class="form-check-input" name="hobi[]" value="Travelling" <?php echo (in_array('Travelling', $hobies)) ? 'checked' : ''; ?>> Travelling
    
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat" ><?= $data['alamat']; ?></textarea>
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
}
?>
     
   