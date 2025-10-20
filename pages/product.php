<?php
// require_once 'config/koneksi.php';
$q_products = mysqli_query($koneksi, "SELECT p.*,c.category_name AS c_name FROM products AS p LEFT JOIN categories AS c ON p.category_id= c.id ORDER BY p.id DESC");
$products = mysqli_fetch_all($q_products, MYSQLI_ASSOC);



if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $s_photo = mysqli_query($koneksi, "SELECT product_photo FROM products WHERE id = $id");
    $row = mysqli_fetch_assoc($s_photo);
    $filePath = $row['product_photo'];

    if (file_exists($filePath)) {
        unlink($filePath);
    }
    $delete = mysqli_query($koneksi, "DELETE FROM products WHERE id = $id");
    if ($delete) {
        header("location:?page=product");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>

<body>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Product</h3>
                    <div align='right' class="d-flex-justify-content-end p-2">
                        <a href="?page=tambah-product">Tambah</a>
                    </div>
                    <table class="table table-bordered  text-center">
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>Product Photo</th>
                            <th>Product Price</th>
                            <th>Product Description</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($products as $key => $v) {
                        ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $v['c_name'] ?></td>
                                <td><?php echo $v['product_name'] ?></td>
                                <td> <img src="<?php echo $v['product_photo'] ?>" width="115" alt=""> </td>
                                <td><?php echo $v['product_price'] ?></td>
                                <td><?php echo $v['product_description'] ?></td>
                                <td>
                                    <a href="?page=tambah-product&edit=<?php echo $v['id'] ?>" class="btn btn-outline-success"><i class="bi bi-trash">edit</i></a>
                                    <a href="?page=product&delete=<?php echo $v['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('really wnna delete??')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>