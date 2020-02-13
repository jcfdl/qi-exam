<?php 
	$classHide = '';
	if ($this->hide)
	{
		Yii::app()->clientScript->registerScript('flash',"
			$('.alert-box.class-hide').delay(".$this->hideTime.").fadeOut(1000, function() { $('.alert-box.class-hide').remove(); });
		");
		$classHide = 'class-hide';
	}

	foreach($this->flashes as $key => $message) 
	{
		if($key == 'error')
			$key = 'danger';
		echo
			'<div class="alert alert-callout alert-'.$key.' alert-dismissable '.$classHide.'">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				'.$message.'
			</div>';
	}
?>

