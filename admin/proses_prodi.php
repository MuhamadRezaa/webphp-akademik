<?php
include("../koneksi.php");

// proses insert
if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {

        $np=$_POST['namaProdi'];
        $js=$_POST['jenjangStudi'];
        $keterangan=$_POST['keterangan'];
        $sql=mysqli_query($db,"INSERT INTO prodi(nama_prodi,jenjang_studi,keterangan) VALUES('$np','$js','$keterangan')");
        if ($sql) {
            header ("location:index.php?p=prodi");
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

// proses update
if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {

        $np=$_POST['namaProdi'];
        $js=$_POST['jenjangStudi'];
        $keterangan=$_POST['keterangan'];
        $sql=mysqli_query($db, "UPDATE prodi SET
                                nama_prodi='$np',
                                jenjang_studi='$js',
                                keterangan='$keterangan'
                                WHERE id='$_POST[id_edit]'");
        if ($sql) {
            echo "<script>window.location='index.php?p=prodi'</script>";
        } else {
            echo "Data gagal disimpan";
        }
    }
}


// query update
if ($_GET['proses']=='delete') {

    
    $hapus=mysqli_query($db,"DELETE FROM prodi WHERE id='$_GET[id_hapus]'");

    if($hapus) {
        // echo
        // header ("location:listDataprodi.php");
        echo "<script>window.location='index.php?p=prodi'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}
