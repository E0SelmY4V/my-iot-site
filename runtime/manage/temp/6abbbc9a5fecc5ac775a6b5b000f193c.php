<?php /*a:1:{s:57:"F:\F1\website\iot\app\manage\view\common\quote.html";i:1644137900;}*/ ?>
<ul style="list-style: none;">
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
    <li id="<?php echo htmlentities($sign); ?>_li<?php echo htmlentities($row['id']); ?>" >
        <span id="<?php echo htmlentities($sign); ?>_span<?php echo htmlentities($row['id']); ?>" onclick="<?php echo htmlentities($sign); ?>.quote_select(<?php echo htmlentities($row['id']); ?>)">
            <div style="position: relative;display: inline-block;right: 0.2cm;">
                <input type="checkbox" id="<?php echo htmlentities($sign); ?>_checkbox<?php echo htmlentities($row['id']); ?>" />
                <div style="position: absolute;top: 0;left: 0;right: 0;bottom: 0;"></div>
            </div>
            <?php echo getAddInfoHTML($sign, $row); ?>
            <?php echo htmlentities($row['chinese']); ?>
        </span>
        <?php echo isParent($sign, $row['id'])
            ? '<button id="'.$sign.'_button'.$row['id'].'" onclick="'.$sign.'.quote_openf('.$row['id'].');">展开</button>'
            : ''; ?>
    </li>
    <script>
        if (typeof <?php echo htmlentities($sign); ?>.quote_checkList[<?php echo htmlentities($row['id']); ?>] == "undefined") <?php echo htmlentities($sign); ?>.quote_checkList[<?php echo htmlentities($row['id']); ?>] = false;
    </script>
<?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<?php echo $list; ?>