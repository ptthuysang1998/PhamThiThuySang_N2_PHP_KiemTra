<?php
class User{
    var $userName;
    var $password;
    function User($userName , $password )
    {
        $this->userName = $userName;
        $this->password = $password;
    }
    /**
     * xác thực người sử dụng
     * @param $userName string tên đăng nhập
     * @param $password string mật khẩu
     * @return user hoặc null nếu như k tồn tại
     */

    static function connect(){
        $con = new  mysqli("localhost","root","","danhba");
        $con->set_charset("utf8");//hướng đối tượng
        if($con->connect_error)
            die("kết nối thất bại. Chi tiết:".$con->connect_error);
        return $con;
    }



    static function authentication($userName , $password)
    {
        $con = user::connect();
        $sql = "SELECT * FROM user where `username`= '$userName' and `password`= '$password' ";
        $result =  $con->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $user = new user($row["username"],$row["password"]);
            return $user;
        }
        return null;
    }
 
}
?>