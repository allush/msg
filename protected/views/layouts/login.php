<?php
/**
 * @var $content string
 */
?>
<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel='stylesheet' href='/css/bootstrap.min.css' type='text/css'>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-8 col-md-offset-4 col-sm-offset-4 col-xs-offset-2">
            <?php echo $content; ?>
        </div>
    </div>
</div>
</body>

<script type='text/javascript' src='/js/bootstrap.min.js'></script>
</html>