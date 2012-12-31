<?php
class User extends Model
{
	public function get_info()
	{
		$data['username'] = 'duythinht';
		$data['copyright'] = '2012';
		return $data;
	}
}