<?php

class Hello extends Controller
{

	public function index()
	{
		$user = new User;
		$data = $user->get_info();

		$this->view->layout = 'layout';
		$this->view->title = 'Hello world';
		$this->view->render('hello_index', $data);
	}

	public function another()
	{
		echo 'Another method: Do you like it?';
	}
}