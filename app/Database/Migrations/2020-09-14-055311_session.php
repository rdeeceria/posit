<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Session extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'        => [
				'type'        => 'VARCHAR',
				'constraint'  => 128,
				'null'				=> FALSE
			],
			'ip_address'    => [
				'type'        => 'VARCHAR',
				'constraint'  => 45,
				'null'        => FALSE,
			],
			'timestamp' => [
				'type'        => 'INT',
				'unsigned'		=> TRUE,
				'default' 		=> 0,
				'null'        => FALSE,
			],
			'data' 			=> [
				'type'        => 'BLOB',
				'null'        => FALSE,
				'default' 		=> '',
			],
		]);
		$this->forge->addKey('timestamp');
		$this->forge->addPrimaryKey('id');
		$this->forge->addPrimaryKey('ip_address');
		$this->forge->createTable('ci_sessions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
