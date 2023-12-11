<?php
require_once 'pdo.php';
function get_news_highligh($limi)
{
    $sql = "SELECT * FROM news WHERE hot = 1 ORDER BY id ASC LIMIT " . $limi;

    return pdo_query($sql);
}
function get_news_all($limit)
{
    $sql = "SELECT * FROM news ORDER BY id DESC LIMIT " . $limit;
    return pdo_query($sql);
}

function get_news_by_id($id)
{
    $sql = "SELECT * FROM news WHERE id=?";
    return pdo_query_one($sql,$id);
}


function showNewsHighligh($dsnews){
$html_ds_news ='';
foreach ($dsnews as $item) {
    
    extract($item);
    if ($img != "") $img = PATH_IMG . $img;
    $link = "index.php?pg=newsdetail&idnews=" . $id;
    $html_ds_news .='
    <a href="'.$link.'">
    <div class="cursor-pointer rounded-lg overflow-hidden shadow-lg">
        <img class="w-full h-80 object-cover" src="'.$img.'" alt="Sunset in the mountains" />
<div class="px-6 py-4">
    <div class="flex items-center justify-start gap-4 pb-2">
        <ion-icon class="text-gray font-mormal text-base" name="calendar"></ion-icon>
        <span class="text-gray font-mormal text-base">'.$date.'</span>
    </div>
    <div class="font-bold text-xl mb-2">'.$title.'</div>
    <p class="text-third leading-6 text-base font-mormal pb-6 tracking-wider">'.$short.'</p>
    <button class="flex items-center gap-4 transiton duration-300 ease-in hover:gap-6">
        <span class="text-pink">ĐỌC THÊM </span>
        <ion-icon class="text-pink" name="arrow-forward"></ion-icon>
    </button>
</div>
</div>
</a>
';
}
return $html_ds_news;
}
function showNewsLatest($dsnews){
$html_ds_news ='';
foreach ($dsnews as $item) {
extract($item);
if ($img != "") $img = PATH_IMG . $img;
$link = "index.php?pg=newsdetail&idnews=" . $id;
$html_ds_news .='
<a href="'.$link.'">
<div class="overflow-hidden py-6 grid grid-cols-5 border-b-2 border-gray"><img
        class="h-52 object-cover col-span-1 w-full rounded-md " src="'.$img.'" alt="    " />
    <div class="px-6 py-4 col-span-4">
        <div class="flex pt-4 items-center justyfy-center gap-2 pb-2">
            <ion-icon class="text-gray font-mormal text-base" name="calendar"></ion-icon><span
                class="text-gray font-mormal text-base">'.$date.'</span>
        </div>
        <div class="font-bold text-xl mb-2">'.$title.'</div>
        <p class="text-third text-base font-mormal pb-2">'.$short.'</p><a href="">
            <button class="flex items-center gap-4 transiton duration-300 ease-in hover:gap-6"><span
                    class="text-pink text-p">ĐỌC THÊM</span>
                <ion-icon class="text-pink text-p" name="arrow-forward"></ion-icon>
            </button></a>
    </div>
</div>
</a>
';
}

return $html_ds_news;
}