<?php
/**
 * @var $this SiteController
 * @var $form CActiveForm
 * @var $model Dialog
 * @var $dialogs Dialog[]
 */
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
        <div class="text-right small" style="margin: 8px 0;">
            <strong>(<?= $model->sender->login; ?>
                )</strong> <?= CHtml::link('Выйти', array('logout'), array('class' => '')); ?>
        </div>
        <div id="dialog">
            <?= $this->renderPartial('_dialogs', array('dialogs' => $dialogs)); ?>
        </div>

        <div id="status" class="text-center" style="margin: 8px 0;">
            <?= $model->receiver->textStatus(); ?>
        </div>

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
            <button type="submit" name="send" class="btn btn-default">
                Отправить
            </button>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $(window).on('beforeunload', function () {
            var exit = false;
            var wait = false;
            var i = 0;
            while (!exit) {
                console.log(i++);
                if (wait) {
                    continue;
                }
                $.ajax({
                    url: 'site/logout',
                    type: 'get',
                    async: false,
                    beforeSend: function () {
                        exit = true;
                    },
                    complete: function () {
                        exit = true;
                    }
                });
            }
        });

        $('#Dialog_text').keypress(function (event) {
            if (event.which == 13) {
                sendMessage($(event.target).parents('#new-message-form'));
            }
        });

        $('#new-message-form').submit(function () {
            sendMessage($(this));
            return false;
        });

        dialogScroll();

        function dialogScroll() {
            var dialog = $('#dialog');
            var dialogHeight = 0;
            dialog.find('.message').each(function () {
                dialogHeight += $(this).outerHeight();
            });
            dialogHeight += (dialog.outerHeight() - dialog.height());

            dialog.scrollTo(0, dialogHeight, {
                animation: {
                    complete: function () {
                    }
                }
            });
        }

        var updateDialogLocked = false;

        function sendMessage(form) {
            var dialogText = $('#Dialog_text');
            $.ajax({
                url: form.attr('action'),
                type: 'post',
                dataType: 'json',
                data: {
                    YII_CSRF_TOKEN: '<?= Yii::app()->request->csrfToken; ?>',
                    'Dialog[text]': dialogText.val(),
                    'Dialog[receiver_id]': $('#Dialog_receiver_id').val(),
                    'Dialog[sender_id]': $('#Dialog_sender_id').val()
                },
                beforeSend: function () {
                    $('#Dialog_text').attr('disabled', 'disabled');
                    updateDialogLocked = true;
                },
                error: function () {
                    updateDialogLocked = false;
                },
                success: function (data) {
                    updateDialogLocked = false;
                    dialogText.removeAttr('disabled');
                    if (data.save == true) {
                        dialogText.val('');
                        updateDialog();
                    }
                    dialogText.focus();
                }
            });
        }

        function updateDialog() {
            if (updateDialogLocked) {
                return;
            }

            $.ajax({
                url: 'site/index',
                type: 'get',
                dataType: 'json',
                success: function (data) {
                    $('#dialog').html(data.dialog);
                    $('#status').html(data.status);
                }
            });
        }

        setInterval(function () {
            updateDialog();
        }, 5000);
    });
</script>