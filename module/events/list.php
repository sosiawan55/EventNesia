<?php 

	$notif = isset($_GET['notif']) ? $_GET['notif'] : false;

	if ($notif == "berhasil") {
		
        echo "  <script>

                    swal(
                      'Success',
                      'Data Event berhasil diubah',
                      'success'
                    )

                </script>";

    } elseif ($notif == "hapus") {

    	echo "  <script>

                    swal(
                      'Success',
                      'Data Event berhasil dihapus',
                      'success'
                    )

                </script>";

    } elseif ($notif == "tambah") {

    	echo "  <script>

                    swal(
                      'Success',
                      'Data Event berhasil ditambah',
                      'success'
                    )

                </script>";

    }

	if ($level == "pengguna") {
?>

		<div id="frame-tambah">
			<div class="row">
				<div class="col-md-10 col-xs-8 moduleEvent1">
					<p>My Event</p>
				</div>
				<div class="col-md-2 col-xs-4 moduleEvent2" align="center">
					<a href="<?php echo BASE_URL."/index.php?page=my-profile&module=events&action=form"; ?>" class="tombol-event">+</a>
			  	</div>
			</div>
			<hr />
			<br />
		</div>

<?php

		$pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;

		$dataPerhalaman = 3;
	    $mulai = ($pagination-1) * $dataPerhalaman;
		
		$query1 = $koneksi->prepare("SELECT EVENTS . * , kategori.kategori, user.username FROM EVENTS JOIN kategori ON events.kategori_id = kategori.kategori_id JOIN user ON events.user_id=user.user_id WHERE events.user_id =:user_id ORDER BY event_id DESC LIMIT $mulai, $dataPerhalaman");
		$array_execute[":user_id"] = $user_id;
		$query1->execute($array_execute);
		$result = $query1->fetchAll(PDO::FETCH_ASSOC);

		if ($query1->rowCount() == 0) {
			echo "<h4>Saat ini belum ada events di dalam table events</h4>";
		} else {

			echo "	<div style='overflow-x:auto;'>
						<table class='table-list' align='center'>
							<tr class='th-title'>
								<th class='kolom-nomor'>No</th>
								<th class='kiri'>kategori</th>
								<th class='kiri' width='350px'>Nama Event</th>
								<th class='tengah'>Biaya</th>
								<th class='tengah'>Status</th>
								<th class='tengah'>Actions</th>
							</tr>";

			$no = 1+$mulai;

			foreach($result as $rows) {

				echo "		<tr>
								<td class='kolom-nomor'>$no</td>
								<td class='kiri'>".$rows['kategori']."</td>
								<td class='kiri'>".$rows['nama_event']."</td>
								<td class='tengah'>".rupiah($rows['biaya'])."</td>
								<td class='tengah'><b>". $rows['status'] ."</b></td>
								<td class='tengah'>
									<a class='edit-action' href='".BASE_URL."/index.php?page=my-profile&module=events&action=form&event_id=".$rows['event_id']."'>Edit</a>
									<a class='delete-action' href='".BASE_URL."/index.php?page=my-profile&module=events&action=action_hapus&event_id=".$rows['event_id']."' name='hapus'>Delete</a>
								</td>
							</tr>";
				$no++;
			}

			echo "		</table>
					</div>";

			$queryHitung = $koneksi->prepare("SELECT * FROM events WHERE user_id=:user_id");
			$array_executeHitung['user_id'] = $user_id;
	        $queryHitung->execute($array_executeHitung);
	        pagination($queryHitung, $dataPerhalaman, $pagination, "my-profile&module=events&action=list");

		}

	} else {

		$pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;

		$dataPerhalaman = 5;
	    $mulai = ($pagination-1) * $dataPerhalaman;

		$query2 = $koneksi->prepare("SELECT events.*, kategori.kategori, user.username  FROM events JOIN kategori ON events.kategori_id=kategori.kategori_id JOIN user ON events.user_id=user.user_id ORDER BY event_id DESC LIMIT $mulai, $dataPerhalaman");

		$query2->execute();
		$result = $query2->fetchAll(PDO::FETCH_ASSOC);

		if ($query2->rowCount() == 0) {
			echo "<h4>Saat ini belum ada events di dalam table events</h4>";
		} else {

			echo "<table class='table-list' align='center'>";

			echo "<tr class='th-title'>
					<th class='kolom-nomor'>No</th>
					<th class='kiri'>kategori</th>
					<th class='kiri'>Username</th>
					<th class='kiri' width='350px'>Nama Event</th>
					<th class='tengah'>Biaya</th>
					<th class='tengah'>Status</th>
					<th class='tengah'>Action</th>
				</tr>";

			$no = 1+$mulai;

			foreach($result as $rows) {

				echo "<tr>
						<td class='kolom-nomor'>$no</td>
						<td class='kiri'>".$rows['kategori']."</td>
						<td class='kiri'>". $rows['username'] ."</td>
						<td class='kiri' width='400px'>".$rows['nama_event']."</td>
						<td class='tengah'>".rupiah($rows['biaya'])."</td>
						<td class='tengah'><b>". $rows['status'] ."</b></td>
						<td class='tengah'>
							<a class='edit-action' href='".BASE_URL."/index.php?page=my-profile&module=events&action=form&event_id=".$rows['event_id']."'>Edit</a>
						</td>
					</tr>";
				$no++;
			}

			echo "</table>";

			$queryHitung = $koneksi->prepare("SELECT * FROM events");
	        $queryHitung->execute();
	        pagination($queryHitung, $dataPerhalaman, $pagination, "my-profile&module=events&action=list");

		}

	}
?>

	