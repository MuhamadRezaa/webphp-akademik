<?php
include("../koneksi.php");
// proses insert
if ($_GET['proses']=='insert') {
    if (isset($_POST['submit'])) {

        $nip=$_POST['nip'];
        $nama=$_POST['nama'];
        $jk=$_POST['jekel'];
        $email=$_POST['email'];
        $notelpon=$_POST['notelp'];
        $hobies=implode(",", $_POST['hobi']);
        $alamat=$_POST['alamat'];
        $sql=mysqli_query($db,"INSERT INTO dosen(nip,nama_dosen,jenis_kelamin,email,no_telp,hobi,alamat) VALUES('$nip','$nama','$jk','$email','$notelpon','$hobies','$alamat')");
        if ($sql) {
            header ("location:index.php?p=dosen");
        }
        else {
            echo "Data gagal disimpan";
        }
    }
}

// proses update
if ($_GET['proses']=='update') {
    if (isset($_POST['submit'])) {
        
        $nip=$_POST['nip'];
        $nama=$_POST['nama'];
        $jk=$_POST['jekel'];
        $email=$_POST['email'];
        $notelpon=$_POST['notelp'];
        $hobies=implode(",", $_POST['hobi']);
        $alamat=$_POST['alamat'];
        $sql=mysqli_query($db, "UPDATE dosen SET
                                nama_dosen='$nama',
                                jenis_kelamin='$jk',
                                email='$email',
                                no_telp='$notelpon',
                                hobi='$hobies',
                                alamat='$alamat'
                                WHERE nip='$_POST[nip_edit]'");
        if ($sql) {
            echo "<script>window.location='index.php?p=dosen'</script>";
        } else {
            echo "Data gagal disimpan";
        }
    }
}


// query deleted
if ($_GET['proses']=='delete') {

    
    $hapus=mysqli_query($db,"DELETE FROM dosen WHERE nip='$_GET[nip_hapus]'");

    if($hapus) {
        // echo
        // header ("location:listDataDosen.php");
        echo "<script>window.location='index.php?p=dosen'</script>";
    }
    else {
        print "Gagal Menghapus Data";
    }
}
