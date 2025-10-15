$(function () {
    /*** CONSTANTS & ELEMENTS ***/
    const STORAGE_KEY = 'smartshop_schedules';
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

    /*** COOKIE HELPERS ***/
    function setCookie(name, value, days = 30) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${encodeURIComponent(value)};expires=${d.toUTCString()};path=/`;
    }

    function getCookie(name) {
        const match = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');
        return match ? decodeURIComponent(match.pop()) : null;
    }

    /*** ALERT MODAL ***/
    function showModalAlert(type, header, message) {
        const $alert = $('#alertModal');
        const alertHeader = $('#alertHeader');
        const alertMessage = $('#alertMessage');

        // Reset isi modal
        alertHeader.text('');
        alertMessage.text('');

        // Atur warna atau ikon berdasarkan tipe alert
        let color;
        switch (type) {
            case 'success':
                color = '#16a34a'; // hijau
                break;
            case 'failed':
                color = '#dc2626'; // merah
                break;
            default:
                color = '#ca8a04'; // kuning (alert)
                break;
        }

        // Isi konten alert
        alertHeader.html(`<strong style="color:${color}">${header}</strong>`);
        alertMessage.html(message);

        // Tampilkan modal
        $alert.fadeIn(180).css('display', 'flex');
    }

    function hideModalAlert() {
        $modalAlert.fadeOut(180);
    }

    $closeAlert.on('click', hideModalAlert);

    /*** CONFIRM DELETE MODAL ***/
    function showModalConfirm(id, type, message) {
        $('#deleteMessage').text(message);
        $modalConfirm
            .data('deleteId', id)
            .data('deleteType', type)
            .fadeIn(180)
            .css('display', 'flex');
    }

    function hideModalConfirm() {
        $modalConfirm.fadeOut(180);
    }

    $closeConfirm.on('click', hideModalConfirm);
    $modalConfirm.on('click', e => {
        if (e.target === e.currentTarget) hideModalConfirm();
    });

    /*** ITEM MODAL ***/
    function showItemModal() {
        const schedules = getSchedules();
        if (!schedules.length) {
            showModalAlert('alert', 'Alert', 'Harus membuat schedule terlebih dahulu!');
            return;
        }
        $modal.css('display', 'flex').hide().fadeIn(180);
        $('#itemName').focus();
    }

    function hideItemModal() {
        $modal.fadeOut(180, () => $itemForm.trigger('reset'));
    }

    $openItemModal.on('click', showItemModal);
    $closeItemModal.on('click', hideItemModal);
    $modal.on('click', e => {
        if (e.target === e.currentTarget) hideItemModal();
    });

    /*** SCHEDULE MODAL ***/
    function showScheduleModal() {
        $modalSchedule.css('display', 'flex').hide().fadeIn(180);
    }

    function hideScheduleModal() {
        $modalSchedule.fadeOut(180, () => $scheduleForm.trigger('reset'));
    }

    $openScheduleModal.on('click', showScheduleModal);
    $closeScheduleModal.on('click', hideScheduleModal);
    $modalSchedule.on('click', e => {
        if (e.target === e.currentTarget) hideScheduleModal();
    });

    function showModalEdit(itemId) {
        const schedules = getSchedules();
        const s = schedules.find(x => x.id === currentScheduleId);
        if (!s) return showModalAlert('failed', 'Gagal', 'Schedule tidak ditemukan.');

        const item = s.items.find(x => x.id === itemId);
        if (!item) return showModalAlert('failed', 'Gagal', 'Item tidak ditemukan.');

        // Isi form dengan data item yang mau diedit
        $('#editItemName').val(item.name);
        $('#editItemQty').val(item.qty);
        $('#editItemPrice').val(item.price);
        $('#editItemDescription').val(item.description);

        editingItemId = itemId;
        $editModal.css('display', 'flex').hide().fadeIn(180);
    }

    // Sembunyikan modal edit
    function hideModalEdit() {
        $editModal.fadeOut(180, () => $editForm.trigger('reset'));
        editingItemId = null;
    }

    $('#editModalCancel').on('click', hideModalEdit);

    $editModal.on('click', e => {
        if (e.target === e.currentTarget) hideModalEdit();
    });

    /*** DARK MODE ***/
    $('#darkToggle').on('change', function () {
        const isDark = $(this).is(':checked');
        $('body').toggleClass('dark', isDark);
        setCookie(DARK_KEY, isDark ? '1' : '0');
    });

    if (getCookie(DARK_KEY) === '1') {
        $('#darkToggle').prop('checked', true);
        $('body').addClass('dark');
    }

    /*** DATA HANDLERS ***/
    function getSchedules() {
        try {
            return JSON.parse(getCookie(STORAGE_KEY)) || [];
        } catch {
            return [];
        }
    }

    function setSchedules(schedules) {
        setCookie(STORAGE_KEY, JSON.stringify(schedules));
        renderSchedules(schedules);
    }

    /*** RENDERING ***/
    function renderSchedules(schedules) {
        $schedulesList.empty();

        if (!schedules.length) {
            $schedulesList.append('<p class="empty-text">Belum ada schedule. Tambah schedule di sidebar.</p>');
            $listWrap.html('<p class="empty-text">Pilih atau buat schedule terlebih dahulu.</p>');
            updateTotal();
            return;
        }

        schedules.forEach(sc => {
            const el = $(`
                <div class="sched-item ${sc.id === currentScheduleId ? 'active' : ''}" data-id="${sc.id}">
                    <span class="sched-title">${escapeHtml(sc.title)}</span>
                    <button class="small-btn red del-sched" title="Hapus schedule">&times;</button>
                </div>
            `);

            el.find('.sched-title').on('click', () => {
                currentScheduleId = sc.id;
                renderSchedules(getSchedules());
            });

            el.find('.del-sched').on('click', e => {
                e.stopPropagation();
                showModalConfirm(sc.id, 'schedule', 'Anda yakin ingin menghapus schedule ini?');
            });

            $schedulesList.append(el);
        });

        if (!currentScheduleId) currentScheduleId = schedules[0].id;

        const selected = schedules.find(x => x.id === currentScheduleId);
        renderItems(selected ? selected.items || [] : []);
        updateTotal();
    }

    function renderItems(items) {
        $listWrap.empty();

        if (!items.length) {
            $listWrap.html('<p class="empty-text">Belum ada item di schedule ini.</p>');
            return;
        }

        items.forEach(it => {
            const card = $(`
                <div class="item-card ${it.done ? 'done' : ''}" data-id="${it.id}">
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
                </div>
            `);

            card.find('.toggle-btn').on('click', () => toggleItemDone(it.id));
            card.find('.edit-btn').on('click', () => showModalEdit(it.id));
            card.find('.del-btn').on('click', () => showModalConfirm(it.id, 'item', 'Anda yakin ingin menghapus item ini?'));

            $listWrap.append(card);
        });
    }

    /*** ACTIONS ***/
    // Delete confirm
    $confirm.on('click', function () {
        const deleteId = $modalConfirm.data('deleteId');
        const deleteType = $modalConfirm.data('deleteType');
        let schedules = getSchedules();

        if (deleteType === 'schedule') {
            const before = schedules.length;
            schedules = schedules.filter(sc => sc.id !== deleteId);
            if (schedules.length < before) {
                setSchedules(schedules);
                currentScheduleId = null;
                showModalAlert('success', 'Berhasil', 'Schedule berhasil dihapus.');
            } else {
                showModalAlert('failed', 'Gagal', 'Schedule tidak ditemukan.');
            }
        } else {
            const schedule = schedules.find(x => x.id === currentScheduleId);
            if (schedule) {
                const before = schedule.items.length;
                schedule.items = schedule.items.filter(it => it.id !== deleteId);
                setSchedules(schedules);
                if (schedule.items.length < before)
                    showModalAlert('success', 'Berhasil', 'Item berhasil dihapus.');
                else
                    showModalAlert('failed', 'Gagal', 'Item tidak ditemukan.');
            }
        }

        hideModalConfirm();
    });

    // Schedule form
    $scheduleForm.on('submit', e => {
        e.preventDefault();
        const title = $scheduleName.val().trim();
        if (!title) return shake($scheduleName);

        const schedules = getSchedules();
        const id = Date.now();
        schedules.push({ id, title, items: [] });
        currentScheduleId = id;
        setSchedules(schedules);
        showModalAlert('success', 'Berhasil', 'Schedule berhasil dibuat.');
        hideScheduleModal();
    });

    // Item form
    $itemForm.on('submit', e => {
        e.preventDefault();
        const name = $('#itemName').val().trim();
        const qty = parseInt($('#itemQty').val());
        const price = parseFloat($('#itemPrice').val());
        const description = $('#itemDescription').val().trim();

        if (!name) return shake($('#itemName'));
        if (!qty || qty <= 0) return shake($('#itemQty'));
        if (isNaN(price) || price < 0) return shake($('#itemPrice'));
        if (!currentScheduleId) return showModalAlert('alert', 'Alert', 'Silakan pilih atau buat schedule terlebih dahulu.');

        const schedules = getSchedules();
        const schedule = schedules.find(x => x.id === currentScheduleId);
        if (!schedule) return showModalAlert('failed', 'Gagal', 'Schedule tidak ditemukan.');

        schedule.items.push({ id: Date.now(), name, qty, price, description, done: false });
        setSchedules(schedules);
        showModalAlert('success', 'Berhasil', 'Item berhasil ditambahkan.');
        hideItemModal();
    });

    $editForm.on('submit', function (e) {
        e.preventDefault();
        const name = $('#editItemName').val().trim();
        const qty = parseInt($('#editItemQty').val());
        const price = parseFloat($('#editItemPrice').val());
        const description = $('#editItemDescription').val().trim();

        if (!name) return shake($('#editItemName'));
        if (!qty || qty <= 0) return shake($('#editItemQty'));
        if (isNaN(price) || price < 0) return shake($('#editItemPrice'));

        const schedules = getSchedules();
        const s = schedules.find(x => x.id === currentScheduleId);
        if (!s) return showModalAlert('failed', 'Gagal', 'Schedule tidak ditemukan.');

        const item = s.items.find(x => x.id === editingItemId);
        if (!item) return showModalAlert('failed', 'Gagal', 'Item tidak ditemukan.');

        // Update data item
        item.name = name;
        item.qty = qty;
        item.price = price;
        item.description = description;

        setSchedules(schedules);
        showModalAlert('success', 'Berhasil', 'Item berhasil diperbarui.');
        hideModalEdit();
    });

    // Toggle done
    function toggleItemDone(id) {
        const schedules = getSchedules();
        const s = schedules.find(x => x.id === currentScheduleId);
        if (!s) return;

        const item = s.items.find(x => x.id === id);
        if (item) {
            item.done = !item.done;
            setSchedules(schedules);
            showModalAlert('success', 'Berhasil', `Item ditandai sebagai ${item.done ? 'selesai' : 'belum selesai'}.`);
        } else {
            showModalAlert('failed', 'Gagal', 'Item tidak ditemukan.');
        }
    }

    /*** SEARCH ***/
    $search.on('input', function () {
        const q = $(this).val().toLowerCase();
        $('.item-card').each(function () {
            const text = $(this).find('h3').text().toLowerCase();
            $(this).toggle(text.includes(q));
        });
    });

    /*** UTILS ***/
    function formatNumber(n) {
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function escapeHtml(s) {
        return String(s).replace(/[&<>"']/g, m => ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;'
        }[m]));
    }

    function shake($el) {
        $el.css('position', 'relative')
            .animate({ left: -8 }, 80)
            .animate({ left: 8 }, 80)
            .animate({ left: 0 }, 80)
            .focus();
    }

    function updateTotal() {
        let total = 0;
        const schedules = getSchedules();
        const s = schedules.find(x => x.id === currentScheduleId);
        if (s && s.items) total = s.items.reduce((sum, it) => sum + it.qty * it.price, 0);
        $totalDisplay.text('Rp' + formatNumber(total));
    }

    /*** INIT ***/
    renderSchedules(getSchedules());
    updateTotal();
});
