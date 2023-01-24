<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableObjek extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5, //panjang angka, dlm int maksimal ada 11
                'unsigned'       => true, //wajib ada jika kita menggunakan primary key
                'auto_increment' => true, //membuat ID scera otomatis
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type' => 'TEXT', //karna panjang dan melebihi 255 shg menggunakan type TEXT
                'null' => true,
            ],
            'longitude' => [
                'type' => 'DECIMAL(20,15)', // 20 angka depan koma, 15 angka belakang koma

            ],
            'latitude' => [
                'type' => 'DECIMAL(20,15)',

            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_objek');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_objek'); // berfungsi untuk roleback : shg semua tabel nya dpt dihps 
    }
}
