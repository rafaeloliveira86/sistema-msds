<?= $this->tag->getDoctype() ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $this->tag->getTitle() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="<?= $phalcon_team ?>" name="author">
    <link rel="shortcut icon" href="/favicon.ico?v=<?= $ptools_version ?>">
    <?= $this->tag->stylesheetLink('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css', false) ?>

    <?= $this->assets->outputCss('main_css') ?>
    
    <?php if (isset($custom_css) && $custom_css == true) { ?><?= $this->assets->outputCss('custom_css') ?><?php } ?>

</head><body class="hold-transition sidebar-mini layout-fixed"><div class="wrapper">
        
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="https://github.com/phalcon/phalcon-devtools/issues" class="nav-link text-primary" target="_blank">
                <i class="fas fa-exclamation-triangle"></i>
                Did something go wrong? Try the Github Issues.
            </a>
        </li>
    </ul>
</nav>


        
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= $webtools_uri ?>" class="brand-link">
        <img class="brand-image" src="https://assets.phalcon.io/phalcon/images/svg/phalcon-logo-white-105x40.svg" alt="Phalcon DevTools" />
        <span class="brand-text font-weight-light">Web Tools</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN NAVIGATION</li>

                <li class="nav-item">
                    <a href="/webtools.php/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Controllers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/controllers/generate">
                                <i class="nav-icon fas fa-cogs"></i>
                                <span>Generate</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/controllers/list">
                                <i class="nav-icon fas fa-list"></i>
                                <span>List all</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Models
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a class="nav-link" href="/webtools.php/models/generate">
                                <i class="nav-icon fas fa-cogs"></i> <span>Generate</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="/webtools.php/models/list">
                                <i class="nav-icon fas fa-list"></i> <span>List all</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-file-code"></i> <span>Scaffold</span>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/scaffold/generate">
                                <i class="nav-icon fas fa-cogs"></i><span>Generate</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-magic"></i> <span>Migrations</span>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/migrations/generate">
                                <i class="nav-icon fas fa-cogs"></i><span>Generate</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/migrations/list">
                                <i class="nav-icon fas fa-list"></i><span>List all</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/migrations/run">
                                <i class="nav-icon fas fa-play"></i><span>Run</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/webtools.php/info">
                        <i class="nav-icon fas fa-info"></i> <p>System Info</p>
                    </a>
                </li>

                <li class="nav-header">LINKS</li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/phalcon/phalcon-devtools" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Phalcon DevTools</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/phalcon/incubator" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Phalcon Incubator</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://docs.phalcon.io/4.0/en/introduction" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Phalcon Docs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://zephir-lang.com/" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Zephir</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/phalcon/awesome-phalcon" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Awesome Phalcon</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<div class="content-wrapper">
    <section class="content-header">
    <div class="container-fluid"><?php if (isset($page_title) && !empty($page_title)) { ?><h1><?= $page_title ?>&nbsp;<?php if (isset($page_subtitle) && !empty($page_subtitle)) { ?><small><?= $page_subtitle ?></small><?php } ?></h1><?php } ?></div>
</section>

    <section class="content">
    <div class="container-fluid">
        <?= $this->getContent() ?>
    </div>
</section>

<div class="control-sidebar-bg"></div>
        </div>
    <footer class="main-footer">
    <div class="row">
        <div class="col-sm-12">
            <div class="hidden-xs">
                <strong><?= $app_name ?></strong>.
                Copyright &copy; <?= $copy_date ?> <?= $this->tag->linkTo([$phalcon_url, $phalcon_team, false]) ?>. All rights reserved.<br>
                <strong><?= $lte_name ?></strong>.
                Copyright &copy; <?= $lte_date ?> <?= $this->tag->linkTo([$lte_url, $lte_team, false]) ?>. All rights reserved.
            </div>
        </div>
    </div>
</footer>


    </div>

    
    <?= $this->assets->outputJs('footer') ?>
</body></html>
