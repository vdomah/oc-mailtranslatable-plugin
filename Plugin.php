<?php namespace Vdomah\MailTranslatable;

use Event;
use System\Classes\PluginBase;
use System\Classes\PluginManager;
use System\Models\MailTemplate;
use Vdomah\MailTranslatable\Models\Template;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        Event::listen('mailer.prepareSend', function ($obMailerInstance, $sView, $obMessage) {
            if (PluginManager::instance()->hasPlugin('RainLab.Translate')) {
                $obMailTemplate = MailTemplate::whereCode($sView)->first();
                if ($obMailTemplate && $obMailTemplate->template_db) {
                    if ($obMailTemplate->template_db->html) {
                        $obMessage->setBody($obMailTemplate->template_db->html, 'text/html');
                    }

                    if ($obMailTemplate->template_db->plain) {
                        $obMessage->addPart($obMailTemplate->template_db->plain, 'text/plain');
                    }
                }
            }
        });

        MailTemplate::extend(function ($model) {
            $model->hasOne['template_db'] = Template::class;
        });
    }
}
