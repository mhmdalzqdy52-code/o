<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Contact.php';

class ContactController extends BaseController
{
    // Anyone can view the list
    public function index(): void
    {
        $this->render('contacts/index', ['contacts' => Contact::all()]);
    }

    public function add(): void
    {
        $this->requireLogin();
        $errors = [];
        $old = ['name' => '', 'email' => '', 'phone' => ''];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->checkCsrf();
            [$old, $errors] = $this->validate();
            if (!$errors) {
                Contact::create($old['name'], $old['email'], $old['phone']);
                $this->redirect('index.php?page=contacts');
            }
        }
        $this->render('contacts/form', ['title' => 'Add contact', 'errors' => $errors, 'contact' => $old]);
    }

    public function edit(): void
    {
        $this->requireLogin();
        $id = (int)($_GET['id'] ?? 0);
        $contact = Contact::find($id);
        if (!$contact) {
            http_response_code(404);
            exit('Contact not found');
        }
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->checkCsrf();
            [$contact, $errors] = $this->validate();
            if (!$errors) {
                Contact::update($id, $contact['name'], $contact['email'], $contact['phone']);
                $this->redirect('index.php?page=contacts');
            }
        }
        $this->render('contacts/form', ['title' => 'Edit contact', 'errors' => $errors, 'contact' => $contact]);
    }

    public function delete(): void
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // delete only via POST
            $this->checkCsrf();
            Contact::delete((int)($_POST['id'] ?? 0));
        }
        $this->redirect('index.php?page=contacts');
    }

    private function validate(): array
    {
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
        ];
        $errors = [];
        if ($data['name'] === '' || mb_strlen($data['name']) > 100) {
            $errors[] = 'Name is required (max 100 characters).';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email is not valid.';
        }
        if (!preg_match('/^[0-9+\-\s]{7,20}$/', $data['phone'])) {
            $errors[] = 'Phone must be 7-20 digits (+, - and spaces allowed).';
        }
        return [$data, $errors];
    }
}
