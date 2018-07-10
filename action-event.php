<?php
	
	$event_id = $_GET['event_id'];

	$query = $koneksi->prepare("SELECT events.event_id, events.user_id, events.gambar, events.nama_event, events.tanggal_mulai, events.tanggal_selesai, events.jam_mulai, events.jam_selesai, events.biaya, events.deskripsi, events.view, events.tempat, kategori.kategori, user.username FROM events JOIN kategori ON events.kategori_id = kategori.kategori_id JOIN user ON events.user_id=user.user_id WHERE events.status=:status AND events.event_id=:event_id");
	$array_execute['status'] = "on";
	$array_execute['event_id'] = $event_id;
	$query->execute($array_execute);
	$result = $query->fetchAll(PDO::FETCH_ASSOC);


	foreach($result as $rows) {
		$kategoriLower = strtolower($rows['kategori']);
		$kategori = $rows['kategori'];
		$user_id = $rows['user_id'];
		$nama_event = $rows['nama_event'];
		$gambar = $rows['gambar'];
		$tanggal_mulai = $rows['tanggal_mulai'];
		$tanggal_selesai = $rows['tanggal_selesai'];
		$jam_mulai = $rows['jam_mulai'];
		$jam_selesai = $rows['jam_selesai'];
		$tempat = $rows['tempat'];
		$biaya = $rows['biaya'];
		$deskripsi = $rows['deskripsi'];
		$views = $rows['view'];
	}

	if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $user_id	) {
		$queryUpdate = $koneksi->prepare("UPDATE events SET view=:views WHERE event_id=:event_id");
		$array_execute_update['views'] = $views + 1;
		$array_execute_update['event_id'] = $event_id;
		$queryUpdate->execute($array_execute_update);
	}

?>

<div class="container tinggi-padding">
	<div class="div-modif s-box">
		<table>
			<tr>
				<td class="font-info">
					<span><i class="fas fa-home"></i>&nbsp;</span>
				</td>
				<td class="font-info"><a href="<?php echo BASE_URL; ?>">Home</a>&nbsp;</td>
				<td class="font-info"><i class="fas fa-chevron-right"></i>&nbsp;</td>
				<td class="font-info">
					<a href='<?php echo BASE_URL."/index.php?page=$kategoriLower"; ?>'>
						<?php echo $kategori; ?>
					</a>
					&nbsp;
				</td>
				<td class="font-info"><i class="fas fa-chevron-right"></i>&nbsp;</td>
				<td class="font-info">
					<?php echo $nama_event; ?>
				</td>
			</tr>
		</table>
	</div>

	<div class="row">
		<div class="col-md-4">
			<div class="s-box" style="background: white;">
				<img class="action-event-img" src="/eventnesia/img/event/<?php echo $gambar; ?>" data-toggle="modal" data-target="#modalTarget">
				<div class="modal fade" id="modalTarget" role="dialog">
                    <div class="modal-dialog modal-md">
                    	
                        <div class="modal-content">
                            <div class="modal-body">
                            	<div align="right" style="padding-bottom: 10px;">
		                    		<button data-dismiss="modal" class="btn btn-default">X</button>
		                    	</div>
                                <img id="img-modal" src="/eventnesia/img/event/<?php echo $gambar; ?>" alt="Event Lari" class="foto img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
				<hr>
				<p class="text-p"><?php echo $nama_event; ?></p>
				<hr>
				<div align="center" style="padding-left: 25px; padding-right: 15px; padding-bottom: 10px;">
					<table width="100%">
						<tr class="icon-events">
							<td class="td-style-info" width="20%" rowspan="2" style="font-style: 20px;"><span><i class="fas fa-calendar-alt"></i></span></td>
							<td class="table-style-info">Tanggal Event</td>
						</tr>
						<tr>
							<td class="td-style-info">
								<?php 

									$tgl_mulai = date_create($tanggal_mulai);
									$tgl_selesai = date_create($tanggal_selesai);

									if ($tanggal_mulai == $tanggal_selesai) {
										echo date_format($tgl_mulai,"d M Y");
									} else {
										echo date_format($tgl_mulai,"d M Y") ." - ". date_format($tgl_selesai,"d M Y");
									}
								?>
							</td>
						</tr>
						<tr>
							<td class="td-style-info" rowspan="2"><span><i class="far fa-clock"></i></span></td>
							<td class="table-style-info">Jam Event</td>
						</tr>
						<tr>
							<td class="td-style-info">
								<?php 

									echo substr($jam_mulai, 0, 5)  . " - " . substr($jam_selesai, 0, 5); 

								?>
									
								</td>
						</tr>
						<tr>
							<td class="td-style-info" rowspan="2"><span><i class="fas fa-map-marker-alt"></i></span></td>
							<td class="table-style-info">Lokasi/Tempat</td>
						</tr>
						<tr>
							<td class="td-style-info"><?php echo $tempat; ?></td>
						</tr>
						<tr>
							<td class="td-style-info" rowspan="2"><span><i class="fas fa-hand-holding-usd"></i></span></td>
							<td class="table-style-info">Biaya</td>
						</tr>
						<tr>
							<td class="td-style-info">
								<?php 

									if ($biaya == 0) {
										echo "Gratis";
									} else {
										echo rupiah($biaya);
									}

								?>
							</td>
						</tr>
						<tr>
							<td class="td-style-info" rowspan="2"><span><i class="fas fa-eye"></i></span></td>
							<td class="table-style-info">Views</td>
						</tr>
						<tr>
							<td class="td-style-info"><?php echo $views; ?></td>
						</tr>
					</table>
				</div>
				
			</div>
		</div>
		<div class="col-md-8">
			<div class="s-box" style="background: white;">

				<div class="deskripsi-p">
					<p>Deskripsi Event</p>
				</div>
				<div class="deskripsi-field">
					<?php echo $deskripsi; ?>
				</div>

			</div>
		</div>
	</div>
	
</div>