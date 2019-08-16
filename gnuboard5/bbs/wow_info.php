<div class="wow_info_readOnly">
    <h2>World Of Warcraft 정보</h2>
    <ul class="wow_info">
        <li>
        <label for="reg_mb_1" class=""><strong>진영</strong></label>
            <ul class="camp">
                <li>
                <label>
                    <input required type="radio" name="mb_1" value="A" <?php echo get_text($member['mb_1']) == 'A' ? 'checked' : '' ?> disabled/ >
                    <img src="/img/Alliance.png">
                    얼라이언스
                </label>
                </li>
                <li>
                
                    <label>
                        <input required type="radio" name="mb_1" value="H" <?php echo get_text($member['mb_1']) == 'H' ? 'checked' : '' ?> disabled />
                        <img src="/img/horde.png">
                        호드
                    </label>
                </li>
            </ul>
        </li>
        <li>
            <label for="reg_mb_2" class=""><strong>클라스</strong></label>
            <ul class="class_choose">
                <?php $class =array("전사","도적","마법사","흑마법사","사제" ,"성기사","주술사","드루이드","사냥꾼");?>
                <?php for($i = 0 ; $i < count($class); $i++){?>

                <li>
                <input  readonly="readonly" type="radio" name="mb_2" value="<?php echo $class[$i] ?>" <?php echo get_text($member['mb_2']) == $class[$i] ? 'checked' : '' ?> disabled />    
                <img src="<?php echo get_icon_by_categoryName($class[$i])?>"> <?php echo $class[$i];?>
                </li>
                <?php } ?>
            </ul>
        </li>
        <li>
            <label for="reg_mb_3" class=""><strong>전문기술</strong></label>
            <ul class="professional">
                <?php $professional =array("가죽세공","기계공학","대장기술","마법부여","재봉","연금술","무두질","약초","채광","낚시","요리");?>
                <?php for($i = 0 ; $i < count($professional); $i++){?>
                <li >
                <?php $professioanl_array = explode('|', $member['mb_3']); ?> 
                <input type="checkbox" name="mb_3[]" value="<?php echo $professional[$i] ?>" <?php if(in_array($professional[$i], $professioanl_array)) echo 'checked';  ?>  disabled />    
                <img src="<?php echo get_icon_by_categoryName($professional[$i])?>"> <?php echo $professional[$i];?>
                </li>
                <?php } ?>
            </ul>
        </li>
    <ul>
</div>