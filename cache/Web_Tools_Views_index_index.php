<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Welcome to WebTools</h3>
            </div>

            <div class="card-body">
                This application allows you to use
                <?= $this->tag->linkTo([$phalcon_url, 'Phalcon', false, 'target' => '_blank']) ?>&nbsp;<?= $this->tag->linkTo([$devtools_url, 'Developer Tools', false, 'target' => '_blank']) ?> using a web interface.
            </div>
        </div>
    </div>
</div>
