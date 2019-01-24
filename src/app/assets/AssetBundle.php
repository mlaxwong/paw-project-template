<?php
namespace project\assets;

class AssetBundle extends \yii\web\AssetBundle
{
    public $sourcePath = '@root/static';
    public $js = [
        ['js/vue.js', 'position' => \yii\web\View::POS_HEAD],
        'dist/bundle.js',
    ];
    public $css = [
        'dist/bundle.css',
    ];
    public $depends = [
        \paw\bootstrap4\BootstrapAsset::class
    ];
}