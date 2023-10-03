<?
$title = 'Dashboard';
$bc = [
    'Dashboard' => [
        'url' => $this->Url->build(['_name' => 'admin_index']),
        'active' => true
    ]
];
?>
<?= $this->element('breadcrumb',  compact('title', 'bc')) ?>
<section class="content">

</section>