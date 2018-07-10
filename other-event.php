<?php
	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$search = isset($_GET['search']) ? $_GET['search'] : false;
	$pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
	$dataPerhalaman = 5;
	$mulai = ($pagination-1) * $dataPerhalaman;

	$where = "";
	$search_url = "";

	if ($search) {
		$search_url = "&search=$search";
		$where = "AND events.nama_event LIKE '%$search%'";
	}

	$tgl = date('Y-m-d');
	$query = $koneksi->prepare("SELECT events.event_id, events.gambar, events.nama_event, events.tanggal_mulai, events.tanggal_selesai, events.view, events.tempat, kategori.kategori, user.username FROM events JOIN kategori ON events.kategori_id = kategori.kategori_id JOIN user ON events.user_id=user.user_id WHERE events.status =:status AND kategori.kategori=:kategori $where LIMIT $mulai, $dataPerhalaman");
	$array_execute['status'] = "on";
	$array_execute['kategori'] = "other_event";
	$query->execute($array_execute);
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container tinggi-padding">
	<div class="row">
		<div class="col-md-9">
		<?php
			foreach($result as $rows) {
		?>
				<div class="s-box">
					<div class="row row-margin">
						<div class="col-md-3" style="padding-left: 0px; padding-right: 0px;">
							<a href="<?php echo BASE_URL.'/index.php?page=action-event&event_id='.$rows['event_id']; ?>">
								<img src="/eventnesia/img/event/<?php echo $rows['gambar'] ?>" class="image">
							</a>
							<span class="category-box">
								<p><?php echo $rows['kategori']; ?></p>
							</span>
						</div>
						<div class="col-md-9 detail-format">
							<div class="post-title">
								<h2>
									<a href="<?php echo BASE_URL.'/index.php?page=action-event&event_id='.$rows['event_id']; ?>">
										<?php 

	                                		if (strlen($rows['nama_event']) > 60) {
	                                			echo substr($rows['nama_event'], 0, 60)."...";
	                                		} else {
	                                			echo $rows['nama_event'];
	                                		}

	                                	?>
									</a>
								</h2>
							</div>
							<div class="post-info">
								<span class="theauthor">
									<i class="fas fa-user"></i>
									<?php echo $rows['username']; ?>&nbsp;
								</span>
								<span class="posted">
									<i class="far fa-clock"></i>
									<?php 
										if ($rows['tanggal_mulai'] == $rows	['tanggal_selesai']) {
											echo $rows['tanggal_mulai'] ."&nbsp; ";
										} else {
											echo $rows['tanggal_mulai'] ." s/d ". $rows['tanggal_selesai'] ."&nbsp; ";
										}
									?>
									
								</span>
								<span class="views">
									<i class="fas fa-eye"></i>
									<?php echo $rows['view']; ?>
								</span>
							</div>
							<div class="post-excerpt" style="padding-top: 5px;">
								<span class="location">
									<i class="fas fa-map-marker-alt"></i>
									<?php echo $rows['tempat']; ?>
								</span>
							</div>
						</div>
					</div>
				</div>
		<?php
			}

			$queryHitungEvent = $koneksi->prepare("SELECT events.*, kategori.kategori FROM events JOIN kategori ON events.kategori_id = kategori.kategori_id WHERE kategori.kategori=:kategori $where");
			$array_executeHitung['kategori'] = "other_event";
			$queryHitungEvent->execute($array_executeHitung);

			echo "<div align='center'>";
			pagination($queryHitungEvent, $dataPerhalaman, $pagination, "other-event$search_url");
			echo "</div>";
		?>
		
		</div>
		
		<div class="col-md-3" style="padding-right: 0px;">
			<div class="s-box">
				<div class="search-container">
    				<form action="<?php echo BASE_URL.'/index.php'; ?>" method="GET">
    					<div class="row">
    						<div class="col-sm-9">
    							<input type="hidden" name="page" value="<?php echo $_GET['page']; ?>">
		      					<input type="text" placeholder="Search..." name="search">
    						</div>
    						<div class="col-sm-3">
    							<button type="submit"><i class="fa fa-search"></i></button>
    						</div>
    					</div>
    				</form>
  				</div>
			</div>
			<div class="s-box content-info">
				<div class="deskripsi-favorite">
					<p>Favorite</p>
				</div>
				<div class="deskripsi-favorite-detail">

					<?php

						$queryFavorite = $koneksi->prepare("SELECT * FROM events ORDER BY view DESC LIMIT 5;");
						$queryFavorite->execute();
						$resultFavorite = $queryFavorite->fetchAll(PDO::FETCH_ASSOC);

						foreach($resultFavorite as $rowsFavorite) {

					?>
							<ul>
								<li><a href="<?php echo BASE_URL.'/index.php?page=action-event&event_id='.$rowsFavorite['event_id']; ?>"><?php echo $rowsFavorite['nama_event'] ?></a></li>
							</ul>

					<?php
						}
					?>

				</div>
			</div>
		</div>
	</div>
</div>
