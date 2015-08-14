<? // подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?//Список акций
if(CModule::IncludeModule("iblock") && $_GET["code"])
{
    global $USER;
    //Получаем ID по коду
    $arSelect = Array("ID", "CODE");
    $arFilter = Array("IBLOCK_ID"=>5, "CODE"=>$_GET["code"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $ID = $arFields["ID"];
    }
    $arIBlockElement = GetIBlockElement($ID, 'pages');

    $page["name"] = iconv("CP1251","UTF8",$arIBlockElement["NAME"]);
    $page["description"] = iconv("CP1251","UTF8",$arIBlockElement["PREVIEW_TEXT"]);
    $page["id"] = $arIBlockElement["ID"];
    $page["code"] = $arIBlockElement["CODE"];
    $page["logoImg"] = CFILE::GetPath($arIBlockElement["PROPERTIES"]["LOGO"]["VALUE"]);
    $page["prizeList"] = $arIBlockElement["PROPERTIES"]["PRIZE_LIST"]["VALUE"];
    $page["isVk"] = $arIBlockElement["PROPERTIES"]["IS_VK"]["VALUE"];
    $page["useShop"] = $arIBlockElement["PROPERTIES"]["USE_SHOP"]["VALUE"];
    $page["scanDate"] = $arIBlockElement["PROPERTIES"]["SCAN_DATE"]["VALUE"];
    $page["useMainPrize"] = $arIBlockElement["PROPERTIES"]["USE_MAIN_PRIZE"]["VALUE"];
    $page["usePeriodPrize"] = $arIBlockElement["PROPERTIES"]["USE_PERIOD_PRIZES"]["VALUE"];
    $page["vkGroup"] = $arIBlockElement["PROPERTIES"]["VK_GROUP"]["VALUE"];
    $page["bannerURL"] = CFILE::GetPath($arIBlockElement["PROPERTIES"]["BANNER"]["VALUE"]);

    $JSONmessage = Array("success" => true, "data" => $page);
} else {
    $JSONmessage = Array("success" => false);
}

print_r(json_encode($JSONmessage));
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>