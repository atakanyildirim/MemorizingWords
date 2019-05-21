<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="assets/images/favicion.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Kurulum / Kelime Ezberleme</title>
  </head>
  <body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
                <a class="navbar-brand" href="#"><img width="180" src="assets/images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
            </div>
      </nav>
    </header>

    <main>
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <h1 class="my-title text-center">İngilizce Kelime Ezberleme</h1>
            <h6 class="my-title-low text-center">Başlamadan önce aşağıdaki bilgileri doldurunuz.</h6>
          </div>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-md-8">
              <form action="install.php" method="post">
                  <div class="form-group">
                    <label for="name">Adınız</label>
                    <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Adınız">
                  </div>
                  <div class="form-group">
                    <label for="surname">Soyadınız</label>
                    <input type="text" name="surname" class="form-control form-control-lg" id="surname" placeholder="Soyadınız">
                  </div>
                  <div class="form-group">
                      <label for="email">Mail Adresiniz</label>
                      <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Email">
                  </div>
                  <button type="submit" class="btn btn-dark btn-lg">ÖĞRENMEYE BAŞLA</button>
              </form>
          </div>
        </div> 
      </div>
    </main>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
$dosya = 'userInformation.json';

if (file_exists($dosya)) 
{
    header('Location: http://localhost/KelimeEzberleme/proje/public/');
} 

if($_POST)
{
    $userName = $_POST['name'];
    $userSurname = $_POST['surname'];
    $userEmail = $_POST['email'];
    
    $data = array('userName' => $userName, 'userSurname' => $userSurname, 'userEmail' => $userEmail);

    $fp = fopen('userInformation.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);

    header('Location: http://localhost/KelimeEzberleme/proje/public/');
}
?>