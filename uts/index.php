<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Smart Shopping List</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
</head>
<body>

<div class="app">
    <aside class="sidebar">
        <div class="brand">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Smart Shop</span>
        </div>

        <div class="sidebar-section">
            <label class="toggle">
                <input type="checkbox" id="darkToggle">
                <span>Dark Mode</span>
            </label>
        </div>
        <button id="openFormSchedule" class="btn primary">
            <i class="fa-solid fa-plus"></i> Tambah Scedule
        </button>

        <div class="sidebar-section">
        </div>

        <div id="schedulesList" class="sidebar-section schedules">
        </div>

        <div class="sidebar-section small">
            <small>Tips: klik "Selesai" untuk tandai item sudah dibeli. Total & diskon dihitung otomatis.</small>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <h1><i class="fa-solid fa-list-check"></i> Daftar Belanja</h1>
            <div class="total-card">
                <div>Total</div>
                <div id="totalDisplay">Rp0</div>
            </div>
        </header>

        <section class="controls">
            <input id="searchInput" placeholder="Cari barang..." />
            <button id="openFormBtn" class="btn primary">
                <i class="fa-solid fa-plus"></i> Tambah Barang
            </button>
        </section>

        <section id="listWrap" class="list-wrap">
        </section>
    </main>
</div>

<div id="modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <button class="modal-close" id="modalClose">&times;</button>
        <h2>Tambah Barang</h2>
        <form id="itemForm">
            <div class="form-row">
                <label>Nama Barang <span class="req">*</span></label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-tag"></i>
                    <input type="text" id="itemName" required />
                </div>
            </div>
            <div class="form-row">
                <label>Jumlah <span class="req">*</span></label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-hashtag"></i>
                    <input type="number" id="itemQty" min="1" value="1" required />
                </div>
            </div>
            <div class="form-row">
                <label>Harga per Barang (Rp) <span class="req">*</span></label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-money-bill"></i>
                    <input type="number" id="itemPrice" min="0" step="100" value="0" required />
                </div>
            </div>
            <div class="form-row">
                <label>Deskripsi</label>
                <div class="input-textarea">
                    <textarea name="description" id="itemDescription"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn primary">Simpan</button>
                <button type="button" id="modalCancel" class="btn">Batal</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <button class="modal-close" id="editModalClose">&times;</button>
        <h2>Edit Barang</h2>
        <form id="editItemForm">
            <div class="form-row">
                <label>Nama Barang <span class="req">*</span></label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-tag"></i>
                    <input type="text" id="editItemName" required />
                </div>
            </div>
            <div class="form-row">
                <label>Jumlah <span class="req">*</span></label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-hashtag"></i>
                    <input type="number" id="editItemQty" min="1" required />
                </div>
            </div>
            <div class="form-row">
                <label>Harga per Barang (Rp) <span class="req">*</span></label>
                <div class="input-with-icon">
                    <i class="fa-solid fa-money-bill"></i>
                    <input type="number" id="editItemPrice" min="0" step="100" required />
                </div>
            </div>
            <div class="form-row">
                <label>Deskripsi</label>
                <div class="input-textarea">
                    <textarea id="editItemDescription"></textarea>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn primary">Simpan Perubahan</button>
                <button type="button" id="editModalCancel" class="btn">Batal</button>
            </div>
        </form>
    </div>
</div>


<div id="modalSchedule" class="modal" aria-hidden="true">
    <div class="modal-content">
        <button class="modal-close" id="modalScheduleClose">&times;</button>
        <h2>Tambah Barang</h2>
        <form id="scheduleForm">
            <div class="form-row">
                <label>Nama Schedule <span class="req">*</span></label>
                <div class="input-with-icon">
                    <input type="text" id="scheduleName" required />
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn primary">Simpan</button>
                <button type="button" id="modalScheduleCancel" class="btn">Batal</button>
            </div>
        </form>
    </div>
</div>

<div id="deleteModal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <h2 >Konfirmasi Hapus</h2>
        <p id="deleteMessage"></p>
        <div class="form-actions">
            <button id="confirmDeleteBtn" class="btn danger">Hapus</button>
            <button id="cancelDeleteBtn" class="btn">Batal</button>
        </div>
    </div>
</div>

<div id="alertModal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <h2 id="alertHeader"></h2>
        <p id="alertMessage"></p>
        <div class="form-actions">
            <button id="okBtn" class="btn">Ok</button>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>
</body>
</html>
