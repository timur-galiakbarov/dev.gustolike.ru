<?// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?
//Сохраняем данные в Битрикс
if(CModule::IncludeModule("iblock")){
    //Сохранение лайков ВК
    $ELEMENT_ID = $_POST["elementId"];  // код элемента
    $PROPERTY_CODE = "VK_LIKES";  // код свойства
    $PROPERTY_VALUE = $_POST["data"]["VKlikes"];  // значение свойства
    // Установим новое значение для данного свойства данного элемента
    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
    //Сохранение репостов ВК
    $ELEMENT_ID = $_POST["elementId"];  // код элемента
    $PROPERTY_CODE = "VK_REPOSTS";  // код свойства
    $PROPERTY_VALUE = $_POST["data"]["VKreposts"];  // значение свойства
    // Установим новое значение для данного свойства данного элемента
    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));

    print_r(json_encode(Array(
        "elementId"=>$_POST["elementId"],
        "data"=>$_POST["data"]
        )));
}
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>