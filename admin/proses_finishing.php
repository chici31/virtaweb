<?php
/*error_reporting(0);*/
include_once '../koneksi.php';

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah (){
    global $conn;
    $id_pemesanan = $_POST['id_pemesanan'];
    $foto_finishing = upload();
    $keterangan_finishing = $_POST['keterangan_finishing'];

    if(!$foto_finishing){
        return false;
    }

    $query = "INSERT INTO tb_jahit_finishing
            VALUES
            ('','$id_pemesanan','$foto_finishing','$keterangan_finishing')
            ";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}



function upload(){
    $namaFile   = $_FILES['foto_finishing']['name'];
    $ukuranFile = $_FILES['foto_finishing']['size'];
    $tmpName    = $_FILES['foto_finishing']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    $ekstensiGambarValid = array('png','jpg','jpeg');
    $ekstensiGambars = explode ('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambars));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
            </script>
        ";
        return false;
    }
    if($ukuranFile > 10000000) {
        echo "<script>
                alert ('ukuran gambar terlalu besar!');
            </script>
        ";
        return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName,'../upload/finishing/'.$namaFileBaru);
    return $namaFileBaru;  
}
?>