<?php

$selectCategories = mysqli_query($koneksi, "SELECT id, category_name FROM categories");
$categories = mysqli_fetch_all($selectCategories, MYSQLI_ASSOC);

if (isset($_POST['simpan'])) {
    $id = $_POST['category_id'];
    $p_name = $_POST['product_name'];
    $p_price = $_POST['product_price'];
    $p_description = $_POST['product_description'];
    $p_photo =$_FILES ['product_photo'];
    // var_dump($p_photo); 

    $filepath ="assets/uploads/".time()."-". $p_photo['name'];
    move_uploaded_file($p_photo['tmp_name'], $filepath);

    $insertProduct = mysqli_query($koneksi, "INSERT INTO products (category_id, product_name, product_price, product_description, product_photo) VALUES ('$id', '$p_name', '$p_price', '$p_description','$filepath')");
    if ($insertProduct) {
        header("location:?page=product");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="card">
        <div class="card-body"><br>
            <h3 class="">Tambah Product</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="w-50">
                    <label for="">Category Name</label>
                    <select class="form-select" name="category_id" required>
                        <option value=""> ----- Pilih Kategori ------</option>
                        <?php
                        foreach ($categories as $c) {
                        ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['category_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <label for="" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" required><br>
                    <label for="" class="form-label">Photo</label>
                    <input type="file" class="form-control" name="product_photo"><br>
                    <label for="" class="form-label">Price</label>
                    <input type="number" class="form-control" name="product_price"><br>
                    <label for="" class="form-label">Description</label><br>
                    <textarea name="product_description" id="" class="form control" cols="30" rows="5"></textarea><br>
                    <button type="submit" name="simpan" class="btn btn-primary mt-2">ADD</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>