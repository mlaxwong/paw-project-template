<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?= Html::beginTag('body', ArrayHelper::merge(
    ['class' => isset($this->theme->skin) ? $this->theme->skin : '']
    , isset($body) ? $body : [])
); ?>
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php $this->endBody() ?>
<?= Html::endTag('body'); ?>
</html>
<?php $this->endPage() ?>