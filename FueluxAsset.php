<?php

namespace leandrogehlen\fuelux;

use yii\web\AssetBundle;

class FueluxAsset extends AssetBundle
{
    public $sourcePath = '@bower/fuelux/dist';

    public $css = [
        'css/fuelux.min.css'
    ];

    public $js = [
        'js/fuelux.min.js'
    ];

} 