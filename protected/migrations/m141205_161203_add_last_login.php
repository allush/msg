<?php

class m141205_161203_add_last_login extends CDbMigration
{
	public function up()
	{
        $sql = "ALTER TABLE `user`
                ADD COLUMN `lastLogin` INT(11) NULL DEFAULT NULL AFTER `password`;";

        $this->execute($sql);

        return true;
	}

	public function down()
	{
		echo "m141205_161203_add_last_login does not support migration down.\n";
		return false;
	}
}