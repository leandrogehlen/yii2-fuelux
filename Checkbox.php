<?php

namespace leandrogehlen\fuelux;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * @see http://exacttarget.github.io/fuelux/javascript.html#checkboxes
 * @author Leandrogehlen <leandroghelen@gmail.com>
 * @since 2.0
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

    private $_internalOptions;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initInternalOptions();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        Html::addCssClass($this->options, 'sr-only');

        if (!$this->inline){
            echo Html::beginTag('div', $this->_internalOptions) . "\n";
            $this->renderCheckbox();
            echo Html::endTag('div');
        } else {
            $this->renderCheckbox();
        }

        FueluxAsset::register($this->getView());
    }

    /**
     * Renders the checkbox input
     */
    public function renderCheckbox()
    {
        if ($this->inline == true){
            Html::addCssClass($this->_internalOptions, 'checkbox-custom checkbox-inline');
            echo Html::beginTag('label', $this->_internalOptions) . "\n";
        } else {
            echo Html::beginTag('label', ['class' => 'checkbox-custom']) . "\n";
        }

        if ($this->hasModel()) {
            echo Html::activeCheckbox($this->model, $this->attribute, $this->options) . "\n";
        } else {
            echo Html::checkbox($this->name, $this->value, $this->options) . "\n";
        }
        echo $this->label . "\n";
        echo Html::endTag('label') . "\n";
    }

    /**
     * Initializes the internal options.
     * This method sets the default values for various options.
     */
    protected function initInternalOptions()
    {
        $this->_internalOptions = [
            'id' => ArrayHelper::remove($this->options, 'id'),
            'data-initialize' => 'checkbox'
        ];

        if (!$this->inline) {
            Html::addCssClass($this->_internalOptions, 'checkbox');
        }

        if ($this->highlight === true) {
            Html::addCssClass($this->_internalOptions, 'highlight');
        }
    }

} 