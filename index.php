<html>
<head>
<script src="jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<link rel="stylesheet/css" type="text/css" href="style.css" />
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
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		content: attr(data-column);
		color: #000;
		font-weight: bold;
	}

}
</style>
</head>
<body>
<div class="">
	<h2 align="center" style="margin: 30px;">Filter &amp; Search pada PHP ke Semua Kolom</h2>
	<?php 	
        $s_keyword="";
        if (isset($_POST['search'])) {
            $s_tgl_masuk = $_POST['tgl_msk'];
            $s_keyword = $_POST['s_keyword'];
        }
	?>
	<form method="POST" action="">
        <div class="row mb-3">
		<center><div class="col-sm-12"><h4 align="center" style="margin: 30px;">Cari</h4></div>
		    <div class="col-sm-3">
		        <div class="form-group">
		            
		                <input type="date">
		           
		        </div>
		    </div>
		    <div class="col-sm-4">
		        <div class="form-group">
		            <input type="text" placeholder="Keyword" name="s_keyword" id="s_keyword" class="form-control" value="<?php echo $s_keyword; ?>">
		        </div>
		    </div>
		    <div class="col-sm-4" >
		        <button id="search" name="search" class="btn btn-warning">Cari</button>
		    </div>
		</div>
	</form>
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
	            $search_tgl_masuk = '%'. $s_tgl_masuk .'%';
	            $search_keyword = '%'. $s_keyword .'%';
	            $no = 1;
	            $query = "SELECT * FROM tbl_mahasiswa WHERE tgl_msk LIKE ? AND (nama_mahasiswa LIKE ? OR alamat LIKE ? OR jurusan LIKE ? OR jk LIKE ? OR tgl_msk LIKE ?) ORDER BY NIM DESC";
	            $query2 = $conn->prepare($query);
	            $query2->bind_param('ssssss', $search_tgl_masuk, $search_keyword, $search_keyword, $search_keyword, $search_keyword, $search_keyword);
	            $query2->execute();
	            $result = $query2->get_result();

	            if ($result->num_rows > 0) {
	                while ($row = $result->fetch_assoc()) {
	                    $NIM = $row['NIM'];
	                    $nama_mahasiswa = $row['nama_mahasiswa'];
	                    $alamat = $row['alamat'];
	                    $jurusan = $row['jurusan'];
	                    $jenis_kelamin = $row['jk'];
	                    $tgl_masuk = $row['tgl_msk'];
	        ?>
	            <tr>
	                <td><?php echo $no++; ?></td>
                    <td data-column="Last Name"><?php echo $NIM;?></td>
	                <td data-column="Job Title"><?php echo $nama_mahasiswa; ?></td>
	                <td data-column="Twitter"><?php echo $alamat; ?></td>
	                <td data-column="First Name"><?php echo $jurusan; ?></td>
	                <td data-column="Last Name"><?php echo $jenis_kelamin; ?></td>
	                <td data-column="Job Title"><?php echo $tgl_masuk; ?></td>
	            </tr>
	        <?php } } else { ?> 
	            <tr>
	                <td colspan='7'>Tidak ada data ditemukan</td>
	            </tr>
	        <?php } ?>
	    </tbody>
            </div>
	</table>
	
</div>
</body>
</html>