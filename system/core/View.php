<?php

class View {

	public $layout = 'layout';
	public $title = '';

	public function render($filename = 'index', $data = null)
	{
		global $config;
		$layout_file = $config['application'].DIRECTORY_SEPARATOR.$config['view'].DIRECTORY_SEPARATOR.$this->layout.'.php';

		ob_start();
		$this->render_partial($filename,$data);
		$content = ob_get_contents();
		ob_clean();

		$layout_data['title'] = $this->title;
		$layout_data['content'] = $content;

		extract($layout_data);
		include $layout_file;

	}

	public function render_partial($filename = 'index', $data = null)
	{
		global $config;
		if (is_array($data)) {
			extract($data);
		}
		
		$view_file = $config['application'].DIRECTORY_SEPARATOR.$config['view'].DIRECTORY_SEPARATOR.$filename.'.php';
		include $view_file;
	}
}