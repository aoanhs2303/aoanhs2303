<?php require_once("include/DB.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Function.php"); ?>
<?php Confirm_Login(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Example </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="vendor/bootstrap.js"></script>
    <script type="text/javascript" src="vendor/angular.js"></script>
    <script type="text/javascript" src="vendor/angular-route.js"></script>
    
    <link rel="stylesheet" href="vendor/bootstrap.css">
    <link rel="stylesheet" href="vendor/font-awesome.css">
    <link rel="stylesheet" href="style-admin.css">
    
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i&amp;subset=vietnamese" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <i class="fa fa-weibo"></i>
                <span class="title-blog-header">My Blog</span>
                <div class="avatar mt-2">
                    <img src="http://baomoi-photo-1.zadn.vn/16/11/16/105/20847423/9_240302.jpg" alt="" style="height: 40px; width: 40px" class="rounded">
                    <b style="margin-left: 8px">AoAnhs2303</b>
                </div>
                <hr>
                <p class="menu-title">Menu</p>
            
                <ul class="dashboard nav flex-column nav-pills">
                    <li class="nav-item"><a  class="nav-link active" href="dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a></li>
                    <li class="nav-item"><a  class="nav-link" href="addnewpost.php"><i class="fa fa-file-text-o"></i>&nbsp;Add New Post</a></li>
                    <li class="nav-item"><a  class="nav-link" href="addnewproject.php"><i class="fa fa-rocket"></i>&nbsp;Add New Project</a></li>
                    <li class="nav-item"><a  class="nav-link" href="addnewcategory.php"><i class="fa fa-pie-chart"></i>&nbsp;Categories</a></li>
                    <li class="nav-item"><a  class="nav-link" href=""><i class="fa fa-comments"></i>&nbsp;Comment</a></li>
                    <li class="nav-item"><a class="nav-link"  href="index.php"><i class="fa fa-line-chart"></i>&nbsp;Live blog</a></li>
                    <li class="nav-item"><a  class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
                </ul>
            </div>
            <div class="col-10" style="background: #444; height: 1000px">
                <nav class="navbar navbar-light bg-faded">
                    <h1 class="navbar-brand mb-0">Dashboard</h1>
                </nav>
                <?php 
                //Xuat thong bao
                echo Success();
                echo Error();
                ?>
                <table class="table table-hover" style="background-color: #FFF">
                    <thead class="thead-inverse">
                    <tr>
                        <th>No.</th>
                        <th>Post Title</th>
                        <th>Date Time</th>
                        <th>Category</th>
                        <th>Banner</th>
                        <th>Comments</th>
                        <th style="width: 150px">Action</th>
                        <th>Detail</th>
                    </tr>
                    </thead>
                    <?php 
                    global $Connection;
                    $Query = "SELECT * FROM post ORDER BY datetime desc";
                    $Execute = mysqli_query($Connection, $Query);
                    $No = 0;
                    while($DataRow = mysqli_fetch_array($Execute)) {
                        $PostID = $DataRow['id'];
                        $Title = $DataRow['title'];
                        $Category = $DataRow['category'];
                        $Datetime = $DataRow['datetime'];
                        $Image = $DataRow['image'];
                        $Content = $DataRow['content'];
                        $No++;
                    ?>
                    <tr>
                        <td><?php echo $No; ?></td>
                        <td><?php echo $Title; ?></td>
                        <td><?php echo $Datetime; ?></td>
                        <td><?php echo $Category; ?></td>
                        <td><img src="upload/<?php echo $Image; ?>" alt="" height="100px" width="200px" class="rounded"></td>
                        <td>Processing</td>
                        <td>
                            <a href="editpost.php?id=<?php echo $PostID; ?>" class="btn btn-success btn-sm">Edit</a> &nbsp;
                            <a href="deletepost.php?id=<?php echo $PostID; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                        <td><a href="fullpost.php?id=<?php echo $PostID; ?>" class="btn btn-info btn-sm">Live Preview</a></td>
                    </tr>
                    <?php } ?> 
                </table>
                    <nav class="navbar navbar-light bg-info">
                        <h1 class="navbar-brand mb-0">Project</h1>
                    </nav>
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Banner</th>
                        <th>Date & Time</th>
                    </tr>
                    <?php 
                    global $Connection;
                    $Query = "SELECT * FROM project ORDER BY datetime desc";
                    $Execute = mysqli_query($Connection, $Query);
                    $No = 0;
                    while($DataRow = mysqli_fetch_array($Execute)) {
                        $PostID = $DataRow['id'];
                        $Title = $DataRow['title'];                  
                        $Datetime = $DataRow['datetime'];
                        $Image = $DataRow['image'];
                        $No++;
                    ?>
                    <tr>
                        <td><?php echo $No; ?></td>
                        <td><?php echo $Title; ?></td>
                        <td><img src="upload/<?php echo $Image; ?>" alt="" height="100px" width="200px" class="rounded"></td>
                        <td><?php echo $Datetime; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                
            </div>
            
            
        </div>
    </div>
</body>
</html>






