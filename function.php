<?php


session_start();
//Membuat koneksi ke database

$conn = mysqli_connect("localhost", "root", "", "apotek");


//Menambah Barang
if (isset($_POST['addnewbarang'])) {
	$merek_dagang = $_POST['merek_dagang'];
	$harga = $_POST['harga'];
	$satuan = $_POST['satuan'];
	$stock = $_POST['stock'];
	$exp_date = $_POST['exp_date'];
	$supplier = $_POST['supplier'];

	$addtotable = mysqli_query($conn, "INSERT INTO stock (merek_dagang,harga,satuan,stock, exp_date, supplier) VALUES ('$merek_dagang','$harga','$satuan','$stock', '$exp_date', '$supplier')");

	if ($addtotable) {
		header('location:index.php');
	} else {
		echo 'GAGAL';
		header('location:index.php');
	}

}

//Menambah Barang Masuk
if (isset($_POST['barangmasuk'])) {
	$barangnya = $_POST['barangnya'];
	$supplier = $_POST['supplier'];
	$qty = $_POST['qty'];
	$harga = $_POST['harga'];

	$cekstockbarang = mysqli_query($conn, "SELECT * from stock where idobat ='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstockbarang);

	$stocksekarang = $ambildatanya['stock'];
	$tambahkanqty = $stocksekarang + $qty;

	$addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idobat,id_supplier,kuantitas, besarharga) values ('$barangnya','$supplier','$qty','$harga')");
	$updatestockmasuk = mysqli_query($conn, "UPDATE stock set stock ='$tambahkanqty' where idobat = '$barangnya'");

	if ($addtomasuk && $updatestockmasuk) {
		header('location:masuk.php');
	} else {
		header('location:masuk.php');
	}
}

if (isset($_POST['barangkeluar'])) {
	$barang = $_POST['barang'];
	$penerima = $_POST['penerima'];
	$kondisi = $_POST['kondisi'];
	$qty = $_POST['qty'];

	$cekstockbarang = mysqli_query($conn, "SELECT * from stock where idbarang ='$barang'");
	$ambildatanya = mysqli_fetch_array($cekstockbarang);

	$stocksekarang = $ambildatanya['stock'];
	$kurangqty = $stocksekarang - $qty;

	$addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang,penerima,kondisi,quantity) values ('$barang','$penerima','$qty','$kondisi')");
	$updatestockkeluar = mysqli_query($conn, "UPDATE stock set stock ='$kurangqty' where idbarang = '$barang'");

	if ($addtokeluar && $updatestockkeluar) {
		header('location:keluar.php');
	} else {
		header('location:keluar.php');
	}
}

if (isset($_POST['updatebarang'])) {
	$idupdt = $_POST['idbaranghapus'];
	$merek_dagang = $_POST['merek_dagang'];
	$harga = $_POST['harga'];

	$updatebarang = mysqli_query($conn, "UPDATE stock set merek_dagang = '$merek_dagang',harga='$harga' where idbarang = '$idupdt'");

	if ($updatebarang) {
		header('location:index.php');
	} else {
		header('location:index.php');
	}
}

if (isset($_POST['hapusbarang'])) {

	$idhapus = $_POST['idb'];


	$hapusbarang = mysqli_query($conn, "DELETE from stock where idobat = '$idhapus'");

	if ($hapusbarang) {
		header('location:index.php');
	} else {
		header('location:index.php');
	}
}

if (isset($_POST['tambahsupplier'])) {
	$namasupplier = $_POST['namasupplier'];
	$alamat = $_POST['alamat'];
	$tel = $_POST['tel'];

	$addtosupplier = mysqli_query($conn, "INSERT INTO supplier (nama_supplier,alamat,no_telp) VALUES ('$namasupplier','$alamat','$tel')");

	if ($addtosupplier) {
		header('location:supplier.php');
	} else {
		header('location:supplier.php');
	}
}

if (isset($_POST['updsup'])) {
	$idupdt = $_POST['idupdtsup'];
	$namasupplier = $_POST['namasupplier'];
	$alamat = $_POST['alamat'];
	$tel = $_POST['tel'];

	$updsup = mysqli_query($conn, "UPDATE supplier set nama_supplier = '$namasupplier' , alamat = '$alamat' , no_telp = '$tel' WHERE idsup = '$idupdt';");

	if ($updsup) {
		header('location:supplier.php');
	} else {
		header('location:supplier.php');
	}
}

if (isset($_POST['hapussupplier'])) {
	$idupdt = $_POST['idupdtsup'];
	$updsup = mysqli_query($conn, "DELETE FROM supplier WHERE idsup = '$idupdt'");

	if ($updsup) {
		header('location:supplier.php');
	} else {
		header('location:supplier.php');
	}
}

if (isset($_POST['addnewfaktur'])) {
	$tanggal = $_POST['tanggalpesan'];
	$penjual = $_POST['penjual'];
	$pesanan = $_POST['pesanan'];
	$totalpesanan = $_POST['totalpesanan'];
	$jatuhtempo = $_POST['jatuhtempo'];

	$addnewfaktur = mysqli_query($conn, "INSERT INTO faktur (tanggal, penjual, pesanan, total_pembayaran, jatuh_tempo) VALUES ('$tanggal', '$penjual', '$pesanan', '$totalpesanan', '$jatuhtempo')");

	if ($addnewfaktur) {
		header('location:faktur.php');
	} else {
		header('location:faktur.php');
	}
}

if (isset($_POST['idupfaktur'])) {
	$idupfaktur = $_POST['id_faktur'];
	$tanggal = $_POST['tanggalpesan'];
	$penjual = $_POST['penjual'];
	$pesanan = $_POST['pesanan'];
	$totalpesanan = $_POST['totalpesanan'];
	$jatuhtempo = $_POST['jatuhtempo'];

	$queryfaktur = mysqli_query($conn, "UPDATE faktur set tanggal = '$tanggal' , penjual = '$penjual' , pesanan = '$pesanan', total_pembayaran = '$totalpesanan', jatuh_tempo = '$jatuhtempo' WHERE id_faktur = '$idupfaktur'");

	if ($queryfaktur) {
		header('location:faktur.php');
	} else {
		header('location:faktur.php');
	}
}

if (isset($_POST['hapusfaktur'])) {
	$idhapusfaktur = $_POST['id_faktur'];
	$queryhapusfaktur = mysqli_query($conn, "DELETE from faktur WHERE id_faktur = '$idhapusfaktur'");

	if ($queryhapusfaktur) {
		header('location:faktur.php');
	} else {
		header('location:faktur.php');
	}
}

if (isset($_POST['buattransaksi'])) {
	$idtbaru = $_POST['id_t'];
	$dokter = null;
	$pasien = null;

	if (isset($_POST['dokter'])) {
		$dokter = $_POST['dokter'];
	}
	if (isset($_POST['pasien'])) {
		$pasien = $_POST['pasien'];
	}

	$querybuattransaksi = mysqli_query($conn, "INSERT INTO transaksi(id_transaksi, jumlah, nominal, nama_pelanggan, nama_dokter) VALUES('$idtbaru', '0', '0', '$pasien', '$dokter');");
	header('location: keluar.php');
}

if (isset($_POST['hapustransaksi'])) {
	$idthapus = $_POST['idth'];

	$queryreleaseobat = mysqli_query($conn, "SELECT k.id_obat, k.jumlah FROM keluar k LEFT JOIN transaksi t ON k.id_transaksi = t.id_transaksi WHERE k.id_transaksi = '$idthapus';");
	while ($obatreleased = mysqli_fetch_array($queryreleaseobat)) {
		$amountreleased = $obatreleased['jumlah'];
		$idtorelease = $obatreleased['id_obat'];
		mysqli_query($conn, "UPDATE stock SET `stock` = `stock` + '$amountreleased' WHERE idobat = '$idtorelease';");
	}

	$queryhapuskeluar = mysqli_query($conn, "DELETE FROM keluar WHERE id_transaksi = '$idthapus';");
	$queryhapustransaksi = mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi = '$idthapus';");
	header('location: keluar.php');
}

function updatetransaksi($connection, $id_t)
{
	$itemsintransaction = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) as amount FROM keluar;"));
	if ($itemsintransaction['amount'] <= 0) {
		mysqli_query($connection, "UPDATE transaksi SET jumlah = '0', nominal = '0' WHERE id_transaksi = '$id_t';");
	} else {
		mysqli_query($connection, "UPDATE transaksi SET jumlah = (SELECT SUM(jumlah) FROM keluar WHERE id_transaksi = '$id_t'), nominal = (SELECT SUM(nominal) FROM keluar WHERE id_transaksi = '$id_t') WHERE id_transaksi = '$id_t';");
	}
}

if (isset($_POST['transaksitambah'])) {
	$t_obat = $_POST['idobatbaru'];
	$t_qty = $_POST['qtybaru'];
	$t_id = $_POST['id_tr'];

	$querycekstok = mysqli_query($conn, "SELECT `stock`, `harga` FROM stock WHERE idobat = '$t_obat'");
	$stoktersisa = mysqli_fetch_array($querycekstok);

	if ($stoktersisa['stock'] < $t_qty) {
		header("location: detilkeluar.php?id=$t_id&msg=Stok obat yang ingin ditambahkan tidak mencukupi!");
		die('');
	}

	$newqty = $stoktersisa['stock'] - $t_qty;
	$querymengurangstok = mysqli_query($conn, "UPDATE stock SET `stock` = '$newqty' WHERE idobat = '$t_obat'");

	$hargaobat = $stoktersisa['harga'] * $t_qty;
	$queryaddbarangtransaksi = mysqli_query($conn, "INSERT INTO keluar VALUES('$t_id', '$t_obat', '$t_qty','$hargaobat');");
	updatetransaksi($conn, $t_id);

	header("location: detilkeluar.php?id=$t_id");
}

if (isset($_POST['aturdetilobat'])) {
	$editdetilobat = $_POST['id_obat_detil'];
	$editdetilstock = $_POST['stock_detil'];
	$oristock = $_POST['id_sori_detil'];
	$bestock = $_POST['id_sb_detil'];
	$editdetilid = $_POST['id_trans_detil'];

	if ($oristock < $editdetilstock) {
		header("location: detilkeluar.php?id=$editdetilid&msg=Stok obat yang ingin ditambahkan tidak mencukupi!");
		die('');
	}

	$newstock = $oristock - $editdetilstock;
	$querymengubahstok = mysqli_query($conn, "UPDATE stock SET `stock` = '$newstock' WHERE idobat = '$editdetilobat';");

	$querymengambilobat = mysqli_fetch_array(mysqli_query($conn, "SELECT harga FROM stock WHERE idobat = '$editdetilobat'"));
	$hargabaru = $editdetilstock * $querymengambilobat['harga'];

	$querymengubahnominal = mysqli_query($conn, "UPDATE keluar SET `jumlah` = '$editdetilstock', `nominal` = '$hargabaru' WHERE id_obat = '$editdetilobat' AND id_transaksi = '$editdetilid';");
	updatetransaksi($conn, $editdetilid);

	header("location: detilkeluar.php?id=$editdetilid");
}

if (isset($_POST['hapustobat'])) {
	$idtransaksidel = $_POST['id_t_del'];
	$idobatdel = $_POST['id_o_del'];

	$jlhrelease = mysqli_fetch_array(mysqli_query($conn, "SELECT jumlah FROM keluar WHERE id_transaksi = '$idtransaksidel' AND id_obat='$idobatdel'"));

	$initialstock = mysqli_fetch_array(mysqli_query($conn, "SELECT `stock` FROM stock WHERE idobat = '$idobatdel'"));
	$newreleasestock = $jlhrelease['jumlah'] + $initialstock['stock'];
	$releasestock = mysqli_query($conn, "UPDATE stock SET stock='$newreleasestock' WHERE idobat = '$idobatdel'");

	$deleteitemintrans = mysqli_query($conn, "DELETE FROM keluar WHERE id_obat='$idobatdel' AND id_transaksi = '$idtransaksidel';");

	updatetransaksi($conn, $idtransaksidel);
	header("location: detilkeluar.php?id=$idtransaksidel");
}



?>