<?php
/**
 * Rate My Shoe
 *
 * @package   rms
 * @author Makanaokeakua Edwards | Hakoni Software Development<makridevelopment@gmail.com>
 * @copyright 2024 Hakoni Software Development
 * @license   Proprietary
 */

declare(strict_types = 1);

namespace RMS\Classes\Abstracts;

/**
 * The Base class which can be extended by other classes to load in default methods
 *
 * @package RMS\Classes\Abstracts
 * @since 1.0.0
 */
abstract class Base {
	public function __constructor() {
		$this->init();
	}
	
	abstract public function init();
}