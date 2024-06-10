<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%projects}}`.
 */
class m240609_191841_create_projects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    { {
        $this->createTable('{{%projects}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            #this will be used to relate to the user who owns or who is assigned the project
            'userId' => $this->integer()->notNull(),
            'imagePath' => $this->string()->defaultValue(null),
            'location' => $this->string()->defaultValue(null),
            'otherDetails' => $this->text(),
        ]);

        // Add foreign key constraint
        $this->addForeignKey(
            'fk-projects-userId',
            'projects',
            'userId',
            'user',
            'id',
            'CASCADE'
        );
    }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%projects}}');
    }
}
