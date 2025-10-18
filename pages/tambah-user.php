<?php
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM users WHERE id= '$id'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['update'])) {
    // $_POST  (buat nampung data dari form)
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($password) {
        $query = mysqli_query($koneksi, "UPDATE users SET name= '$name', email= '$email' WHERE id= '$id'");
    } else {
        $query = mysqli_query($koneksi, "UPDATE users SET name= '$name', email= '$email' WHERE id= '$id'");
    }

    if ($query) {
        header("location:user.php?ubah=berhasil");
    }
}

if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "INSERT INTO users (name , email , password) VALUES ('$name','$email','$password')");

    if ($query) {
        header("location:user.php?tambah=berhasil");
    }
};

?>


<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">
                    <?php echo isset($_GET['edit']) ? 'Edit' : 'Add' ?> User
                </h3>
                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Name *</label>
                        <input type="name" name="name" class="form-control" placeholder="Enter your name babe" required value="<?php echo $rowEdit['name'] ?? '' ?>">
                    </div><br>
                    <div class="mb-3">
                        <label for="" class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email babe" required value="<?php echo $rowEdit['email'] ?? '' ?>">
                    </div><br>
                    <div class="mb-3">
                        <label for="" class="form-label">Password * <small>kosongkan jika tidak ingin mengubah</small></label><br>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password babe">
                    </div><br>
                    <div class="mb-3">
                        <button class="btn btn-success" type="submit" name="<?php echo ($id) ? 'update' : 'simpan' ?>">
                            <?php echo ($id) ? 'simpan perubahan' : 'simpan' ?>
                        </button>
                        <button class="btn btn-warning" style="text-color: white;">
                            <a href="user.php">Back</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>