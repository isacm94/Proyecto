
<div class="x_panel">
    <table class="table table-bordered table-hover table-responsive">
        <tr class="warning">            
            <th>Template</th>
            <th>Seleccionada</th>
            <th>Localización</th>
            <th>Demo</th>
        </tr>
        
        <?php foreach ($plantillas_admin as $key => $value):?>
            <tr>
                <td><?=$key?></td>
                <td>
                    <?php if($this->session->userdata('template-adm-activa') == $value['fichero']): //Si la template está activa?>
                        <a href="#" class="btn btn-default btn-select-template"><i class="fa fa-star fa-lg" aria-hidden="true"></i></a>
                    <?php endif;?>
                    
                    <?php if($this->session->userdata('template-adm-activa') != $value['fichero']): //Si la template NO está activa?>
                        <a href="<?=  site_url().'//ConfigPlantillas/CambiaPlantillaAdmin/'.$value['fichero']?>" class="btn btn-default btn-no-select-template"><i class="fa fa-star-o fa-lg" aria-hidden="true"></i></a>
                    <?php endif;?>
                </td>
                <td>Administración</td>
                <td><a target="_blank" href="<?=$value['linkDemo']?>">Ver demo</a></td>
            </tr>
        <?php endforeach;?>
    </table>
</div>

