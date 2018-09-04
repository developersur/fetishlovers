<div class="container" id="contenedor_quienessomos">
    

    <?php //echo var_dump($this->cart->contents()); ?>
    <div id="resultados"></div>

    <div class="row">
        <div class="col-md-12">
        <fieldset>
            <legend class="text-center header titulo">Carrito de compras</legend>
            <div class="col-md-12">
                <div class="listado_carrito">
                    <table class="table">
                        <thead class="cabecera_dark">
                            <tr>
                                <th style="text-align: center">Imagen</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th style="text-align: right">Precio</th>
                                <th>Cantidad</th>
                                <th style="text-align: right">Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="body_carrito">
                            <?php $productosC = $this->cart->contents(); ?>
                            <?php if(count($productosC)) { ?>
                            <?php foreach ($productosC as $p) { ?>
                            <tr>
                                <td align="center"><img src="<?php echo $p["imagen"]; ?>" width="80px"></td>
                                <td><?php echo $p["id"]; ?></td>
                                <td><?php echo $p["name"]; ?></td>
                                <td align="right">$<?php echo number_format($p["price"],'0',',','.'); ?></td>
                                <td>
                                    <input type="number" name="cantidad" class="form-control InputCantidad" value="<?php echo $p["qty"]; ?>" rowid="<?php echo $p["rowid"]; ?>" action="<?php echo base_url();?>index.php/Carro/Actualizar">
                                    <a href="<?php echo base_url(); ?>index.php/Carro/"><i class="fas fa-redo-alt"></i></a>
                                </td>
                                <td align="right">$<?php echo number_format($p["subtotal"],'0',',','.'); ?></td>
                                <td><a href="#" class="Quitar" action="<?php echo base_url();?>index.php/Carro/Quitar" rowid="<?php echo $p["rowid"]; ?>"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4">No hay productos en el carrito</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td align="right">Total: </td>
                                <td align="right"><b>$<?php echo number_format($this->cart->total(),'0',',','.'); ?></b></td>
                                <td></td>
                            </tr>
                    </table>
                    
                    <div style="text-align: right; margin-bottom: 100px;">
                    <?php if(isset($productosC) and count($productosC)>0) { ?>
                        <a href="<?php echo base_url(); ?>index.php/Carro/Paso1" class="btn btn-primary">Continuar con la compra</a>
                    <?php } ?>
                    </div>
                
                </div>    
            </div>
        </fieldset>
        </div>
    </div>
</div>