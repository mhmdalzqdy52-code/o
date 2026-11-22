<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Manager</title>
<style>
 body{font-family:Arial,sans-serif;max-width:800px;margin:30px auto;padding:0 15px}
 table{width:100%;border-collapse:collapse}th,td{border:1px solid #ccc;padding:8px;text-align:left}
 .err{color:#b00020}label{display:block;margin-top:10px}input{padding:6px;width:100%;box-sizing:border-box}
 nav{margin-bottom:20px}button,.btn{padding:6px 12px;cursor:pointer}form.inline{display:inline}
</style>
</head>
<body>
<nav>
 <a href="index.php?page=contacts">Contacts</a> |
 <?php if (!empty($_SESSION['user_id'])): ?>
   <a href="index.php?page=contacts&action=add">Add contact</a> |
   <a href="index.php?page=auth&action=logout">Logout</a>
 <?php else: ?>
   <a href="index.php?page=auth&action=login">Admin login</a>
 <?php endif; ?>
</nav>
