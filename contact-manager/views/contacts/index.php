<h2>Contacts</h2>
<table>
 <tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Created</th><?php if (!empty($_SESSION['user_id'])): ?><th>Actions</th><?php endif; ?></tr>
 <?php foreach ($contacts as $c): ?>
 <tr>
  <td><?= (int)$c['id'] ?></td>
  <td><?= e($c['name']) ?></td>
  <td><?= e($c['email']) ?></td>
  <td><?= e($c['phone']) ?></td>
  <td><?= e($c['created_at']) ?></td>
  <?php if (!empty($_SESSION['user_id'])): ?>
  <td>
   <a href="index.php?page=contacts&action=edit&id=<?= (int)$c['id'] ?>">Edit</a>
   <form class="inline" method="post" action="index.php?page=contacts&action=delete" onsubmit="return confirm('Delete this contact?')">
    <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
    <input type="hidden" name="id" value="<?= (int)$c['id'] ?>">
    <button type="submit">Delete</button>
   </form>
  </td>
  <?php endif; ?>
 </tr>
 <?php endforeach; ?>
</table>
