<?php require_once("include/DB.php"); ?>
<?php require_once("include/Session.php"); ?>
<?php require_once("include/Function.php"); ?>

<?php 
    $Name = $_POST['user'];
    $Comment = $_POST['comment'];
    $PostId = $_POST['post_id'];
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $CurrentTime = time();
    $DateTime = strftime("%B-%m-%Y %H:%M:%S", $CurrentTime);
    if(empty($Name) || empty($Comment)) {
        $_SESSION['ErrorMessage'] = 'Điền gì đi chứ bạn. Sao để trống vậy';
        Redirect_to("fullblog.php?id={$PostId}");
    } else {
        global $Connection;
        $Query = "INSERT INTO comments(user, datetime, comment, post_id) VALUES('$Name', '$DateTime', '$Comment' ,'$PostId')";
        $Execute = mysqli_query($Connection, $Query);
        if($Execute) {
            $_SESSION['SuccessMessage'] = 'Cám ơn bạn đã đóng góp ý kiến <3.';
            Redirect_to("fullblog.php?id={$PostId}");
        } else {
            $_SESSION['ErrorMessage'] = 'Đéo thêm được ? Éo hiểu vì sao';
            Redirect_to("fullblog.php?id={$PostId}");
        }
        
    }
?>