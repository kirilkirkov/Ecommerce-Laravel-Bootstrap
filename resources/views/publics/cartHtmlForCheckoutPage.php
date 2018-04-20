<ul>
    <?php
    $sum_total = $sum = 0;
    foreach ($products as $cartProduct) {
        $sum_total += $cartProduct->num_added * (float) $cartProduct->price;
        $sum = $cartProduct->num_added * (float) $cartProduct->price;
        ?>
        <li>
            <input name="id[]" value="<?= $cartProduct->id ?>" type="hidden">
            <input name="quantity[]" value="<?= $cartProduct->num_added ?>" type="hidden">
            <a href="<?= lang_url($cartProduct->url) ?>" class="link">                                        
                <img src="<?= asset('storage/' . $cartProduct->image) ?>" alt="">
                <div class="info">
                    <span class="name"><?= $cartProduct->name ?></span>
                    <span class="price">
                        <?= $cartProduct->num_added ?> x <?= $cartProduct->price ?> = <?= $sum ?>
                    </span> 
                </div>
            </a>
            <div class="controls">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button type="button" onclick="removeQuantity(<?= $cartProduct->id ?>)" class="btn btn-default">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    </span>
                    <input type="text" name="quant" disabled="" class="form-control" value="<?= $cartProduct->num_added ?>">
                    <span class="input-group-btn">
                        <button type="button" onclick="addProduct(<?= $cartProduct->id ?>)" class="btn btn-default">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </span>
                </div>
            </div>
            <a href="javascript:void(0);" class="removeProduct" onclick="removeProduct(<?= $cartProduct->id ?>)">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
            <div class="clearfix"></div>
        </li>
    <?php } ?>
</ul>
<div class="final-total"><?= __('public_pages.sum_for_pay') ?> <?= $sum_total ?></div>