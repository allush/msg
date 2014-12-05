<?php
/**
 * @var $this SiteController
 * @var $form CActiveForm
 * @var $model Dialog
 * @var $dialogs Dialog[]
 */
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">

        <br>

        <div id="dialog">
            <?= $this->renderPartial('_dialogs', array('dialogs' => $dialogs)); ?>
        </div>

        <hr>

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'new-message-form',
            'action' => array('newMessage'),
        )); ?>

        <?= $form->hiddenField($model, 'sender_id'); ?>
        <?= $form->hiddenField($model, 'receiver_id'); ?>

        <div class="form-group">
            <?= $form->textArea($model, 'text', array('class' => 'form-control')); ?>
            <?= $form->error($model, 'text'); ?>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-4">
                    <?= CHtml::link('Выйти', array('logout'), array('class' => 'btn  btn-danger')); ?>
                </div>
                <div class="col-md-4 text-center">
                    <small>
                        Был(а) последний раз:
                        <br><strong><?= $model->receiver->lastLogin ? date('d.m.Y H:i:s', $model->receiver->lastLogin) : '?'; ?></strong>
                    </small>
                </div>
                <div class="col-md-4 text-right">
                    <button type="submit" name="send" class="btn btn-default">
                        <i class="glyphicon glyphicon-send"></i> Отправить
                    </button>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#new-message-form').submit(function () {
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                dataType: 'json',
                data: {
                    YII_CSRF_TOKEN: '<?= Yii::app()->request->csrfToken; ?>',
                    'Dialog[text]': $('#Dialog_text').val(),
                    'Dialog[receiver_id]': $('#Dialog_receiver_id').val(),
                    'Dialog[sender_id]': $('#Dialog_sender_id').val()

                },
                beforeSend: function () {
                    $('#Dialog_text').attr('disabled', 'disabled');
                },
                success: function (data) {
                    $('#Dialog_text').removeAttr('disabled');
                    if (data.save == true) {
                        $('#Dialog_text').val('');
                        updateDialog();
                    }
                }
            });

            return false;
        });

        function updateDialog() {
            $.ajax({
                url: 'site/index',
                type: 'get',
                success: function (data) {
                    $('#dialog').html(data);
                }
            });
        }

        setInterval(function () {
            updateDialog()
        }, 10000);
    });
</script>