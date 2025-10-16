<?php
session_start();
// print_r($_SESSION);exit;
header('Content-Type: application/json');

if (!isset($_SESSION['schedules'])) {
    $_SESSION['schedules'] = [];
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$response = ['status' => 'failed', 'message' => 'Aksi tidak dikenali'];

switch ($action) {
    case 'get':
        echo json_encode($_SESSION['schedules']);
        exit;

    case 'add_schedule':
        $title = trim($_POST['title'] ?? '');
        if ($title === '') {
            $response['message'] = 'Nama schedule tidak boleh kosong.';
            break;
        }
        $id = time();
        // 1 Januari 1970
        $_SESSION['schedules'][] = [
            'id' => $id,
            'title' => $title,
            'items' => []
        ];
        $response = ['status' => 'success', 'message' => 'Schedule berhasil ditambahkan.', 'id' => $id];
        break;

    case 'delete_schedule':
        $id = $_POST['id'] ?? null;
        $_SESSION['schedules'] = array_values(array_filter($_SESSION['schedules'], fn($s) => $s['id'] != $id));
        $response = ['status' => 'success', 'message' => 'Schedule berhasil dihapus.'];
        break;

    case 'add_item':
        $scheduleId = $_POST['schedule_id'] ?? null;
        $name = trim($_POST['name'] ?? '');
        $qty = intval($_POST['qty'] ?? 0);
        $price = floatval($_POST['price'] ?? 0);
        $desc = trim($_POST['description'] ?? '');
        if ($name === '' || $qty <= 0 || $price < 0) {
            $response['message'] = 'Data item tidak valid.';
            break;
        }
        foreach ($_SESSION['schedules'] as &$s) {
            if ($s['id'] == $scheduleId) {
                $s['items'][] = [
                    'id' => time(),
                    'name' => $name,
                    'qty' => $qty,
                    'price' => $price,
                    'description' => $desc,
                    'done' => false
                ];
                $response = ['status' => 'success', 'message' => 'Item berhasil ditambahkan.'];
                break 2;
            }
        }
        $response['message'] = 'Schedule tidak ditemukan.';
        break;

    case 'update_item':
        $scheduleId = $_POST['schedule_id'] ?? null;
        $itemId = $_POST['item_id'] ?? null;
        $name = trim($_POST['name'] ?? '');
        $qty = intval($_POST['qty'] ?? 0);
        $price = floatval($_POST['price'] ?? 0);
        $desc = trim($_POST['description'] ?? '');
        foreach ($_SESSION['schedules'] as &$s) {
            if ($s['id'] == $scheduleId) {
                foreach ($s['items'] as &$it) {
                    if ($it['id'] == $itemId) {
                        $it['name'] = $name;
                        $it['qty'] = $qty;
                        $it['price'] = $price;
                        $it['description'] = $desc;
                        $response = ['status' => 'success', 'message' => 'Item berhasil diperbarui.'];
                        break 3;
                    }
                }
            }
        }
        $response['message'] = 'Item tidak ditemukan.';
        break;

    case 'delete_item':
        $scheduleId = $_POST['schedule_id'] ?? null;
        $itemId = $_POST['item_id'] ?? null;
        foreach ($_SESSION['schedules'] as &$s) {
            if ($s['id'] == $scheduleId) {
                $s['items'] = array_values(array_filter($s['items'], fn($it) => $it['id'] != $itemId));
                $response = ['status' => 'success', 'message' => 'Item berhasil dihapus.'];
                break 2;
            }
        }
        $response['message'] = 'Item tidak ditemukan.';
        break;

    case 'toggle_item':
        $scheduleId = $_POST['schedule_id'] ?? null;
        $itemId = $_POST['item_id'] ?? null;
        foreach ($_SESSION['schedules'] as &$s) {
            if ($s['id'] == $scheduleId) {
                foreach ($s['items'] as &$it) {
                    if ($it['id'] == $itemId) {
                        $it['done'] = !$it['done'];
                        $response = ['status' => 'success', 'message' => 'Status item diperbarui menjadi ' . ($it['done'] ? 'selesai' : 'belum'), 'done' => $it['done']];
                        break 3;
                    }
                }
            }
        }
        $response['message'] = 'Item tidak ditemukan.';
        break;
}

echo json_encode($response);
