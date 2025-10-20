<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$selectCategory = mysqli_query($koneksi, "SELECT category_name FROM categories WHERE id = '$id'");
$category = mysqli_fetch_assoc($selectCategory);

if (isset($_POST['simpan'])) {
    $category_name = $_POST['category_name'];
    $insert = mysqli_query($koneksi, "INSERT INTO categories (category_name) VALUES ('$category_name')");

    header("location:?page=category");
}
if (isset($_POST['update'])) {
    $category_name = $_POST['category_name'];
    $update = mysqli_query($koneksi, "UPDATE categories SET category_name ='$category_name' WHERE id = 
    $id");
    header('location:?page=category');
}
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $q_delete = mysqli_query($koneksi, "DELETE FROM categories WHERE id = $id");
    header("location:?page=category");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
</head>

<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="card"><br>
                <div class="card-body">
                    <h1><?php echo isset($_GET['edit']) ? 'Update' : 'Tambah' ?> Kategori</h1><br>
                    <form action="" method="post">
                        <label for="" class="form-label">Category Name *</label><br>
                        <input type="text" class="form-control w-50" name="category_name" value="<?php echo $category['category_name'] ?? '' ?>"><br><br>
                        <button type="submit" class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan' ?>"> <?php echo isset($_GET['edit']) ? 'Edit' : 'Create' ?> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>