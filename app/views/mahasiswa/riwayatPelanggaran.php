    <!-- Content -->
    <div class="flex-1 pl-8 pb-8 pt-6 pr-8 shadow-sm main_content">
      <div class="containerBars_toggled">
        <i class="fa-solid fa-bars icon_bars toggle_bars toggle_bars_toggled"></i>
      </div>
      <h1 class="text-2xl font-bold mb-2">Riwayat Pelanggaran</h1>
      <div class="flex bg-white h-10 items-center shadow-sm subtitle_dashboard">
        <div class="flex-1 ml-4"><?php ?></div>
      </div>
      <hr class="hr_db">
      <div class="flex bg-white flex-col xl:flex-row">
        <div class="flex-1 bg-white p-4"> <!-- Tambahkan "flex" class di sini -->
        <div class="grid grid-cols-1 gap-4 mt-5">
        <div class="container mx-auto mt-8 containerTableDosen overflow-x-auto">
          <table id="tableMahasiswa" class="min-w-full border ">
            <!-- Tambahkan header tabel di sini -->
            <thead>
              <tr class="border-b">
                <th class="py-2 px-4 border-r">Tanggal</th>
                <th class="py-2 px-4 border-r">Pelanggaran</th>
                <th class="py-2 px-4 border-r">Tingkat</th>
                <th class="py-2 px-4 border-r">Kompen</th>
                <!-- Tambahkan header lainnya sesuai kebutuhan -->
              </tr>
            </thead>
              <tbody>
                <!-- Tambahkan baris-baris data di sini -->
                <?php
                foreach ($data['kompen'] as $dt) 
                {  
                ?>
                <tr class="border-b">
                  <td class="py-2 px-4 border-r"><?= $dt['tanggal_pengaduan']; ?></td>
                  <td class="py-2 px-4 border-r"><?= $dt['pelanggaran']; ?></td>
                  <td class="py-2 px-4 border-r text-center">
                    <?php
                      if ($dt['tingkat'] == '1') {
                        echo '<div class="w-[130px] h-[30px] rounded-md bg-red-700 px-1 text-lg font-medium text-white">Sangat Berat</div>';
                      } elseif ($dt['tingkat'] == '2') {
                        echo '<div class="w-[130px] h-[30px] rounded-md bg-orange-600 px-1 text-lg font-medium text-white">Berat</div>';
                      }elseif ($dt['tingkat'] == '3'){
                        echo '<div class="w-[130px] h-[30px] rounded-md bg-yellow-500 px-1 text-lg font-medium text-white">Cukup Berat</div>';
                      }elseif ($dt['tingkat'] == '4'){
                        echo '<div class="w-[130px] h-[30px] rounded-md bg-yellow-200 px-1 text-lg font-medium text-yellow-600">Sedang</div>';
                      }elseif ($dt['tingkat'] == '5'){
                        echo '<div class="w-[130px] h-[30px] rounded-md bg-green-200 px-1 text-lg font-medium text-green-700">Ringan</div>';
                      }
                      ?>
                  </td>
                  <td class="py-2 px-4 border-r">
                  <?php
                    if ($dt['status_kompen'] == 'baru') {
                      echo '<a href="#"><button id="baru" class="bg-blue-500 hover:bg-blue-700 py-2 px-7 rounded text-white text-center" onclick="showModalProses('.$dt['riwayat_id'].')">Baru</button></a>';
                    } elseif ($dt['status_kompen'] == 'sedang dikerjakan') {
                      echo '<a href="'. BASEURL .'/mahasiswa/uploadBuktiKompen/'. $dt['riwayat_id'] .'"><button id="upload" class="bg-indigo-400 hover:bg-indigo-500 py-2 px-5 rounded text-white text-center">Upload</button></a>';
                    } elseif ($dt['status_kompen'] == 'proses') {
                      echo '<a href="#"><button id="proses" class="bg-orange-400 py-2 px-5 rounded text-white text-center">Proses</button></a>';
                    } elseif ($dt['status_kompen'] == 'ditolak') {
                      echo '<a href="#"><button id="diTolak" class="bg-red-500 hover:bg-red-700 py-2 px-4 rounded text-white text-center" href="#" onclick="showModalDitolak('.$dt['riwayat_id'].')">Ditolak</button></a>';
                    } else{
                      echo '<a href="#"><button class="bg-green-500 py-2 px-4 rounded text-white text-center">Selesai</button></a>';
                    }
                  ?>                            
                  </td>
                </tr>
                <?php
                }
                ?>
              </tbody>
          </table>
        </div>
        <!-- Tambahkan elemen sesuai kebutuhan Anda -->
      </div>
      </div>
    </div>
    <div id="modalProses" class="fixed inset-0 hidden overflow-y-auto overflow-x-hidden z-50">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black opacity-50 "></div>
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="bg-white w-full max-w-3xl p-8 rounded-lg shadow-md relative">
        <!-- Tombol untuk menutup modal -->
        <button id="tutupModal" class="absolute top-4 right-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
          <i class="fa-solid fa-times"></i>
        </button>
        <h3 class="text-2xl mb-7 font-bold">Sanksi</h3>
        <div class="flex border border-grey-400">
          <p id="catatan"></p>
        </div>
        <div class="text-right">
        <form action="<?= BASEURL;?>/Mahasiswa/updateKompen/" method="post">
          <input type="hidden" name="id" id="iniIdUpdate">
          <input type="hidden" name="aksi" value="kerjakan">
          <button type="submit" class="bg-orange-400 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded" id="kerjakan" onclick="showElement()">
            kerjakan
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>
    <div id="modalTolak" class="fixed inset-0 hidden overflow-y-auto overflow-x-hidden z-50">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black opacity-50 "></div>
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="bg-white w-full max-w-3xl p-8 rounded-lg shadow-md relative">
        <!-- Tombol untuk menutup modal -->
        <button id="tutupModal1" class="absolute top-4 right-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
          <i class="fa-solid fa-times"></i>
        </button>
        <h3 class="text-2xl mb-7 font-bold">Tolak</h3>
        <div class="flex border border-grey-400">
          <p id="catatan2"></p>
        </div>
        <div class="text-right">
        <a class="hrefUpUlang" href="<?= BASEURL;?>/mahasiswa/uploadBuktiKompen/<?= $dt['riwayat_id'];?>"><button id="tutupModalKompen2" class="bg-orange-400 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
          Upload Ulang
        </button></a>
        
        </div>
      </div>
    </div>
  </div>
<script>
  $('#riwayatPelanggaran_mahasiswa').addClass('bg-blue-400');
</script>
    <script>
        // function hideElement() {
        //     document.getElementById('baru').classList.add('hidden');
        // }
        // function showElement() {
        //     document.getElementById('upload').classList.remove('hidden');
        // }

const modalKompen = document.getElementById('modalProses');
        const showModalProses = (id) => {
          $('.sidebar').addClass('sidebar-backdrop');
          $.ajax({
            url: '<?= BASEURL; ?>/Mahasiswa/getKompenById/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
              console.log(response.sanksi_pelanggaran);
              $('#iniIdUpdate').val(response.riwayat_id);
              $('#catatan').html(response.sanksi_pelanggaran);
            },
            error: function(error) {
              console.log(error);
              alert("Error: " + xhr.status + "\n" + xhr.responseText);
            }
          });
          modalKompen.classList.remove('hidden');
        }
        const tutupModalKompen = document.getElementById('tutupModal');

        tutupModalKompen.addEventListener('click', function() {
          $('.sidebar').removeClass('sidebar-backdrop');
          modalKompen.classList.add('hidden');
        });

const modalKompen1 = document.getElementById('modalTolak');
        const showModalDitolak = (id) => {
          $('.sidebar').addClass('sidebar-backdrop');
          $.ajax({
            url: '<?= BASEURL; ?>/Mahasiswa/getKompenById/' + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
              console.log(response.catatan_kompen);
              $('#catatan2').html(response.catatan_kompen);
              $('.hrefUpUlang').attr('href', '<?= BASEURL;?>/mahasiswa/uploadBuktiKompen/' + response.riwayat_id);
            },
            error: function(error) {
              console.log(error);
              alert("Error: " + xhr.status + "\n" + xhr.responseText);
            }
          });
          modalKompen1.classList.remove('hidden');
        }
        const tutupModalKompen1 = document.getElementById('tutupModal1');

        tutupModalKompen1.addEventListener('click', function() {
          $('.sidebar').removeClass('sidebar-backdrop');
          modalKompen1.classList.add('hidden');
        });

      $(document).ready(function() {
$('#tableMahasiswa').DataTable({
  rowReorder: {
    selector: 'td:nth-child(2)'
  },
  lengthChange: false,
  responsive: {
    breakpoints: [{
        name: 'bigdesktop',
        width: Infinity
      },
      {
        name: 'meddesktop',
        width: 1480
      },
      {
        name: 'smalldesktop',
        width: 1280
      },
      {
        name: 'medium',
        width: 1188
      },
      {
        name: 'tabletl',
        width: 1024
      },
      {
        name: 'btwtabllandp',
        width: 848
      },
      {
        name: 'tabletp',
        width: 768
      },
      {
        name: 'mobilel',
        width: 480
      },
      {
        name: 'mobilep',
        width: 320
      }
    ]
  }
});
$('#tableDosen_filter').append('<div id="buttonTambahDosen"><a onclick="showModal();"data-modal-toggle="static-modal" href="#" class="bg-blue-500 hover:bg-blue-700 sm:right-[-100px] text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-plus"></i> Tombol Link</a></div>');
});
    </script>