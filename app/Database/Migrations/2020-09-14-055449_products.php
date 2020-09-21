<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'product_id'				=> [
				'type'           		=> 'CHAR',
				'constraint'     		=> 13,
				'null'        			=> false,
			],
			'category_id'				=> [
				'type'        	   	=> 'CHAR',
				'constraint'  	   	=> 13,
				'null'							=> false,
			],
			'product_name'			=> [
				'type'          	 	=> 'VARCHAR',
				'constraint'    	 	=> 30,
			],
			'product_price'			=> [
				'type'          	 	=> 'INT',
				'constraint'   	  	=> 10,
				'unsigned'   	  		=> true,
				'default'   	  		=> 0,
			],
			'product_sku'				=> [
				'type'         	  	=> 'VARCHAR',
				'constraint'   	  	=> 15,
			],
			'product_status'		=> [
				'type'          	 	=> 'ENUM',
				'constraint' 				=> ['Active','Inactive'],
      	'default' 					=> 'Active',
			],
			'product_image'			=> [
				'type'           		=> 'VARCHAR',
				'constraint'     		=> 40,
			],
			'product_description'	=> [
				'type'           		=> 'TEXT',
				'null'           		=> true,
			],
		]);
		$this->forge->addKey('product_id', true);
		$this->forge->addForeignKey('category_id','categories','category_id','CASCADE','CASCADE');
		$this->forge->createTable('products');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('products', true);
	}
}
