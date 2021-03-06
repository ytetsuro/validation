<?php
/**
 * @package   Fuel\Validation
 * @version   2.0
 * @author    Fuel Development Team
 * @license   MIT License
 * @copyright 2010 - 2013 Fuel Development Team
 * @link      http://fuelphp.com
 */

namespace Fuel\Validation\Rule;

class DateTest extends AbstractRuleTest
{

	/**
	 * {@inheritdocs}
	 */
	protected $message = 'The field does not contain a valid date.';

	protected function _before()
	{
		$this->object = new Date;
	}

	/**
	 * @dataProvider validateProvider
	 */
	public function testValidate()
	{
		list($dateValue, $format, $strict, $expected) = func_get_args();

		$param = array('format' => $format, 'strict' => $strict);

		parent::testValidate($dateValue, $expected, $param);
	}

	/**
	 * {@inheritdocs}
	 */
	public function validateProvider()
	{
		return array(
			0 => array('admin@test.com', 'Y/m/d', true, false),
			1 => array('admin@test.com', null, true, false),
			2 => array('admin@test.com', 'Y/m/d', false, false),
			3 => array('admin@test.com', null, false, false),
			4 => array('10/41/10', 'Y/m/d', true, false),
			5 => array('10/41/10', null, true, false),
			6 => array('10/41/10', 'Y/m/d', false, false),
			7 => array('10/41/10', null, false, false),
			8 => array('10/10/10', 'Y/m/d', true, true),
			9 => array('10/10/10', null, true, false),
			10 => array('10/10/10', 'Y/m/d', false, true),
			11 => array('10/10/10', null, false, false),
			12 => array('2012/10/10', 'Y/m/d', true, true),
			13 => array('2012/10/10', null, true, false),
			14 => array('2012/10/10', 'Y/m/d', false, true),
			15 => array('2012/10/10', 'Y.m.d', false, false),
			16 => array('2012.10.10', 'Y.m.d', false, true),
			17 => array('2012/10/10', null, false, false),
			18 => array(new \stdClass(), "Y/m.d", false, false),
			19 => array(new \stdClass(), null, true, false),
			20 => array(new \ClassWithToString("1990/12/12"), "Y/m/d", true, true),
			21 => array(new \ClassWithToString(), "D/m/Y", true, false),
			22 => array(new \ClassWithToString(), null, true, false),
			23 => array(new \ClassWithToString(), 100000, true, false),
			24 => array(function(){ return "10/10/10"; }, "d/m/y", true, false),
		);
	}

	public function testGetMessageParams()
	{
		$parameter = 'YYYY/MM/DD';

		$this->object->setParameter(array('format' => $parameter));

		$this->assertEquals(
			array('format' => $parameter),
			$this->object->getMessageParameters()
		);
	}

}
