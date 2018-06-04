<?php
	$koneksi = mysql_connect("localhost","root","") or die("Koneksi Gagal !" . mysql_error());
	$database = mysql_select_db("kasir");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<script type="text/javascript">
	function update(){
		document.location.hre = "index.php";
	}
</script>
<meta name="Description" content="Information architecture, Web Design, Web Standards." />
<meta name="Keywords" content="your, keywords" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="Erwin Aligam - ealigam@gmail.com" />
<meta name="Robots" content="index,follow" />
<link rel="stylesheet" href="images/HigherGround.css" type="text/css" /><title>RESTORAN MANUSIAWI</title>

</head>


<body>
<!-- wrap starts here -->
<div id="wrap">
<div id="top-bg"></div>
<!--header -->
<div id="header">
<h1 id="logo-text"><a href="#" title="">MUHAMAD<span> FADHIL<span> INDIRWAN</span></a></h1>
<p id="slogan">1600018213</p>
<div id="header-links">
</div>
<!--header ends--> </div>
<div id="header-photo"></div>
<!-- navigation starts-->
<div id="nav">
<ul>
<li id="current"><a href="home.php">Home</a></li>
<li><a href="index.php">Order</a></li>
<li><a href="menu.php">Menu</a></li>

</ul>


<table align="center">
		
        <td id="td"><a href="tambah_barang.html">Tambah Pesanan</a></td>
		<td id="td"><a href="beli.php">Pemesanan</a></td>
		
		<tr>
        <td id="test" align="left">
        <form action="delete.php" method="post" enctype="multipart/form-data">
			<select name="kd">
            <?php
				$lihat = mysql_query("select * from Barang");
				while($data = mysql_fetch_array($lihat))
				{
					echo "<option ' id='kd' value=".$data['kd_brg'].">".$data['kd_brg']."<option>";
				}
			?>
        	</select><input type="submit" value="Delete Pesanan" />
            </form>
			</td>
        <td id="test" align="right">
		<form action="update.php" method="post" enctype="multipart/form-data">
			<select name="kd">
            <?php
				$lihat = mysql_query("select * from Barang");
				while($data = mysql_fetch_array($lihat))
				{
					echo "<option onclick='isi()' id='kd' value=".$data['kd_brg'].">".$data['kd_brg']."<option>";
				}
			?>
        	</select><input type="submit" value="Update Pesanan" />
            </form>
            </td>
		
		</tr>
        
			
	
</table>
<tr>
			<center><form method="post" action="search_barang.php" ><input type="text" name="kd_brg" />&nbsp;&nbsp;
		<input type="submit" value="Search" /></form>
    </tr></center>
<br />
<div style="width:100%">
	<div align="center">
    	<div style="width:600px;">
        	<div style="width:600px; float:left">
            <table align="center" border="1" width="600">
            <tr id="td">
                <<td>No.</td>
                <td>Kode Pemesan</td>
                <td>Nama Pesanan</td>
                <td>Harga</td>
                <td>jumlah</td>
            </tr>
            <?php
					$dataPerPage = 5; //Jumlah Page Yang inign ditampilkan di halaman depan
					if(isset($_GET['page']))
					{
						$noPage = $_GET['page'];
					}
					else $noPage = 1;
					
					$offset = ($noPage - 1) * $dataPerPage;
					
            $no = 1;
            $lihat = mysql_query("select *,format(harga,0) as 'harga' from barang LIMIT $offset, $dataPerPage");
            while($hasil = mysql_fetch_array($lihat))
            {
                echo "<tr>
                        <td>".$no."</td>
                        <td>".$hasil['kd_brg']."</td>
                        <td>".$hasil['nama_brg']."</td>
                        <td>Rp.".$hasil['harga']."</td>
                        <td>".$hasil['stok']."</td>
                      </tr>
                ";
                $no ++;
            }
            ?>
	        </table>
            <?php
            		$query = "SELECT COUNT(*) AS jumData FROM barang";
					$hasil = mysql_query($query);
					$data = mysql_fetch_array($hasil);
					$jumData = $data['jumData'];
					$jumPage = ceil($jumData/$dataPerPage);
					if ($noPage > 1) echo  "<a id='page' href='".$_SERVER['PHP_SELF']."?page=".($noPage-1)."'>&lt;&lt;</a>";
					for($page = 1; $page <= $jumPage; $page++)
					{
						if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $jumPage))
						 {
							if (($page != ($jumPage - 1)) && ($page == $jumPage))
							{
								echo "...";
							}
							if ($page == $noPage)
							{
							echo " <b>".$page."</b> ";
							}
							else 
							{
							echo " <a id='page' href='".$_SERVER['PHP_SELF']."?page=".$page."'>".$page."</a> ";
							}
							
							$page = $page;
						}
					}
					if ($noPage < $jumPage) echo "<a id='page' href='".$_SERVER['PHP_SELF']."?page=".($noPage+1)."'>&gt;&gt;</a>";

				?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
