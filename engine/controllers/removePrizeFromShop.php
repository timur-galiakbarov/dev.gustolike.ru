<?// подключение служебной части пролога
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?
//Удаление вознаграждения из БД
if(CModule::IncludeModule('iblock') && ($arIBlockElement = GetIBlockElement($_POST["id"], 'pages')))
{
    if ($arIBlockElement["PROPERTIES"]["PAGE_ID"]["VALUE"] == $_POST["activePage"]){
        $DB->StartTransaction();
        if(!CIBlockElement::Delete($_POST["id"]))
        {
            $message = Array("success"=>false);
            $DB->Rollback();
        }
        else{
            $message = Array("success"=>true);
            $DB->Commit();
        }
    } else {
        $message = Array("success"=>false);
    }
}
?>

<?echo json_encode($message);?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>