<?php

namespace leandrogehlen\fuelux;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * @see http://exacttarget.github.io/fuelux/javascript.html#checkboxes
 * @author Leandrogehlen <leandroghelen@gmail.com>
 */
class Checkbox extends InputWidget
{
    /**
     * @var string the checkbox label
     */
    public $label;

    /**
     * @var boolean whether controls appear on the same line.
     */
    public $inline = false;

    /**
     * @var boolean whether add a background highlight upon check
     */
    public $highlight = false;

    /**
     * @var boolean whether controls is addon checkbox.
     */
    public $addon = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->addon) {
            $this->inline = true;
        }

        if ($this->label == null && !$this->addon && $this->hasModel()) {
            $this->label = $this->model->getAttributeLabel($this->attribute);
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $pluginOptions = [
            'id' => ArrayHelper::remove($this->options, 'id'),
            'data-initialize' => 'checkbox'
        ];

        if (!$this->inline) {
            Html::addCssClass($pluginOptions, 'checkbox');
        }

        if ($this->addon) {
            Html::addCssClass($pluginOptions, 'input-group-addon');
        }

        if ($this->highlight === true) {
            Html::addCssClass($pluginOptions, 'highlight');
        }

        Html::addCssClass($this->options, 'sr-only');

        $this->renderCheckbox($pluginOptions);
        FueluxAsset::register($this->getView());
    }

    /**
     * Renders the checkbox input
     * @param array $pluginOptions
     */
    public function renderCheckbox($pluginOptions)
    {
        if ($this->inline){
            Html::addCssClass($pluginOptions, 'checkbox-custom checkbox-inline');
            echo Html::beginTag('label', $pluginOptions) . "\n";
        } else {
            echo Html::beginTag('div', $pluginOptions) . "\n";
            echo Html::beginTag('label', ['class' => 'checkbox-custom']) . "\n";
        }

        if ($this->hasModel()) {
            echo Html::activeInput('checkbox', $this->model, $this->attribute, $this->options) . "\n";
        } else {
            echo Html::checkbox($this->name, $this->value, $this->options) . "\n";
        }
        echo $this->label . "\n";
        echo Html::endTag('label') . "\n";

        if (!$this->inline) {
            echo Html::endTag('div');
        }
    }

}
