<?php

class m140720_122640_addUsers extends CDbMigration
{
	public function up()
	{
                $userAdmin = new User('register');
                $userAdmin->email = 'admin@gmail.com';
                $userAdmin->password = 'admin';
                $userAdmin->role = User::ROLE_ADMIN;
                $userAdmin->save();

                $userManager = new User('register');
                $userManager->email = 'manager@gmail.com';
                $userManager->password = 'manager';
                $userManager->role = User::ROLE_MANAGER;
                $userManager->save();

                $user_1 = new User('register');
                $user_1->email = 'demo1@gmail.com';
                $user_1->password = 'demo';
                $user_1->role = User::ROLE_USER;
                $user_1->save();

                $user_2 = new User('register');
                $user_2->email = 'demo2@gmail.com';
                $user_2->password = 'demo';
                $user_2->role = User::ROLE_USER;
                $user_2->save();

                $user_3 = new User('register');
                $user_3->email = 'demo3@gmail.com';
                $user_3->password = 'demo';
                $user_3->role = User::ROLE_USER;
                $user_3->save();
	}

	public function down()
	{
		echo "m140720_122640_addUsers does not support migration down.\n";
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