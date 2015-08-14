<? // подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?//Список акций
if(CModule::IncludeModule("iblock"))
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


    $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_USER_ID","PROPERTY_PAGE_ID","PROPERTY_IS_MEMBER",
        "PROPERTY_VK_LIKES", "PROPERTY_VK_REPOSTS", "PROPERTY_VK_COMMENTS");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>10, "PROPERTY_USER_ID"=>$USER->GetID(), "PROPERTY_PAGE_ID"=>$ID);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    $message["success"] = false;
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        //print_r($arFields);
        $message["success"] = true;
        $message["elementId"] = $arFields["ID"];
        $message["isMember"] = $arFields["PROPERTY_IS_MEMBER_VALUE"];
        $message["vkLikes"] = $arFields["PROPERTY_VK_LIKES_VALUE"];
        $message["vkReposts"] = $arFields["PROPERTY_VK_REPOSTS_VALUE"];
        $message["vkComments"] = $arFields["PROPERTY_VK_COMMENTS_VALUE"];
        $message["userId"] = $USER->GetID();
    }
    //echo json_encode($message);

    $JSONmessage = Array("success" => true, "data" => $message);
}

print_r(json_encode($JSONmessage));
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>