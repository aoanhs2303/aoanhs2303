<!DOCTYPE html>
<html lang="en">
<?php require_once("include/DB.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Function.php"); ?>

<?php 
if(isset($_POST['Submit'])) {
    $Name = $_POST['nameUser'];
    $Comment = $_POST['commentUser'];
    $PostId = $_GET['id'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $CurrentTime = time();
    $DateTime = strftime("%B-%m-%Y %H:%M:%S", $CurrentTime);
    if(empty($Name) || empty($Comment)) {
        $_SESSION['ErrorMessage'] = 'Điền gì đi chứ bạn. Sao để trống vậy';
        Redirect_to("fullblog.php?id={$PostId}");
    } else {
        global $Connection;
        $PostIDFromURL = $_GET['id'];
        $Query = "INSERT INTO comments(user, datetime, comment, post_id) VALUES('$Name', '$DateTime', '$Comment' ,'$PostIDFromURL')";
        $Execute = mysqli_query($Connection, $Query);
        if($Execute) {
            $_SESSION['SuccessMessage'] = 'Cám ơn bạn đã đóng góp ý kiến <3.';
            Redirect_to("fullblog.php?id={$PostId}");
        } else {
            $_SESSION['ErrorMessage'] = 'Đéo thêm được ? Éo hiểu vì sao';
            Redirect_to("fullblog.php?id={$PostId}");
        }
        
    }
}
?>
<head>
    <?php 
    global $Connection;
    $PostIdURL = $_GET['id'];
    $Query = "SELECT * FROM post WHERE id = '$PostIdURL'";
    $Execute = mysqli_query($Connection, $Query);
    while($DateRow = mysqli_fetch_array($Execute)) {     
        $TitleURL = $DateRow['title'];
    }

    ?> 
    <title> <?php echo $TitleURL; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="vendor/bootstrap.js"></script>
    <script type="text/javascript" src="vendor/angular.js"></script>
    <script type="text/javascript" src="vendor/angular-route.js"></script>
    <script type="text/javascript" src="main.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="hightlight/styles/atom-one-dark.css">
    <script src="hightlight/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
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
                            <a class="nav-link" href="#">Turtorial</a>
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
            <p id="desc">Website Developer</p>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row">
                
                <div class="col-sm-8 big-col-8">
                    <div class="feature">
                        <?php 
                        global $Connection;
                        $PostIdURL = $_GET['id'];
                        $Query = "SELECT * FROM post WHERE id = '$PostIdURL'";
                        $Execute = mysqli_query($Connection, $Query);
                        while($DateRow = mysqli_fetch_array($Execute)) {
                            $PostId = $DateRow['id'];
                            $Title = $DateRow['title'];
                            $Category = $DateRow['category'];
                            $Datetime = $DateRow['datetime'];
                            $Image = $DateRow['image'];
                            $Content = $DateRow['content'];
                        }
            
                        ?> 
                        <h2 class="titlefull"><?php echo $Title; ?></h2>
                        <div class="info-news">
                            <span><i class="fa fa-user"></i> AoAnhs2303</span>
                            <span><i class="fa fa-calendar"></i><?php echo $Datetime; ?></span>
                            <span><i class="fa fa-tag"></i><?php echo $Category; ?></span>
                            
                        </div>
                        <div class="img-featured mt-3">
                            <img src="upload/<?php echo $Image; ?>" alt="" class="img-fluid rounded">
                        </div>
                        <div class="content-full mt-3">
                            <?php echo nl2br($Content); ?>
                        </div>
                        
                    </div>
                    <hr>
                    <div class="comment mt-3" style="padding: 10px; background-color: #ccc; border-radius: 4px">
                        <h5 style="color: #e67e22;"><i class="fa fa-comment"></i> Bình luận</h5>
                        <?php 
                        global $Connection;
                        $PostIDFromURL = $_GET['id'];
                        $Query = "SELECT * FROM comments WHERE post_id = '$PostIDFromURL'";    
                        $Execute = mysqli_query($Connection, $Query);
                        while($DataRow = mysqli_fetch_array($Execute)) {
                            $Name = $DataRow['user'];
                            $DateTime = $DataRow['datetime'];
                            $Comment = $DataRow['comment'];
                        ?>
                        <div class="one-comment mt-1" style="background-color: #F6F7F9; padding: 10px">
                            <div class="row">
                                <div class="col-2">
                                    <img src="http://sohanews.sohacdn.com/2016/photo-7-1467618024092.jpg" alt="" class="img-fluid rounded">
                                </div>
                                <div class="col-sm-10 no-padding-left">
                                    <p class="name" style="margin-bottom: 0px; font-weight: bold"><?php echo $Name; ?></p>
                                    <div class="info-news">
                                        <span><i class="fa fa-user"></i> AoAnhs2303</span>
                                        <span><i class="fa fa-calendar"></i><?php echo $Datetime; ?></span>
                           

                                    </div>
                                    <div class="content-cm" style="font-size: 14px">
                                        <?php echo $Comment; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
<!--            COMMENT-->
               <hr>
                <div class="comment-form">
                    <h3 class="form-comm">Ý kiến của bạn</h3>
                    <form class="cmform" action="fullblog.php?id=<?php echo $PostId; ?>" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="nameUser" class="form-control" placeholder="Enter your name">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <textarea name="commentUser" cols="30" rows="3" class="form-control" placeholder="Give me your opinion"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="Submit" class="btn btn-info" value="Gửi bình luận" style="border-radius: 0px; background-color: #e67e22;border-color: #e67e22;">
                        </div>
                    </form>
                </div>

                    

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
                        <div class="bottom-ab">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <b>Posts</b><br>1000
                                </div>
                                <div class="col-4 text-center">
                                    <b>Comments</b><br>1000
                                </div>
                                <div class="col-4 text-center">
                                    <b>Share</b><br>1000
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
