<div class="cart-products-fast-view">
    <div class="content">
        <a href="javascript:void(0);" class="close-me" onclick="closeFastCartView()"><i class="fa fa-times" aria-hidden="true"></i></a>
        <ul>
            <?php
            foreach ($products as $cartProduct) {
                $sum += $cartProduct->num_added * (float) $cartProduct->price;
                ?>
                <li>
                    <a href="<?= lang_url($cartProduct->url) ?>" class="link"> 
                        <img src="<?= asset('storage/' . $cartProduct->image) ?>" alt="">
                        <span class="name"><?= $cartProduct->name ?></span>
                        <span class="price">
                            <?= $cartProduct->num_added ?> x <?= $cartProduct->price ?>
                        </span>
                    </a>
                    <a href="javascript:void(0);" class="removeQantity" onclick="removeQuantity(<?= $cartProduct->id ?>)">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <div class="clearfix"></div>
                </li>
            <?php } ?>
        </ul>
        <div class="pay-sum">
            <span class="text"><?= __('public_pages.subtotal') ?></span>
            <span class="sum"><?= $sum ?></span>
            <div class="clearfix"></div>
        </div>
        <a href="<?= lang_url('checkout') ?>" class="green-btn"><?= __('public_pages.payment') ?></a>
    </div>
</div>