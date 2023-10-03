
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= $title ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><?= $this->Html->link('Home', ['_name' => 'admin_index']); ?></li>
                    <? if (!empty($bc)): ?>
                        <? foreach ($bc as $label=>$link): ?>
                            <? if (isset($link['active']) && $link['active']): ?>
                        <li class="breadcrumb-item active"><?= $label ?></li>
                            <? else: ?>
                        <li class="breadcrumb-item"><?= $this->Html->link($label, $link) ?></li>
                            <? endif; ?>
                        <? endforeach; ?>
                    <? endif; ?>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>