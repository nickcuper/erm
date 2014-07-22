<?php

class m140722_010610_addComment extends CDbMigration
{
	public function up()
	{
                echo 'Create Comment data'.PHP_EOL;
                $date = date('Y-m-d H:i:s');
                $sql = 'SELECT MAX(id) as max, MIN(id) as min FROM user';;

                $userData = Yii::app()->db->createCommand($sql)->queryRow();

                for ($i=1;$i<100;$i++)
                {
                        $idUser = rand($userData['min'],$userData['max']);
                        $text = $this->generateRandomString(rand(50,180));

                        $inserRow = <<<SQL
                                INSERT INTO `comment` (`userId`, `created`, `text`) VALUES ($idUser, "$date", "$text");
SQL;
                        $this->execute($inserRow);
                }
                echo 'Compleate'.PHP_EOL;

	}

	public function down()
	{
		echo "m140722_010510_elasticsearch does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/



        private function generateRandomString($length = 10)
        {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, strlen($characters) - 1)];
                }
                return $randomString;
        }
}