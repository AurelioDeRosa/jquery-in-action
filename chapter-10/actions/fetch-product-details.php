<?php
    $items = array(
        '7141832' => array(
            'name' => 'Chippewa 17-inch Engineer Boot',
            'sku' => '7141832',
            'height' => '17 inches',
            'lining' => 'Leather',
            'colors' => 'Black Oil-tanned, Black Polishable',
            'price' => '$187.00',
            'features' => 'Oil-tanned or polishable full-grain leather uppers. Vibram sole. Goodyear welt. Padded insole. Steel safety toe.'
        ),
        '7173656' => array(
            'name' => 'Chippewa 11-inch Engineer Boot',
            'sku' => '7173656',
            'height' => '11 inches',
            'lining' => 'None',
            'colors' => 'Black, Crazy Horse',
            'price' => '$167.00',
            'features' => 'Oil-tanned full-grain leather uppers. Vibram sole. Goodyear welt. Padded insole. Steel safety toe. Texon&reg; insole.'
        ),
        '7141922' => array(
            'name' => 'Chippewa Harness Boot',
            'sku' => '7141922',
            'height' => '13 inches',
            'lining' => 'Leather',
            'colors' => 'Black, Crazy Horse',
            'price' => '$187.00',
            'features' => 'Full-grain leather uppers. Leather lining. Vibram sole. Goodyear welt.'
        ),
        '7177382' => array(
            'name' => 'Caterpillar Tradesman Work Boot',
            'sku' => '7177382',
            'height' => '6 inches',
            'lining' => 'Leather',
            'colors' => 'Honey, Peanut',
            'price' => '$87.00',
            'features' => 'Full-grain oil-tanned leather. Nylon mesh lining. Ortholite sock liner. EVA midsole. T84V Rubberlon outsole.'
        ),
        '7141730' => array(
            'name' => 'Danner Foreman Pro Work Boot',
            'sku' => '7141730',
            'height' => '10 inches',
            'lining' => 'Leather',
            'colors' => 'Honey, Brown',
            'price' => '$287.00',
            'features' => 'Alkali-resistant full-grain leather. Cambrelle nylon lining. Fiberglass shank. Vibram 4014 Cristy sole. Stitch-down construction.'
        ),
        '7141833' => array(
            'name' => 'Chippewa 17-inch Snakeproof Boot',
            'sku' => '7141833',
            'height' => '17 inches',
            'lining' => 'Leather',
            'colors' => 'Russet',
            'price' => '$147.00',
            'features' => 'Full-grain leather foot. 1000 Denier Cordura Viper cloth shaft. Goodyear welt. Leather Lining. Body Cushion Insole. Vibram Robinson Outsole.'
        ),
        '7257914' => array(
            'name' => 'Danner Grouse GTX Boot',
            'sku' => '7257914',
            'height' => '8 inches',
            'lining' => 'Gore-Tex',
            'colors' => 'Brown',
            'price' => '$207.00',
            'features' => 'Full-grain leather foot. 1000 Denier Cordura Viper cloth shaft. Gore-Tex lining. Stich-down construction.'
        ),
        '7269643' => array(
            'name' => 'Caterpillar Logger Boot',
            'sku' => '7269643',
            'height' => '8 inches',
            'lining' => 'Cambrelle',
            'colors' => 'Black',
            'price' => '$157.00',
            'features' => 'Full-grain leather. Cambrelle&reg; lining. Steel safety toe. Electrical hazard protection. Poliyou&reg; cushion insole. Rubber lug outsole.'
        ),
        '7332058' => array(
            'name' => 'Chippewa 9-inch Briar Waterproof Bison Boot',
            'sku' => '7332058',
            'height' => '9 inches',
            'lining' => 'Chip-A-Tex&reg; waterproof',
            'colors' => 'tan/brown/amber',
            'price' => '$138.00',
            'features' => 'Amber shark skin tip leather. Chip-A-Tex&reg; waterproof bootie. Vibram long haul outsole. Steel shank. Black nickle non-tarnishable hardware. Heavy duty stay-tied laces. Removable cushion orthotic. Non-insulated.'
        ),
        'default' => array(
            'name' => '-',
            'sku' => 'none',
            'height' => '-',
            'lining' => '-',
            'colors' => '-',
            'price' => '-',
            'features' => '-'
        )
    );

    $model = isset($_REQUEST['model']) ? $_REQUEST['model'] : 'default';
    $item = $items[$model];
?>

<ul class="boot-description">
    <li>
        <span class="property">Item name:</span> <?php echo $item['name']; ?>
    </li>
    <li>
        <span class="property">SKU:</span> <span class="value"><?php echo $item['sku']; ?>
    </li>
    <li>
        <span class="property">Height:</span> <span class="value"><?php echo $item['height']; ?>
    </li>
    <li>
        <span class="property">Colors:</span> <span class="value"><?php echo $item['colors']; ?>
    </li>
    <li>
        <span class="property">Lining:</span> <span class="value"><?php echo $item['lining']; ?>
    </li>
    <li>
        <span class="property">Today's price:</span> <span class="value"><?php echo $item['price']; ?>
    </li>
    <li>
        <span class="property">Features:</span> <span class="value"><?php echo $item['features']; ?>
    </li>
</ul>

<div>
    <?php
        if ($model !== 'default') {
            ?>
            <img id="item-photo" src="photos/<?php echo $item['sku']; ?>.png" />
        <?php
        }
    ?>
</div>
