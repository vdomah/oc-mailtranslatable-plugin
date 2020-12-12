<?php namespace Vdomah\MailTranslatable;

use Backend;
use Event;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use System\Classes\SettingsManager;
use System\Models\MailTemplate;
use Vdomah\MailTranslatable\Models\Template;

class Plugin extends PluginBase
{
    public $require = ['RainLab.Translate'];

    public function boot()
    {
        Event::listen('mailer.prepareSend', function ($obMailerInstance, $sView, $obMessage) {
            if (PluginManager::instance()->hasPlugin('RainLab.Translate')) {
                //get the currently sending template's record from db
                $obMailTemplate = MailTemplate::whereCode($sView)->first();

                //check if it exists and has template_db object which stores translations
                if ($obMailTemplate && $obMailTemplate->template_db) {
                    if ($obMailTemplate->template_db->subject) {
                        $obMessage->subject($obMailTemplate->template_db->subject);
                    }

                    if ($obMailTemplate->template_db->html) {
                        $obMessage->setBody($obMailTemplate->template_db->html, 'text/html');
                    }

                    if ($obMailTemplate->template_db->plain) {
                        $obMessage->addPart($obMailTemplate->template_db->plain, 'text/plain');
                    }
                }
            }
        });

        MailTemplate::extend(function ($obModel) {
            $obModel->hasOne['template_db'] = Template::class;
        });
    }

    public function registerSettings()
    {
        return [
            'templates' => [
                'label' => 'vdomah.mailtranslatable::lang.menu.templates_label',
                'description' => 'vdomah.mailtranslatable::lang.menu.templates_description',
                'icon' => 'icon-language',
                'url' => Backend::url('vdomah/mailtranslatable/templates'),
                'category'    => SettingsManager::CATEGORY_MAIL,
                'order' => 500,
                'permissions' => ['vdomah.mailtranslatable.access_settings']
            ],
        ];
    }

    public function registerPermissions()
    {
        return [
            'vdomah.mailtranslatable.access_settings' => [
                'tab' => 'vdomah.mailtranslatable::lang.plugin.name',
                'label' => 'vdomah.mailtranslatable::lang.permissions.access_settings'
            ],
        ];
    }
}
