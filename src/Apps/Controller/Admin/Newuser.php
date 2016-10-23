<?php

namespace Apps\Controller\Admin;


use Extend\Core\Arch\AdminController;
use Ffcms\Core\App;
use Ffcms\Core\Helper\FileSystem\File;
use Apps\ActiveRecord\App as AppRecord;
use Ffcms\Core\Helper\Serialize;
use Apps\Model\Admin\Newuser\FormSettings;

/**
 * Class Newuser. Admin controller to manage new users widget
 * @package Apps\Controller\Admin
 */
class Newuser extends AdminController
{
    const VERSION = '1.0.0';

    public $type = 'widget';

    private $appRoot;
    private $tplDir;

    /**
     * Set default data - root path, tpl directory and language locale
     */
    public function before()
    {
        $this->appRoot = realpath(__DIR__ . '/../../../');
        $this->tplDir = realpath($this->appRoot . '/Apps/View/Admin/default/');
        $langFile = $this->appRoot . '/I18n/Admin/' . $this->lang .'/Newuser.php';
        if ($this->lang !== 'en' && File::exist($langFile)) {
            App::$Translate->append($langFile);
        }
    }

    /**
     * Widget admin settings
     * @return string
     * @throws \Ffcms\Core\Exception\SyntaxException
     * @throws \Ffcms\Core\Exception\NativeException
     */
    public function actionIndex()
    {
        // init settings model
        $model = new FormSettings($this->getConfigs());

        // check if request is submited
        if ($model->send() && $model->validate()) {
            $this->setConfigs($model->getAllProperties());
            App::$Session->getFlashBag()->add('success', __('Settings is successful updated'));
        }

        // render viewer
        return $this->view->render('newuser/index', [
            'model' => $model
        ], $this->tplDir);
    }

    /**
     * Installation process function
     */
    public static function install()
    {
        // initialize class for configs & names
        $data = new \stdClass();
        $data->configs = [
            'count' => 12,
            'cache' => 60
        ];
        $data->name = [
            'en' => 'New users',
            'ru' => 'Новые пользователи'
        ];

        // find widget record in db
        $widget = AppRecord::where('type', 'widget')->where('sys_name', 'Newuser');
        if ($widget->count() !== 1) {
            return;
        }

        // update db data
        $widget->update([
            'name' => Serialize::encode($data->name),
            'configs' => Serialize::encode($data->configs),
            'disabled' => false,
            'version' => static::VERSION
        ]);
    }

}