$(function () {
    const API_URL = 'api.php';
    const DARK_KEY = 'smartshop_dark';
    const $modal = $('#modal');
    const $modalConfirm = $('#deleteModal');
    const $editModal = $('#editModal');
    const $editForm = $('#editItemForm');
    const $modalSchedule = $('#modalSchedule');
    const $modalAlert = $('#alertModal');
    const $confirm = $('#confirmDeleteBtn');
    const $closeConfirm = $('#cancelDeleteBtn');
    const $closeAlert = $('#okBtn');
    const $openItemModal = $('#openFormBtn');
    const $closeItemModal = $('#modalClose, #modalCancel');
    const $openScheduleModal = $('#openFormSchedule');
    const $closeScheduleModal = $('#modalScheduleClose, #modalScheduleCancel');
    const $schedulesList = $('#schedulesList');
    const $scheduleForm = $('#scheduleForm');
    const $scheduleName = $('#scheduleName');
    const $itemForm = $('#itemForm');
    const $listWrap = $('#listWrap');
    const $totalDisplay = $('#totalDisplay');
    const $search = $('#searchInput');
    let currentScheduleId = null;
    let editingItemId = null;
    let schedules = [];


    function showModalAlert(type, header, message) {
        const $alert = $('#alertModal');
        const alertHeader = $('#alertHeader');
        const alertMessage = $('#alertMessage');
        alertHeader.text('');
        alertMessage.text('');
        let color;
        switch (type) {
            case 'success': color = '#16a34a'; break;
            case 'failed': color = '#dc2626'; break;
            default: color = '#ca8a04'; break;
        }
        alertHeader.html(`<strong style="color:${color}">${header}</strong>`);
        alertMessage.html(message);
        $alert.fadeIn(180).css('display', 'flex');
    }

    function hideModalAlert() { $modalAlert.fadeOut(180); }
    $closeAlert.on('click', hideModalAlert);


    function showModalConfirm(id, type, message) {
        $('#deleteMessage').text(message);
        $modalConfirm.data('deleteId', id).data('deleteType', type).fadeIn(180).css('display', 'flex');
    }

    function hideModalConfirm() { 
        $modalConfirm.fadeOut(180); 
    }

    $closeConfirm.on('click', hideModalConfirm);
    $modalConfirm.on('click', e => { if (e.target === e.currentTarget) hideModalConfirm(); });


    function showItemModal() {
        if (!schedules.length) return showModalAlert('alert', 'Alert', 'Harus membuat schedule terlebih dahulu!');
        $modal.css('display', 'flex').hide().fadeIn(180);
        $('#itemName').focus();
    }

    function hideItemModal() { 
        $modal.fadeOut(180, () => $itemForm.trigger('reset')); 
    }

    $openItemModal.on('click', showItemModal);
    $closeItemModal.on('click', hideItemModal);
    $modal.on('click', e => { if (e.target === e.currentTarget) hideItemModal(); });

    function showScheduleModal() { 
        $modalSchedule.css('display', 'flex').hide().fadeIn(180); 
    }

    function hideScheduleModal() { 
        $modalSchedule.fadeOut(180, () => $scheduleForm.trigger('reset')); 
    }

    $openScheduleModal.on('click', showScheduleModal);
    $closeScheduleModal.on('click', hideScheduleModal);
    $modalSchedule.on('click', e => { if (e.target === e.currentTarget) hideScheduleModal(); });

    function showModalEdit(itemId) {
        const s = schedules.find(x => x.id === currentScheduleId);
        if (!s) return showModalAlert('failed', 'Gagal', 'Schedule tidak ditemukan.');
        const item = s.items.find(x => x.id === itemId);
        if (!item) return showModalAlert('failed', 'Gagal', 'Item tidak ditemukan.');
        $('#editItemName').val(item.name);
        $('#editItemQty').val(item.qty);
        $('#editItemPrice').val(item.price);
        $('#editItemDescription').val(item.description);
        editingItemId = itemId;
        $editModal.css('display', 'flex').hide().fadeIn(180);
    }

    function hideModalEdit() { 
        $editModal.fadeOut(180, () => $editForm.trigger('reset')); editingItemId = null; 
    }

    $('#editModalCancel').on('click', hideModalEdit);
    $editModal.on('click', e => { if (e.target === e.currentTarget) hideModalEdit(); });

    function setCookie(name, value, days = 30) {
        const d = new Date();
        d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = `${name}=${value};expires=${d.toUTCString()};path=/`;
    }

    function getCookie(name) {
        const match = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
        return match ? decodeURIComponent(match.pop()) : null;
    }

    $('#darkToggle').on('change', function () {
        const isDark = $(this).is(':checked');
        $('body').toggleClass('dark', isDark);
        setCookie(DARK_KEY, isDark ? '1' : '0');
    });
    
    if (getCookie(DARK_KEY) === '1') {
        $('#darkToggle').prop('checked', true);
        $('body').addClass('dark');
    }

    function fetchSchedules() {
        return $.getJSON(API_URL, { action: 'get' }, data => {
            schedules = data;
            renderSchedules(schedules);
        });
    }

    function renderSchedules(schedules) {
        $schedulesList.empty();
        if (!schedules.length) {
            $schedulesList.append('<p class="empty-text">Belum ada schedule.</p>');
            $listWrap.html('<p class="empty-text">Pilih atau buat schedule terlebih dahulu.</p>');
            updateTotal();
            return;
        }
        schedules.forEach(sc => {
            const el = $(`<div class="sched-item ${sc.id === currentScheduleId ? 'active' : ''}" data-id="${sc.id}">
                <span class="sched-title">${escapeHtml(sc.title)}</span>
                <button class="small-btn red del-sched" title="Hapus schedule">&times;</button>
            </div>`);
            el.find('.sched-title').on('click', () => { currentScheduleId = sc.id; renderSchedules(schedules); });
            el.find('.del-sched').on('click', e => { e.stopPropagation(); showModalConfirm(sc.id, 'schedule', 'Anda yakin ingin menghapus schedule ini?'); });
            $schedulesList.append(el);
        });
        if (!currentScheduleId) currentScheduleId = schedules[0].id;
        const selected = schedules.find(x => x.id === currentScheduleId);
        renderItems(selected ? selected.items : []);
        updateTotal();
    }

    function renderItems(items) {
        $listWrap.empty();
        if (!items.length) return $listWrap.html('<p class="empty-text">Belum ada item di schedule ini.</p>');
        items.forEach(it => {
            const card = $(`<div class="item-card ${it.done ? 'done' : ''}" data-id="${it.id}">
                <div class="item-left">
                    <h3>${escapeHtml(it.name)}</h3>
                    <p>${it.qty} × Rp${formatNumber(it.price)} = Rp${formatNumber(it.qty * it.price)}</p>
                    <p>${escapeHtml(it.description)}</p>
                    <div class="item-meta">ID: ${it.id}</div>
                </div>
                <div class="item-actions">
                    <button class="small-btn green toggle-btn">${it.done ? 'Belum' : 'Selesai'}</button>
                    <button class="small-btn yellow edit-btn"><i class="fa fa-pencil"></i></button>
                    <button class="small-btn red del-btn"><i class="fa fa-trash"></i></button>
                </div>
            </div>`);
            card.find('.toggle-btn').on('click', () => toggleItemDone(it.id));
            card.find('.edit-btn').on('click', () => showModalEdit(it.id));
            card.find('.del-btn').on('click', () => showModalConfirm(it.id, 'item', 'Anda yakin ingin menghapus item ini?'));
            $listWrap.append(card);
        });
    }

    $confirm.on('click', function () {
        const id = $modalConfirm.data('deleteId');
        const type = $modalConfirm.data('deleteType');
        hideModalConfirm();

        if (type === 'schedule') {
            $.post(API_URL, { action: 'delete_schedule', id }, res => {
                showModalAlert(res.status, res.status === 'success' ? 'Berhasil' : 'Gagal', res.message);
                fetchSchedules();
            }, 'json');
        } else {
            $.post(API_URL, { action: 'delete_item', schedule_id: currentScheduleId, item_id: id }, res => {
                showModalAlert(res.status, res.status === 'success' ? 'Berhasil' : 'Gagal', res.message);
                fetchSchedules();
            }, 'json');
        }
    });

    $scheduleForm.on('submit', e => {
        e.preventDefault();
        const title = $scheduleName.val().trim();
        if (!title) {
            return showModalAlert('failed', 'Gagal', 'Nama schedule tidak boleh kosong!');
        }
        $.post(API_URL, { action: 'add_schedule', title }, res => {
            showModalAlert(res.status, res.status === 'success' ? 'Berhasil' : 'Gagal', res.message);
            hideScheduleModal();
            fetchSchedules();
        }, 'json');
    });

    $itemForm.on('submit', e => {
        e.preventDefault();
        const name = $('#itemName').val().trim();
        const qty = parseInt($('#itemQty').val());
        const price = parseFloat($('#itemPrice').val());
        const description = $('#itemDescription').val().trim();

        if (!name) {
            return showModalAlert('failed', 'Gagal', 'Nama barang tidak boleh kosong!');
        }
        if (!qty || qty <= 0) {
            return showModalAlert('failed', 'Gagal', 'Jumlah harus lebih dari 0!');
        }
        if (isNaN(price) || price < 0) {
            return showModalAlert('failed', 'Gagal', 'Harga tidak boleh negatif!');
        }

        $.post(API_URL, { action: 'add_item', schedule_id: currentScheduleId, name, qty, price, description }, res => {
            showModalAlert(res.status, res.status === 'success' ? 'Berhasil' : 'Gagal', res.message);
            hideItemModal();
            fetchSchedules();
        }, 'json');
    });

    $editForm.on('submit', e => {
        e.preventDefault();
        const name = $('#editItemName').val().trim();
        const qty = parseInt($('#editItemQty').val());
        const price = parseFloat($('#editItemPrice').val());
        const description = $('#editItemDescription').val().trim();

        if (!name) {
            return showModalAlert('failed', 'Gagal', 'Nama barang tidak boleh kosong!');
        }
        if (!qty || qty <= 0) {
            return showModalAlert('failed', 'Gagal', 'Jumlah harus lebih dari 0!');
        }
        if (isNaN(price) || price < 0) {
            return showModalAlert('failed', 'Gagal', 'Harga tidak boleh negatif!');
        }

        $.post(API_URL, { action: 'update_item', schedule_id: currentScheduleId, item_id: editingItemId, name, qty, price, description }, res => {
            showModalAlert(res.status, res.status === 'success' ? 'Berhasil' : 'Gagal', res.message);
            hideModalEdit();
            fetchSchedules();
        }, 'json');
    });

    function toggleItemDone(id) {
        $.post(API_URL, { action: 'toggle_item', schedule_id: currentScheduleId, item_id: id }, res => {
            showModalAlert(res.status, res.status === 'success' ? 'Berhasil' : 'Gagal', res.message);
            fetchSchedules();
        }, 'json');
    }

    $search.on('input', function () {
        const q = $(this).val().toLowerCase();
        $('.item-card').each(function () {
            const text = $(this).find('h3').text().toLowerCase();
            $(this).toggle(text.includes(q));
        });
    });

    function formatNumber(n) {
        if (n === null || n === undefined) return '0';
        const num = Number(n) || 0;
        const parts = Math.round(num).toString().split('');
        return parts.join('').replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function escapeHtml(s) {
        if (s === null || s === undefined) return '';
        return String(s).replace(/[&<>"']/g, function (m) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }[m];
        });
    }

    function updateTotal() {
        let total = 0;
        if (!Array.isArray(schedules)) schedules = [];
        const s = schedules.find(x => x.id === currentScheduleId);
        if (s && Array.isArray(s.items)) {
            total = s.items.reduce((sum, it) => {
                const qty = Number(it.qty) || 0;
                const price = Number(it.price) || 0;
                return sum + qty * price;
            }, 0);
        }
        $totalDisplay.text('Rp' + formatNumber(total));
    }

    function init() {
        fetchSchedules()
            .done(() => {
                if (!currentScheduleId && schedules.length) currentScheduleId = schedules[0].id;
                renderSchedules(schedules);
                updateTotal();
            })
            .fail(() => {
                showModalAlert('failed', 'Gagal', 'Gagal mengambil data dari server.');
            });
    }

    init();
});
