<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="row py-3">
	<div class="col-md-6">
		<div class="jumbotron">
		    <h1>Login</h1>
		    <p>lease fill out the form with your login credentials</p>
		</div>
	</div>
	<div class="col-md-6">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'form-login',
			'enableClientValidation'=>false,
			'htmlOptions' => array('class'=>'form floating-label','accept-charset'=>'utf-8'),
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>
			<div class="form-group">
				<?php
					$this->widget('Flash', array('flashes'=>Yii::app()->user->getFlashes()));
					echo CHtml::errorSummary(
						array($model), 
						null, 
						null, 
						array('class' => 'alert alert-danger')
					);
				?>
			</div>
			<div class="form-group">
				<label>Email Address</label>
				<?php echo $form->textField($model,'username', array('class'=>'form-control' . (($model->hasErrors('username'))?' is-invalid':''), 'placeholder'=>'Enter your email here.')); ?>
				<?php echo $form->error($model,'username', array('class' => 'invalid-feedback')); ?>
			</div>
			<div class="form-group">
				<label>Password</label>
				<?php echo $form->passwordField($model,'password', array('class'=>'form-control' . (($model->hasErrors('email'))?' is-invalid':''), 'placeholder'=>'Enter your password here')); ?>
				<?php echo $form->error($model,'password', array('class' => 'invalid-feedback')); ?>
			</div>
			<div class="form-group">
			  <div class="form-check">
			  	<?php echo $form->checkBox($model,'rememberMe', array('class'=>'form-check-input')); ?>
			    <label class="form-check-label" for="invalidCheck">Remember Me</label>
			  </div>
			</div>
			<div class="form-button">
				<?php echo CHtml::submitButton('Login', array('class'=>'btn btn-primary')); ?>
			</div>
		<?php $this->endWidget(); ?>
	</div>
</div>