<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UserProjectsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UserProjectsTable Test Case
 */
class UserProjectsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UserProjectsTable
     */
    protected $UserProjects;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.UserProjects',
        'app.Users',
        'app.Projects',
        'app.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('UserProjects') ? [] : ['className' => UserProjectsTable::class];
        $this->UserProjects = $this->getTableLocator()->get('UserProjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->UserProjects);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\UserProjectsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\UserProjectsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
