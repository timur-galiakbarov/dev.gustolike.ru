<? // подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?//Список акций
if(CModule::IncludeModule("iblock"))
{
    global $USER;
    $pagesList = '';
    $i = 0;
    $arSelect = Array("ID", "NAME", "PROPERTY_ADMIN_ID", "CODE");
    $arFilter = Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $pagesList[$i]["name"] = iconv("CP1251","UTF8",$arFields["NAME"]);
        $pagesList[$i]["id"] = $arFields["ID"];
        $pagesList[$i]["code"] = $arFields["CODE"];
        if ($arFields["PROPERTY_ADMIN_ID_VALUE"] == $USER->GetID())
            $pagesList[$i]["isAdmin"] = true;
        else $pagesList[$i]["isAdmin"] = false;       
        $i++;
    }

    $JSONmessage = Array("success" => true, "data" => $pagesList);
}

print_r(json_encode($JSONmessage));
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>