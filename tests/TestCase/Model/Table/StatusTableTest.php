<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StatusTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StatusTable Test Case
 */
class StatusTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'Status' => 'app.status',
        'Statuses' => 'app.statuses',
        'Students' => 'app.students',
        'Schools' => 'app.schools',
        'Rosters' => 'app.rosters',
        'Classes' => 'app.classes',
        'Staffs' => 'app.staffs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Status') ? [] : ['className' => 'App\Model\Table\StatusTable'];
        $this->Status = TableRegistry::get('Status', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Status);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
