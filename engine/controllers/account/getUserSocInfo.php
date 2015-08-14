<? // подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?//Список акций
if(CModule::IncludeModule("iblock"))
{
    $arUser=CUser::GetByID($USER->GetID())->GetNext();

    $message["userVkId"] = $arUser["UF_VK_LOGIN"];
    $message["userId"] = $USER->GetID();
    $message["userVkToken"] = $arUser["UF_VK_TOKEN"];

    $JSONmessage = Array("success" => true, "data" => $message);
}

print_r(json_encode($JSONmessage));
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>