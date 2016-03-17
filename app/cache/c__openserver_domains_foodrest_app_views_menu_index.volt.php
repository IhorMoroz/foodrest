<?php

?>
<div class="backFoodMenu AbsBox">
    <div class="foodMenu SiteBox">
        <ul>
            <?php foreach ($typeMenu as $item) { ?>
                <li>
                    <a href="<?php echo $item->href; ?>">
                        <img src="/public/img/<?php echo $item->image; ?>" alt="<?php echo $item->name; ?>">
                        <h4><?php echo $item->name; ?></h4>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <div class="content">
            <div class="boxInfoDish">
                <div class="img">
                    <img src="/public/img/back/food1.png" alt="">
                </div>
                <div class="info">
                    <h3>name dish</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti minima nemo minus culpa ratione amet. Assumenda recusandae dicta libero nulla, vel laborum, magni explicabo ipsa facilis labore nisi sint quam.
                    </p>
                    <a href="#">to order</a>
                </div>
            </div>
            <div class="boxList">
                <h2><?php echo $titleList; ?></h2>
                <table class="table table-hover">
                    <tr>
                        <th>name dish</th>
                        <th>gramme</th>
                        <th>price</th>
                    </tr>
                    <?php foreach ($dishList as $item) { ?>
                         <tr>
                            <td><p data-show="<?php echo $item->id; ?>" class="showDish"><?php echo $item->name_dish; ?></p></td>
                            <td><?php echo $item->weight_dish; ?><?php echo $item->type_weight_dish; ?></td>
                            <td>$<?php echo $item->price_dish; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>