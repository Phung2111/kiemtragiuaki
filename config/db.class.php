<?php // IDEA:
class Db
{
    protected static $connection;

    public function connect(){
        if(!isset(self::$connection)){
            $config = parse_ini_file("config.ini");
            $username = isset($config["username"]) ? $config["username"] : "";
            $password = isset($config["password"]) ? $config["password"] : "";
            $databasename = isset($config["databasename"]) ? $config["databasename"] : "";

            self::$connection = new mysqli("localhost", $username, $password, $databasename);
        }
        if(self::$connection->connect_errno){
            echo "Failed to connect to MySQL: " . self::$connection->connect_error;
            exit();
        }
        return self::$connection;
    }

    public function query_execute($queryString){
        $connection = $this->connect();
        $result = $connection->query($queryString);
        if(!$result){
            echo "Error executing query: " . $connection->error;
            exit();
        }
        return $result;
    }

    public function select_to_array($queryString){
        $row = array();
        $result = $this->query_execute($queryString);
        while($item = $result->fetch_assoc()){
            $row[] = $item;
        }
        // Đóng kết nối sau khi lấy hết dữ liệu từ kết quả truy vấn
        $result->close();
        return $row;
    }
}
?>
