<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'category_id'			=> [
				'type'           	=> 'CHAR',
				'constraint'     	=> 13,
				'null'        		=> FALSE,
			],
			'category_name'		=> [
				'type'						=> 'VARCHAR',
				'constraint'			=> 20,
			],
			'category_status'	=> [
				'type'						=> 'ENUM',
				'constraint' 			=> ['Active','Inactive'],
				'default' 				=> 'Active'
			],
		]);
		$this->forge->addKey('category_id');
		$this->forge->addPrimaryKey('category_id');
		$this->forge->createTable('categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
