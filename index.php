<!DOCTYPE html>
<html lang="en">
<?php require_once("include/DB.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Function.php"); ?>


<head>
    <title> AoAnhs2303's Blog </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="vendor/bootstrap.js"></script>
    <script type="text/javascript" src="vendor/angular.js"></script>
    <script type="text/javascript" src="vendor/angular-route.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome.css">
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <header>
        <div class="container top-menu">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="togger-icon">
          <div class="one-line-togger"></div>
          <div class="one-line-togger"></div>
          <div class="one-line-togger"></div>
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
                            <a class="nav-link" href="#">Tutorial</a>
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
                    
                    <form class="form-inline my-2 my-lg-0 search-form" method="get">
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
            <p id="desc">Website Developer</p>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-8 big-col-8">
                    <div class="feature">
                        <div class="header-feature">
                            <?php 
                                global $Connection;
                                $Query = "SELECT * FROM post WHERE id = 30";
                                $Execute =  mysqli_query($Connection, $Query);
                                while($DataRow = mysqli_fetch_array($Execute)) {
                                $PostId = $DataRow['id'];
                                $DateTime = $DataRow['datetime'];
                                $Titile = $DataRow['title'];
                                $Category = $DataRow['category'];
                                $Image = $DataRow['image'];
                                $Content = $DataRow['content'];
                                $Content = substr($Content, 0, 200).'...';
                            ?>
                            <h4 id="header-fetu"><i class="fa fa-bookmark">&nbsp;</i>Featured</h4>
                            <div class="wrapperfetu">

                                <div class="img-featured">
                                    <img src="upload/<?php echo $Image; ?>" alt="" class="img-fluid rounded">
                                </div>

                                <a href="fullblog.php?id=<?php echo $PostId; ?>" id="title-featured">
                                    <h3>
                                        <?php echo $Titile; ?>
                                    </h3>
                                </a>
                                <p class="desctiption"><?php echo $Content; ?></p>
                                <a href="fullblog.php?id=<?php echo $PostId; ?>" class="btn btn-info read-more">Read more&nbsp;<i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="news">
                        <!--ones-news-->
                        <?php 
                            global $Connection;
                            isset($_GET['page']) ? $Page = $_GET['page'] : $Page = 1;
                            $ShowPostFrom = ($Page * 4) - 4;
                            if($Page <= 0) {
                                $ShowPostFrom = 0;
                            }
                            
                            if(isset($_GET['Search'])) {
                                $Search = $_GET['SearchFill'];     
                                $Query = "SELECT * FROM post WHERE id LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR content LIKE '%$Search%'";

                            } else {
                                $Query = "SELECT * FROM post ORDER BY datetime desc LIMIT $ShowPostFrom, 4";
                            }
                            $Execute =  mysqli_query($Connection, $Query);
                            while($DataRow = mysqli_fetch_array($Execute)) {
                            $PostId = $DataRow['id'];
                            $DateTime = $DataRow['datetime'];
                            $Titile = $DataRow['title'];
                            $Category = $DataRow['category'];
                            $Image = $DataRow['image'];
                            $Content = $DataRow['content'];
                            $Content = substr($Content, 0, 200).'...';
                        ?>
                                <div class="one-news">
                                    <div class="row">
                                        <div class="col-sm-4 col-12">
                                            <img src="upload/<?php echo $Image; ?>" alt="" class="img-fluid">
                                        </div>
                                        <div class="col-sm-8 col-12 no-padding-left">
                                            <a href="fullblog.php?id=<?php echo $PostId; ?>">
                                                <h5 id="title-news"><?php echo $Titile; ?></h5>
                                            </a>

                                            <div class="info-news">
                                                <span><i class="fa fa-user"></i> AoAnhs2303</span>
                                                <span><i class="fa fa-calendar"></i> <?php echo $DateTime; ?></span>
                                                <span><i class="fa fa-tag"></i> <?php echo $Category; ?></span>
                                                <p><?php echo $Content; ?></p>
                                                <a href="fullblog.php?id=<?php echo $PostId; ?>" class="btn btn-info read-more">Read more&nbsp;<i class="fa fa-angle-double-right"></i></a>
                                                <a href="" class="btn btn-success share">Share&nbsp;<i class="fa fa-share-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
    


                    </div>
                    
<!--                PAGINATION-->
                   
                   <nav aria-label="Page navigation example">
                        <?php 
                            global $Connection;
                            if(isset($_GET['Search'])) {
                                $Search = $_GET['SearchFill'];     
                                $QueryCount = "SELECT COUNT(*) FROM post WHERE id LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR content LIKE '%$Search%'";

                            } else {
                                $QueryCount = "SELECT COUNT(*) FROM post";
                            }
                            
                            $ExecutePagination = mysqli_query($Connection, $QueryCount);
                            $RowPagination = mysqli_fetch_array($ExecutePagination);
                            $TotalPost = array_shift($RowPagination);
                            $TotalPage = ceil($TotalPost/4);
                            isset($_GET['page']) ? $Page = $_GET['page'] : $Page = 1;
                            
                        ?>
                        
                        <ul class="pagination">
                        <?php if ($Page > 1) {
                            
                        ?>  
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=<?php echo ($Page - 1); ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>  
                        <?php } ?>   
                        <?php
                        
                        for($i=1; $i<=$TotalPage; $i++) {
                            if($i == $Page) {    
                        ?>
                            <li class="page-item active"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } else {?> 
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                        <?php } } ?>
                        <?php if ($Page < $TotalPage) {
                            
                        ?>  
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=<?php echo ($Page + 1) ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>  
                        <?php } ?>  
                      
                        
                      </ul>
                    </nav>
                </div>
                <div class="col-sm-4">

                    <div class="about-me">
                        <div class="top-ab">
                            <h4 class="name-about">Trần Như Lực</h4>
                            <p class="webdev">Website Developer</p>
                        </div>
                        <div class="avatar">
                            <img src="images/avt.jpg" alt="" width="60px" height="60px" class="rounded-circle">
                        </div>
                        <?php 
                            global $Connection;
                            //Num of post
                            $QueryPost = "SELECT COUNT(*) FROM post";
                            $ExecutePost = mysqli_query($Connection, $QueryPost);
                            $NumPost = mysqli_fetch_array($ExecutePost);
                            $PostsNumber = array_shift($NumPost);
                            //Num of comment
                            $QueryComment = "SELECT COUNT(*) FROM comments";
                            $ExecuteComment = mysqli_query($Connection, $QueryComment);
                            $NumCmt = mysqli_fetch_array($ExecuteComment);
                            $NumberComments = array_shift($NumCmt);
                        ?>
                        <div class="bottom-ab">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <b>Posts</b><br><?php echo $PostsNumber; ?>
                                </div>
                                <div class="col-4 text-center">
                                    <b>Comments</b><br><?php echo $NumberComments ?>
                                </div>
                                <div class="col-4 text-center">
                                    <b>Share</b><br>0
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="follow-me">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-envelope" style="color: #dd4b39"></i></div>
                            <input type="email" placeholder="Enter your email" class="form-control">
                            <div class="input-group-addon"><i class="fa fa-check" style="color: #2ecc71"></i></div>
                        </div>
                    </div>
                    
                                        
                    <div class="angular-trending" ng-app="tabTrending" ng-controller="TabController">
                        <div class="all-tab">
                            <div class="tab-header">
                                <ul class="tab-he">
                                    <li ng-class="{active:isActiveTab(1)}" ><a href=""ng-click="changeTab(1)"><i class="fa fa-bolt"></i> Trending</a></li>
                                    <li ng-class="{active:isActiveTab(2)}" ><a href="" ng-class="{active:isActiveTab(2)}" ng-click="changeTab(2)"><i class="fa fa-star"></i> Project</a></li>
                                    <li ng-class="{active:isActiveTab(3)}" ><a href="" ng-class="{active:isActiveTab(3)}" ng-click="changeTab(3)"><i class="fa fa-tag"></i> Labels</a></li>
                                </ul>
                                <div class="tabs-content">
                                    <div ng-show="current_tab == 1">
                                        <?php 
                                            $Query = "SELECT * FROM post ORDER BY datetime desc LIMIT 0, 4";
                                            $Execute =  mysqli_query($Connection, $Query);
                                            while($DataRow = mysqli_fetch_array($Execute)) {
                                            $PostId = $DataRow['id'];
                                            $DateTime = $DataRow['datetime'];
                                            $DateTime = substr($DateTime, 0, 18);
                                            $Titile = $DataRow['title'];
                                            $Category = $DataRow['category'];
                                            $Image = $DataRow['image'];
                                        ?>
                                        <div class="one-news-small">
                                        
                                            <div class="row">
                                                <div class="col-3 no-padding-right">
                                                    <img src="upload/<?php echo $Image; ?>" alt="" class="img-fluid">
                                                    
                                                </div>
                                                <div class="col-9">
                                                    <a href="fullblog.php?id=<?php echo $PostId; ?>"><h5 style="margin-bottom: 0px; font-size:16px"><?php echo $Titile; ?></h5></a>
                                                    <div class="info-news">
                                                        <span><i class="fa fa-calendar"></i>&nbsp;<?php echo $DateTime; ?></span>
                                                        <span><i class="fa fa-tag"></i> <?php echo $Category; ?></span>
                                                    </div>
                                                    <div class="info-news">
                                                        <span><i class="fa fa-eye"></i> 30</span>
                                                        <span><i class="fa fa-comment"></i> 3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    
                                    </div>
                                    <div ng-show="current_tab == 2">
                                        <?php 
                                            $Query = "SELECT * FROM project ORDER BY datetime desc";
                                            $Execute =  mysqli_query($Connection, $Query);
                                            while($DataRow = mysqli_fetch_array($Execute)) {
                                            $PostId = $DataRow['id'];
                                            $DateTime = $DataRow['datetime'];
                                            $DateTime = substr($DateTime, 0, 18);
                                            $Titile = $DataRow['title'];
                                            $Image = $DataRow['image'];
                                            $Link = $DataRow['link'];
                                        ?>
                                        <div class="one-news-small">
                                        
                                            <div class="row">
                                                <div class="col-3 no-padding-right">
                                                    <img src="upload/<?php echo $Image; ?>" alt="" class="img-fluid">
                                                    
                                                </div>
                                                <div class="col-9">
                                                    <a href="<?php echo $Link; ?>"><h5 style="margin-bottom: 0px; font-size:16px"><?php echo $Titile; ?></h5></a>
                                                    <div class="info-news">
                                                        <span><i class="fa fa-calendar"></i>&nbsp;<?php echo $DateTime; ?></span>
                                                    </div>
                                                    <div class="info-news">
                                                        <span><i class="fa fa-eye"></i> 30</span>
                                                        <span><i class="fa fa-comment"></i> 3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div ng-show="current_tab == 3">
                                        <ul class="list-group">
                                            <?php 
                                                $Query = "SELECT * FROM category ORDER BY datetime desc";
                                                $Execute =  mysqli_query($Connection, $Query);
                                                while($DataRow = mysqli_fetch_array($Execute)) {
                                                    $Cate = $DataRow['name'];
                                                    $QueryCount = "SELECT COUNT(*) FROM post WHERE category='$Cate'";
                                                    $ExecuteCo = mysqli_query($Connection, $QueryCount);
                                                    $NumberCate = mysqli_fetch_array($ExecuteCo);
                                                    $NumCategory = array_shift($NumberCate);
                                                
                                            ?>                                 
                                          <li class="list-group-item"><?php echo $Cate; ?> <span class="badge badge-default ml-auto"><?php echo $NumCategory; ?></span></li>
                                          <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                </div>
            </div>
            
        </div>
    </footer>
</body>

</html>
