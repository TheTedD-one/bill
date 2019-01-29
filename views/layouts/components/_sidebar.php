<?php
    use yii\helpers\Html;
?>
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">

                    <a href="#" class="media-left"><?= Html::img('/images/placeholder.jpg', ['class' => 'img-circle img-sm']); ?></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">Victoria Baker</span>
                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                        </div>
                    </div>

                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="#"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Меню</span> <i class="icon-menu" title="Main pages"></i></li>
                    <li class="active"><a href="index.html"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <li>
                        <a href="#"><i class="icon-stack2"></i> <span>Page layouts</span></a>
                        <ul>
                            <li><a href="layout_navbar_fixed.html">Fixed navbar</a></li>
                            <li><a href="layout_navbar_sidebar_fixed.html">Fixed navbar &amp; sidebar</a></li>
                            <li><a href="layout_sidebar_fixed_native.html">Fixed sidebar native scroll</a></li>
                            <li><a href="layout_navbar_hideable.html">Hideable navbar</a></li>
                            <li><a href="layout_navbar_hideable_sidebar.html">Hideable &amp; fixed sidebar</a></li>
                            <li><a href="layout_footer_fixed.html">Fixed footer</a></li>
                            <li class="navigation-divider"></li>
                            <li><a href="boxed_default.html">Boxed with default sidebar</a></li>
                            <li><a href="boxed_mini.html">Boxed with mini sidebar</a></li>
                            <li><a href="boxed_full.html">Boxed full width</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /main navigation -->
    </div>
</div>