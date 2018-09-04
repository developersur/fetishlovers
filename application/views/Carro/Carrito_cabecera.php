                            <?php $productosC = $this->cart->contents(); ?>
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Carrito</span>
                                <div class="qty"><?php if(isset($productosC)) echo count($productosC); ?></div>
                            </a> 
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                <?php $productosC = $this->cart->contents(); ?>
                                <?php if(count($productosC)) { ?>
                                <?php foreach ($productosC as $p) { ?>
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="<?php echo $p["imagen"]; ?>" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#"><?php echo $p["name"]; ?></a></h3>
                                            <h4 class="product-price"><span class="qty"><?php echo $p["qty"]; ?>x</span>$<?php echo number_format($p["price"],'0',',','.'); ?></h4>
                                        </div>
                                        <button class="delete QuitarCabecera" rowid="<?php echo $p["rowid"]; ?>" action="index.php/Carro/QuitarCabecera"><i class="fas fa-times"></i></button> 
                                    </div>
                                <?php } ?>
                                <?php } else { ?>
                                    <div class="product-widget">
                                       No hay productos en el carrito
                                    </div>
                                <?php } ?>
                                </div>
                                <div class="cart-summary">
                                    <small>
                                        <?php if(isset($productosC)) echo count($productosC); ?>
                                        Item(s) seleccionados</small>
                                    <h5>SUBTOTAL: $<?php echo number_format($this->cart->total(),'0',',','.'); ?></h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="<?php echo base_url(); ?>index.php/Carro/">Ver carrito</a>
                                    <a href="<?php echo base_url(); ?>index.php/Carro/Paso1">Comprar  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>