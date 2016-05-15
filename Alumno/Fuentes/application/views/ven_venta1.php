<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary">
                <div class="panel-heading">Paso 1</div>
                <div class="panel-body">
                    <form action="<?= site_url('/Venta/ProcesaCliente') ?>" method="POST">
                        <label for="select-gear">Selecciona un cliente:</label>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <select name="cliente" class="js-example-placeholder-multiple form-control">
                                    <option value="">Selecciona un cliente...</option>
                                    <optgroup label="Minoristas">
                                        <?php foreach ($minoristas as $value) : ?>
                                            <option value="<?= $value['id'] ?>" <?= set_select('cliente', $value['id']); ?>>
                                                <?= $value['nombre'] . ' - ' . $value['nif'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                    <optgroup label="Mayoristas">
                                        <?php foreach ($mayoristas as $value) : ?>
                                            <option value="<?= $value['id'] ?>" <?= set_select('cliente', $value['id']); ?>>
                                                <?= $value['nombre'] . ' - ' . $value['nif'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                </select>
                            </div>
                            
                        </div>
                        <?php if(isset($errorselect))
                                    echo $errorselect;
                                ?>
                        <div class="text-right" style="margin-top: 15px;">
                            <button type="submit" class="btn btn-default btn-primary">SIGUIENTE 
                                <i class="fa fa-arrow-right" aria-hidden="true"></i> 
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <script src="<?= base_url() . 'assets/js/jquery-2.2.3.min.js' ?>"></script>
            <script src="<?= base_url() . 'assets/js/select2.js' ?>"></script>
            <script>

                                $(".js-example-placeholder-multiple").select2({
                                    placeholder: "Selecciona un cliente"
                                });
            </script>
        </div>
    </div>
    <?php
//    echo '<pre>';
//    print_r($_POST);
//    echo '</pre>';
    ?>

</div>
