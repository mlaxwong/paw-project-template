<?php
\project\assets\AssetBundle::register($this);
?>
<?php $this->beginContent('@app/views/layouts/_clear.php'); ?>
<?= $content; ?>
<?php $this->endContent(); ?>