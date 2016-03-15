<?php


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>foodrest</title>
        <link rel="stylesheet" href="/public/css/main.css">
        <link rel="stylesheet" href="/public/css/bootstrap.min.css">
        <link rel="stylesheet" href="/public/css/bootstrap-datetimepicker.min.css">
        <script src="/public/js/jquery.min.js" charset="utf-8"></script>
        <script src="/public/js/moment-with-locales.min.js" charset="utf-8"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- <script src="js/bootstrap.min.js" charset="utf-8"></script> -->
        <script src="/public/js/bootstrap-datetimepicker.min.js" charset="utf-8"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCF-6pxk4Z98Yn21PhDJ4MjFIAKjERSHY&callback=initMap"async defer></script>
        <script src="/public/js/main.js" charset="utf-8"></script>
    </head>
    <body>
        <header>
            <div class="backTopPanel AbsBox">
                <div class="topPanel SiteBox">
                    <div class="right">
                        <p class="orderTime">Order food 24/7</p>
                        <a href="tel:0895743456" class="phone">089573456</a>
                        <div class="box">
                            <?php if(!empty($fullName)){ ?>
                                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                <form method="POST" action="" style="float:right;margin:10px 0px;padding:0;">
                                    <input type="hidden" name="exit" value="1" />
                                    <button type="submit" class="exit" style="cursor:pointer;background:none;border:none;margin:0;padding:0;">
                                        EXIT
                                    </button>
                                </form>
                                <a href="#" data-toggle="modal" data-target="#login">
                                    <?php echo $fullName; ?>
                                </a>
                            <?php }else{ ?>
                                <a href="#" data-toggle="modal" data-target="#login">
                                    Login
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="back_nav AbsBox">
                <nav class="SiteBox">
                    <div class="logo">
                        <a href="/"><img src="/public/img/back/logo.png" alt=""></a>
                    </div>
                    <div class="right">
                        <ul>
                            <li><a href="/">home</a></li>
                            <li><a href="/news">news</a></li>
                            <li><a href="/menu">menu</a></li>
                            <li><a href="#">delivery</a></li>
                        </ul>
                        <div class="box">
                            <a href="/table">table booking</a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <section>
            {{content()}}
        </section>
        <footer>
            <div id="map"></div>
            <div class="backFooter AbsBox">
                <div class="content SiteBox">
                    <div class="timeWorks">
                        <h3>Work time</h3>
                        <p>Mondey-Friday 09:00 - 22:00</p>
                        <p>Saturday-Sunday 10:00 - 23:00</p>
                    </div>
                    <div class="feedback">
                        <h3>feedback form</h3>
                        <form action="" method="POST">
                            <div>
                                <input type="text" placeholder="You Name?">
                                <input type="email" placeholder="You Email?">
                                <input type="phone" placeholder="You Phone?">
                            </div>
                            <textarea name="name" rows="8" cols="40" placeholder="You Message"></textarea>
                            <button type="submit" name="button">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </footer>
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Login</h4>
              </div>
              <form action="" method="POST">
                  <div class="modal-body">
                        <span>You Login</span>
                        <input type="text" name="login">
                        <span>You Password</span>
                        <input type="password" name="pass">
                        <a href="#" data-toggle="modal" data-target="#Registration">registration</a>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Login</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="Registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registration</h4>
              </div>
              <form action="" method="POST">
                  <div class="modal-body">
                        <span>*You name</span>
                        <input type="text" name="Crname">
                        <span>*You Surname</span>
                        <input type="text" name="Crsurname">
                        <span>*You Login</span>
                        <input type="text" name="Crlogin">
                        <span>You Email</span>
                        <input type="email" name="Cremail">
                        <span>You Phone</span>
                        <input type="password" name="Crphone">
                        <span>*You Password</span>
                        <input type="password" name="Crpass">
                        <span>*Repeat Password</span>
                        <input type="password" name="Crpasstwo">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registration</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <script>
            function initMap() {
              var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -34.397, lng: 150.644},
                scrollwheel: false,
                zoom: 8
              });
            }
        </script>
    </body>
</html>