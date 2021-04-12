<?php

abstract class Smartcrawl_Schema_Property_Source {
	/**
	 * @var Smartcrawl_Schema_Helper
	 */
	protected $helper;

	public function __construct() {
		$this->helper = Smartcrawl_Schema_Helper::get();
	}

	public abstract function get_value();
}
