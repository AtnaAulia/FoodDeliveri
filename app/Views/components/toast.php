<?php
$toast = session()->getFlashdata('toast');

$data = [
    'show' => false
];

if ($toast) {
    $data = [
        'show' => true,
        'type' => $toast['type'] ?? 'success',
        'title' => $toast['title'] ?? '',
        'message' => $toast['message'] ?? ''
    ];
}
?>

<script id="toast-data" type="application/json">
<?= json_encode($data) ?>
</script>
