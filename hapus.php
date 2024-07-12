<?php
include 'koneksi.php';

if (isset($_GET['idlaporan'])){
    $idlaporan=$_GET['idlaporan'];

$query="Delete from prosespengaduan where idlaporan='$idlaporan'";

$result=mysqli_query($koneksi,$query);
if($result){
    echo "<script> alert('berhasil dihapus');</script>";
 header("Location:landingpage.php#proses");
}
}
?>
