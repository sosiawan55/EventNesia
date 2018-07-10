<?php

	include_once("function/koneksi.php");
	include_once("function/helper.php");

?>

<!-- Jumbotron Img -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

	<!-- Indicators -->
  	<ol class="carousel-indicators">
  		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  	</ol>

  	<!-- Wrapper for slides -->
  	<div class="carousel-inner" role="listbox">
  		<div class="item active">
  			<img src="img/banner/bn2.jpeg" alt="Img Carousel" style="width: 100%; height: 500px;">
  		</div>
  		<div class="item">
  			<img src="img/banner/bn3.jpeg" alt="Img Carousel" style="width: 100%; height: 500px;">
  		</div>
  		<div class="item">
  			<img src="img/banner/bn1.jpeg" alt="Img Carousel" style="width: 100%; height: 500px;">
  		</div>
  	</div>

  	<!-- Controls -->
  	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	  	<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
  	</a>
  	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	</a>

</div>


<div class="container home-container s-box">
	<div class="home-detail-container">
		<div class="row">
			<div class="col-md-6">
				<p class="home-paragraf-detail">Festival</p>
			</div>
			<div class="col-md-6">
				<div class="button-views" align="right">
					<form action="<?php echo BASE_URL."/index.php?page=festival";?>" method=POST>
						<button class="btn btn-default">Lihat Selengkapnya</button>
					</form>
				</div>
			</div>
		</div>
		<div class="row home-detail-events">

		<?php
			$query_festival = $koneksi->prepare("SELECT events.nama_event, events.event_id, events.gambar, events.tanggal_mulai, events.tanggal_selesai, user.username, events.view, events.tempat FROM events JOIN kategori ON events.kategori_id = kategori.kategori_id JOIN user ON events.user_id=user.user_id WHERE events.status=:status AND kategori.kategori=:kategori ORDER BY events.event_id DESC LIMIT 4");

			$array_execute_festival['status'] = "on";
			$array_execute_festival['kategori'] = "festival";
			$query_festival->execute($array_execute_festival);
			$result_festival = $query_festival->fetchAll(PDO::FETCH_ASSOC);

			foreach($result_festival as $row_festival) {
		?>
			<a class="container-festival-part" href="<?php echo BASE_URL."/index.php?page=action-event&event_id=".$row_festival['event_id']; ?>">
				<div class="col-md-3">
					<div class="home-container-all" style="border: 1px solid black;">
						<table align="center" class="fontsTim">
		                    <tbody>
		                        <tr>
		                            <td colspan="3" align="center">
	                            		<img class="img-home" src="img/event/<?php echo $row_festival['gambar'] ?>" style="width: 100%; height: 200px;">
		                                <h4>
		                                	<?php 

		                                		if (strlen($row_festival['nama_event']) > 37) {
		                                			echo substr($row_festival['nama_event'], 0, 37)."...";
		                                		} else {
		                                			echo $row_festival['nama_event'];
		                                		}

		                                	?>
		                                </h4>
		                                <div class="post-info">
											<span class="posted">
												<i class="far fa-clock"></i>
												<?php 
													if ($row_festival['tanggal_mulai'] == $row_festival['tanggal_selesai']) {
														echo $row_festival['tanggal_mulai'] ."&nbsp; ";
													} else {
														echo $row_festival['tanggal_mulai'] ." s/d ". $row_festival['tanggal_selesai'] ."&nbsp; ";
													}
												?>
											</span>
											<br />
		                                	<span class="theauthor">
												<i class="fas fa-user"></i>
												<?php echo $row_festival['username']; ?>
											</span>
											&nbsp;&nbsp;
											<span class="views">
												<i class="fas fa-eye"></i>
												<?php echo $row_festival['view']; ?>
											</span>
											<br /><br />
											<span style="font-size: 16px; color: black;" class="location">
												<i class="fas fa-map-marker-alt"></i>
												<?php 

			                                		if (strlen($row_festival['tempat']) > 52) {
			                                			echo substr($row_festival['tempat'], 0, 52)."...";
			                                		} else {
			                                			echo $row_festival['tempat'];
			                                		}
			                                		 
			                                	?>
											</span>
		                                </div>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
					</div>
				</div>
			</a>
		<?php 
			}
		?>
		</div>
	</div>
</div>

<div class="container home-container s-box">
	<div class="home-detail-container">
		<div class="row">
			<div class="col-md-6">
				<p class="home-paragraf-detail">Seminar</p>
			</div>
			<div class="col-md-6">
				<div align="right">
					<form action="<?php echo BASE_URL."/index.php?page=seminar";?>" method=POST>
						<button class="btn btn-default">Lihat Selengkapnya</button>
					</form>
				</div>
			</div>
		</div>
		<div class="row home-detail-events">

		<?php
			$query_seminar = $koneksi->prepare("SELECT events.nama_event, events.event_id, events.gambar, events.tanggal_mulai, events.tanggal_selesai, user.username, events.view, events.tempat FROM events JOIN kategori ON events.kategori_id = kategori.kategori_id JOIN user ON events.user_id=user.user_id WHERE events.status=:status AND kategori.kategori=:kategori ORDER BY events.event_id DESC LIMIT 4");

			$array_execute_seminar['status'] = "on";
			$array_execute_seminar['kategori'] = "seminar";
			$query_seminar->execute($array_execute_seminar);
			$result_seminar = $query_seminar->fetchAll(PDO::FETCH_ASSOC);

			foreach($result_seminar as $row_seminar) {
		?>
			<a href="<?php echo BASE_URL."/index.php?page=action-event&event_id=".$row_seminar['event_id']; ?>">
				<div class="col-md-3">
					<div class="home-container-all" style="border: 1px solid black;">
						<table align="center" class="fontsTim">
		                    <tbody>
		                        <tr>
		                            <td colspan="3" align="center">
	                            		<img class="img-home" src="img/event/<?php echo $row_seminar['gambar'] ?>" style="width: 100%; height: 200px;">
		                                <h4>
		                                	<?php 

		                                		if (strlen($row_seminar['nama_event']) > 37) {
		                                			echo substr($row_seminar['nama_event'], 0, 37)."...";
		                                		} else {
		                                			echo $row_seminar['nama_event'];
		                                		}
		                                		 
		                                	?>
		                                </h4>
		                                <div class="post-info">
											<span class="posted">
												<i class="far fa-clock"></i>
												<?php 
													if ($row_seminar['tanggal_mulai'] == $row_seminar['tanggal_selesai']) {
														echo $row_seminar['tanggal_mulai'] ."&nbsp; ";
													} else {
														echo $row_seminar['tanggal_mulai'] ." s/d ". $row_seminar['tanggal_selesai'] ."&nbsp; ";
													}
												?>
											</span>
											<br />
		                                	<span class="theauthor">
												<i class="fas fa-user"></i>
												<?php echo $row_seminar['username']; ?>
											</span>
											&nbsp;&nbsp;
											<span class="views">
												<i class="fas fa-eye"></i>
												<?php echo $row_seminar['view']; ?>
											</span>
											<br /><br />
											<span style="font-size: 16px; color: black;" class="location">
												<i class="fas fa-map-marker-alt"></i>
												<?php 

			                                		if (strlen($row_seminar['tempat']) > 52) {
			                                			echo substr($row_seminar['tempat'], 0, 52)."...";
			                                		} else {
			                                			echo $row_seminar['tempat'];
			                                		}
			                                		 
			                                	?>
											</span>
		                                </div>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
					</div>
				</div>
			</a>
		<?php 
			}
		?>
		</div>
	</div>
</div>

<div class="container home-container s-box">
	<div class="home-detail-container">
		<div class="row">
			<div class="col-md-6">
				<p class="home-paragraf-detail">Workshop</p>
			</div>
			<div class="col-md-6">
				<div align="right">
					<form action="<?php echo BASE_URL."/index.php?page=workshop";?>" method=POST>
						<button class="btn btn-default">Lihat Selengkapnya</button>
					</form>
				</div>
			</div>
		</div>
		<div class="row home-detail-events">

		<?php
			$query_workshop = $koneksi->prepare("SELECT events.nama_event, events.event_id, events.gambar, events.tanggal_mulai, events.tanggal_selesai, user.username, events.view, events.tempat FROM events JOIN kategori ON events.kategori_id = kategori.kategori_id JOIN user ON events.user_id=user.user_id WHERE events.status=:status AND kategori.kategori=:kategori ORDER BY events.event_id DESC LIMIT 4");

			$array_execute_workshop['status'] = "on";
			$array_execute_workshop['kategori'] = "workshop";
			$query_workshop->execute($array_execute_workshop);
			$result_workshop = $query_workshop->fetchAll(PDO::FETCH_ASSOC);

			foreach($result_workshop as $row_workshop) {
		?>

			<a href="<?php echo BASE_URL."/index.php?page=action-event&event_id=".$row_workshop['event_id']; ?>">
				<div class="col-md-3">
					<div class="home-container-all" style="border: 1px solid black;">
						<table align="center" class="fontsTim">
		                    <tbody>
		                        <tr>
		                            <td colspan="3" align="center">
		                            	<img class="img-home" src="img/event/<?php echo $row_workshop['gambar'] ?>" style="width: 100%; height: 200px;">
		                                <h4>
		                                	<?php 

		                                		if (strlen($row_workshop['nama_event']) > 37) {
		                                			echo substr($row_workshop['nama_event'], 0, 37)."...";
		                                		} else {
		                                			echo $row_workshop['nama_event'];
		                                		}
		                                		 
		                                	?>
		                                </h4>
		                                <div class="post-info">
											<span class="posted">
												<i class="far fa-clock"></i>
												<?php 
													if ($row_workshop['tanggal_mulai'] == $row_workshop['tanggal_selesai']) {
														echo $row_workshop['tanggal_mulai'] ."&nbsp; ";
													} else {
														echo $row_workshop['tanggal_mulai'] ." s/d ". $row_workshop['tanggal_selesai'] ."&nbsp; ";
													}
												?>
											</span>
											<br />
		                                	<span class="theauthor">
												<i class="fas fa-user"></i>
												<?php echo $row_workshop['username']; ?>
											</span>
											&nbsp;&nbsp;
											<span class="views">
												<i class="fas fa-eye"></i>
												<?php echo $row_workshop['view']; ?>
											</span>
											<br /><br />
											<span style="font-size: 16px; color: black;" class="location">
												<i class="fas fa-map-marker-alt"></i>
												<?php 

			                                		if (strlen($row_workshop['tempat']) > 52) {
			                                			echo substr($row_workshop['tempat'], 0, 52)."...";
			                                		} else {
			                                			echo $row_workshop['tempat'];
			                                		}
			                                		 
			                                	?>
											</span>
		                                </div>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
					</div>
				</div>
			</a>
		<?php 
			}
		?>
		</div>
	</div>
</div>

<div class="container home-container s-box">
	<div class="home-detail-container">
		<div class="row">
			<div class="col-md-6">
				<p class="home-paragraf-detail">Sports</p>
			</div>
			<div class="col-md-6">
				<div align="right">
					<form action="<?php echo BASE_URL."/index.php?page=sports";?>" method=POST>
						<button class="btn btn-default">Lihat Selengkapnya</button>
					</form>
				</div>
			</div>
		</div>
		<div class="row home-detail-events">

		<?php
			$query_sports = $koneksi->prepare("SELECT events.nama_event, events.event_id, events.gambar, events.tanggal_mulai, events.tanggal_selesai, user.username, events.view, events.tempat FROM events JOIN kategori ON events.kategori_id = kategori.kategori_id JOIN user ON events.user_id=user.user_id WHERE events.status=:status AND kategori.kategori=:kategori ORDER BY events.event_id DESC LIMIT 4");

			$array_execute_sports['status'] = "on";
			$array_execute_sports['kategori'] = "sports";
			$query_sports->execute($array_execute_sports);
			$result_sports = $query_sports->fetchAll(PDO::FETCH_ASSOC);

			foreach($result_sports as $row_sports) {
		?>
			<a href="<?php echo BASE_URL."/index.php?page=action-event&event_id=".$row_sports['event_id']; ?>">
				<div class="col-md-3">
					<div class="home-container-all" style="border: 1px solid black;">
						<table align="center" class="fontsTim">
		                    <tbody>
		                        <tr>
		                            <td colspan="3" align="center">
		                               <img class="img-home" src="img/event/<?php echo $row_sports['gambar'] ?>" style="width: 100%; height: 200px;">
		                                <h4>
		                                	<?php 

		                                		if (strlen($row_sports['nama_event']) > 37) {
		                                			echo substr($row_sports['nama_event'], 0, 37)."...";
		                                		} else {
		                                			echo $row_sports['nama_event'];
		                                		}
		                                		 
		                                	?>
		                                </h4>
		                                <div class="post-info">
											<span class="posted">
												<i class="far fa-clock"></i>
												<?php 
													if ($row_sports['tanggal_mulai'] == $row_sports	['tanggal_selesai']) {
														echo $row_sports['tanggal_mulai'] ."&nbsp; ";
													} else {
														echo $row_sports['tanggal_mulai'] ." s/d ". $row_sports['tanggal_selesai'] ."&nbsp; ";
													}
												?>
											</span>
											<br />
		                                	<span class="theauthor">
												<i class="fas fa-user"></i>
												<?php echo $row_sports['username']; ?>
											</span>
											&nbsp;&nbsp;
											<span class="views">
												<i class="fas fa-eye"></i>
												<?php echo $row_sports['view']; ?>
											</span>
											<br /><br />
											<span style="font-size: 16px; color: black;" class="location">
												<i class="fas fa-map-marker-alt"></i>
												<?php 

			                                		if (strlen($row_sports['tempat']) > 52) {
			                                			echo substr($row_sports['tempat'], 0, 52)."...";
			                                		} else {
			                                			echo $row_sports['tempat'];
			                                		}
			                                		 
			                                	?>
											</span>
		                                </div>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
					</div>
				</div>
			</a>
		<?php 
			}
		?>
		</div>
	</div>
</div>

<div class="container home-container s-box">
	<div class="home-detail-container">
		<div class="row">
			<div class="col-md-6">
				<p class="home-paragraf-detail">Other Events</p>
			</div>
			<div class="col-md-6">
				<div align="right">
					<form action="<?php echo BASE_URL."/index.php?page=other-event";?>" method=POST>
						<button class="btn btn-default">Lihat Selengkapnya</button>
					</form>
				</div>
			</div>
		</div>
		<div class="row home-detail-events">

		<?php
			$query_other_event = $koneksi->prepare("SELECT events.nama_event, events.event_id, events.gambar, events.tanggal_mulai, events.tanggal_selesai, user.username, events.view, events.tempat FROM events JOIN kategori ON events.kategori_id = kategori.kategori_id JOIN user ON events.user_id=user.user_id WHERE events.status=:status AND kategori.kategori=:kategori ORDER BY events.event_id DESC LIMIT 4");

			$array_execute_other_events['status'] = "on";
			$array_execute_other_events['kategori'] = "other_event";
			$query_other_event->execute($array_execute_other_events);
			$result_other_events = $query_other_event->fetchAll(PDO::FETCH_ASSOC);

			foreach($result_other_events as $row_other_event) {
		?>
			<a href="<?php echo BASE_URL."/index.php?page=action-event&event_id=".$row_other_event['event_id']; ?>">
				<div class="col-md-3">
					<div class="home-container-all" style="border: 1px solid black;">
						<table align="center" class="fontsTim">
		                    <tbody>
		                        <tr>
		                            <td colspan="3" align="center">
		                                <img class="img-home" src="img/event/<?php echo $row_other_event['gambar'] ?>" style="width: 100%; height: 200px;">
		                                <h4>
		                                	<?php 

		                                		if (strlen($row_other_event['nama_event']) > 37) {
		                                			echo substr($row_other_event['nama_event'], 0, 37)."...";
		                                		} else {
		                                			echo $row_other_event['nama_event'];
		                                		}
		                                		 
		                                	?>
		                                </h4>
		                                <div class="post-info">
											<span class="posted">
												<i class="far fa-clock"></i>
												<?php 
													if ($row_other_event['tanggal_mulai'] == $row_other_event	['tanggal_selesai']) {
														echo $row_other_event['tanggal_mulai'] ."&nbsp; ";
													} else {
														echo $row_other_event['tanggal_mulai'] ." s/d ". $row_other_event['tanggal_selesai'] ."&nbsp; ";
													}
												?>
											</span>
											<br />
		                                	<span class="theauthor">
												<i class="fas fa-user"></i>
												<?php echo $row_other_event['username']; ?>
											</span>
											&nbsp;&nbsp;
											<span class="views">
												<i class="fas fa-eye"></i>
												<?php echo $row_other_event['view']; ?>
											</span>
											<br /><br />
											<span style="font-size: 16px; color: black;" class="location">
												<i class="fas fa-map-marker-alt"></i>
												<?php 

			                                		if (strlen($row_other_event['tempat']) > 52) {
			                                			echo substr($row_other_event['tempat'], 0, 52)."...";
			                                		} else {
			                                			echo $row_other_event['tempat'];
			                                		}
			                                		 
			                                	?>
											</span>
		                                </div>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
					</div>
				</div>
			</a>
		<?php 
			}
		?>
		</div>
	</div>
</div>