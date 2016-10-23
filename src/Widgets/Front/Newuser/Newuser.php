<?php

namespace Widgets\Front\Newuser;

use Apps\ActiveRecord\Profile;
use Extend\Core\Arch\FrontWidget;
use Ffcms\Core\App;
use Ffcms\Core\Helper\FileSystem\File;
use Ffcms\Core\Traits\ClassTools;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class Newuser. Front widget logic
 * @package Widgets\Front\Newuser
 */
class Newuser extends FrontWidget
{
    use ClassTools;

    public $count;
    public $cache;

    private $_cacheName;

    /**
     * Initialize widget - set default properties from configs
     */
    public function init()
    {
        // get configs and set properties
        $cfg = $this->getConfigs();
        if ($this->count === null) {
            $this->count = (int)$cfg['count'];
        }
        if ($this->cache === null) {
            $this->cache = (int)$cfg['cache'];
        }
        $this->_cacheName = 'widget.newuser.' . $this->createStringClassSnapshotHash();
        // set translation
        $root = realpath(__DIR__ . '/../../../');
        $langFile = $root . '/I18n/Front/' . App::$Request->getLanguage() . '/Newuser.php';
        if (File::exist($langFile)) {
            App::$Translate->append($langFile);
        }
    }

    /**
     * Display widget data
     * @return string
     * @throws \Ffcms\Core\Exception\SyntaxException
     * @throws \Ffcms\Core\Exception\NativeException
     */
    public function display()
    {
        $records = null;
        if ($this->cache > 0) {
            if (App::$Cache->get($this->_cacheName) !== null) {
                $records = App::$Cache->get($this->_cacheName);
            } else {
                $records = $this->getUserProfiles();
                App::$Cache->set($this->_cacheName, $records, $this->cache);
            }
        } else {
            $records = $this->getUserProfiles();
        }

        // render output view
        return App::$View->render('widgets/newuser/index', [
            'records' => $records
        ], __DIR__);
    }

    /**
     * Get user profiles from db as active records collection
     * @return Collection
     */
    private function getUserProfiles()
    {
        return Profile::orderBy('created_at', 'DESC')->take($this->count)->get();
    }
}