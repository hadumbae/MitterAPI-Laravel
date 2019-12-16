<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $__env->yieldContent('title-name'); ?></title>
    <!-- Material Icon CDN -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Used as an example only to position the footer at the end of the page.
    You can delete these styles or move it to your custom css file -->
    <style>
      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;

        /* background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
		url("<?php echo e(asset('img/5dea9f992dadd2d6ef5f62a8e1c8a04f.jpg')); ?> ");
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed; */
        }
      main {
        flex: 1 0 auto;
      }
      header, main, footer{
        padding-left: 300px;
      }

      header{
        display: none;
      }

      .testDiv{
          height: 100vh;
      }

      @media  only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
        }
      }

      @media  only screen and (max-width : 992px) {
      header{
        display: block;
        }
      }
    </style>
  </head>
  <body>
    <header>
      <nav class="transparent">
        <div class="nav-wrapper">
          <div class="container">
            <a href="#" class="brand-logo">mitter</a>
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a href="#">item1</a></li>
              <li><a href="#">item2</a></li>
              <li><a href="#">item3</a></li>
              <li><a href="#">item4</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <main class="valign-wrapper">

    <ul id="slide-out" class="sidenav sidenav-fixed">
        <li><div class="center-align user-view">
        <a href="#user"><img style="height: 200px" src="<?php echo e(asset('img/mitterlogo.png')); ?>"></a>
        </div></li>
        <li><a class="waves-effect btn center-align indigo lighten-2" href="#!">Timeline</a></li>
        <li><a class="waves-effect btn center-align indigo lighten-2" href="#!">Profile</a></li>
        <li><a class="waves-effect btn center-align indigo lighten-2" href="#!">Notification</a></li>
        <li><a class="waves-effect btn center-align indigo lighten-2" href="#!">Explore</a></li>
        <li><a class="waves-effect btn center-align indigo lighten-2" href="#!">Tweet</a></li>
        <li><a class="waves-effect btn center-align indigo lighten-2" href="#!">About</a></li>
        <li><a class="waves-effect btn center-align indigo lighten-2" href="#!">Logout</a></li>
    </ul>

        <?php echo $__env->yieldContent('main-content'); ?>

    </main>
    <footer class="center-align footer-copyright">
        <h6 class="grey-text">Mitter © 2019 Lorem</h6>
    </footer>
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Materialize JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
      $("document").ready(function(){
        $(".sidenav").sidenav();
      });
    </script>
  </body>
</html>
<?php /**PATH C:\Users\August Lin\Documents\GitHub\Mitter\Laravel\Mitter\resources\views/layout.blade.php ENDPATH**/ ?>