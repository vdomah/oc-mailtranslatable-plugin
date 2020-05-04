<?php namespace Vdomah\MailTranslatable\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use System\Classes\SettingsManager;

class Templates extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Vdomah.MailTranslatable', 'templates');
        //BackendMenu::setContext('Vdomah.MailTranslatable', 'mailtranslatable', 'mailtranslatable');
    }
}