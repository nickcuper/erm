<?php

class m140722_010610_addComment extends CDbMigration
{
	public function up()
	{
                echo 'Create Comment data'.PHP_EOL;
                
                for ($i=1;$i<100;$i++)
                {
                        $mComment = new Comment;
                        $mComment->userId = rand(1,4);
                        $mComment->text = $this->generateRandomString(rand(50,180));
                        $mComment->created = date('Y-m-d H:i:s');
                        $mComment->save();
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