<?php
    use yii\helpers\Html;
use yii\widgets\Menu;

?>
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">

                    <a href="#" class="media-left"><?= Html::img('/images/placeholder.jpg', ['class' => 'img-circle img-sm']); ?></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">Администратор</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp;Казахстан, Караганда
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">

                <?php
                echo Menu::widget([
                    'items' => require __DIR__ . '/_menu.php',
                    'options' => [
                        'class' => 'navigation navigation-main navigation-accordion',
                    ],
                    'submenuTemplate' => "\n<ul class='nav nav-group-sub'>\n{items}\n</ul>\n",
                    'activeCssClass' => 'active',
                    'encodeLabels' => false,
                    'activateParents' => true,
                    'itemOptions' => ['class' => 'nav-item'],
                    'linkTemplate' => '<a href="{url}" class="nav-link"><span>{label}</span></a>'
                ]); ?>

            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>