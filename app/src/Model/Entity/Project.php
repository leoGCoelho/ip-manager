<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $serverip
 * @property string|null $token
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\ProjectClient[] $project_clients
 * @property \App\Model\Entity\UserProject[] $user_projects
 */
class Project extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'organization_id' => true,
        'name' => true,
        'serverip' => true,
        'token' => true,
        'created' => true,
        'modified' => true,
        'organization' => true,
        'project_clients' => true,
        'user_projects' => true,
    ];
}
