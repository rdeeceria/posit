<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'trx_id'				=> [
				'type'           	=> 'CHAR',
				'constraint'     	=> 13,
				'null'        		=> FALSE,
			],
			'product_id'		=> [
				'type'           	=> 'CHAR',
				'constraint'     	=> 13,
				'null'						=> FALSE,
			],
			'trx_price'			=> [
				'type'           	=> 'INT',
				'constraint'     	=> 13,
			],
			'trx_date'      => [
				'type'           	=> 'DATE',
			],
		]);
		$this->forge->addKey('trx_id');
		$this->forge->addKey('trx_date');
		$this->forge->addPrimaryKey('trx_id');
		$this->forge->addForeignKey('product_id','products','product_id','CASCADE','CASCADE');
		$this->forge->createTable('transactions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
