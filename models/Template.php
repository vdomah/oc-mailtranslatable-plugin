<?php namespace Vdomah\MailTranslatable\Models;

use Model;
use System\Models\MailTemplate;

/**
 * Model
 */
class Template extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /** @var array */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /** @var array */
    public $translatable = ['description', 'subject', 'plain', 'html'];

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vdomah_mailtranslatable_templates';

    public $belongsTo = [
        'mail_template' => MailTemplate::class,
    ];

    public function getHtml($data = [])
    {
        $out = $this->html;

        foreach ($data as $var=>$value) {
            $out = str_replace('{{ ' . $var . ' }}', $value, $out);
            $out = str_replace('{{' . $var . '}}', $value, $out);
        }

        return $out;
    }
}