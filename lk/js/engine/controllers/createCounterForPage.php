<?// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>
<?
if(CModule::IncludeModule("iblock"))
{
    //Сохранение акции
    $el = new CIBlockElement;
    $PROP = array();
    $PROP["USER_ID"] = $USER->GetID();
    $PROP["PAGE_ID"] = $_POST["activePage"];
    $PROP["IS_MEMBER"] = $_POST["isMember"];
    $arLoadProductArray = Array(
      "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
      "IBLOCK_ID"      => 10,
      "PROPERTY_VALUES"=> $PROP,
      "NAME" => "Счетчик пользователя ".$USER->GetFirstName()." ".$USER->GetLastName(),
      );

    if($el->Add($arLoadProductArray))
      $message = array("success"=>"true");
    else
      $message = array("success"=>"fail", "Error"=> $el->LAST_ERROR, "Place"=>"Произошла ошибка в контроллере savePageSettings.php");
}
print_r(json_encode($message));
?>
<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>