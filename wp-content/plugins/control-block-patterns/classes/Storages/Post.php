<?php
namespace ControlPatterns\Storages;
use ControlPatterns\Storages\Base as Base_Storage;
/**
 * Post storage
 *
 * @package ControlPatterns
 */

/**
 * Class CTRLBP_Post_Storage
 */
class Post extends Base_Storage {

	/**
	 * Object type.
	 *
	 * @var string
	 */
	protected $object_type = 'post';
}
