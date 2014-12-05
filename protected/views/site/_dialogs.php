<?php
/**
 * @var $this SiteController
 * @var $dialogs Dialog[]
 */
?>

<?php foreach ($dialogs as $message) {
    $own = ($message->sender_id == Yii::app()->user->id);
    ?>
    <div class="message <?= $own ? 'own' : ''; ?>">
        <div class="time">
            <?= date('d.m H:i:s', $message->createdOn); ?>
            <strong><?= $message->sender->login; ?></strong>
        </div>
        <div class="text"><?= $message->text; ?></div>
    </div>
<?php
} ?>