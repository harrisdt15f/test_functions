<?php
/**
 * Created by PhpStorm.
 * author: harris
 * Date: 17-10-25
 * Time: 上午9:48
 */
if (isset($_POST['submit']))
{
    var_dump($_POST);
    //array(2) {
    // ["education"]=> array(3) {
    // [0]=> string(1) "1" [1]=> string(1) "2" [2]=> string(1) "3"
    // }
    // ["submit"]=> string(3) "add" }
}else{
    echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">
<input type="text" name="ranks[]" value="1">
<input type="text" name="ranks[]" value="2">
<input type="text" name="ranks[]" value="3">
<input type="submit" name="submit" value="add"/>
</form>';
}