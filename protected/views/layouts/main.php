<?php
/**
 * @var $this FrontController
 * @var $content string
 */
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>msg</title>
    <meta name="description" content="msg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl?>/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->baseUrl?>/css/front.css">
</head>

<body>
<div class="container">
    <?php echo $content; ?>
</div>

<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<script src="<?= Yii::app()->baseUrl?>/js/jquery.scrollto.js"></script>
<script src="<?= Yii::app()->baseUrl?>/js/bootstrap.min.js"></script>
<script src="<?= Yii::app()->baseUrl?>/js/frontend.js"></script>
</body>
</html>
