<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IpitemsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IpitemsTable Test Case
 */
class IpitemsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IpitemsTable
     */
    protected $Ipitems;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Ipitems',
        'app.ProjectIpitems',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Ipitems') ? [] : ['className' => IpitemsTable::class];
        $this->Ipitems = $this->getTableLocator()->get('Ipitems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Ipitems);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\IpitemsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
