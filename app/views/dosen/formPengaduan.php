<!-- Content -->
<div class="flex-1 pl-8 pb-8 pt-6 pr-8 shadow-sm main_content">
  <div class="containerBars_toggled">
    <i class="fa-solid fa-bars icon_bars toggle_bars toggle_bars_toggled"></i>
  </div>
  <h1 class="text-4xl font-bold mb-5 text-center">Ajukan Pengaduan</h1>
  <form action="<?= BASEURL; ?>/Dosen/ajukanPengaduan/" method="POST" enctype="multipart/form-data">
    <div class="flex-col bg-white shadow-lg subtitle_dashboard mx-80 text-center shadow-neutral-800">
      <?php
      if (isset($_SESSION['flash'])) {
        Flasher::flash();
      }
      ?>
      <div class=" flex-1 bg-white mt-3">
        <label for="nimPengaduan">NIM:</label>
        <br>
        <select name="nimPengaduan" id="nimPengaduan" class="border border-neutral-400 w-[250px] h-[50px] rounded-lg">
          <option value="" selected>Pilih Mahasiswa</option>
          <?php
          $mhs = [];
          $ct = 0;
          foreach ($data['mahasiswa'] as $dt) {
            $mhs[$ct] = $dt;
            echo '<option value="' . $dt['nim'] . '">' . $dt['nim'] . '</option>';
            // echo '<option value="'. $dt['nim'] .'">'. $dt['nim'] .' - '. $mhs[$ct]['nama'] .'</option>';
            $ct++;
          }
          ?>
        </select>
        <br>
        <br>
        <label for="namaMhsPengaduan">Nama Mahasiswa:</label>
        <br>
        <input class="pl-2 w-[250px] h-[40px] border border-neutral-400 rounded-lg mt-1" type="text" name="namaMhsPengaduan" id="namaMhsPengaduan" disabled>
        <br>
        <br>
        <label for="noHpMhsPengaduan">Nomor Hp Mahasiswa:</label>
        <br>
        <input class="pl-2 w-[250px] h-[40px] border border-neutral-400 rounded-lg mt-1" type="text" name="noHpMhsPengaduan" id="noHpMhsPengaduan" disabled>
        <br>
        <br>
        <label for="jenisPelanggaran">Jenis Pelanggaran:</label>
        <br>
        <select name="jenisPelanggaran" id="jenisPelanggaran" class="border border-neutral-400 w-[250px] h-[40px] rounded-lg">
          <option value="" selected>Pilih Pelanggaran</option>
          <?php
          foreach ($data['pelanggaran'] as $dt) {
            echo '<option value="' . $dt["pelanggaran_id"] . '">' . $dt["pelanggaran"] . '</option>';
          }
          ?>
        </select>
        <br><br>
        <label for="tingkat">Tingkat:</label>
        <br>
        <input class="pl-2 w-[250px] h-[40px] border border-neutral-400 rounded-lg mt-1" type="text" name="tingkat" id="tingkat" disabled>
        <br><br>
        <label for="prodi">Prodi:</label>
        <br>
        <input class="pl-2 w-[250px] h-[40px] border border-neutral-400 rounded-lg mt-1" type="text" name="noHpMhsPengaduan" id="prodi" disabled>
        <br>
        <br>
        <label for="fotoPengaduan">Upload Foto:</label>
        <br>
        <input class="pl-2 w-[250px] h-[40px] mt-1" type="file" name="fotoPengaduan" id="fotoPengaduan">
        <br>
        <br>
        <label for="tglPengaduan">Tanggal Pengaduan:</label>
        <br>
        <input class="pl-2 mt-1 border border-neutral-400 w-[250px] h-[40px] rounded-lg " type="date" name="tglPengaduan" id="tglPengaduan" value="<?php echo date('Y-m-d'); ?>" required>
        <br>
        <button type="submit" class="w-[130px] h-[40px] items-center align-center bg-sky-600 rounded-3xl text-white text-2xl font-normal font-['Inter'] mt-3 mb-3 text-center hover:bg-sky-700">Simpan</button>
  </form>
</div>
</div>

<script>
  $('#nimPengaduan').select2();
  $(document).ready(function() {
    $('#nimPengaduan').on("change", function(e) {
      let nim = $('#nimPengaduan').val();

      $.ajax({
        url: '<?= BASEURL; ?>/Dosen/getMahasiswaByNim/' + nim,
        type: 'POST',
        data: nim,
        processData: false,
        contentType: false, //harusnya contentType: "application/json",
        dataType: "json",
        success: function(response) {
          console.log(response.nama);

          $('#namaMhsPengaduan').val(response.nama);
          $('#noHpMhsPengaduan').val(response.no_phone);
          $('#prodi').val(response.prodi_nama);
        }
      })
    })

    $('#jenisPelanggaran').on("click", function(e) {
      let id_pel = $('#jenisPelanggaran').val();

      $.ajax({
        url: '<?= BASEURL; ?>/Dosen/getPelanggaranById/' + id_pel,
        type: 'POST',
        data: id_pel,
        processData: false,
        contentType: false, //harusnya contentType: "application/json",
        dataType: "json",
        success: function(response) {
          console.log(response.tingkat);

          $('#tingkat').val(response.tingkat);
        }
      })
    })
  })
</script>