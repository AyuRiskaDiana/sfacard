<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRatingTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rating' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pengaduan' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'rating' => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'komentar' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tanggal' => [
                'type'    => 'DATETIME',
                'default' => new \RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id_rating', true);
        $this->forge->addForeignKey('id_pengaduan', 'pengaduan', 'id_pengaduan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('rating');
    }

    public function down()
    {
        $this->forge->dropTable('rating');
    }
}
