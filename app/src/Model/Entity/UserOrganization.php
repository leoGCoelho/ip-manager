<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserOrganization Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $organization_id
 * @property int|null $adm
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Organization $organization
 */
class UserOrganization extends Entity
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
        'user_id' => true,
        'organization_id' => true,
        'adm' => true,
        'user' => true,
        'organization' => true,
    ];
}
