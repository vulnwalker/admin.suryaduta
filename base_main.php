<?php



$Main->Base =
"

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>

    <meta name='twitter:site' content='@metroui'>
    <meta name='twitter:creator' content='rm-rf.Studio'>
    <meta name='twitter:card' content='summary'>
    <meta name='twitter:title' content='Metro 4 Components Library'>
    <meta name='twitter:description' content='Metro 4 is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with responsive grid system, extensive prebuilt components, and powerful plugins built on jQuery.'>
    <meta name='twitter:image' content='../../images/m4-logo-social.png'>

    <meta property='og:url' content='https://metroui.org.ua/v4/index.html'>
    <meta property='og:title' content='Metro 4 Components Library'>
    <meta property='og:description' content='Metro 4 is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or build your entire app with responsive grid system, extensive prebuilt components, and powerful plugins built on jQuery.'>
    <meta property='og:type' content='website'>
    <meta property='og:image' content='../../images/m4-logo-social.png'>
    <meta property='og:image:secure_url' content='../../images/m4-logo-social.png'>
    <meta property='og:image:type' content='image/png'>
    <meta property='og:image:width' content='968'>
    <meta property='og:image:height' content='504'>

    <meta name='author' content='Sergey Pimenov'>
    <meta name='description' content='The most popular HTML, CSS, and JS library in Metro style.'>
    <meta name='keywords' content='HTML, CSS, JS, Metro, CSS3, Javascript, HTML5, UI, Library, Web, Development, Framework'>

        <link rel='stylesheet' href='../netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css' type='text/css' />
        <link rel='stylesheet' href='../netdna.bootstrapcdn.com/bootswatch/3.0.3/cosmo/bootstrap.min.css' type='text/css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.css' type='text/css' />

        <link rel='stylesheet' href='../css/css_asset/style.css' type='text/css' />


    <title>RIZKI KITA</title>
</head>
    <body>

        <!-- BACKGROUND -->
        <img src='../img/background-1.jpg' class='background' alt='' />
        <!-- /BACKGROUND -->

        <!-- LOGO -->
        <div class='header'>
            <h1>
                <a data-scroll='scrollto'  href='#start'>
                    <img src='../img/headerlogo.png' height='32' width='35' class='header-logo' alt=''/>
                    REZEKI KITA
                </a>
            </h1>
        </div>
        <!-- /LOGO -->

        <!-- MAIN CONTENT SECTION -->
        <section id='content'>

            <!-- SECTION -->
            <section class='clearfix section' id='start'>

                <!-- SECTION TITLE -->
                <h3 class='block-title'>Admin Panel</h3>
                <!-- /SECTION TITLE -->

                <!-- SECTION TILES -->
                <div class='tile turquoise w4 h2 title-horizontalcenter icon-scaleuprotate360cw'>
                    <a class='link' href='pages.php?Pg=penjualanProduk'>
                        <i class='fas fa-shopping-cart'></i>
                        <p class='title'>Penjualan</p>
                    </a>
                </div>

                <div class='tile orange w4 h2 icon-featurecw title-fadeout'>
                    <a   href='pages.php?Pg=pembayaranKomisi' class='link'>
                        <i class='fas fa-comments-dollar'></i>
                        <p class='title'>Komisi</p>
                    </a>
                </div>

                <div class='tile blue title-verticalcenter icon-flip w2 h2'>
                    <a class='link'   href='pages.php?Pg=refArtikel'>
                        <i class='fas fa-newspaper'></i>
                        <p class='title'>Artikel</p>
                    </a>
                </div>

                <div class='tile purple title-scaleup icon-scaledownrotate360cw w2 h2'>
                    <a class='link'   href='pages.php?Pg=refProduk'>
                        <i class='fas fa-flask'></i>
                        <p class='title'>Produk</p>
                    </a>
                </div>

                <div class='tile green icon-featurefade title-indent w2 h2'>
                    <a class='link'  href='pages.php?Pg=refGalery' >
                        <i class='fas fa-images'></i>
                        <p class='title'>Galery</p>
                    </a>
                </div>

                <div class='tile blue icon-flip title-fadeout w2 h2'>
                    <a class='link'  href='pages.php?Pg=refMember'>
                        <i class='fas fa-users'></i>
                        <p class='title'>Member</p>
                    </a>
                </div>

                <!-- /
                <div class='tile imagetile title-indent tileshow w2 h1'>
                    <div class='slide active'>
                        <a href='#galleryimage' data-lightbox='mlightboximage' class='link'
                           data-src='../img/01_preview.jpg' data-title='Generic' data-description='by PierreBorodin'>
                            <img src='../img/01_thumbnail.jpg' alt='' />
                            <p class='title'>Galery</p>
                        </a>
                    </div>
                    <div class='slide'>
                        <a href='#galleryimage' data-lightbox='mlightboximage' class='link'
                           data-src='../img/02_preview.jpg' data-title='Solana' data-description='by abcgomel'>
                            <img src='../img/02_thumbnail.jpg' alt='' />
                            <p class='title'>Galery</p>
                        </a>
                    </div>
                    <div class='slide'>
                        <a href='#galleryimage' data-lightbox='mlightboximage' class='link'
                           data-src='../img/03_preview.jpg' data-title='Top of the world' data-description='Amazing photomanipulation'>
                            <img src='../img/03_thumbnail.jpg' alt='' />
                            <p class='title'>Galery</p>
                        </a>
                    </div>
                </div>
                -->
                <div class='tile title-fade icon-featureccw w4 h4'>
                    <a class='link' target='_blank' href='https://nutrisio.rm-rf.studio'>
                        <div class='text'>
                            <p class='text-medium'>
                                Lihat website
                            </p>
                            <p>
                                Rezeki Kita
                            </p>
                        </div>
                        <p class='sub'>2</p>
                        <p class='title'><i class='fa fa-arrow-right fa-2x'></i></p>
                    </a>
                </div>
                <!-- /
                  <div class='tile red imagetile tileshow w2 h1'>
                      <div class='slide active'>
                          <div class='caption red'>
                              <a class='link' href='blog/post-1.html'>
                                  <div class='title'><i class='fa fa-file-text fa-2x'></i></div>
                                  <div class='caption-text twoline'>
                                      Strapslide is the new big thing in Bootstrap Development!
                                  </div>
                              </a>
                          </div>
                          <img src='../img/blogpost-1.jpg' alt='' />
                      </div>
                      <div class='slide'>
                          <div class='caption red'>
                              <a class='link' href='blog/post-2.html'>
                                  <div class='title'><i class='fa fa-file-text  fa-2x'></i></div>
                                  <div class='caption-text'>
                                      You'll simply love REZEKI KITA
                                  </div>
                              </a>
                          </div>
                          <img src='../img/blogpost-2.jpg' alt='' />
                      </div>
                      <div class='slide'>
                          <div class='caption red'>
                              <a class='link' href='blog/post-3.html'>
                                  <div class='title'><i class='fa fa-file-text fa-2x'></i></div>
                                  <div class='caption-text'>
                                      The most amazing Metro UI
                                  </div>
                              </a>
                          </div>
                          <img src='../img/blogpost-3.jpg' alt='' />
                      </div>
                  </div>
                -->
              <!-- /
                <div class='tile turquoise icon-fadeoutscaleup title-fade w1 h1'>
                    <a class='link'  href='http://nutrsio.rm-rf.studio' target='_blank'>
                        <i class='fas fa-file-text'></i>
                        <p class='title'>Site</p>
                    </a>
                </div>
               -->
                <!-- /SECTION TILES -->

            </section>
            <!-- /SECTION -->


        </section>
        <!-- /MAIN CONTENT SECTION -->

        <!-- LOCKSCREEN -->
        <section class='mlightbox' id='lockscreen'>
            <div id='lockscreen-content'>
                <img src='../img/logo.png' height='109' width='140' id='locklogo'  alt='REZEKI KITA'/>
                <br/><br/>
                <img src='../img/preloader.gif' id='lockloader'  alt='Loading..'/>
            </div>
        </section>
        <!-- /LOCKSCREEN -->

        <!-- SIDEBAR -->
        <div id='opensidebar'><i class='fa fa-3x'>+</i></div>
        <section id='sidebar'>
            <ul>
                <li></li>
                <li><a data-scroll='scrollto'  href='#start' ><i class='fa fa-windows fa fa-4x'></i></a></li>
                <li><a data-scroll='scrollto'  href='#services' ><i class='fa fa-pencil fa fa-4x'></i></a></li>
                <li><a data-scroll='scrollto'  href='#about' ><i class='fa fa-user fa fa-4x'></i></a></li>
                <li><a data-scroll='scrollto'  href='#portfolio' ><i class='fa fa-picture-o fa fa-4x'></i></a></li>
            </ul>
        </section>
        <!-- /SIDEBAR -->

        <!-- PRELOADER -->
        <section class='mlightbox' id='loader'>
            <a href='#'>
                <img src='../img/preloader.gif' alt='Loading..'/>
            </a>
        </section>
        <!-- /PRELOADER -->

        <!-- GALLERY LIGHTBOX -->
        <section class='mlightbox' id='galleryimage'>
            <section class='mlightbox-content'>
                <img src='#'  alt=''/>
            </section>
            <section class='mlightbox-details'>
                <div class='mlightbox-description'>
                    <h2 class='mlightbox-title'>REZEKI KITA</h2>
                    <p class='mlightbox-subtitle muted'>by Grozav</p>
                </div>
                <ul class='mlist'>
                    <li><a class='close-mlightbox' href='#'><i class='fa fa-arrow-left'></i> Back to REZEKI KITA</a></li>
                    <li></li>
                    <li><a target='_blank' href='http://facebook.com/grozavcom'><i class='fa fa-facebook-sign'></i> Like us on Facebook</a></li>
                    <li><a target='_blank' href='https://twitter.com/intent/user?screen_name=grozavcom'><i class='fa fa-twitter-sign'></i> Follow us on Twitter</a></li>
                </ul>
            </section>
        </section>
        <!-- /GALLERY LIGHTBOX -->

        <!-- VIDEO LIGHTBOX -->
        <section class='mlightbox' id='galleryvideo'>
            <section class='mlightbox-content'>
                <div class='fitvideo'>
                    <iframe width='560' height='315' src='http://www.youtube.com/embed/VbDZmbx474k?modestbranding=1'></iframe>
                </div>
            </section>
            <section class='mlightbox-details'>
                <div class='mlightbox-description'>
                    <h2 class='mlightbox-title'>REZEKI KITA</h2>
                    <p class='mlightbox-subtitle muted'>by Grozav</p>
                </div>
                <ul class='mlist'>
                    <li><a class='close-mlightbox' href='#'><i class='fa fa-arrow-left'></i> Back to REZEKI KITA</a></li>
                    <li></li>
                    <li><a target='_blank' href='http://facebook.com/grozavcom'><i class='fa fa-facebook-sign'></i> Like us on Facebook</a></li>
                    <li><a target='_blank' href='https://twitter.com/intent/user?screen_name=grozavcom'><i class='fa fa-twitter-sign'></i> Follow us on Twitter</a></li>
                </ul>
            </section>
        </section>
        <!-- /VIDEO LIGHTBOX -->

        <script src='../js/js_asset/jquery-latest.min.js' type='text/javascript'></script> <!-- jQuery Library -->
        <script src='../js/js_asset/respond.min.js' type='text/javascript'></script>
        <script src='../js/js_asset/jquery.isotope.min.js' type='text/javascript'></script>
        <script src='../js/js_asset/jquery.mousewheel.js' type='text/javascript'></script>
        <script src='../js/js_asset/jquery.mCustomScrollbar.js' type='text/javascript'></script>
        <script src='../js/js_asset/tileshow.js' type='text/javascript'></script>
        <script src='../js/js_asset/mlightbox.js' type='text/javascript'></script>
        <script src='../js/js_asset/jquery.touchSwipe.min.js' type='text/javascript'></script>
        <script src='../js/js_asset/jquery.fitVids.js' type='text/javascript'></script>
        <script src='../js/js_asset/lockscreen.js' type='text/javascript'></script>
        <script src='../netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js' type='text/javascript'></script>

        <script src='../js/js_asset/script.js' type='text/javascript'></script>

    </body>
</html>

";
?>
