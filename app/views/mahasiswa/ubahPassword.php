    <!-- Content -->
    <div class="pl-8 pb-8 pt-6 pr-8 main_content">
      <div class="containerBars_toggled">
        <i class="fa-solid fa-bars icon_bars toggle_bars toggle_bars_toggled"></i>
      </div>
      <h1 class="text-2xl font-bold mb-2">Ubah Password</h1>
      <div class=" bg-white h-10 items-center subtitle_dashboard">
        <div class="ml-4 mt-1">Masukkan Password Baru</div>
      </div>
      <?php 
      if(isset($_SESSION['flash'])){
        Flasher::flash();
      }
      ?>
      <div class=" bg-white p-4 rounded-b-lg border-t-2 border-neutral-300 text-center">
      <form action="<?= BASEURL; ?>/Mahasiswa/ubahPw" method="post">
        <div class=" bg-white p-4 rounded-b-lg border-t-2 border-neutral-300 text-center">
            <label for="newPass">Password Baru:</label>
            <br>
            <input class="w-[250px] h-[40px] border border-neutral-400 rounded-lg mt-3 pl-2" type="hidden" name="username" id="username" value="<?= $_SESSION['username']; ?>">
            <input class="w-[250px] h-[40px] border border-neutral-400 rounded-lg mt-3 pl-2" type="password" name="newPass" id="newPass">
            <br>
            <br>
            <label for="newPass">Konfirmasi Password Baru:</label>
            <br>
            <input class="w-[250px] h-[40px] border border-neutral-400 rounded-lg mt-3 pl-2" type="password" name="confPass" id="confPass">
            <br>
            <button type="submit" class="w-[170px] h-[50px] items-center bg-sky-600 rounded-3xl text-white text-2xl font-normal font-['Inter'] mt-5  hover:bg-sky-700">Simpan</button>
        </div>
      </form>
      </div>
    </div>
    <script>
        $('#ubahPassword_mahasiswa').addClass('bg-blue-400');
    </script>