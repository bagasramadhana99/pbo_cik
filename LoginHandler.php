<?php
class LoginHandler {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }

    public function validateLogin() {
        // Hardcoded username and password for demonstration
        if ($this->username === "admin" && $this->password === "admin123") {
            $_SESSION['username'] = $this->username;
            $this->redirect('admin_dashboard.php', 'Login sebagai Admin berhasil!');
        } elseif ($this->username === "user" && $this->password === "user123") {
            $this->redirect('home.php', 'Login sebagai User berhasil!');
        } else {
            return "Username atau password salah!";
        }
        return null;
    }

    private function redirect($url, $message) {
        echo "<script>alert('$message'); window.location.href='$url';</script>";
        exit();
    }
}
?>
