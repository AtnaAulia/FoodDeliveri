<?php
$toast = session()->getFlashdata('toast');
if (!$toast) return;

$type    = esc($toast['type'] ?? 'default');
$title   = esc($toast['title'] ?? 'Info');
$message = esc($toast['message'] ?? '');
?>

<div id="custom-toast-container">
    <div class="custom-toast <?= $type ?>" id="custom-toast">
        <div class="custom-toast-icon">
            <?php if ($type === 'success'): ?>✓<?php endif; ?>
            <?php if ($type === 'error'): ?>✕<?php endif; ?>
            <?php if ($type === 'warning'): ?>!<?php endif; ?>
            <?php if ($type === 'default'): ?>i<?php endif; ?>
        </div>

        <div class="custom-toast-body">
            <div class="custom-toast-title"><?= $title ?></div>
            <?php if ($message): ?>
                <div class="custom-toast-text"><?= $message ?></div>
            <?php endif ?>
        </div>
    </div>
</div>

<script>
setTimeout(() => {
    document.getElementById('custom-toast')?.classList.add('hide');
}, 3000);
</script>
