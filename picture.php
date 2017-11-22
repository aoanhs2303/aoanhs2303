<?php require_once("include/DB.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Function.php"); ?>

<!DOCTYPE html>
<html lang="en">
 
<head>
    
    <title>AoAnhs2303's Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="images/favicon.ico" />
    <script type="text/javascript" src="vendor/bootstrap.js"></script>
    <script type="text/javascript" src="vendor/angular.js"></script>
    <script type="text/javascript" src="vendor/angular-route.js"></script>
    <script type="text/javascript" src="vendor/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="vendor/imagesloaded.pkgd.min.js"></script>
    <link rel="stylesheet" href="vendor/jquery.fancybox.min.css">
    <script type="text/javascript" src="vendor/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome.css">
    <link rel="stylesheet" href="vendor/hamberger.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-picture.css">
    <link rel="stylesheet" href="hightlight/styles/atom-one-dark.css">
    <script src="hightlight/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=vietnamese" rel="stylesheet">
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109040970-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-109040970-1');
    </script>
</head>

<body>
    <header>
        <div class="container top-menu">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="togger-icon">
          <!-- <div class="one-line-togger"></div>
          <div class="one-line-togger"></div>
          <div class="one-line-togger"></div> -->
            <div class="wrapper-menu xxx toggle-icon">
                <div class="line-menu half start"></div>
                <div class="line-menu"></div>
                <div class="line-menu half end"></div>
            </div>
        </span>
      </button>
                <a class="navbar-brand" href="index.php"><span class="red">A</span>o<span class="red">A</span>nhs2303</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Relaxing &nbsp;<i class="fa fa-caret-down"></i></a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="picture.php">Xem ảnh</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Nghe nhạc</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Project &nbsp;<i class="fa fa-caret-down"></i></a>
                            <ul class="sub-menu">
                                <?php 
                                global $Connection;
                                $Query = "SELECT * FROM project";
                                $Execute = mysqli_query($Connection, $Query);
                                while($DateRow = mysqli_fetch_array($Execute)) {
                                    $Title = $DateRow['title'];
                                    $Link = $DateRow['link'];
                                

                                ?> 
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo $Link;?>"><?php echo $Title; ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0 search-form" method="get" action="index.php">
                        <div class="input-group">
                            <input class="form-control mr-sm-2" type="text" name="SearchFill" placeholder="Search for...">
                            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="Search"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <section class="blog-name">
        <div class="container">
            <h1 id="logo"><span class="yolo">A</span>o<span class="yolo">A</span>nhs2303<small>'s</small> Blog</h1>
            <p id="desc" style="margin-bottom: 0px">Website Developer</p>
        </div>
    </section>
    <section class="contentMansory">
        
        <header class="mansory">
            <div class="container">
                <ul class="nav justify-content-center mansory-header">
                    <li class="nav-item active" data-kind="*">
                        <a class="nav-link" href="#">All</a>
                    </li>
                    <li class="nav-item" data-kind=".Girl">
                        <a class="nav-link" href="#">Girl</a>
                    </li>
                    <li class="nav-item" data-kind=".Dev">
                        <a class="nav-link" href="#">Dev</a>
                    </li>
                    <li class="nav-item" data-kind=".Funny">
                        <a class="nav-link" href="#">Funny</a>
                    </li>
                    <li class="nav-item" data-kind=".Scenery">
                        <a class="nav-link" href="#">Scenery</a>
                    </li>
                </ul>    
            </div>
            
        </header>
        <h2 class="text-center big-title">All Pictures</h2>
        <div class="clearfix"></div>
        <div class="container pinterest">
            <div class="content">
                <ul>
                    <?php 
                    $Query = "SELECT * FROM picture ORDER BY datetime desc";
                    $Execute =  mysqli_query($Connection, $Query);
                    while($DataRow = mysqli_fetch_array($Execute)) {
                    $PictureId = $DataRow['id'];
                    $DateTime = $DataRow['datetime'];
                    $Kind = $DataRow['kind'];
                    $Image = $DataRow['image'];
                    ?>   
                    <li class="<?php echo $Kind; ?>">
                        <a href="imageMansory/<?php echo $Image; ?>" data-fancybox="<?php echo $Kind; ?>"><img src="imageMansory/<?php echo $Image; ?>" alt="" class="rounded"></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <ul class="footer">
                        <li>
                            <a href="">Homepage</a>
                        </li>
                        <li>
                            <a href="">News</a>
                        </li>
                        <li>
                            <a href="">Project</a>
                        </li>
                        <li>
                            <a href="">Tutorial</a>
                        </li>
                    </ul>
                    <p>Designed with all the <i class="fa fa-heart" style="color: #e74c3c"></i> in the world by <b style="color: #FFF">Aoanhs2303</b>.</p>
                    <p>Copyright © 2017 Aoanhs2303's Blog. All rights reserved.</p>
                </div>
                <div class="col-4">
                    <p class="fb">Find me on: <a href="https://www.facebook.com/tranlucs2303"><i class="fa fa-facebook social"></i></a></p>
                    <p class="emailname"><i class="fa fa-envelope" style="color: #e74c3c"></i> Email: <b>trannhulucs2303@gmail.com</b></p>
                    <a href="dashboard.php" style="color: #CCC"><i style="color: #e67e22" class="fa fa-caret-square-o-right"></i>&nbsp; Go to Dashboard</a>
                </div>
            </div>
            
        </div>
    </footer>
</body>

</html>
