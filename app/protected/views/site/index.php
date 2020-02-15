<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>
<div class="row py-3">
	<div class="col-md-6">
		<div class="jumbotron">
		    <h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
		    <p>Register now to create an account and to explore the application!</p>
		</div>
	</div>

	<div class="col-md-6">
		<?php
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'form-new-user',		
				'enableClientValidation'=>false,
				'htmlOptions' => array('class'=>'form floating-label sp-form','accept-charset'=>'utf-8'),
				'clientOptions'=>array(
					'validateOnSubmit'=>false,
				),
			));
		?>
		<div class="form-group">
		<?php
			$this->widget('Flash', array('flashes'=>Yii::app()->user->getFlashes()));
			echo CHtml::errorSummary(
				array($user), 
				null, 
				null, 
				array('class' => 'alert alert-danger')
			);
		?>
		</div>
		<div class="form-group">
		  <label>Email Address</label>
		  <?php echo $form->textField($user,'email', array('class' => 'form-control' . (($user->hasErrors('email'))?' is-invalid':''), 'placeholder' => 'Enter your email address here')); ?>
			<?php echo $form->error($user,'email', array('class' => 'invalid-feedback')); ?>
		</div>
		<div class="form-group">
		  <label>First Name</label>
		  <?php echo $form->textField($user,'first_name', array('class' => 'form-control' . (($user->hasErrors('first_name'))?' is-invalid':''), 'placeholder' => 'Enter your first name here')); ?>
			<?php echo $form->error($user,'first_name', array('class' => 'invalid-feedback')); ?>
		</div>
		<div class="form-group">
		  <label>Last Name</label>
		  <?php echo $form->textField($user,'last_name', array('class' => 'form-control' . (($user->hasErrors('last_name'))?' is-invalid':''), 'placeholder' => 'Enter your last name here')); ?>
			<?php echo $form->error($user,'last_name', array('class' => 'invalid-feedback')); ?>
		</div>
		<div class="form-group">
		  <label>Password</label>
		  <?php echo $form->passwordField($user,'password', array('class' => 'form-control' . (($user->hasErrors('password'))?' is-invalid':''), 'placeholder' => 'Enter your password here')); ?>
			<?php echo $form->error($user,'password', array('class' => 'invalid-feedback')); ?>
		</div>
		<div class="form-group">
		  <label>Confirm Password</label>
		  <?php echo $form->passwordField($user,'confirmPassword', array('class' => 'form-control' . (($user->hasErrors('confirmPassword'))?' is-invalid':''), 'placeholder' => 'Please confirm your password here')); ?>
			<?php echo $form->error($user,'confirmPassword', array('class' => 'invalid-feedback')); ?>
		</div>
		<button type="submit" class="btn btn-primary"><em class="fas fa-user-plus"></em> Register</button>
		<?php $this->endWidget(); ?>
	</div>
</div>