<?php
class DanhBa{
    #Begin properties
    var $id;
    var $name;
    var $phonenumber;
    var $email;

    #Construct function
    function DanhBa($id , $name , $phonenumber, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phonenumber = $phonenumber;
        $this->email = $email;
    }
    
    // static function authentication($userName , $password)
    // {
    //     if($userName == "hoang" && $password== "123")
    //     {
    //         return new User($userName , $password ,"hoang");
    //     }
    //     else return null;
    // }

    static function connect(){
        $con = new  mysqli("localhost","root","","danhba");
        $con->set_charset("utf8");//hướng đối tượng
        if($con->connect_error)
            die("kết nối thất bại. Chi tiết:".$con->connect_error);
        return $con;
    }
    static function getListDanhBaFromDB(){
       
        $con = DanhBa::connect();
        //b2: thao tác với csdl : CRUD

        $username = $_SESSION["username"];

        $sql = "SELECT * FROM danhba where username='$username'";
        $result =  $con->query($sql);
        $lsDanhba = array();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {//biên nó thành 1 mảng kết hợp
                $Danhba = new DanhBa($row["id"],$row["name"],$row["phonenumber"],$row["email"]);
                array_push($lsDanhba,$Danhba);
            }
        }
        //b3 : đóng kết nối
        $con->close();
        //echo "<h4>kết nối thành công<h4>";
        return $lsDanhba;
    }

    static function addDanhBaToDB($content)
    {
        $con = DanhBa::connect();
        $username = $_SESSION["username"];
        $sql="INSERT INTO `DanhBa`( `name`, `phonenumber`, `email`,`username`) VALUES ('$content[0]','$content[1]','$content[2]','$username')";
       // $result =  $con->query($sql);
        if (mysqli_query($con, $sql)) {
            echo "alert('New record created successfully')";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        //b3 : đóng kết nối
        $con->close();
    }

    static function editDanhBaDB($content){
        $con = DanhBa::connect();
        $sql="UPDATE `danhba` SET `name`='$content[1]',`phonenumber`='$content[2]',`email`='$content[3]' WHERE id='$content[0]'";
        if (mysqli_query($con, $sql)) {
            echo "alert('New record created successfully')";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        $con->close();
    }
    
    static function deleteDanhBaDB($id){
        $con = DanhBa::connect();
        $sql="DELETE FROM `danhba` WHERE id='$id'";
        if (mysqli_query($con, $sql)) {
            echo "alert('Delete  successfully')";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
        //b3 : đóng kết nối
        $con->close();
    }

    static function searchDanhBaByLabel( $id_label){
        session_start();
        $_SESSION["idlabel"] = $id_label;
        $con = DanhBa::connect();
        $username = $_SESSION["username"];
        // $sql="SELECT * FROM `danhba` WHERE name LIKE '%$name%'";
        $sql="SELECT distinct danhba.* FROM danhba INNER JOIN label_danhba
        on danhba.id = label_danhba.danhba_id WHERE danhba.username = '$username' and label_danhba.label_id = '$id_label'";
        $result =  $con->query($sql);
        $lsDanhBa = array();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {//biên nó thành 1 mảng kết hợp
                $danhba = new DanhBa($row["id"],$row["name"],$row["phonenumber"],$row["email"]);
                array_push($lsDanhBa,$danhba);
            }
        }
        //b3 : đóng kết nối
        $con->close();
        //echo "<h4>kết nối thành công<h4>";
        return $lsDanhBa;
    }

}
?>