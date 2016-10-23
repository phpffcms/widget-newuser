<?php

namespace Apps\Model\Admin\Newuser;


use Ffcms\Core\Arch\Model;
use Ffcms\Core\Helper\Type\Obj;

/**
 * Class FormSettings. Business logic of newuser widget settings
 * @package Apps\Model\Admin\Newuser
 */
class FormSettings extends Model
{
    public $count;
    public $cache;

    private $_configs;

    /**
     * FormSettings constructor. Pass default configs inside
     * @param array $configs
     */
    public function __construct(array $configs)
    {
        $this->_configs = $configs;
        parent::__construct(true);
    }

    /**
     * Set default properties from passed config array
     */
    public function before()
    {
        if (!Obj::isArray($this->_configs)) {
            return;
        }

        foreach ($this->_configs as $config => $value) {
            if (property_exists($this, $config)) {
                $this->{$config} = $value;
            }
        }
    }

    /**
     * Form validation rules
     * @return array
     */
    public function rules()
    {
        return [
            [['count', 'cache'], 'required'],
            [['count', 'cache'], 'int']
        ];
    }

    /**
     * Form display labels
     * @return array
     */
    public function labels()
    {
        return [
            'count' => __('Count'),
            'cache' => __('Cache')
        ];
    }
}