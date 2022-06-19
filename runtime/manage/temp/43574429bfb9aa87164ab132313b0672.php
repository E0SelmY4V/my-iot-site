<?php /*a:1:{s:60:"F:\F1\DataLibraries\iot\app\manage\view\common\retrieve.html";i:1644132411;}*/ ?>
<ul>
<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?>
    <li id="<?php echo htmlentities($sign); ?>_li<?php echo htmlentities($row['id']); ?>">
        <span onmousedown="<?php echo htmlentities($sign); ?>.select(<?php echo htmlentities($row['id']); ?>)" id="<?php echo htmlentities($sign); ?>_span<?php echo htmlentities($row['id']); ?>">
            <?php echo getAddInfoHTML($sign, $row); ?>
            <?php echo htmlentities($row['chinese']); ?>
        </span>
        <?php echo isParent($sign, $row['id'])
            ? '<button id="'.$sign.'_button'.$row['id'].'" onclick="'.$sign.'.openf('.$row['id'].');">展开</button>'
            : ''; ?>
    </li>
    <script>
        <?php echo htmlentities($sign); ?>.list[<?php echo htmlentities($row['id']); ?>] = <?php echo json_encode($row); ?>;
    </script>
<?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<?php echo $list; ?>