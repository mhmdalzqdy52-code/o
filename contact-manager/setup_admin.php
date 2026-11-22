
<?php
if (php_sapi_name() !== 'cli') { exit('Run from the command line only.'); }
require __DIR__ . '/models/Database.php';

echo 'Username: ';
$username = trim(fgets(STDIN));
echo 'Password (min 8 chars): ';
$password = trim(fgets(STDIN));
if ($username === '' || strlen($password) < 8) { exit("Invalid input.\n"); }

$st = Database::connect()->prepare(
    'INSERT INTO users (username, password_hash) VALUES (:u, :p)'
);
$st->execute([':u' => $username, ':p' => password_hash($password, PASSWORD_DEFAULT)]);
echo "User '$username' created.\n";