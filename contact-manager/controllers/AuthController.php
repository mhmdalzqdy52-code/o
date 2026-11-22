<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends BaseController
{
    public function login(): void
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->checkCsrf();
            $user = User::findByUsername(trim($_POST['username'] ?? ''));
            if ($user && password_verify($_POST['password'] ?? '', $user['password_hash'])) {
                session_regenerate_id(true); // prevents session fixation
                $_SESSION['user_id'] = $user['id'];
                $this->redirect('index.php?page=contacts');
            }
            $error = 'Invalid username or password';
        }
        $this->render('auth/login', ['error' => $error]);
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect('index.php?page=auth&action=login');
    }
}
