<?php

require_once("config/db.class.php");

class User
{
    public $id;
    public $username;
    public $password;
    public $fullname;
    public $email;
    public $role;

    public function __construct($username, $password, $fullname, $email, $role)
    {
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->role = $role;
    }

    public static function getUserByUsername($username)
    {
        $db = new Db();
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $db->select_to_array($sql);
        if ($result) {
            $user = new User(
                $result[0]['username'],
                $result[0]['password'],
                $result[0]['fullname'],
                $result[0]['email'],
                $result[0]['role']
            );
            return $user;
        } else {
            return null;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
