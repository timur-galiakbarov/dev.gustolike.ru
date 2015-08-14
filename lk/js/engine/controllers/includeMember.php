<?// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?//Вступление в акцию
if(CModule::IncludeModule("iblock"))
{
    $ELEMENT_ID = $_POST["elementId"];  // код элемента
    $PROPERTY_CODE = "IS_MEMBER";  // код свойства
    $PROPERTY_VALUE = $_POST["isMember"];  // значение свойства
    // Установим новое значение для данного свойства данного элемента
    $message["elementId"] = $_POST["elementId"];
    $message["isMember"] = $_POST["isMember"];
    $message["success"] = true;
    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
    print_r(json_encode($message));
}
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>