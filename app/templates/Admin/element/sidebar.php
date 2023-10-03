<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
            <li class="nav-item">
                <?= $this->Html->link('
                    <i class="nav-icon fas fa-globe"></i><span class="nav-link-text"> Todos Projetos</span>', 
                    ['_name' => 'admin_projects_index'], 
                    ['escape' => false, 'class' => 'nav-link']
                ); ?>
            </li>

            <li><hr class="mt-1 mb-1" /></li>

            <?php $fst=true;$proj_i=0 ?>
            <div id="accordion">
            <?php foreach ($loggeduser_organizations as $user_organization) : ?>
                <div class="card" style="background-color: rgba(0,0,0,.0);">
                    <div class="card-header" id=<?= "heading".strval($proj_i) ?>>
                        <h4 class="nav-link-text text-light">
                        <button class="btn btn-link text-light" data-toggle="collapse" data-target=<?= "#collapse".strval($proj_i) ?> aria-expanded=<?= $fst==true?"true":"false" ?> aria-controls= <?= "collapse".strval($proj_i) ?> >
                            <?= strtoupper($user_organization->organization->name) ?>
                        </button>
                        </h4>
                    </div>
                    
                    <?php if ($fst == true) : ?>
                        <div id=<?= "collapse".strval($proj_i) ?> class="collapse show" aria-labelledby=<?= "heading".strval($proj_i) ?> data-parent="#accordion">
                    <?php else : ?>
                        <div id=<?= "collapse".strval($proj_i) ?> class="collapse" aria-labelledby=<?= "heading".strval($proj_i) ?> data-parent="#accordion">
                    <?php endif; ?>
                            <div class="card-body" style="background-color: rgba(0,0,0,.120);">
                            <?php if ($user_organization->adm == 1) : ?>
                                <li class="nav-item">
                                    <?= $this->Html->link('
                                        <i class="nav-icon fas fa-users text-black"></i><span class="nav-link-text"> Usuários</span>', 
                                        ['controller' => 'Users', 'action' => 'index'], 
                                        ['escape' => false, 'class' => 'nav-link']
                                    ); ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('
                                        <i class="fas fa-cogs text-black"></i><span class="nav-link-text"> Roles</span>', 
                                        ['_name' => 'admin_roles_index'], 
                                        ['escape' => false, 'class' => 'nav-link']
                                    ); ?>
                                </li>
                                <li class="nav-item">
                                    <?= $this->Html->link('
                                        <i class="fas fa-newspaper text-black"></i><span class="nav-link-text"> Log de Atividades</span>', 
                                        ['_name' => 'admin_activities_index'], 
                                        ['escape' => false, 'class' => 'nav-link']
                                    ); ?>
                                </li>

                                <li><hr class="mt-4 mb-1" /></li>
                            <?php endif; ?>

                            <?php if ($user_organization->adm == 1) : ?>
                                <li class="nav-item">
                                    <?= $this->Html->link('
                                        <i class="nav-icon fas fa-plus"></i><span class="nav-link-text"> Criar Projeto</span>', 
                                        ['controller' => 'Projects', 'action' => 'add', $user_organization->organization_id], 
                                        ['escape' => false, 'class' => 'nav-link']
                                    ); ?>
                                </li>
                                <li><hr class="mt-1 mb-1" /></li>
                            <?php endif; ?>

                            <?php foreach ($projects as $project): ?>
                                <?php if ($project->organization_id == $user_organization->organization_id): ?>
                                    <li class="nav-item">
                                        <?= $this->Html->link('
                                            <i class="nav-icon fas fa-server"></i><span class="nav-link-text"> '.$project['name'].'</span>', 
                                            ['controller' => 'Projects', 'action' => 'view', $project['id']], 
                                            ['escape' => false, 'class' => 'nav-link']
                                        ); ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

                <?php $fst = false;$proj_i++; ?>
            <?php endforeach; ?>
            </div>
        </ul>
    </nav>
</div>