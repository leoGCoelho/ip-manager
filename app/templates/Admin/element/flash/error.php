<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<?php $this->start('script') ?>
    $(document).ready(function () {
        toastr.error('<?= $message ?>');
        toastr.clear;
    });
<?php $this->end() ?>
