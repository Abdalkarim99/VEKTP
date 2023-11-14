<?php
ini_set('display_errors', 0);
require 'includes/database.php';
require 'auth.php';
require 'url.php';

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
<div class="modal fade" id="addDocument" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Doküman Ekle</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="completedate" class="form-label">Tarih</label>
                    <input type="date" class="form-control" id="completedate">
                </div>
                <div class="mb-3">
                    <label for="completereference" class="form-label">Referans Numarası</label>
                    <input type="text" class="form-control" id="completereference">
                </div>

                <div class="mb-3">
                    <label for="completeinvoice" class="form-label">Fatura Numarası</label>
                    <input type="text" class="form-control" id="completeinvoice">
                </div>

                <div class="mb-3">
                    <label for="completepaid" class="form-label">Ödeme Yöntemi</label>
                    <input type="text" class="form-control" id="completepaid">
                </div>
                <div class="mb-3">
                    <label for="completemail" class="form-label">Mail</label>
                    <input type="email" class="form-control" id="completemail">
                </div>
                <div class="mb-3">
                    <form enctype="multipart/form-data">
                        <input type="file" name="pdf" class="form-control" id="pdf">
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="addDocument()">Ekle</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>


<div class="container my-5">
    <button type="button" class="btn btn-dark my-5 col-2" data-bs-toggle="modal" data-bs-target="#addDocument"> + Doküman Ekle</button>

    <div class="dropdown">
        <button class="btn btn-dark d-grid col-2 mx-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="position: absolute; top:-85px; right:50px;">Filtre</button>
        <ul class="dropdown-menu">
            <li><button class="dropdown-item" type="button" name="referenceNo" id="referenceNo" onclick="fitlerReferenceNo()">Referans Numarası</button></li>
            <li><button class="dropdown-item" type="button" name="email" id="email" onclick="fitlerEmail()">Mail</button></li>
            <li><button class="dropdown-item" type="button" name="date" id="date" onclick="fitlerDate()">Tarih</button></li>
        </ul>
    </div>

    <div id="displayDataTable"></div>
</div>

<?php require 'includes/footer.php' ?>

<script src="/js/archive.js"></script>