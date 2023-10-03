<?
$title = 'Usuários';
$bc = [
    'Usuários' => [
        'url' => $this->Url->build(['_name' => 'admin_users_index']),
        'active' => true
    ]
];
?>
<?= $this->element('breadcrumb',  compact('title', 'bc')) ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Gestão de usuários de acesso ao CMS</h3>
                    </div>
                    <div class="card-body">
                        <table id="table_content" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="sort" data-sort="name" width="65%"><?= $this->Paginator->sort('name', __('Nome')) ?></th>
                                    <th scope="col" class="sort" data-sort="email" width="65%"><?= $this->Paginator->sort('email', __('E-mail')) ?></th>
                                    <th scope="col" class="sort" data-sort="created" width="15%"><?= $this->Paginator->sort('created', __('Criado Em')) ?></th>
                                    <th scope="col" class="sort" data-sort="modified" width="15%"><?= $this->Paginator->sort('modified', __('Última Modificação')) ?></th>
                                    <th scope="col" class="actions text-right" width="5%"><?= __('Ações') ?></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= (($user->name!=null) || ($user->name!="")) ? h($user->name) : h("Sem Nome") ?></td>
                                    <td><?= h($user->email) ?></td>
                                    <td><?= h($user->created) ?></td>
                                    <td><?= h($user->modified) ?></td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <?= $this->Html->link('<i class="fas fa-unlock-alt"></i>'.__('Debloquear'), ['action' => 'unlock', $user->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
                                                <?= $this->Html->link('<i class="far fa-edit"></i>'.__('Editar'), ['action' => 'edit', $user->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
                                                <?= $this->Form->postLink('<i class="far fa-trash-alt"></i>'.__('Remover'), ['action' => 'delete', $user->id], ['confirm' => __('Confirmar remoção do registro #{0}?', $user->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">
                                    <?= $this->Paginator->counter('Mostrando de {{start}} à {{end}} de {{count}} registros'); ?>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    <nav>
                                        <ul class="pagination">
                                            <?= $this->Paginator->first() ?>
                                            <?= $this->Paginator->prev() ?>
                                            <?= $this->Paginator->numbers() ?>
                                            <?= $this->Paginator->next() ?>
                                            <?= $this->Paginator->last() ?>

                                            <?php /* -----PAGINACAO BONITA----
                                            <?php if ($pageindex > 1): ?>
                                            <li class="paginate_button page-item previous disabled" id="example2_previous">
                                                <a href=<?= $pageurl . strval($pageindex-1) ?> aria-controls="example2" class="page-link">Anterior</a>
                                            </li>
                                            <?php endif; ?>

                                            <?php $i=1; ?>
                                            <?php foreach ($this->Paginator->numbers() as $page): ?>
                                                <li class= <?= ($i == $pageindex) ? "paginate_button page-item active" : "paginate_button page-item" ?>
                                                    <a href=<?= $pageurl . strval($i) ?> aria-controls="example2" class="page-link">$i</a>
                                                </li>
                                                <?php $i++; ?>
                                            <?php endforeach; ?>

                                            <?php if($pageindex < $i-1): ?>
                                            <li class="paginate_button page-item next" id="example2_next">
                                                <a href=<?= $pageurl . strval($pageindex+1) ?> aria-controls="example2" class="page-link">Próximo</a>
                                            </li-->
                                            <li class="paginate_button page-item last" id="example2_last">
                                                <a href=<?= $pageurl . strval($i-1) ?> aria-controls="example2" class="page-link">Último</a>
                                            </li-->
                                            <?php endif; ?>
                                            */ ?>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>