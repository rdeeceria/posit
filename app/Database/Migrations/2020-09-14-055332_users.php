<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'				=> [
				'type'						=> 'CHAR',
				'constraint'			=> 13,
				'null'        		=> FALSE,
			],
			'username'	=> [
				'type'						=> 'VARCHAR',
				'constraint'			=> 20,
			],
			'name'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 30,
			],
			'email'			=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 30,
			],
			'password'	=> [
				'type'           	=> 'VARCHAR',
				'constraint'     	=> 255,
			],
			'status'		=> [
				'type'					=> 'ENUM',
				'constraint' 		=> ['Active','Inactive'],
				'default' 			=> 'Active'
			],
			'level'			=> [
				'type'					=> 'ENUM',
				'constraint' 		=> ['Admin','User'],
				'default' 			=> 'Admin'
			],
		]);
		$this->forge->addKey('id');
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('users');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
