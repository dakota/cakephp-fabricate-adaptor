<?php
namespace CakeFabricate\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 * @package       CakeFabricate\Test\Fixture
 */
class UsersFixture extends TestFixture {

/**
 * fields property
 *
 * @var array
 */
    public $fields = [
        'id' =>       ['type' => 'integer', 'key' => 'primary'],
        'user' =>     ['type' => 'string', 'null' => true],
        'password' => ['type' => 'string', 'null' => true],
        'created' => 'datetime',
        'updated' => 'datetime'
    ];
}
