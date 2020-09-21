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
				'null'        		=> false,
			],
			'category_name'		=> [
				'type'						=> 'VARCHAR',
				'constraint'			=> 30,
			],
			'category_status'	=> [
				'type'						=> 'ENUM',
				'constraint' 			=> ['Active','Inactive'],
				'default' 				=> 'Active'
			],
		]);
		$this->forge->addKey('category_id', true);
		$this->forge->createTable('categories');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('categories', true);
	}
}
