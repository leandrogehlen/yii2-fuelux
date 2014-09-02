<?php

namespace leandrogehlen\fuelux;

use yii\web\AssetBundle;

class FueluxAsset extends AssetBundle
{
    public $sourcePath = '@vendor/leandrogehlen/yii2-fuelux/assets';

    public $css = [
        'css/fuelux.min.css'
    ];

    public $js = [
        'js/fuelux.min.js'
    ];

} 