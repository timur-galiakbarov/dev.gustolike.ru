<?// ����������� ��������� ����� �������
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
//------------------------------------------------------------------------------?>

<?
//��������� ������ � �������
if(CModule::IncludeModule("iblock")){
    //���������� ������ ��
    $ELEMENT_ID = $_POST["elementId"];  // ��� ��������
    $PROPERTY_CODE = "VK_LIKES";  // ��� ��������
    $PROPERTY_VALUE = $_POST["data"]["VKlikes"];  // �������� ��������
    // ��������� ����� �������� ��� ������� �������� ������� ��������
    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
    //���������� �������� ��
    $ELEMENT_ID = $_POST["elementId"];  // ��� ��������
    $PROPERTY_CODE = "VK_REPOSTS";  // ��� ��������
    $PROPERTY_VALUE = $_POST["data"]["VKreposts"];  // �������� ��������
    // ��������� ����� �������� ��� ������� �������� ������� ��������
    CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));

    print_r(json_encode(Array(
        "elementId"=>$_POST["elementId"],
        "data"=>$_POST["data"]
        )));
}
?>

<?//----------------------------------------------------------------------------
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>