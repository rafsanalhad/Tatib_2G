<div class="flex-1 pl-8 pb-8 pt-6 pr-8 shadow-sm main_content">
  <div id="data_mahasiswa">
    <div class="containerBars_toggled">
      <i class="fa-solid fa-bars icon_bars toggle_bars toggle_bars_toggled"></i>
    </div>
    <h1 class="text-2xl font-bold mb-2">Data Mahasiswa</h1>

    <div class="flex bg-white h-10 items-center shadow-sm subtitle_dashboard">
      <div class="flex-1 ml-4">Kelola Data Mahasiswa</div>
    </div>
    <hr class="hr_db">
    <div class="flex bg-white">
      <div class="flex-1 bg-white p-4"> <!-- Tambahkan "flex" class di sini -->
        <!-- <div class="flex-1 notif_db h-10 flex items-center pl-2">Ini adalah data system</div> -->
        <div class="grid grid-cols-1 gap-4 mt-5">
          <div class="container mx-auto mt-8 containerTableDosen overflow-x-auto">
            <table id="tableMahasiswa" class="min-w-full border ">
              <!-- Tambahkan header tabel di sini -->
              <thead>
                <tr class="border-b">
                  <th class="py-2 px-4 border-r">Nama Mahasiswa</th>
                  <th class="py-2 px-4 border-r">NIM</th>
                  <th class="py-2 px-4 border-r">Prodi</th>
                  <th class="py-2 px-4 border-r">TTL</th>
                  <th class="py-2 px-4 border-r">Jen. Kelamin</th>
                  <th class="py-2 px-4 border-r">No. Telp</th>
                  <th class="py-2 px-4 border-r">Alamat</th>
                  <th class="py-2 px-4 border-r">Aksi</th>
                  <!-- Tambahkan header lainnya sesuai kebutuhan -->
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data['mahasiswa'] as $row) { ?>

                  <tr class="border-b">
                    <!-- <div class="flex items-center">
                    
                  </div> -->
                    <td class="py-2 px-4 border-r">
                      <?php
                      echo '<img src="' . BASEURL . '/img/profil/' . $row['mahasiswa_img'] . '" alt="" class="foto_profil_dosen_table inline ">';
                      ?>
                      <p class="nama_dosen_table inline"><?= $row['nama']; ?></p>
                    </td>
                    <td class="py-2 px-4 border-r"><?= $row['nim']; ?></td>
                    <td class="py-2 px-4 border-r"><?= $row['prodi_nama']; ?></td>
                    <td class="py-2 px-4 border-r"><?= $row['TTL']; ?></td>
                    <td class="py-2 px-4 border-r">
                      <?php
                      if ($row['jenis_kelamin'] == 'L') {
                        echo '<div class="w-[120px] h-[30px] rounded-full px-1 text-lg font-medium text-blue-800 text-center" style="background-color: #92a9f9;">Laki-Laki</div>';
                      } else {
                        echo '<div class="w-[120px] h-[30px] rounded-full px-1 text-lg font-medium text-rose-600 text-center" style="background-color: #FFB5B5;">Perempuan</div>';
                      }
                      ?>
                    </td>
                    <td class="py-2 px-4 border-r"><?= $row['phone_ortu']; ?></td>
                    <td class="py-2 px-4 border-r"><?= $row['alamat']; ?></td>
                    <td class="py-2 px-4 border-r flex">
                      <a href="#" onclick="editMahasiswa(<?= $row['nim'] ?>);" class="bg-yellow-500 hover:bg-yellow-700 sm:right-[-100px] text-white font-bold py-2 px-4 rounded mr-1"><i class="fa-solid fa-pen-to-square"></i></a>
                      <a href="#" onclick="hapusMahasiswa(<?= $row['nim'] ?>, <?= $row['user_id'] ?>);" class="bg-red-500 hover:bg-red-700 sm:right-[-100px] text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-trash"></i></a>
                    </td>
                    <!-- Tambahkan data lainnya sesuai kebutuhan -->
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

      <!-- Tambahkan elemen sesuai kebutuhan Anda -->
    </div>
  </div>
</div>
<div id="static-modal" class="fixed inset-0 hidden overflow-y-auto overflow-x-hidden z-50">
  <!-- Backdrop -->
  <div class="fixed inset-0 bg-black opacity-50 ">

  </div>

  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="bg-white w-full max-w-3xl p-8 rounded-lg shadow-md relative">
      <!-- Tombol untuk menutup modal -->
      <button id="tutupModal" class="absolute top-4 right-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        <i class="fa-solid fa-times"></i>
      </button>

      <!-- Konten Modal -->
      <!-- <h1 class="text-2xl font-bold mb-4">Tambah Produk</h1> -->
      <h3 class="text-2xl mb-7 font-bold headerModal">Tambah Data Mahasiswa</h3>
      <form class="mb-3" id="formTambahMahasiswa" action="<?= BASEURL; ?>/Admin/tambahMahasiswa" method="POST">
        <div class="flex flex-col md:flex-row">
          <div class="containerGroupImg md:w-2/6" id="dropAreaImgMahasiswa" class="drop-area">
            <img src="<?= BASEURL; ?>/img/icon/Group.png" alt="" style="padding: 50px;" id="noImgMahasiswa">
            <input type="file" id="imgInputMahasiswa" name="imgMahasiswa" accept="image/*" style="display: none;">
            <div id="preview"></div>
          </div>
          <div class="error_msg_gambar hidden block" style="position: absolute; top: 460px; left: 30px;">
            <p class="mt-2 text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> Gambar tidak boleh kosong!</p>
          </div>
          <div class="containerFormModal md:w-4/6 ml-3">
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="nama" id="namaLabel" class="block text-sm font-medium text-gray-900">Nama</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 titikDuaNama">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="nama" id="nama" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_nama hidden">
                      <p class="text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> Nama tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="nim" id="nimLabel" class="block text-sm font-medium text-gray-900">NIM</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 titikDuaNim">:</div>
                  <div class="flex-grow flex_error_msg">

                    <input type="text" name="nim" id="nim" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_nim hidden">
                      <p class="text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> NIM tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="ttl" id="ttlLabel" class="block text-sm font-medium text-gray-900">TTL</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 titikDuaTtl">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="ttl" id="ttl" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_ttl hidden">
                      <p class="text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> TTL tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="jenkel" id="jenkelLabel" class="block text-sm font-medium text-gray-900">Jenis Kelamin
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <select name="jenkel" id="jenisKelamin" class="mt-1 p-2 w-full border rounded-md">
                      <option name="jenkel" value="null">Pilih Jenis Kelamin</option>
                      <option name="jenkel" value="L">Laki-laki</option>
                      <option name="jenkel" value="P">Perempuan</option>
                    </select>
                    <div class="error_msg_jenkel hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block email_err_msg"><span class="font-medium">Maaf!</span> Jenis kelamin tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="email" id="emailLabel" class="block text-sm font-medium text-gray-900">Email</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_email hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block email_err_msg"><span class="font-medium">Maaf!</span> Email tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="prodi" id="prodiLabel" class="block text-sm font-medium text-gray-900">Prodi</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <select name="prodi_id" id="prodi" class="mt-1 p-2 w-full border rounded-md">
                      <?php
                      foreach ($data['prodi'] as $dt) {
                        echo '<option value="' . $dt["prodi_id"] . '">' . $dt["prodi_nama"] . '</option>';
                      }
                      ?>
                      <option value="" selected>Pilih Prodi</option>
                    </select>
                    <div class="error_msg_prodi hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block email_err_msg"><span class="font-medium">Maaf!</span> Prodi tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="notelp" id="notelpLabel" class="block text-sm font-medium text-gray-900">No Telp</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="notelp" id="notelp" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_notelp hidden">
                      <p class="text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> No Telepon tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="name" id="notelp_ortuLabel" class="block text-sm font-medium text-gray-900">No Telp Ortu</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 titikDua">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="notelp_ortu" id="notelp_ortu" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_ttl hidden">
                      <p class="text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf,</span> No Telepon tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mb-2">
              <div class="flex items-center">
                <div class="w-2/4">
                  <label for="name" id="alamatLabel" class="block text-sm font-medium text-gray-900">Alamat</label>
                </div>
                <div class="w-3/4 inline-flex items-center">
                  <div class="mr-2 flex-shrink-0 flex titikDuaAlamat">:</div>
                  <div class="flex-grow flex_error_msg">
                    <input type="text" name="alamat" id="alamat" class="mt-1 p-2 w-full border rounded-md">
                    <div class="error_msg_alamat hidden">
                      <p class="mt-2 text-sm text-red-600 dark:text-red-500 block"><span class="font-medium">Maaf!</span> Alamat tidak boleh kosong!</p>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="flex w-full">
              <div class="ml-auto">
                <button id="tutupModal2" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                  Tutup
                </button>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                  Simpan
                </button>
              </div>
      </form>
    </div>
  </div>
</div>
</div>
<script>
  $('#data_mahasiswa_nav').addClass('bg-blue-400');
  let checkTypeSubmit = null;
  const hapusMahasiswa = (nim, userid) => {
    Swal.fire({
      title: 'Apakah anda yakin ingin menghapus data?',
      showDenyButton: true,
      showCancelButton: false,
      confirmButtonColor: '#28a745',
      confirmButtonText: `Hapus`,
      denyButtonText: `Batal`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          url: '<?= BASEURL; ?>/Admin/hapusMahasiswa/' + nim + '/' + userid,
          type: 'GET',
          success: function(response) {
            console.log(response);
            Swal.fire({
              title: 'Berhasil!',
              text: 'Data mahasiswa berhasil dihapus!',
              icon: 'success',
              confirmButtonColor: '#28a745',
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            })
          }
        })
      }
    })
  }
  $(document).ready(function() {
    $('#formTambahMahasiswa').on("submit", function(e) {
      e.preventDefault();
      var semuaKondisiTerpenuhi = true;

      function handleCondition(inputSelector, errorSelector, titikDuaSelector) {
        var inputValue = $(inputSelector).val().trim();

        if (inputValue === "") {
          $(errorSelector).removeClass('hidden');
          $(titikDuaSelector).addClass('mb-3');
          semuaKondisiTerpenuhi = false;
          console.log(semuaKondisiTerpenuhi);
        } else {
          if (inputSelector === '#email' && !isValidEmail(inputValue)) {
            $(errorSelector).removeClass('hidden');
            $(titikDuaSelector).addClass('mb-3');
            semuaKondisiTerpenuhi = false;
          } else {
            $('.email_err_msg').html('<span class="font-medium">Maaf!</span> Email tidak valid!');
            $(errorSelector).addClass('hidden');
            $(titikDuaSelector).removeClass('mb-3');
          }
        }
      }

      function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
      }

      handleCondition('#nama', '.error_msg_nama', '.titikDuaNama');
      handleCondition('#nim', '.error_msg_nim', '.titikDuaNim');
      handleCondition('#ttl', '.error_msg_ttl', '.titikDuaTtl');
      handleCondition('#email', '.error_msg_email', '.titikDuaEmail');
      handleCondition('#notelp', '.error_msg_notelp', '.titikDuaNoTelp');
      handleCondition('#notelp_ortu', '.error_msg_notelportu', '.titikDuaNoTelpOrtu');
      handleCondition('#alamat', '.error_msg_alamat', '.titikDuaAlamat');

      var imgInputValue = $("#imgInputMahasiswa").val();
      var previewContent = $("#preview").html();
      let jenkel = $('#jenisPelanggaran').val();
      let prodi = $('#prodi').val();

      // Melakukan validasi
      if (imgInputValue === "" && previewContent === "") {
        // Menampilkan pesan error jika input gambar dan preview kosong
        $('.error_msg_gambar').removeClass('hidden');
        $('.error_msg_gambar').addClass('block');
        semuaKondisiTerpenuhi = false;
      } else {
        $('.error_msg_gambar').addClass('hidden');
        $('.error_msg_gambar').removeClass('block');
      }
      if (jenkel === "null") {
        $('.error_msg_jenkel').removeClass('hidden');
        $('.error_msg_jenkel').addClass('block');
        semuaKondisiTerpenuhi = false;
      } else {
        $('.error_msg_jenkel').addClass('hidden');
        $('.error_msg_jenkel').removeClass('block');
      }

      if (prodi === "") {
        $('.error_msg_prodi').removeClass('hidden');
        $('.error_msg_prodi').addClass('block');
        semuaKondisiTerpenuhi = false;
      } else {
        $('.error_msg_prodi').addClass('hidden');
        $('.error_msg_prodi').removeClass('block');
      }


      if (semuaKondisiTerpenuhi) {
        if ($('.headerModal').html() == 'Tambah Data Mahasiswa') {
          let formData = new FormData($('#formTambahMahasiswa')[0]);
          $.ajax({
            url: '<?= BASEURL; ?>/Admin/tambahMahasiswa',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              console.log('anjay tambah');
              console.log(response);
              if (response == 'berhasil') {

                Swal.fire({
                  title: "Berhasil!",
                  text: "Data Mahasiswa berhasil ditambahkan!",
                  icon: "success"
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.reload();
                  }
                });
              } else {
                Swal.fire({
                  title: "Gagal!",
                  text: response,
                  icon: "error"
                });
              }

            },
            error: function(error) {
              alert("Error: " + xhr.status + "\n" + xhr.responseText);
            }
          });

        } else if ($('.headerModal').html() == 'Edit Data Mahasiswa') {
          let formData = new FormData($('#formTambahMahasiswa')[0]);
          $.ajax({
            url: '<?= BASEURL; ?>/Admin/editMahasiswa',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              console.log('anjay ubah');
              console.log(response);
              Swal.fire({
                title: "Berhasil!",
                text: "Data mahasiswa berhasil diubah!",
                icon: "success"
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.reload();
                }
              });
            },
            error: function(error) {
              alert("Error: " + xhr.status + "\n" + xhr.responseText);
            }
          });
        }
      } else {
        Swal.fire({
          title: "Gagal!",
          text: "Data mahasiswa gagal ditambahkan!",
          icon: "error"
        });
      }

    })
  })

  const editMahasiswa = (nim) => {
    $('.headerModal').html('Edit Data Mahasiswa');
    const modal = document.getElementById('static-modal');
    $('.sidebar').addClass('sidebar-backdrop');
    modal.classList.remove('hidden');
    $.ajax({
      url: '<?= BASEURL; ?>/Admin/getMahasiswaByNim/' + nim,
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        $('#nama').val(response.nama);
        $('#nim').val(response.nim);
        $('#ttl').val(response.TTL);
        $('#email').val(response.email);
        $('#notelp').val(response.no_phone);
        $('#notelp_ortu').val(response.phone_ortu);
        $('#alamat').val(response.alamat);
        $("#jenisKelamin").val(response.jenis_kelamin);
        $("#prodi").val(response.prodi_id);
        $('#imgInputMahasiswa').val('');
        $('#preview').html('<img src="<?= BASEURL; ?>/img/profil/' + response.mahasiswa_img + '" alt="">');
        $('#noImgMahasiswa').addClass('hidden');
      },
      error: function(error) {
        alert("Error: " + xhr.status + "\n" + xhr.responseText);
      }
    });
  }
  const dropArea = $('#dropAreaImgMahasiswa');
  const fileInput = $('#imgInputMahasiswa');
  const preview = $('#preview');
  const noImgMahasiswa = $('#noImgMahasiswa');

  dropArea.on('dragover', function(event) {
    event.preventDefault();
    dropArea.addClass('hover:bg-sky-700');
  });

  dropArea.on('dragleave', function() {
    dropArea.removeClass('hover:bg-sky-700');
  });

  dropArea.on('drop', function(event) {
    event.preventDefault();
    dropArea.removeClass('hover:bg-sky-700');

    const files = event.originalEvent.dataTransfer.files;

    if (files.length > 0) {
      handleFiles(files);
    }
  });

  dropArea.on('click', function() {
    // Pengecekan agar tidak terjadi pemanggilan berulang
    if (!fileInput.data('clickTriggered')) {
      fileInput.data('clickTriggered', true);
      fileInput.click();
    } else {
      fileInput.data('clickTriggered', false);
    }
  });

  fileInput.on('change', function() {
    const files = fileInput[0].files;
    handleFiles(files);
    fileInput.data('clickTriggered', false); // Reset nilai setelah perubahan
  });

  function handleFiles(files) {
    if (files.length > 0) {
      const file = files[0];
      noImgMahasiswa.addClass('hidden');

      const reader = new FileReader();

      reader.onload = function(e) {
        const img = $('<img>').attr('src', e.target.result);
        preview.empty().append(img);
      };

      reader.readAsDataURL(file);
    }
  }

  const resetFormModal = () => {
    $('#nama').val('');
    $('#nim').val('');
    $('#ttl').val('');
    $('#jabatan').val('');
    $('#email').val('');
    $('#notelp').val('');
    $('#notelp_ortu').val('');
    $('#alamat').val('');
    $('#imgInputDosen').val('');
    $('#preview').empty();
    $('#noImgDosen').removeClass('hidden');
  }

  const showModal = () => {
    resetFormModal();
    const modal = document.getElementById('static-modal');
    $('.sidebar').addClass('sidebar-backdrop');
    modal.classList.remove('hidden');
  }
  // const modalKompen = document.getElementById('static-modal-kompen');
  //   const showModalKompen = () => {
  //     $('.sidebar').addClass('sidebar-backdrop');
  //     modalKompen.classList.remove('hidden');
  //   }
  // const tutupModalKompen = document.getElementById('tutupModalKompen');
  // const tutupModalKompen2 = document.getElementById('tutupModalKompen2');


  // tutupModalKompen.addEventListener('click', function() {
  //   $('.sidebar').removeClass('sidebar-backdrop');
  //   modalKompen.classList.add('hidden');
  // });
  // tutupModalKompen2.addEventListener('click', function() {
  //   $('.sidebar').removeClass('sidebar-backdrop');
  //   modalKompen.classList.add('hidden');
  // });

  const buttonTambahDosen = document.getElementById('buttonTambahDosen');
  const staticModal = document.getElementById('static-modal');
  const tutupModal = document.getElementById('tutupModal');
  const tutupModa2 = document.getElementById('tutupModal2');



  tutupModal.addEventListener('click', function() {
    $('.sidebar').removeClass('sidebar-backdrop');
    staticModal.classList.add('hidden');
  });
  tutupModa2.addEventListener('click', function() {
    $('.sidebar').removeClass('sidebar-backdrop');
    staticModal.classList.add('hidden');
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
    $('#tableMahasiswa_filter').append('<div id="buttonTambahDosen"><a href="#" onclick="showModal();" class="bg-green-500 hover:bg-green-700 sm:right-[-100px] text-white font-bold py-2 px-4 rounded"><i class="fa-solid fa-plus"></i> Tambah Mahasiswa</a></div>');
  });
</script>