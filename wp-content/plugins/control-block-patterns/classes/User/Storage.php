<?php
namespace ControlPatterns\User;
use ControlPatterns\Storages\Base as Base_Storage;

class Storage extends Base_Storage {
	protected $object_type = 'user';
}
