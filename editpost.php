<?php require_once('include/DB.php'); ?>
<?php require_once('include/Session.php'); ?>
<?php require_once('include/Function.php'); ?>
<?php Confirm_Login(); ?>

<?php 
    if(isset($_POST['Submit'])) {
        $Title = $_POST['title'];
        $Content = $_POST['post'];
        $Category = $_POST['Category'];
        $Image = $_FILES["Image"]["name"];
        $Target="upload/".basename($_FILES["Image"]["name"]); 
        
        if($Image) {
            
        } else {
            $Image = $_POST['imageBefore'];
        }
            
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $CurrentTime = time();
        $DateTime = strftime("%B-%m-%Y %H:%M:%S", $CurrentTime);
        
        if (empty($Category) || empty($Title) || empty($Content)) {
            $_SESSION["ErrorMessage"] = "Sao mày đéo điền gì hết vậy";
            Redirect_to("addnewpost.php");
        } elseif(strlen($Title) > 500) {
            $_SESSION["ErrorMessage"] = "Điền nhiều thế. Dưới 50 ký tự thôi nhé";
            Redirect_to("addnewpost.php");
        } else {
            global $Connection;
            $PostIDFromURL = $_GET['id'];
            $Query = "UPDATE post SET datetime='$DateTime', title='$Title', category='$Category', image='$Image', content='$Content' WHERE id = '$PostIDFromURL' ";
            $Execute = mysqli_query($Connection, $Query);
            move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
            if($Execute) {
                $_SESSION["SuccessMessage"] = "Ngon ! sửa được rồi nhé";
                Redirect_to("addnewpost.php");
            } else {
                $_SESSION["ErrorMessage"] = "Lỗi con mẹ nó rồi";
                Redirect_to("addnewpost.php");
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
    <link rel="icon" type="image/ico" href="images/favicon.ico" />
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
                    <li class="nav-item"><a  class="nav-link" href="addnewpicture.php"><i class="fa fa-picture-o"></i>&nbsp;Picture</a></li>
                    <li class="nav-item"><a  class="nav-link" href="addnewcategory.php"><i class="fa fa-pie-chart"></i>&nbsp;Categories</a></li>
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
                <?php 
                global $Connection;
                $PostID = $_GET['id'];
                $ViewQuery = "SELECT * FROM post WHERE id = '$PostID'";
                $Execute = mysqli_query($Connection, $ViewQuery);
                while($DataRow = mysqli_fetch_array($Execute)) {
                    $Id = $DataRow['id'];
                    $DateTime = $DataRow['datetime'];
                    $Title = $DataRow['title'];
                    $Category = $DataRow['category'];
                    $Content = $DataRow['content'];
                    $Image = $DataRow['image'];
                }
                ?>
                <div class="content">
                    <form method="post" action="editpost.php?id=<?php echo $PostID; ?>" style="background-color: #FFF; padding: 40px" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="category" placeholder="Title of the Post" value="<?php echo $Title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="category">Category : đã chọn <b><?php echo $Category; ?></b></label>
                            <select class="form-control" id="categoryselect" name="Category">
                            <?php 
                                global $Connection;
                                $ViewQuery = "SELECT * FROM category ORDER BY datetime desc";
                                $Execute = mysqli_query($Connection, $ViewQuery);
                                while($DataRow = mysqli_fetch_array($Execute)) {
                                    $Id = $DataRow['id'];
                                    $Category = $DataRow['name'];
                                ?>
                                <option><?php echo $Category; ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                        <input type="hidden" name="imageBefore" value="<?php echo $Image; ?>">
                            <b>Hình đã được chọn trước đó: </b>
                        <img src="upload/<?php echo $Image; ?>" alt="" style="width: 300px" class="rounded-top">
                            <br>
                            <label for="imageselect">Select Image</label>
                            <input type="file" class="form-control" name="Image" id="imageselect">
                        </div>
                        <div class="form-group">
                            <label for="postarea">Content</label>
                            <textarea name="post" id="postarea" cols="30" rows="6" class="form-control"><?php echo $Content; ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="Submit" class="btn btn-warning" value="Sửa">
                        </div>
                    </form>    
                </div>
                
                

            </div>
        </div>
    </div>
</body>
</html>






