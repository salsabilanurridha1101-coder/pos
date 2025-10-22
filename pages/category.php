<?php
$q_categories = mysqli_query($koneksi, "SELECT * FROM categories");
$categories = mysqli_fetch_all($q_categories, MYSQLI_ASSOC);
// var_dump($categories);
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $q_categories = mysqli_query($koneksi, "DELETE FROM categories WHERE id = $id");
    header("location:?page=category");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
</head>

<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Category</h3>
                    <div align="right">
                        <a href="?page=tambah-category" class="btn btn-outline-primary"><i class="bi bi-plus-circle"></i> Add category</a>
                    </div><br>
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                        <?php
                        foreach ($categories as $key => $category) {
                        ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $category['category_name'] ?></td>
                                <td>
                                    <a class="btn btn-outline-success" href="?page=tambah-category&edit=<?php echo $category['id'] ?>"> <i class="bi bi-pencil"></i></a>
                                    <form class="d-inline" action="?page=category&delete=<?php echo $category['id']?>" method="post" onclick="return confirm('ingin menghapusnya?')">
                                        <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            <?php
                        }
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>