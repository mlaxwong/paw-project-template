<?php
\project\assets\AssetBundle::register($this);
?>
<?php $this->beginContent('@app/views/layouts/_clear.php'); ?>
<div class="container">
    <?= $content; ?>
</div>
<?php $this->endContent(); ?>