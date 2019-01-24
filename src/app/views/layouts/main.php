<?php
\project\assets\AssetBundle::register($this);
?>
<?php $this->beginContent('@app/views/layouts/base.php'); ?>
<div class="container">
    <?= $content; ?>
</div>
<?php $this->endContent(); ?>