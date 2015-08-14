<? // подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?//Список акций
if(CModule::IncludeModule("iblock"))
{
    global $USER;
    //Получаем ID по коду
    $arSelect = Array("ID", "CODE");
    $arFilter = Array("IBLOCK_ID"=>5, "CODE"=>$_GET["id"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    $ID = 0;
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $ID = $arFields["ID"];
    }


    $message = '';
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_PAGE_ID", "PREVIEW_PICTURE", "PREVIEW_TEXT");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>6, "PROPERTY_PAGE_ID"=>$ID);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    $i=0;
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        //print_r($arFields);
        $message[$i]["name"] = iconv("CP1251","UTF8",$arFields["NAME"]);
        $message[$i]["id"] = $arFields["ID"];
        $message[$i]["picture"] = CFILE::GetPath($arFields["PREVIEW_PICTURE"]);
        $message[$i]["description"] = iconv("CP1251","UTF8",$arFields["PREVIEW_TEXT"]);
        $i++;
    }
    //echo json_encode($message);

    $JSONmessage = Array("success" => true, "id"=>$ID, "data" => $message);
}

print_r(json_encode($JSONmessage));
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>