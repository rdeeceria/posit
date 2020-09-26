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
				'null'        		=> false,
			],
			'product_id'		=> [
				'type'           	=> 'CHAR',
				'constraint'     	=> 13,
				'null'						=> false,
			],
			'trx_qty'				=> [
				'type'           	=> 'TINYINT',
				'constraint'     	=> 3,
			],
			'trx_price'			=> [
				'type'           	=> 'INT',
				'constraint'     	=> 10,
			],
			'trx_date'      => [
				'type'           	=> 'DATE',
			],
		]);
		$this->forge->addKey('trx_id', true);
		$this->forge->addKey('trx_date');
		$this->forge->addForeignKey('product_id','products','product_id','CASCADE','CASCADE');
		$this->forge->createTable('transactions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('transactions', true);
	}
}
