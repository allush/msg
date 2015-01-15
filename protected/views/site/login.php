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

<div style="text-align: center">
    <p style="font-size: 18px;" class="label label-success">С возвращением :)</p>
</div>
<br>
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
        <i class='glyphicon glyphicon-log-in text-success'></i>&nbsp;&nbsp;Да, я этого хочу!
    </button>
</div>

<?php $this->endWidget(); ?>
