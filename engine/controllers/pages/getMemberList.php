<? // подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?//Список акций
if(CModule::IncludeModule("iblock"))
{
    global $USER;
    $membersList = '';
    $i = 0;
    $arSelect = Array("ID", "NAME", "PROPERTY_ADMIN_ID", "CODE", "PROPERTY_PAGE_ID", "PROPERTY_IS_MEMBER", "PROPERTY_USER_ID");
    $arFilter = Array("IBLOCK_ID"=>10, "ACTIVE"=>"Y", "PROPERTY_PAGE_ID"=>$_GET["pageId"], "PROPERTY_IS_MEMBER"=>"true");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50, "iNumPage"=>1), $arSelect);

    while($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $rsUser = CUser::GetByID($arFields["PROPERTY_USER_ID_VALUE"]);
        $arUser = $rsUser->Fetch();

        $membersList[$i]["userId"] = $arFields["ID"];
        $membersList[$i]["isMember"] = $arFields["PROPERTY_IS_MEMBER_VALUE"];
        $membersList[$i]["pageId"] = $_GET["pageId"];
        $membersList[$i]["userFirstName"] = iconv("CP1251","UTF8",$arUser["NAME"]);
        $membersList[$i]["userLastName"] = iconv("CP1251","UTF8",$arUser["LAST_NAME"]);
        $i++;
    }

    $JSONmessage = Array("success" => true, "data" => $membersList);
}

print_r(json_encode($JSONmessage));
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>