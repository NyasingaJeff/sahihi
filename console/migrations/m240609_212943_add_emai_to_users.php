<?php

use yii\db\Migration;

/**
 * Class m240609_212943_add_emai_to_users
 */
class m240609_212943_add_emai_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->addColumn('{{%user}}', 'email', $this->string()->unique());


    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropColumn('{{%user}}','email');
    }

}
