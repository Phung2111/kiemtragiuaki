<?php // IDEA:
 // require_once("/config/db.class.php");
 require_once(__DIR__ . '/../config/db.class.php');

class Nhanvien
{
    public $Ma_NV;
    public $Ten_NV;
    public $Phai;
    public $Noi_Sinh;
    public $Ma_Phong;
    public $Luong;
  

    public function __construct($Ma_NV, $Ten_NV,$Phai,$Noi_Sinh,$Ma_Phong, $Luong)
    {
        $this->Ma_NV = $Ma_NV;
        $this-> Ten_NV= $Ten_NV;
        $this->Phai = $Phai;
        $this-> Noi_Sinh =$Noi_Sinh;
        $this->Ma_Phong =$Ma_Phong;
        $this->Luong = $Luong;
    }

    public function save(){
        $db = new Db();
        $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$this->Ma_NV', '$this->Ten_NV', '$this->Phai', '$this->Noi_Sinh', '$this->Ma_Phong', '$this->Luong')";
        $result = $db->query_execute($sql);
        return $result;

    }

    //public static function getAllCategories(){
    //    $db = new Db();
     //   $sql = "SELECT * FROM Category";
     //   $result = $db->select_to_array($sql);
     //   return $result;
    //}

    public static function list_nhanvien(){
        $db = new Db();
        $sql = "SELECT * FROM nhanvien";
        $result = $db-> select_to_array($sql);
        return $result;
    }

    public static function count_nhanvien(){
        $db = new Db();
        $sql = "SELECT COUNT(*) AS total FROM nhanvien";
        $result = $db->query_execute($sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    public static function list_nhanvien_paging($offset, $records_per_page){
        $db = new Db();
        $sql = "SELECT * FROM nhanvien LIMIT $offset, $records_per_page";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
?>