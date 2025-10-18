<?php
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT r.name AS role_name, u.* FROM users u LEFT JOIN roles r ON r.id = u.role_id WHERE u.deleted_at IS NOT NULL ORDER BY u.id ");
$users = mysqli_fetch_all($query, MYSQLI_ASSOC);

//disini parameter delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM users WHERE id = $id");
    //redirect
    header("location: user.php?hapus=sukses");
}
if (isset($_GET['restore'])) {
    $id = $_GET['restore'];
    $restore = mysqli_query($koneksi, "UPDATE users SET deleted_at = NULL WHERE id = $id");
    //redirect
    header("location: user.php?restore=sukses");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restore Data User</title>
</head>

<body>
    <h1>Restore Data User</h1>
    <div align="right">
        <a href="user.php">Back</a>
    </div>
    <table class="table" border="1" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $value): ?>
                <tr>
                    <td><?php echo $key += 1 ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['email'] ?></td>
                    <td><?php echo $value['role_name'] ?></td>
                    <td>
                        <a href="user-restore.php?restore=<?php echo $value['id'] ?>" onclick="return confirm('ingin restore data ini?')">Restore Data</a>
                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="user-restore.php?delete=<?php echo $value['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>