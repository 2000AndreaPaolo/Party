<?php

namespace app\widgets;


use yii\bootstrap\Html;
use yii\base\Widget;

class Card extends \yii\bootstrap\Widget {

    public $containerOptions;
    public $title;
    public $titleOptions;
    public $useHeader = true;
    public $headerOptions;
    public $body = '';
    public $bodyOptions;
    public $footer;
    public $footerOptions;
    public $width;


    public function init() {
        parent::init();
        if (empty($this->containerOptions)) {
            Html::addCssClass($this->containerOptions, 'panel');
        }
        Html::addCssClass($this->containerOptions, 'panel-default');
        Html::addCssClass($this->headerOptions, 'panel-heading');
        Html::addCssClass($this->titleOptions, 'panel-title');
        Html::addCssClass($this->bodyOptions, 'panel-body');
        Html::addCssClass($this->footerOptions, 'panel-footer');
        Html::addCssStyle($this->containerOptions, 'width: 200px');
        ob_start();
    }

    public function run() {
        $out = Html::beginTag('div', $this->containerOptions);
        if (!empty($this->title)) {
            if ($this->useHeader) {
                $out .= Html::beginTag('div', $this->headerOptions);
                $out .= Html::beginTag('h5', $this->titleOptions);
                $out .= $this->title;
                $out .= Html::endTag('h5');
                $out .= Html::endTag('div');
            }
        }

        $out .= Html::beginTag('div', $this->bodyOptions);
        if (!$this->useHeader) {
            $out .= Html::beginTag('h5', $this->titleOptions);
            $out .= $this->title;
            $out .= Html::endTag('h5');
        }
        $out .= $this->body;
        $out .= ob_get_clean();
        $out .= Html::endTag('div');
        if (isset($this->footer)) {
            $out .= Html::beginTag('div', $this->footerOptions);
            $out .= $this->footer;
            $out .= Html::endTag('div');
        }
        $out .= Html::endTag('div');
        return $out;
    }

}
