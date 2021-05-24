<?php
    require_once "encabezados/Header.php";
?>
<!-- <link rel="stylesheet" href="<?php echo DOMINIO;?>/public/assets/css/main.css"/> -->
<link rel="stylesheet" href="<?php echo DOMINIO;?>/public/assets/css/slider.css"/>

<nav class="navbar navbar-expand-md navbar-dark" style="background-color:#5a6e78">
 <div class="container">
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse " id="navbarSupportedContent" style="font-family:old Standard;">
    <ul class="navbar-nav w-100 justify-content-between" style="color:#f5f0ed">
      <li class="nav-item active">
        <a class="nav-link" href="#">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">¿Quiénes somos?</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sacramento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Bautismo</a>
          <a class="dropdown-item" href="#">Comunión</a>
          <a class="dropdown-item" href="#">Confirmación</a>
          <a class="dropdown-item" href="#">Matrimonio</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Citas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Chat</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo DOMINIO; ?>/home/login">Acceder</a>
      </li>
    </ul>
  </div>
 </div>
</nav>
<div>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?php echo DOMINIO;?>/public/assets/images/img9.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?php echo DOMINIO;?>/public/assets/images/img1.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?php echo DOMINIO;?>/public/assets/images/img2.jpeg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="<?php echo DOMINIO;?>/public/assets/images/img3.jpeg" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<section>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2">
                <h2 class="text-center">TRASMISIÓN</h2>
                <iframe  style="width:100%;" src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2FLaSantisimaTrinidadySantaMariadeGuadalupe%2Fvideos%2F2796586137219964%2F&show_text=false&width=560" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
            </div>
        </div>
    </div>
</section>

    <!-- Posts -->
    <section class="wrapper style1">
        <div class="container">
            <div class="row">
                <section class="col-6 col-12-narrower">
                    <div class="box post">
                        <a href="#" class="image left"><img src="<?php echo DOMINIO;?>/public/assets/images/pic01.jpg" alt="" /></a>
                        <div class="inner">
                            <h3>The First Thing</h3>
                            <p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
                        </div>
                    </div>
                </section>
                <section class="col-6 col-12-narrower">
                    <div class="box post">
                        <a href="#" class="image left"><img src="<?php echo DOMINIO;?>/public/assets/images/pic02.jpg" alt="" /></a>
                        <div class="inner">
                            <h3>The Second Thing</h3>
                            <p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row">
                <section class="col-6 col-12-narrower">
                    <div class="box post">
                        <a href="#" class="image left"><img src="<?php echo DOMINIO;?>/public/assets/images/pic03.jpg" alt="" /></a>
                        <div class="inner">
                            <h3>The Third Thing</h3>
                            <p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
                        </div>
                    </div>
                </section>
                <section class="col-6 col-12-narrower">
                    <div class="box post">
                        <a href="#" class="image left"><img src="<?php echo DOMINIO;?>/public/assets/images/pic04.jpg" alt="" /></a>
                        <div class="inner">
                            <h3>The Fourth Thing</h3>
                            <p>Duis neque nisi, dapibus sed mattis et quis, nibh. Sed et dapibus nisl amet mattis, sed a rutrum accumsan sed. Suspendisse eu.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section id="cta" class="wrapper style3">
        <div class="container">
            <header>
                <h2>Realiza inscripción al catesismo</h2>
                <a href="registro.php" class="button">Registrarse</a>
            </header>
        </div>
    </section>


    <section class="col-6 col-12-narrower">
        <h3>CONTÁCTANOS</h3>
        <form>
            <div class="row gtr-50">
                <div class="col-6 col-12-mobilep">
                    <input type="text" name="name" id="name" placeholder="Name" />
                </div>
                <div class="col-6 col-12-mobilep">
                    <input type="email" name="email" id="email" placeholder="Email" />
                </div>
                <div class="col-12">
                    <textarea name="message" id="message" placeholder="Message" rows="5"></textarea>
                </div>
                <div class="col-12">
                    <ul class="actions">
                        <li><input type="submit" class="button alt" value="Mandar mensaje" /></li>
                    </ul>
                </div>
            </div>
        </form>
    </section>
</div>
<!-- Scripts -->
<script src="<?php echo DOMINIO;?>/public/assets/js/jquery.min.js"></script>


<?php
require_once "encabezados/Footer.php";
?>