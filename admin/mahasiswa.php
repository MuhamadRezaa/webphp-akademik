<?php
include("../koneksi.php");
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
   <div class="row">
            <div class="col-lg-12">
                <h2>List Data Mahasiswa</h2>
                <a href="index.php?p=mhs&aksi=input" class="btn btn-primary mb-3" >Tambah Data Mahasiswa</a>
                <table class="table table-bordered" id="tabel-mahasiswa">
                    <thead>
                        <tr class="table-primary">
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $tampil=mysqli_query($db, "SELECT * FROM mahasiswa a JOIN prodi b ON a.prodi_id=b.id ORDER BY nama_mhs");
                        $no=1;
                        while ($data=mysqli_fetch_array($tampil)) {
                    ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['nim']; ?></td>
                                <td><?php echo $data['nama_mhs']; ?></td>
                                <td><?php echo $data['nama_prodi']; ?></td>
                                <td><?php echo $data['tgl_lahir']; ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td>
                                    <?php if($_SESSION['level'] == 'admin'){ ?>
                                    <a href="proses_mahasiswa.php?proses=delete&nim_hapus=<?= $data['nim'] ?>" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger">Hapus</a>
                                    <?php } ?>
                                    <a href="index.php?p=mhs&aksi=edit&nim_edit=<?= $data['nim'] ?>" class="btn btn-warning">Edit</a>
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
                <form action="proses_mahasiswa.php?proses=insert" method="post">
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Prodi</label>
                        <select class="form-select" name="prodi" id="prodi" required>
                            <option value="">Pilih Prodi</option>
                            <?php
                                $query_prodi = mysqli_query($db, "SELECT * FROM prodi");
                                while ($row = mysqli_fetch_array($query_prodi)) {
                            ?>
                            <option value="<?= $row['id'] ?>"><?= $row['nama_prodi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-3">
                                <select name="tgl" class="form-select">
                                <option value="">Tanggal</option>
                                <?php    
                                    $i=1;
                                    do
                                    { 
                                        echo "<option value=".$i.">".$i."</option>";
                                        $i++;
                                    }while ($i <=31);
                                ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="bln" class="form-select">
                                    <option value="">Bulan</option>
                                    <?php
                                    $bln=[1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                    foreach ($bln as $key => $namaBln) {
                                        echo "<option value=".$key.">".$namaBln."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="thn" class="form-select">=
                                <option value="">Tahun</option>
                                <?php    
                                    for ($i=2023; $i >=1970 ; $i--) { 
                                        echo "<option value=".$i.">".$i."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
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

            $edit=mysqli_query($db, "SELECT * FROM mahasiswa WHERE nim='$_GET[nim_edit]'");
            $data=mysqli_fetch_array($edit);
            list($thn_lahir,$bln_lahir,$tgl_lahir)=explode('-', $data['tgl_lahir']);
?>  
<div class="row">
            <div class="col-lg-6">
                <h1>Edit Data Mahasiswa</h1>
                <form action="proses_mahasiswa.php?proses=update" method="post">
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim" disabled value="<?php echo $data['nim']; ?>">
                        <input type="hidden" class="form-control" name="nim_edit"  value="<?php echo $data['nim']; ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['nama_mhs']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Prodi</label>
                        <select class="form-select" name="prodi" id="prodi" required>
                            <option value="">Pilih Prodi</option>
                            <?php
                                $query_prodi = mysqli_query($db, "SELECT * FROM prodi");
                                while ($row = mysqli_fetch_array($query_prodi)) {
                                $selected = ($row['id'] == $data['prodi_id']) ? 'selected' : '';   
                            ?>
                            <option <?= $selected ?> value="<?= $row['id'] ?>"><?= $row['nama_prodi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-3">
                                <select name="tgl" class="form-select">
                                <option value="">Tanggal</option>
                                <?php    
                                    $i=1;
                                    do
                                    { 
                                        $selected=($i==$tgl_lahir) ? 'selected' : '';
                                        echo "<option value=".$i." $selected>".$i."</option>";
                                        $i++;
                                    }while ($i <=31);
                                ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="bln" class="form-select">
                                    <option value="">Bulan</option>
                                    <?php
                                    $bln=[1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                                    foreach ($bln as $key => $namaBln) {
                                        $selected=($key==$bln_lahir) ? 'selected' : '';
                                        echo "<option value=".$key." $selected>".$namaBln."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-3">
                                <select name="thn" class="form-select">=
                                <option value="">Tahun</option>
                                <?php    
                                    for ($i=2023; $i >=1970 ; $i--) { 
                                        $selected=($i==$thn_lahir) ? 'selected' : '';
                                        echo "<option value=".$i." $selected>".$i."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Alamat</label>
                        <textarea class="form-control" rows="3" name="alamat"><?= $data['alamat']; ?></textarea>
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
     
   