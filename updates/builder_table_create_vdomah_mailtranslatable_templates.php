<?php namespace Vdomah\MailTranslatable\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateVdomahMailTranslatableTemplates extends Migration
{
    public function up()
    {
        Schema::create('vdomah_mailtranslatable_templates', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('mail_template_id')->unsigned();
            $table->string('description')->nullable();
            $table->string('subject')->nullable();
            $table->text('plain')->nullable();
            $table->text('html')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('vdomah_mailtranslatable_templates');
    }
}
