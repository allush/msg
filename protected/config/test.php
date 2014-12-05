<?php

return CMap::mergeArray(
    require(dirname(__FILE__) . '/main.php'),
    array(
        'components' => array(
            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => true,
            ),
            'fixture' => array(
                'class' => 'system.test.CDbFixtureManager',
            ),
            'db' => array(
                'connectionString' => 'mysql:host=localhost;dbname=claymakeTest',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '8534i6282',
                'charset' => 'utf8',
            )
        ),
    )
);
