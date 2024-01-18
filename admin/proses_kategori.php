<?php
include '../koneksi.php';

// proses insert
if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {
        
        $sql=mysqli_query($db,"INSERT INTO kategori(nama_kategori,keterangan) VALUES('$_POST[nama_kategori]','$_POST[keterangan]')");
        if ($sql) {
            header ("location:index.php?p=kategori");
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

// proses update
if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
     
        $sql=mysqli_query($db, "UPDATE kategori SET 
                                nama_kategori='$_POST[nama_kategori]',
                                keterangan='$_POST[keterangan]'
                                WHERE id='$_POST[id_edit]'");
        if ($sql) {
            echo "<script>window.location='index.php?p=kategori'</script>";
        }
        else {
            echo "Data gagal disimpan";
        }
    }// query update
}

// query deleted
if ($_GET['proses']=='delete') {

   
    $hapus=mysqli_query($db,"DELETE FROM kategori WHERE id='$_GET[id_hapus]'");

    if($hapus) {
        // echo
  

        echo "<script>window.location='index.php?p=kategori'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}
