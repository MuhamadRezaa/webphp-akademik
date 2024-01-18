<?php
// proses insert
if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        include 'koneksi.php';
        $nim=$_POST['nim'];
        $nama=$_POST['nama'];
        $prodi=$_POST['prodi'];
        $hari=$_POST['tgl'];
        $bulan=$_POST['bln'];
        $tahun=$_POST['thn'];
        $tanggal_lahir="$tahun-$bulan-$hari";
        $alamat=$_POST['alamat'];
        $sql=mysqli_query($db,"INSERT INTO mahasiswa(nim,nama_mhs,prodi_id,tgl_lahir,alamat) VALUES('$nim','$nama','$prodi','$tanggal_lahir','$alamat')");
        if ($sql) {
            header ("location:index.php?p=mhs");
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

// proses update
if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
        include 'koneksi.php';
        $nim=$_POST['nim'];
        $nama=$_POST['nama'];
        $prodi=$_POST['prodi'];
        $hari=$_POST['tgl'];
        $bulan=$_POST['bln'];
        $tahun=$_POST['thn'];
        $tanggal_lahir="$tahun-$bulan-$hari";
        $alamat=$_POST['alamat'];
        $sql=mysqli_query($db,"UPDATE mahasiswa SET 
                                nama_mhs='$nama',
                                prodi_id='$prodi',
                                tgl_lahir='$tanggal_lahir',
                                alamat='$alamat'
                                WHERE nim='$_POST[nim_edit]'");
        if ($sql) {
            echo "<script>window.location='index.php?p=mhs'</script>";
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

// query update
if ($_GET['proses']=='delete') {

    include 'koneksi.php';
    $hapus=mysqli_query($db,"DELETE FROM mahasiswa WHERE nim='$_GET[nim_hapus]'");

    if($hapus) {
        // echo
  

        echo "<script>window.location='index.php?p=mhs'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}
