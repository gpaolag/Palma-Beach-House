<?php
namespace ControlPatterns;
/**
 * Storage registry class
 *
 * @package ControlPatterns
 */

/**
 * Class CTRLBP_Storage_Registry
 */
class Storage_Registry {

	/**
	 * List storage instances.
	 *
	 * @var array
	 */
	protected $storages = array();

	/**
	 * Get storage instance.
	 *
	 * @param string $class_name Storage class name.
	 * @return ControlPatterns\Interfaces\Storage
	 */
	public function get( $class_name ) {
		if ( empty( $this->storages[ $class_name ] ) ) {
			$this->storages[ $class_name ] = new $class_name();
		}

		return $this->storages[ $class_name ];
	}
}
