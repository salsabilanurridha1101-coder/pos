<?php
include '../config/koneksi.php';

$queryCat = mysqli_query($koneksi, "SELECT * FROM categories");
$fetchCats = mysqli_fetch_all($queryCat, MYSQLI_ASSOC);

// query product
$queryProducts = mysqli_query($koneksi, "SELECT c.category_name,p.* FROM products p LEFT JOIN categories c ON c.id = p.category_id");
$fetchProducts = mysqli_fetch_all($queryProducts, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Of Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/css/salsa.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
</head>

<body>




    <!-- container-fluid -->
    <div class="container-fluid container-pos">
        <div id="card">
            <!-- <h3>Nama Product</h3>
            <p>Description product</p> -->
        </div>
        <div class="row h-100">
            <div class="col-md-7 product-section">
                <div class="mb-4">
                    <h4 class="mb-3" id="product-title">
                        <i class="fas fas-store"></i>product
                    </h4>
                    <input type="text" id="searchProduct" class="form-control search-box" placeholder="find the product..">
                </div>
                <div class="mb-4">
                    <button class="btn btn-warning category-btn active" onclick="filterCategory('all', this)">All Menu</button>
                    <?php foreach ($fetchCats as $cat): ?>
                        <button class="btn btn-outline-warning category-btn " onclick="filterCategory('<?php echo $cat['category_name'] ?>', this)"><?php echo $cat['category_name'] ?></button>
                    <?php endforeach ?>
                    <!-- <button class="btn btn-outline-warning category-btn ">Drink</button>
                    <button class="btn btn-outline-warning category-btn ">Snack</button> -->
                </div>
                <div class="row" id="productGrid"></div>

            </div>
            <div class="col-md-5 cart-section">
                <div class="cart-header">
                    <h4>cart</h4>
                    <small>Order # <span class="orderNumber">001</span></small>
                </div>
                <div class="cart-items" id="cartItems">
                    <div class="text-center text-muted mt-5">
                        <i class="bi bi-cart mb-3"></i>
                        <p>cart the empty </p>
                    </div>
                </div>

                <div class="cart-footer">
                    <div class="total-section">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal :</span>
                            <span id="Subtotal">Rp. 100.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pajak (10%) :</span>
                            <span id="tax">Rp. 10.000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total :</span>
                            <span id="total">Rp. 110.000</span>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-6">
                            <button class="btn btn-outline-danger w-100">
                                <i class="bi bi-trash"></i> Clear Cart
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-checkout btn-primary w-100">
                                <i class="bi bi-cash"></i> Process Payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous">
        </script>
        <script>
            const products = <?php echo json_encode($fetchProducts); ?>
        </script>

        <script src="../assets/js/salsa.js"></script>
</body>

</html>