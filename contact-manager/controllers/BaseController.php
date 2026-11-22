<?php
// Shared helpers: rendering views, auth check, CSRF protection
class BaseController
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . "/../views/$view.php";
        require __DIR__ . '/../views/layout/footer.php';
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    protected function requireLogin(): void
    {
        if (empty($_SESSION['user_id'])) {
            $this->redirect('index.php?page=auth&action=login');
        }
    }

    protected function checkCsrf(): void
    {
        $token = $_POST['csrf'] ?? '';
        if (!hash_equals($_SESSION['csrf'] ?? '', $token)) {
            http_response_code(403);
            exit('Invalid CSRF token');
        }
    }
}
