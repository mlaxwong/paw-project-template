<?php
\project\assets\AssetBundle::register($this);
?>
<?php $this->beginContent('@app/views/layouts/base.php'); ?>
<div class="global-container">
    <div class="global-sidebar">
        <a href="#" class="system-info">
            this is info
        </a>
        <nav>
            <ul>
                <li><a href="#">Dashboarad</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-container">
        <header>
            
        </header>
        <main>
            <?= $content; ?>
        </main>
    </div>
</div>
<?php $this->endContent(); ?>