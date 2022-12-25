<?php


session_start();
//Membuat koneksi ke database

$conn = mysqli_connect("localhost","root","","apotek");
if ($conn){
    echo "berhasil";
}

//Menambah Barang
if(isset($_POST['addnewbarang'])){
    $merek_dagang = $_POST['merek_dagang'];
    $harga = $_POST['harga'];
    $satuan = $_POST['satuan'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "INSERT INTO stock (merek_dagang,harga,satuan,stock) VALUES ('$merek_dagang','$harga','$satuan','$stock')");
    
    if($addtotable){
        header('location:index.php');
    }
    else{
        echo 'GAGAL';
        header('location:index.php');
    }

}

//Menambah Barang Masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $supplier = $_POST['supplier'];
    $qty = $_POST['qty'];
    $harga = $_POST['harga'];

    $cekstockbarang = mysqli_query($conn,"SELECT * from stock where idobat ='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstockbarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanqty = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idobat,supplier,kuantitas, besarharga) values ('$barangnya','$supplier','$qty','$harga')");
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock set stock ='$tambahkanqty' where idobat = '$barangnya'");

    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    }
    else{
        header('location:masuk.php');
    }
}

if(isset($_POST['barangkeluar'])){
    $barang = $_POST['barang'];
    $penerima = $_POST['penerima'];
    $kondisi = $_POST['kondisi'];
    $qty = $_POST['qty'];

    $cekstockbarang = mysqli_query($conn,"SELECT * from stock where idbarang ='$barang'");
    $ambildatanya = mysqli_fetch_array($cekstockbarang);

    $stocksekarang = $ambildatanya['stock'];
    $kurangqty = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang,penerima,kondisi,quantity) values ('$barang','$penerima','$qty','$kondisi')");
    $updatestockkeluar = mysqli_query($conn, "UPDATE stock set stock ='$kurangqty' where idbarang = '$barang'");

    if($addtokeluar&&$updatestockkeluar){
        header('location:keluar.php');
    }
    else{
        header('location:keluar.php');
    }
}

if(isset($_POST['updatebarang'])){
    $idupdt = $_POST['idbaranghapus'];
    $merek_dagang = $_POST['merek_dagang'];
    $harga = $_POST['harga'];
 
    $updatebarang = mysqli_query($conn, "UPDATE stock set merek_dagang = '$merek_dagang',harga='$harga' where idbarang = '$idupdt'");

    if($updatebarang){
        header('location:index.php');
    }
    else{
        header('location:index.php');
    }
}

if(isset($_POST['hapusbarang'])){

    $idhapus = $_POST['idb'];
    
 
    $hapusbarang = mysqli_query($conn, "DELETE from stock where idobat = '$idhapus'");

    if($hapusbarang){
        header('location:index.php');
    }
    else{
        header('location:index.php');
    }
}

if(isset($_POST['tambahsupplier'])){
    $namasupplier = $_POST['namasupplier'];
    $alamat = $_POST['alamat'];
    $tel = $_POST['tel'];

    $addtosupplier = mysqli_query($conn, "INSERT INTO supplier (nama_supplier,alamat,no_telp) VALUES ('$namasupplier','$alamat','$tel')");

    if($addtosupplier){
        header('location:supplier.php');
    }
    else{
        header('location:supplier.php');
    }
}

if(isset($_POST['updsup'])){
    $idupdt = $_POST['idupdtsup'];
    $namasupplier = $_POST['namasupplier'];
    $alamat = $_POST['alamat'];
    $tel = $_POST['tel'];

    $updsup = mysqli_query($conn, "UPDATE supplier set nama_supplier = '$namasupplier' , alamat = '$alamat' , notelp = '$tel' WHERE idsup = '$idupdt'");

    if($updsup){
        header('location:supplier.php');
    }
    else{
        header('location:supplier.php');
    }
}

if(isset($_POST['hapussupplier'])){
    $idupdt = $_POST['idupdtsup'];
    $updsup = mysqli_query($conn, "DELETE FROM supplier WHERE idsup = '$idupdt'");

    if($updsup){
        header('location:supplier.php');
    }
    else{
        header('location:supplier.php');
    }
}


?>