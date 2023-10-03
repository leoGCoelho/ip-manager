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
<?php $this->start('toastr') ?>
    $(document).ready(function () {
        toastr.success('<?= $message ?>');
        toastr.clear;
    });
<?php $this->end() ?>
