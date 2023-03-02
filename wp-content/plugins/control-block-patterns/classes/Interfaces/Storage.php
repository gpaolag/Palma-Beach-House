<?php
namespace ControlPatterns\Interfaces;
/**
 * Storage interface
 *
 * @package ControlPatterns
 */

/**
 * Interface ControlPatterns\Interfaces\Storage
 */
interface Storage {

	/**
	 * Get value from storage.
	 *
	 * @param  int    $object_id Object id.
	 * @param  string $name      Field name.
	 * @param  array  $args      Custom arguments..
	 * @return mixed
	 */
	public function get( $object_id, $name, $args = array() );
}
