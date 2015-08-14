<?// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?
//ѕроверка вступлени€ пользовател€ в группу
if(CModule::IncludeModule("iblock"))
{
    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_USER_ID","PROPERTY_PAGE_ID","PROPERTY_IS_MEMBER");//IBLOCK_ID и ID об€зательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>10, "PROPERTY_USER_ID"=>$_POST["id"], "PROPERTY_PAGE_ID"=>$_POST["activePage"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    $message["success"] = false;
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        //print_r($arFields);
        $message["success"] = true;
        $message["elementId"] = $arFields["ID"];
        $message["isMember"] = $arFields["PROPERTY_IS_MEMBER_VALUE"];
    }
    echo json_encode($message);
}
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>