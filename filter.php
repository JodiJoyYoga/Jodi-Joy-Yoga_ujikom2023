<html>
<head>
<script src="jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
table { 
	width: 750px; 
	border-collapse: collapse; 
	margin:50px auto;
	}
tr:nth-of-type(odd) { 
	background: #eee; 
	}
th { 
	background: #3498db; 
	color: white; 
	font-weight: bold; 
	}
td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 18px;
	}
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		position: absolute;
		top: 6px;
		left: 6px;
		width: 100%; 
		padding-right: 10px; 
		white-space: nowrap;
		content: attr(data-column);
		color: #000;
		font-weight: bold;
	}

}
</style>
<body>
<div class="">
	<h2 align="center" style="margin: 30px;">Filter &amp; Search pada PHP ke Semua Kolom</h2>
	<form method="POST" action="">
        <div class="row mb-3">
		<center><div class="col-sm-12"><h4 align="center" style="margin: 30px;">Cari</h4></div>
		    <div class="col-sm-3">
		        <div class="form-group">		            
		                <input type="date" name="dari_tgl">	
                        <input type="date" name="sampai_tgl">		           
		        </div>
		    </div>
		    <div class="col-sm-4" >
		        <button id="filter" name="filter" class="a_demo_two">Filter</button>
		    </div>
		</div>
	</form>
    <div>
	<table>
	    <thead>
	        <tr>
                <th>No.</th>
	            <th>NIM</th>
	            <th>Nama Mahasiswa</th>
	            <th>Alamat</th>
	            <th>Jurusan</th>
	            <th>Jenis Kelamin</th>
	            <th>Tanggal Masuk</th>
	        </tr>
	    </thead>
	    <tbody>
	        <?php
                    include 'koneksi.php';  
                    if(isset($_POST['filter'])){
                        $dari_tgl=mysqli_real_escape_string($conn,$_POST['dari_tgl']);
                        $sampai_tgl=mysqli_real_escape_string($conn,$_POST['sampai_tgl']);
                        $query_rentang_tgl=mysqli_query($conn,"SELECT * FROM tbl_mahasiswa WHERE tgl_msk BETWEEN '$dari_tgl' AND '$sampai_tgl'");
                    } else {
                        $query_rentang_tgl=mysqli_query($conn,"SELECT * FROM tbl_mahasiswa");
                    }
                    $no=1;
	                while ($row = mysqli_fetch_array($query_rentang_tgl)) {
	                    $NIM = $row['NIM'];
	                    $nama_mahasiswa = $row['nama_mahasiswa'];
	                    $alamat = $row['alamat'];
	                    $jurusan = $row['jurusan'];
	                    $jenis_kelamin = $row['jk'];
	                    $tgl_masuk = $row['tgl_msk'];
	        ?>
	            <tr>
	                <td><?php echo $no++; ?></td>
                    <td><?php echo $NIM;?></td>
	                <td><?php echo $nama_mahasiswa; ?></td>
	                <td><?php echo $alamat; ?></td>
	                <td><?php echo $jurusan; ?></td>
	                <td><?php echo $jenis_kelamin; ?></td>
	                <td><?php echo $tgl_masuk; ?></td>
	            </tr>
	        <?php }  ?> 
	           
	        
	    </tbody>
	</table>
</div>
</body>
</html>