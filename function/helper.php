<?php

    define("BASE_URL", "http://localhost/eventnesia");

    function rupiah($nilai = 0){
    	$string = "Rp.".number_format($nilai);
    	return $string;
    }

    function pagination($query, $dataPerhalaman, $pagination, $url) {
    	$totalData = $query->rowCount();
		$totalHalaman = ceil($totalData/$dataPerhalaman);

		echo "<ul class='pagination'>";

		if ($pagination > 1) {
			$prev = $pagination - 1;
			echo "<li><a href='".BASE_URL."/index.php?page=$url&pagination=$prev'><< Prev</a></li>";
		}

		for ($i=1; $i<=$totalHalaman; $i++) { 
			if ($pagination == $i) {
				echo "<li><a class='active' href='".BASE_URL."/index.php?page=$url&pagination=$i'>$i</a></li>";
			} else {
				echo "<li><a href='".BASE_URL."/index.php?page=$url&pagination=$i'>$i</a></li>";
			}
		}

		if ($pagination < $totalHalaman) {
			$next = $pagination + 1;
			echo "<li><a href='".BASE_URL."/index.php?page=$url&pagination=$next'>Next >></a></li>";
		}

		echo "</ul>";
    }