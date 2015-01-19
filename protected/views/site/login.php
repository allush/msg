<?php
/**
 * @var $this SiteController
 * @var $model LoginForm
 * @var $form CActiveForm
 */
?>

<br>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'focus' => array($model, 'login'),
)); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'login'); ?>
    <?php echo $form->textField($model, 'login', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
    <?php echo $form->error($model, 'login'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control', 'autocomplete' => 'off')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-default form-control">
        <i class='glyphicon glyphicon-log-in text-success'></i>&nbsp;&nbsp;Войти
    </button>
</div>

<?php $this->endWidget(); ?>
