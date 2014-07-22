<?php

class m140722_010510_elasticsearch extends CDbMigration
{
	public function up()
	{
                echo 'Create SE data'.PHP_EOL;
                
                Yii::app()->getModule('ESearch');
                
                $name = [ 'Maksim', 'Ivan', 'Petro', 'Oleksandr', 'Alina', 'Mark'];
                
                $lname = [ 'Petrov', 'Ivanov', 'Maksimov', 'Androv', 'More'];
                
                for ($i=1;$i<=100;$i++) 
                {
                        $model = new ESForm('create');
                        $model->FirstName = $name[rand(0,5)];
                        $model->LastName = $lname[rand(0,4)];
                        $model->Age = rand(20,85);
                        $model->Gender = range('Male','Famale');
                        $model->create();
                    
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
}