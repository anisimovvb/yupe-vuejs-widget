<?php
/**
 * Виджет для интеграции с VueJS
 *
 * @category GoodlyWidget
 * @package  yupe.modules.investor.widgets
 * @author   AnisimovVB <anisimovvb@gmail.com>
 * @license  BSD http://ru.wikipedia.org/wiki/%D0%9B%D0%B8%D1%86%D0%B5%D0%BD%D0%B7%D0%B8%D1%8F_BSD
 * @version  0.2
 * @link     https://codebe.ru
 *
 **/

class YVue extends CWidget
{
    public $jsName = 'app';

    public $data;

    public $template;

    public $methods;

    public $computed;
    
    public $beforeCreate;
    
    public $created;
    
    public $beforeMount;
    
    public $mounted;
    
    public $beforeUpdate;
    
    public $updated;
    
    public $activated;

    public $deactivated;

    public $beforeDestroy;

    public $destroyed;

    public $script;

    public $components;


    public function init() {
        $vueAssets = $this->getAssetsUrl();

        Yii::app()->getClientScript()->registerScriptFile($vueAssets.'/js/vue.js');
        Yii::app()->getClientScript()->registerScriptFile($vueAssets . '/js/httpVueLoader.js');
        Yii::app()->getClientScript()->registerScriptFile($vueAssets . '/js/axios.min.js');
        Yii::app()->getClientScript()->registerCssFile($vueAssets . '/css/bootstrap-vue.css');
        Yii::app()->getClientScript()->registerScriptFile($vueAssets . '/js/bootstrap-vue.js');
        Yii::app()->getClientScript()->registerScriptFile($vueAssets . '/js/vue-simple-spinner.js');

    }
    public function getAssetsPath()
    {
        return  dirname(__FILE__) . '/assets';
    }

    public function getAssetsUrl()
    {
        return Yii::app()->getAssetManager()->publish($this->getAssetsPath());
    }

    public static function createData($data){
        $res = [];
        foreach ($data as $item){
            $res[] = $item->getAttributes();
        }
        return $res;
    }

    public static function begin($config = array()) {
        $obj =  parent::begin($config);
        echo '<div id="'.$obj->id.'">';
        return $obj;
    }


    public static function end() {
        echo '</div>';
        return parent::end();
    }

    public function run() {
        return $this->renderVuejs();
    }

    public function renderVuejs() {
        $data = $this->generateData();
        $methods = $this->generateMethods();
        $computed = $this->generateComputed();
        $el = $this->id;
        $js = "
            ".(!empty($this->script) ? $this->script : null).";
            var {$this->jsName} = new Vue({
                el: '#".$el."',
                ".(!empty($this->template) ? "template :'".$this->template."'," :null)."
                ".(!empty($data) ? "data :".$data.",":null)."
                ".(!empty($methods) ? "methods :".$methods."," :null)."
                ".(!empty($computed) ? "computed :".$computed."," :null)."
                ".(!empty($this->components) ? "components :".$this->components."," :null)."
                ".(!empty($this->mounted) ? "mounted :".$this->mounted."," :null)."
            }); 
        ";
        Yii::app()->clientScript->registerScript(
            'vuejs',
            $js,
            CClientScript::POS_END
        );

    }

    public function generateData() {
        if(!empty($this->data)){
            return json_encode($this->data);
        }
    }

    public function generateMethods() {
        if(is_array($this->methods) && !empty($this->methods)){
            $str = '';
            foreach ($this->methods as $key => $value) {
                    $str.= $key.":".$value.",";
            }
            return "{".$str."}";
        }
    }

    public function generateComputed() {
        if(is_array($this->computed) && !empty($this->computed)){
            $str = '';
            foreach ($this->computed as $key => $value) {
                    $str.= $key.":".$value->expression;
            }
            return "{".$str."}";
        }
    }
}
