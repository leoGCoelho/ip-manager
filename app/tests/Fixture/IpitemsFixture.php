<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IpitemsFixture
 */
class IpitemsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'type' => 'Lorem ipsum dolor sit amet',
                'num' => 'Lorem ipsum dolor sit amet',
                'created' => '2022-11-18 13:39:40',
                'modified' => '2022-11-18 13:39:40',
            ],
        ];
        parent::init();
    }
}
