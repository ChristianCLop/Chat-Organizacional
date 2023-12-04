<?php
use PHPUnit\Framework\TestCase;


class RegistroTest extends TestCase {
    public function testRegistro()
    {
        $_POST['fname'] = 'John';
        $_POST['lname'] = 'Freire';
        $_POST['email'] = 'johnfreire@gmail.com';
        $_POST['password'] = '12345';
        $image = [
            'name' => 'Captura2.PNG',
            'type' => 'image/png',
            'tmp_name' => 'C:\xampp\tmp\phpCB2C.tmp',
            'error' => 0,
            'size' => 25925,
        ];
        $_FILES['image']=$image;        
        $_SESSION['unique_id'] = 123;

        $_SERVER['REQUEST_METHOD'] = 'POST';
        ob_start();
        include './php/signup.php';
        $output = ob_get_clean();
        $this->assertEquals('success', $output);
    }
}
?>


