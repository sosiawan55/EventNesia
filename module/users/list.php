<?php
    
    $notif = isset($_GET['notif']) ? $_GET['notif'] : false;
    $pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;

    if ($notif == "berhasil") {
        echo "  <script>

                    swal(
                      'Success',
                      'Data Users berhasil diubah',
                      'success'
                    )

                </script>";
    }
    

    $dataPerhalaman = 3;
    $mulai = ($pagination-1) * $dataPerhalaman;

    $no=1 + $mulai;
    
    $queryAdmin = $koneksi->prepare("SELECT * FROM user ORDER BY nama ASC LIMIT $mulai, $dataPerhalaman");
    $queryAdmin->execute();
    $result = $queryAdmin->fetchAll(PDO::FETCH_ASSOC);
      
    if($queryAdmin->rowCount() == 0) {
        echo "<h3>Saat ini belum ada data user yang dimasukan</h3>";
    } else {
        
        echo "  <div style='overflow-x:auto;'>
                    <table class='table-list'>";
          
        echo "          <tr class='th-title'>
                            <th class='kolom-nomor'>No</th>
                            <th class='kiri'>Nama</th>
                            <th class='kiri'>Username</th>
                            <th class='tengah'>Email</th>
                            <th class='kiri'>Level</th>
                            <th class='tengah'>Action</th>
                        </tr>";
  
        foreach($result as $rowUser) {
                
            echo "      <tr>
                            <td class='kolom-nomor'>$no</td>
                            <td class='kiri'>".$rowUser['nama']."</td>
                            <td class='kiri'>".$rowUser['username']."</td>
                            <td class='tengah'>".$rowUser['email']."</td>
                            <td class='kiri'>".$rowUser['level']."</td>
                            <td class='tengah'>
                                <a class='edit-action' href='".BASE_URL."/index.php?page=my-profile&module=users&action=form&user_id=".$rowUser['user_id']."'>Edit</a>
                            </td>
                        </tr>";
              
                $no++;
            }
        
        echo "      </table>
                </div>";

        $queryHitung = $koneksi->prepare("SELECT * FROM user");
        $queryHitung->execute();
        pagination($queryHitung, $dataPerhalaman, $pagination, "my-profile&module=users&action=list");
    }
?>