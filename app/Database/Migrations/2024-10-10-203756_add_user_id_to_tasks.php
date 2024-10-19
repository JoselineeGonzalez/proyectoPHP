<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToTask extends Migration
{
    public function up()
    {
        
        $this->forge->addColumn('tasks', [ 
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true
            ]
        ]);

        
        $sql = "ALTER TABLE tasks
                ADD CONSTRAINT tasks_user_id_fk
                FOREIGN KEY (user_id) REFERENCES user(id)
                ON DELETE CASCADE ON UPDATE CASCADE";

        $this->db->simpleQuery($sql);
    }

    public function down()
    {
        
        $this->forge->dropForeignKey('tasks', 'tasks_user_id_fk');
        
    
        $this->forge->dropColumn('tasks', 'user_id');
    }
}

