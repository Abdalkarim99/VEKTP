<?php
ini_set('display_errors', 0);
require 'auth.php';
require 'includes/database.php';
$conn = getDB();
$error = '';
session_start();

if (!isset($_SESSION['company_id'])) {
    header('Location: login.php'); // Redirect to login page
    exit;
}

?>
<?php require 'includes/header.php' ?>


<!-- Modal -->
<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ürün Ekle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="completename" class="form-label">Ürün Adı</label>
                    <input type="text" class="form-control" id="completename" placeholder="ürün adını gir">
                </div>
                <div class="mb-3">
                    <label for="completecode" class="form-label">Ürün Kodu</label>
                    <input type="text" class="form-control" id="completecode" placeholder="ürün kodunu gir">
                </div>

                <div class="mb-3">
                    <label for="completecategory" class="form-label">Ürün Kategorisi</label>
                    <input type="text" class="form-control" id="completecategory" placeholder="ürün kategorisini gir">
                </div>

                <div class="mb-3">
                    <label for="completestock" class="form-label">Stok Sayısı</label>
                    <input type="email" class="form-control" id="completestock" placeholder="stok numarasını gir">
                </div>
                <div class="mb-3">
                    <label for="completeprice" class="form-label">Ürün Fiyatı</label>
                    <input type="email" class="form-control" id="completeprice" placeholder="ürün fiyatını gir">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="addproduct()">Ekle</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<!--Update user Modal-->
<div class="modal fade" id="updateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ürünü Düzenle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="updatename" class="form-label">Ürün Adı</label>
                    <input type="text" class="form-control" id="updatename" placeholder="ürün adını gir">
                </div>

                <div class="mb-3">
                    <label for="updatecode" class="form-label">Ürün Kodu</label>
                    <input type="text" class="form-control" id="updatecode" placeholder="ürün kodunu gir">
                </div>

                <div class="mb-3">
                    <label for="updatecategory" class="form-label">Ürün Kategorisi</label>
                    <input type="text" class="form-control" id="updatecategory" placeholder="ürün kategorisini gir">
                </div>

                <div class="mb-3">
                    <label for="updatestock" class="form-label">Stok Sayısı</label>
                    <input type="email" class="form-control" id="updatestock" placeholder="stok numarasını gir">
                </div>
                <div class="mb-3">
                    <label for="updateprice" class="form-label">Ürün Fiyatı</label>
                    <input type="email" class="form-control" id="updateprice" placeholder="ürün fiyatını gir">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="EditProductDetails()">Düzenle</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                <input type="hidden" id="hiddendata">
            </div>
        </div>
    </div>
</div>


<div class="container my-5">
    <button type="button" class="btn btn-dark my-5 col-2" data-bs-toggle="modal" data-bs-target="#addProduct">+Ürün Ekle</button>

    <div class="dropdown">
        <button class="btn btn-dark d-grid col-2 mx-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="position: absolute; top:-80px; right:50px;">Filtre</button>
        <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button" name="name" id="name" onclick="fitlerName()">Ad</button></li>
            <li><button class="dropdown-item" type="button" name="category" id="category" onclick="fitlerCategory()">Kategori</button></li>
            <li><button class="dropdown-item" type="button" name="price" id="price" onclick="fitlerPrice()">Fiyat</button></li>
        </ul>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="container my-2">
                <input type="text" class="form-control" id="searchInput" placeholder="Ara...">
            </div>
        </div>
    </div>
    <div id="displayDataTable"></div>
</div>


<?php require 'includes/footer.php' ?>
<script src="/js/inventory.js"></script>