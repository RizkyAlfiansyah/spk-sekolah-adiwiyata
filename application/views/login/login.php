<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link href="assets/images/logo.png" rel="shortcut icon">

  <title><?php echo $this->page->generateTitle(); ?></title>
</head>

<body class="bg-light">
  <div class="container">
    <div class="col-md-7 mx-auto bg-white shadow  p-3 py-4 my-3 rounded-3 border border-3 border-light">
      <div class="mx-3 h25">

        <img src="assets/images/umi.png" alt="logo" width="100" class="float-start mx-4">
        <img src="assets/images/logo.png" alt="logo" width="100" class="float-end mx-4">
        <!-- <img src="assets/images/logo.png" alt="logo" width="100" class="position-relative"> -->
        <h4 class="text-center mx-2 " style="font-family:'Poppins', sans-serif; "><strong>Sistem Pendukung Keputusan Penentuan Sekolah Adiwiyata Menggunakan Metode Simple Additive Weighting</strong> </h4>
      </div>
      <form class="col-md-7 mx-auto bg-light bg-gradient shadow  p-3 py-5 mt-5 mb-5 border border-3 border-light rounded-3" action="<?php echo base_url('Auth/cek_login'); ?>" method="post">
        <div class="text-center" style="color: red;margin-bottom: 15px;">
          <?php
          // Cek apakah terdapat session nama message
          if ($this->session->flashdata('msg')) { // Jika ada
            echo $this->session->flashdata('msg'); // Tampilkan pesannya
          }
          ?>
        </div>
        <h1 class="text-center font-bold mb-3" style="font-family:'Poppins', sans-serif;">LOGIN</h1>
        <div class="form-floating">
          <input type="username" name="username" id="username" class="border-dark shadow sm mb-3 form-control" placeholder="username">
          <label for="username">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" name="password" id="password" class="border-dark shadow sm mb-3 form-control" placeholder="passwrod">
          <label for="password">Password</label>
        </div>
        <div class="text-center" style="color: red;margin-bottom: 15px;">
          <?php
          // Cek apakah terdapat session nama message
          if ($this->session->flashdata('message')) { // Jika ada
            echo $this->session->flashdata('message'); // Tampilkan pesannya
          }
          ?>
        </div>
        <input type="submit" name="bLogin" value="Login" class="btn btn-primary shadow form-control rounded-pill p-2 font-costom mt-3">
      </form>
    </div>
  </div>

  </div>

  <style>
    .font-costom {
      font-size: 25px;
      font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
  </style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</body>

</html>