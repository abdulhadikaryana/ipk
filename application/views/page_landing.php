<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Indeks Pembangunan Kebudayaan</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?php echo HTTP_IMAGES_PATH;?>favicon.png" rel="icon">

  <link href="<?php echo HTTP_IMAGES_PATH;?>apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  
 
  <link href="<?php echo HTTP_LIB_PATH;?>bootstrap/css/bootstrap.css" rel="stylesheet">


  <!-- Libraries CSS Files -->
  <script src="<?php echo base_url().'assets/lib/font-awesome/css/font-awesome.min.css'?>" rel="stylesheet"></script>

  <script src="<?php echo base_url().'assets/lib/animate/animate.min.css'?>" rel="stylesheet"></script>

  <script src="<?php echo base_url().'assets/lib/ionicons/css/ionicons.min.css'?>" rel="stylesheet"></script>

  <script src="<?php echo base_url().'assets/lib/owlcarousel/assets/owl.carousel.min.css'?>" rel="stylesheet"></script>

  <script src="<?php echo base_url().'assets/lib/lightbox/css/lightbox.min.css'?>" rel="stylesheet"></script>

  <link rel="stylesheet" href="<?php echo base_url().'assets/css/map-style.css'?>" />

  <script src="<?php echo base_url().'assets/js/jquery-3.4.1.min.js'?>"></script>

  <script src="<?php echo base_url().'assets/js/raphael-min.js'?>"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
  

  <!-- Main Stylesheet File -->
  <link href="<?php echo HTTP_CSS_PATH;?>style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: NewBiz
    Theme URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
        <a href="#intro" class="scrollto"><img src="<?php echo HTTP_IMAGES_PATH;?>logo3.png" alt="" class="img-fluid"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro">Beranda</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#hasil_hitung">Hasil</a></li>
          <!--<li><a href="#nilaiprovinsi">Simulasi</a></li>-->
          
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <div class="intro-img">
        <img src="<?php echo HTTP_IMAGES_PATH;?>layar1.svg" alt="" class="img-fluid">
      </div>

      <div class="intro-info">
        <h2>Indeks<br><span>Pembangunan</span><br>Kebudayaan</h2>
        <div>
          
          <a href="#hasil_hitung" class="btn-services scrollto">Hasil</a><a href="<?php echo HTTP_IMAGES_PATH;?>handbook_ipk.pdf" class ="btn-services">Unduh Buku IPK</a>
        </div>
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>Pengantar</h3>
          <p>
            Indeks Pembangunan Kebudayaan (IPK) disusun sebagai salah satu instrumen untuk memberikan gambaran kemajuan pembangunan kebudayaan yang dapat 
            digunakan sebagai basis formulasi kebijakan bidang kebudayaan, serta menjadi acuan dalam koordinasi lintas sektor dalam pelaksanaan pemajuan 
            kebudayaan. Penyusunan indeks tersebut melibatkan berbagai pemangku kebijakan dan data yang berkaitan dengan pembangunan kebudayaan nasional.
          </p>
          <h3>Metodologi Penghitungan</h3>
          <p><img src="<?php echo HTTP_IMAGES_PATH;?>metodologi.png" class="img-fluid"> </p>
        </header>
        
        

        <div class="row about-container">

          <div class="row about-container">
          <?php
            foreach ($desc->result() as $row) {
              if ($row->NAMA_DIM != "IPK") {
                ?><div class="col content order-md-1 order-2 wow fadeInUp">
                  <div class="row-sm-6">
                    <div class="icon-box wow fadeInUp">
                      <img src="<?php echo HTTP_IMAGES_PATH.$row->ASSET_DIM;?>" class="img-fluid icon center"  alt="">
                     
                    
                    
                    </div>
                  </div>
                  <div class="row-md-6">
                    <h4 ><a href="<?php echo base_url().'page/showdimdesc/'.$row->KODE_DIM;?>" data-href="<?php echo base_url().'page/showdimdesc/'.$row->KODE_DIM;?>" class="openBtn"><?php echo $row->NAMA_DIM;?></a>
                      
                    </h4>

                  </div>
                  
                </div><?php
              }
             } 
          ?>
        </div>

            
        </div>

        

      </div>
    </section><!-- #about -->

    
    

    <!--==========================
      Portfolio Section
    ============================-->
    <section id="hasil_hitung" class="clearfix">
      <div class="row no-gutter">
        <div class="container">
          <header class="section-header">
            <h3 class="section-title">Hasil Penghitungan</h3>
          </header>   
        </div>

        <div class="container">
          <div class="row">
            <div class="col">

              <div class="container">
                <div class="bar-chart-container">
                  <canvas id="bar-chart"></canvas>
                </div>
              </div>


              <script>
                  $(function(){
                      //get the radar chart canvas
                      var cData = JSON.parse(`<?php echo $chart_data; ?>`);
                      var ctx = $("#bar-chart");

                 
                      //radar chart data
                      var data = {
                        labels: cData.label,
                        datasets: [
                          {
                            pontRadius: 0,
                            borderWidth: 4,
                            data: cData.data,
                            backgroundColor: [
                              "#DEB887",
                              "#A9A9A9",
                              "#DC143C",
                              "#F4A460",
                              "#2E8B57",
                              "#1D7A46",
                              "#CDA776",
                              "#CDA776",
                              "#989898",
                              "#CB252B",
                              "#E39371",
                            ],
                            borderColor: [
                             'rgba(0, 0, 255, 1)'
                            ],
                            fill: false,
                            borderWidth: [1, 1, 1, 1, 1,1,1,1, 1, 1, 1,1,1]
                          }
                        ]
                      };
                 
                      //options
                      var options = {
                        responsive: true,
                        title: {
                          display: true,
                          position: "top",
                          text: "IPK NASIONAL 2018 "+<?php echo $ipk;?>,
                          fontSize: 18,
                          fontColor: "#111"
                        },
                        legend: {
                          display: false
                        }
                      };
                 
                      //create bar Chart class object
                      var chart1 = new Chart(ctx, {
                        type: "radar",
                        data: data,
                        options: options
                      });
                 
                  });
                </script>


            </div>
            
          </div>
        </div>

      </div>
    </section><!-- #portfolio -->

    <section id="nilaiprovinsi">
      <div class="container">
        <header class="section-header">
          <h3 class="section-title">Nilai Per Provinsi</h3>
        </header>
       
        <iframe src="<?php echo base_url().'page/maps_all'; ?>" style="width: 100%;height: 100vh;position: relative;"></iframe>

      </div>
    </section>

   

   

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6 footer-links">
            <h4>Sekretariat Direktorat Jenderal</h4>
            <h4>Direktorat Jenderal Kebudayaan</h4>
            <h4>Kementrian Pendidikan dan Kebudayaan</h4>
          </div>

          <div class="col-lg-4 col-md-6 footer-contact">
            <h4>Ditjen Kebudayaan</h4>
            <p>
              Komplek Kemdikbud, Gedung E Lt.4 <br>
              Jln. Jenderal Sudirman, Senayan, Jakarta 10270<br>
              
              <strong>Telepon:</strong> (021) 5731063, (021) 5725035<br>
              <strong>Email:</strong> kebudayaan@kemdikbud.go.id<br>
              <strong>Fax:</strong> (021) 5731063, (021) 5725578<br>
            </p>

            <div class="social-links">
              <a href="https://twitter.com/budayasaya" class="twitter"><i class="fa fa-twitter"></i></a>
              <a href="https://www.facebook.com/budayasaya" class="facebook"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/budayasaya/" class="instagram"><i class="fa fa-instagram"></i></a>
            </div>

          </div>

          <div class="col-lg-4">
            <a><img src="<?php echo HTTP_IMAGES_PATH;?>logo3.png" alt="" class="img-fluid"></a>
          </div>

          

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; <strong>Ditjen Kebudayaan</strong>. 
      </div>
      <div class="credits">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=NewBiz
        -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  
  <script type="text/javascript" src="assets/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="assets/lib/easing/easing.min.js"></script>
  <script type="text/javascript" src="assets/lib/mobile-nav/mobile-nav.js"></script>
  <script type="text/javascript" src="assets/lib/wow/wow.min.js"></script>
  <script type="text/javascript" src="assets/lib/waypoints/waypoints.min.js"></script>
  <script type="text/javascript" src="assets/lib/counterup/counterup.min.js"></script>
  <script type="text/javascript" src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
  <script type="text/javascript" src="assets/lib/isotope/isotope.pkgd.min.js"></script>
  <script type="text/javascript" src="assets/lib/lightbox/js/lightbox.min.js"></script>
  <script type="text/javascript" src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
  <!-- Contact Form JavaScript File -->
  <!--<script src="assets/contactform/contactform.js"></script> -->

  <!-- Template Main Javascript File -->
  <script type="text/javascript" src="assets/js/main.js"></script>
  <script type="text/javascript" src="assets/js/map-script.js"></script>
  

</body>
</html>
