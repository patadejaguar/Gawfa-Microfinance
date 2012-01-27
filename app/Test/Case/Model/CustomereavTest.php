<?php
/* Customereav Test cases generated on: 2012-01-14 12:09:11 : 1326542951*/
App::uses('Customereav', 'Model');

/**
 * Customereav Test Case
 *
 */
class CustomereavTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.customereav', 'app.customer');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Customereav = ClassRegistry::init('Customereav');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Customereav);

		parent::tearDown();
	}

}
