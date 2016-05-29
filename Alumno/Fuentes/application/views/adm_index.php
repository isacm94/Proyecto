<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><img src="<?= base_url() . 'assets/images/este_mes.png' ?>" style="padding: 10px;"></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= $este_mes['mes'] ?></span>
                <span class="info-box-number"><?= $este_mes['ventas'] . ' ventas' ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><img src="<?= base_url() . 'assets/images/anterior_mes.png' ?>" style="padding: 10px;"></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= $anterior_mes['mes'] ?></span>
                <span class="info-box-number"><?= $anterior_mes['ventas'] . ' ventas' ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><img src="<?= base_url() . 'assets/images/anterior_semana.png' ?>" style="padding: 10px;"></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= $anterior_semana['lunes'] . ' - ' . $anterior_semana['domingo'] ?></span>
                <span class="info-box-number"><?= $anterior_semana['ventas'] . ' ventas' ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><img src="<?= base_url() . 'assets/images/esta_semana.png' ?>" style="padding: 10px;"></span>
            <div class="info-box-content">
                <span class="info-box-text"><?= $esta_semana['lunes'] . ' - ' . $esta_semana['domingo'] ?></span>
                <span class="info-box-number"><?= $esta_semana['ventas'] . ' ventas' ?></span>
            </div>
        </div>
    </div>
</div>