yupe-vuejs-widget
=====
Install
------------


Run

```
php composer.phar require anisimovvb/yupe-vuejs-widget "*"
```


Add to protected/config/main.php

```php
'aliases' => [
    'vuejs' => realpath(Yii::getPathOfAlias('vendor') . '/anisimovvb/yupe-vuejs-widget/widget')
  ]
```



Usage
----- 


```php
<div id="vue-app">
    <template>
        <b-alert show>Test Alert</b-alert>
    <template>
</div>


<?php $this->beginWidget(
    'vuejs.YVue',
    [
        'id' => "vue-app",
        'data' => [
            'param_name' => 'param_value',
        ],
        'methods' => [
            'func1' =>
                "function(event){
                          return false;
                    }",
        ],
    ]
);
$this->endWidget();
?>
```
