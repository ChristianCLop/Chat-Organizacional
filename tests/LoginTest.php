<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase {
    public function testInicioSesionTodosDatos()
    {
        $_POST['email'] = 'john.freire@gmail.com';
        $_POST['password'] = '12345';

        ob_start();

        include './php/login.php';

        $output = ob_get_clean();

        $this->assertEquals('success', $output);
        $this->assertArrayHasKey('unique_id', $_SESSION);
        $this->assertNotEmpty($_SESSION['unique_id']);
    }
    public function testInicioSesionCorreoNoRegistrado()
    {
        $_POST['email'] = 'pedro@gmail.com';
        $_POST['password'] = '12345';

        ob_start();

        include './php/login.php';

        $output = ob_get_clean();

        $this->assertEquals('pedro@gmail.com - Este correo no esta registrado!', $output);
        $this->assertArrayNotHasKey('unique_id', $_SESSION);
    }

   
}
?>
