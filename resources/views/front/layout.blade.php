<!DOCTYPE html>
<html>
<head>

<title>Internsip</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<link href="{{ asset('css/home.css') }}" rel="stylesheet">

@stack('css')

</head>
<body>

<!-- Berfungsi untuk membuat navbar pada halaman view home-->
<nav class="navbar navbar-expand-lg navbar navbar-light bg-transparent" id="wholenavbar">
  <div class="container-fluid">
    <a class="navbar-brand" id="title" href="#">INTERNSIP</a>
    <button class="navbar-toggler" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" id="nav1" href="#">Cari Lowongan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="nav2" href="#">Cari Perusahaan</a>
        </li>
        @guest
        <li class="nav-item">
          <a href="#ModalLogin" class="nav-link active trigger-btn" data-toggle="modal" id="nav3">Login</a>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

@yield('content')

<!-- Berfungsi untuk memunculkan modal register menjadi user / perusahaan-->
<!-- Modal Pilih Register User / Perusahan-->
<div id="ModalPilih" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Member Login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalRegisterUser" data-dismiss="modal">Buat Akun User</button>
                        <br>
                        <br>
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#ModalRegisterPerusahaan" data-dismiss="modal">Buat Akun Perusahaan</button>
					</div>
			</div>
			<div class="modal-footer">
				<!--<a href="#" class="nav-link active trigger-btn" data-dismiss="modal" data-toggle="modal">Belum punya akun ? Klik untuk Registrasi</a>-->
			</div>
		</div>
	</div>
</div>
<!------------------------------------------------------------------------------>


<!-- Berfungsi untuk memunculkan Modal Login yang nanti akan digunakan user/perusahan untuk login-->
<!-- Modal Login -->

<div id="ModalLogin" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Login</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{ route('login') }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" class="form-control" name="email" placeholder="Email" required="required">
					</div>
					<div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" class="form-control" name="password" placeholder="Password" required="required">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success btn-block btn-lg" id="btnlogin" value="Login">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#ModalPilih" class="nav-link active trigger-btn" data-dismiss="modal" data-toggle="modal">Belum punya akun ? Klik untuk Registrasi</a>
			</div>
		</div>
	</div>
</div>
<!------------------------------------------------------------------------------>

<!-- Berfungsi untuk memunculkan modal untuk register sebagai perusahaan-->
<!-- Modal Register Perusahaan-->
<div id="ModalRegisterPerusahaan" class="modal fade" >
	<div class="modal-dialog modal-login" id="modal-body-regist">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Registration</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post">
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" class="form-control" placeholder="Username" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" class="form-control" placeholder="Password" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" class="form-control" placeholder="Confirm Password" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-home "></i>
						<input type="text" class="form-control" placeholder="Nama Perusahaan" required="required">
					</div>
					<div class="form-group">
						<i class="fa fa-envelope "></i>
						<input type="text" class="form-control" placeholder="Email" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-address-book "></i>
						<input type="text" class="form-control" placeholder="No Telp" required="required">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!------------------------------------------------------------------------------>

<!-- Berfungsi untuk memunculkan modal untuk register sebagai user(pelamar)-->
<!--Modal buat register user-->
<div id="ModalRegisterUser" class="modal fade" >
	<div class="modal-dialog modal-login" id="modal-body-regist">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Registration</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="#" method="post">
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" class="form-control" placeholder="Username" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" class="form-control" placeholder="Password" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" class="form-control" placeholder="Confirm Password" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-address-card"></i>
						<input type="text" class="form-control" placeholder="Nama Lengkap" required="required">
					</div>
					<div class="form-group">
						<i class="fa fa-calendar "></i>
						<input type="text" class="form-control" placeholder="TTL" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-university"></i>
						<input type="text" class="form-control" placeholder="Pendidikan Terakhir" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-envelope "></i>
						<input type="text" class="form-control" placeholder="Email" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-address-book "></i>
						<input type="text" class="form-control" placeholder="No Telp" required="required">
					</div>
                    <div class="form-group">
						<i class="fa fa-home"></i>
						<input type="text" class="form-control" placeholder="Alamat" required="required">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block btn-lg" value="Login">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@stack('js')
</body>
</html>
