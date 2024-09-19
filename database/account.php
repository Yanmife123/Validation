<?php
require('db_connect.php');
class addAccount
{
    protected $email;
    private $fullName;
    protected $password;
    public function __construct($formData,)
    {
        global $conn;
        $this->email = mysqli_real_escape_string($conn, $formData['email']);
        $this->fullName = mysqli_real_escape_string($conn, $formData['fullname']);
        $this->password = mysqli_real_escape_string($conn, $formData['password']);
    }
    public function viewProperties()
    {
        echo "your email: $this->email";
    }
    public function isEmailTaken()
    {
        global $conn;
        $query = "SELECT fullname FROM users WHERE email = '$this->email'";
        $result = mysqli_query($conn, $query);
        return empty(mysqli_fetch_assoc($result)) ? 0 : 1;
    }
    public function addTo_Database()
    {
        global $conn;
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users(fullname, password, email) VALUES('$this->fullName', '$passwordHash', '$this->email')";
        // if (!mysqli_query($conn, $query)) {
        //     echo mysqli_error($conn);
        // } else = 
        return !mysqli_query($conn, $query) ?  mysqli_error($conn) : "done";
    }
}

class loginValidate extends addAccount
{
    public $id;
    public function __construct($formData)
    {
        parent::__construct($formData);
    }
    public function emailExixts()
    {
        $exist = parent::isEmailTaken();
        if ($exist === 0) {
            return ['result' => 'notExist'];
        } else {
            return $this->verifyPassword();
        }
    }
    public function verifyPassword()
    {
        global $conn;
        $query = "SELECT password,id FROM users WHERE email = '$this->email'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            // $this->id = $data['id'];
            // return password_verify($this->password, $data['password']) ? 1 : 0;
            $result =  password_verify($this->password, $data['password']) ? 1 : 0;
            return ['id' => $data['id'], 'result' => $result];
        }
    }
}

$javascriptRequest = json_decode(file_get_contents('php://input'), true);
if ($javascriptRequest) {
    switch ($javascriptRequest['case']) {
        case 'email':
            $obj = new addAccount($javascriptRequest['formData']);
            // $obj->viewProperties();
            echo json_encode($obj->isEmailTaken());


            break;
        case 'Login':
            $obj = new loginValidate($javascriptRequest['formData']);
            echo json_encode($obj->emailExixts());
            break;
        default:
            # code...
            break;
    }
}
