<?php
class Label{
    var $id;
    var $labelname;
    function Label($id , $labelname )
    {
        $this->id = $id;
        $this->labelname = $labelname;
    }

    /**
     * xác thực người sử dụng
     * @param $userName string tên đăng nhập
     * @param $password string mật khẩu
     * @return label hoặc null nếu như k tồn tại
     */

    static function connect(){
        $con = new  mysqli("localhost","root","","danhba");
        $con->set_charset("utf8");//hướng đối tượng
        if($con->connect_error)
            die("kết nối thất bại. Chi tiết:".$con->connect_error);
        return $con;
    }



    static function getListLabelFromDB(){
        if(! isset($_SESSION["username"])) 
        header("location:login.php");
       
        $con = Label::connect();
        //b2: thao tác với csdl : CRUD

        $username = $_SESSION["username"];

        $sql = "SELECT * FROM label where `username` = '$username'";
        $result =  $con->query($sql);
        $lsLabel = array();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {//biên nó thành 1 mảng kết hợp
                $Label = new Label($row["id"],$row["labelname"]);
                array_push($lsLabel,$Label);
            }
        }
        //b3 : đóng kết nối
        $con->close();
        //echo "<h4>kết nối thành công<h4>";
        return $lsLabel;
    }

    static function addLabelToDB($labelname)
    {
        $con = Label::connect();
        $username = $_SESSION["username"];
        $sql="INSERT INTO `Label`( `labelname`,`username` ) VALUES ('$labelname','$username')";
        if (mysqli_query($con, $sql)) {
            echo "alert('New record created successfully')";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        //b3 : đóng kết nối
        $con->close();
    }

    static function addDanhBaToLabel($danhba_id, $label_id)
    {
        session_start();
        $con = Label::connect();
        $username = $_SESSION["username"];
        
            $sql = "INSERT INTO `label_danhba` ( `danhba_id`, `username`, `label_id`) VALUES ('$danhba_id','$username','$label_id')";
            if (mysqli_query($con, $sql)) {
                echo "alert('New record created successfully')";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        
        $con->close();
    }

    static function deleteLabelInDanhBa($id){
        $con = Label::connect();
        session_start();
        $username = $_SESSION["username"];
        $id_label = $_SESSION["idlabel"];

        $sql="DELETE FROM `label_danhba` WHERE danhba_id='$id' and username = '$username' and label_id = '$id_label' ";
        echo "<script>alert('Delete  successfully')</script> ";
        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Delete  successfully')</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        //b3 : đóng kết nối
        $con->close();
    }
    
    static function addPhonenumberToLabel($danhba_id, $label_id){ //sai tham khảo cái sai
        if(! isset($_SESSION["username"])) 
        header("location:login.php");
       
        $con = Label::connect();
        //b2: thao tác với csdl : CRUD
        $username = $_SESSION["username"];

        $sql = "INSERT INTO `label_danhba` ( `danhba_id`, `username`, `label_id`) VALUES ('$danhba_id','$username','$label_id')";
        $result =  $con->query($sql);
        // $sql = "SELECT * FROM label_danhba where `username` = '$username' and `danhba_id` = '$danhba_id' and `label_id` = '$label_id'";
        // $check = $con->query($sql);
        // if($check->num_rows <= 0){
        //     $sql = "INSERT INTO `label_danhba`( `danhba_id`, `username`, `label_id`) VALUES ('$danhba_id','$username','$label_id'";
        //     $result =  $con->query($sql);
        // }
        
        if (mysqli_query($con, $sql)) {
            echo "alert('New record created successfully')";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }

        //b3 : đóng kết nối
        $con->close();
        //echo "<h4>kết nối thành công<h4>";
        return $result;
    }
 
}
?>