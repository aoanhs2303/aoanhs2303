<?php require_once('include/DB.php'); ?>
<?php require_once('include/Session.php'); ?>
<?php require_once('include/Function.php'); ?>
<?php Confirm_Login(); ?>

<?php 
    if(isset($_POST['Submit'])) {
        $Category = $_POST['category'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $CurrentTime = time();
        $DateTime = strftime("%B-%m-%Y %H:%M:%S", $CurrentTime);
        if (empty($Category)) {
            $_SESSION["ErrorMessage"] = "Sao mày đéo điền gì hết vậy";
            Redirect_to("addnewcategory.php");
        } elseif(strlen($Category) > 50) {
            $_SESSION["ErrorMessage"] = "Điền nhiều thế. Dưới 50 ký tự thôi nhé";
            Redirect_to("addnewcategory.php");
        } else {
            global $Connection;
            mysqli_set_charset($Connection, 'utf8');
            $Query = "INSERT INTO category(datetime, name) VALUES('$DateTime', '$Category')";
            $Execute = mysqli_query($Connection, $Query);
            if($Execute) {
                $_SESSION["SuccessMessage"] = "Ngon ! Thêm được rồi nhé";
                Redirect_to("addnewcategory.php");
            } else {
                $_SESSION["ErrorMessage"] = "Lỗi con mẹ nó rồi";
                Redirect_to("addnewcategory.php");
            }
        }
    }
?>


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
                    <li class="nav-item"><a  class="nav-link" href="dashboard.php"><i class="fa fa-home"></i>&nbsp;Dashboard</a></li>
                    <li class="nav-item"><a  class="nav-link" href="addnewpost.php"><i class="fa fa-file-text-o"></i>&nbsp;Add New Post</a></li>
                    <li class="nav-item"><a  class="nav-link active" href="addnewcategory.php"><i class="fa fa-pie-chart"></i>&nbsp;Categories</a></li>
                    <li class="nav-item"><a  class="nav-link" href=""><i class="fa fa-comments"></i>&nbsp;Comment</a></li>
                    <li class="nav-item"><a class="nav-link"  href="index.php"><i class="fa fa-line-chart"></i>&nbsp;Live blog</a></li>
                    <li class="nav-item"><a  class="nav-link" href=""><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
                </ul>
            </div>
            <div class="col-10" style="background: #444">
                <nav class="navbar navbar-light bg-faded">
                    <h1 class="navbar-brand mb-0">Add new category</h1>
                </nav>
                <?php 
                //Xuat thong bao
                echo Success();
                echo Error();
                ?>
                <div class="content">
                    <form method="post" action="addnewcategory.php" style="background-color: #FFF; padding: 40px" >
                        <div class="form-group">
                            <label for="category">Add new category</label>
                            <input type="text" name="category" class="form-control" id="category" placeholder="Write a new category">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="Submit" class="btn btn-success">
                        </div>
                    </form>    
                </div>
                
                
                <div class="result-category mt-3">
                    <nav class="navbar navbar-light bg-info">
                        <h1 class="navbar-brand mb-0">All Category</h1>
                    </nav>
                    <table class="table table-hover" style="background-color: #FFF">
                        <thead class="thead-inverse">
                        <tr>
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>Date &amp; Time</th>           
                        </tr>    
                        </thead>
                        
                        <?php 
                            global $Connection;
                            $ViewQuery = "SELECT * FROM category ORDER BY id desc";
                            $Execute = mysqli_query($Connection, $ViewQuery);
                            $No = 0;
                            while ($DataRow = mysqli_fetch_array($Execute)){
                                $Id = $DataRow['id'];
                                $DateTime = $DataRow['datetime'];
                                $CategoryName = $DataRow['name'];
                                $No++;
                            
                        ?>
                        <tr>
                            <td><?php echo $No; ?></td>
                            <td><?php echo $CategoryName; ?></td>
                            <td><?php echo $DateTime; ?></td>
                        </tr>
                        
                        <?php } ?> 
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>






