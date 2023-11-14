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
<div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Yeni Çalışan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="completename" class="form-label">İsim</label>
                    <input type="text" class="form-control" id="completename" placeholder="isminizi giriniz">
                </div>
                <div class="mb-3">
                    <label for="completephone" class="form-label">Telefon</label>
                    <input type="text" class="form-control" id="completephone" placeholder="telefon numaranızı giriniz">
                </div>

                <div class="mb-3">
                    <label for="completerole" class="form-label">Rol</label>
                    <input type="text" class="form-control" id="completerole" placeholder="rolunuzu giriniz">
                </div>

                <div class="mb-3">
                    <label for="completemail" class="form-label">Mail</label>
                    <input type="email" class="form-control" id="completemail" placeholder="mail adresinizi giriniz">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="adduser()">Ekle</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<!--Update user Modal-->
<div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kullanıcıyı Düzenle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="updatename" class="form-label">İsim</label>
                    <input type="text" class="form-control" id="updatename" placeholder="isminizi giriniz">
                </div>

                <div class="mb-3">
                    <label for="updatephone" class="form-label">Telefon</label>
                    <input type="text" class="form-control" id="updatephone" placeholder="telefon numaranızı giriniz">
                </div>

                <div class="mb-3">
                    <label for="updaterole" class="form-label">Rol</label>
                    <input type="text" class="form-control" id="updaterole" placeholder="rolunuzu giriniz">
                </div>

                <div class="mb-3">
                    <label for="updatemail" class="form-label">Mail</label>
                    <input type="email" class="form-control" id="updatemail" placeholder="mail adresinizi giriniz">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="EditUserDetails()">Düzenle</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                <input type="hidden" id="hiddendata">
            </div>
        </div>
    </div>
</div>


<div class="container my-5">
    <button type="button" class="btn btn-dark my-5" data-bs-toggle="modal" data-bs-target="#addEmployee">+ Çalışan Ekle</button>
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
<script src="/js/employee.js"></script>