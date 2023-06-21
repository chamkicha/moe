<?php


use App\Models\Registry_type;
use App\Models\School_category;
use Illuminate\Support\Carbon;

function generateTrackingNumber($schoolCategory){

    $category = School_category::find($schoolCategory);

    if ($category->category == 'Awali pekee'){

        return 'EA' .'-'.Carbon::today()->format('Ymd').'-'. mt_rand(100,999);
    }
    elseif ($category->category == 'Awali na Msingi'){

        return 'EM' .'-'.Carbon::today()->format('Ymd').'-'. mt_rand(100,999);
    }
    elseif ($category->category == 'Sekondari'){

        return 'ES' .'-'.Carbon::today()->format('Ymd').'-'. mt_rand(100,999);
    }
    elseif ($category->category == 'Chuo cha ualimu'){

        return 'EC' .'-'.Carbon::today()->format('Ymd').'-'. mt_rand(100,999);
    }
}

function generateFileNumber($registry,$school_category){

    $category = School_category::find($school_category);
    $registry_data = Registry_type::find($registry);

    if ($category->category == 'Awali pekee' & $registry_data->id == 1 || $registry_data->id == 2){

        return 'CD' .'.'.'28'.'/'.'315';
    }
    elseif ($category->category == 'Awali na Msingi' & $registry_data->id == 1 || $registry_data->id == 2){

        return 'CD' .'.'.'5'.'/'.'315';
    }
    elseif ($category->category == 'Sekondari' & $registry_data->id == 1 || $registry_data->id == 2){

        return 'CD' .'.'.'295'.'/'.'315';
    }
    elseif ($category->category == 'Chuo cha ualimu' & $registry_data->id == 1 || $registry_data->id == 2){

        return 'CB' .'.'.'5'.'/'.'375';
    }
    elseif ($category->category == 'Awali na Msingi' & $registry_data->id == 3){

        return 'EA' .'.'.'295'.'/'.'315';
    }
    elseif ($category->category == 'Sekondari' & $registry_data->id == 3){

        return 'EB'.'.'.'295'.'/'.'315';
    }
    elseif ($category->category == 'Chuo cha ualimu' & $registry_data->id == 3){

        return 'EC'.'.'.'280'.'/'.'374';
    }
}

function controlNumber(): int
{

    return mt_rand(100000000000,999999999999);
}

 function bill($billInfo)
{
    $url = env('BASE_URL') . '/api/bill-payment/sync/manage-bill';
    $data = $billInfo;

    return xmlResponse($url, inputXmlBill($data), $data['BillId']);
}

 function xmlResponse($url, $xmlData, $tracking_number)
{

    $billReqId = HASH('SHA256', $tracking_number);

    $callback = env('APP_URL').'payment/callback';
    $billCallBack = env('APP_URL').'bill/payment/callback';

    $headers = [
        "PymtClBckUrl: .$callback.",
        "BillClBckUrl: .$billCallBack.",
        "SpSysId:TTET001",
        "SpCode:SP896",
        "BillReqId: .$billReqId.",
        "Cache-Control:no-cache",
        "Content-Type:application/xml",
    ];

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $xmlData,
        CURLOPT_HTTPHEADER => $headers,
    );
    $curl = curl_init();
    curl_setopt_array($curl, $options);
    $data = curl_exec($curl);
    curl_close($curl);
    return simplexml_load_string($data);
}

function getDataString($inputstr,$datatag): string
{
    $datastartpos = strpos($inputstr, $datatag);
    $dataendpos = strrpos($inputstr, $datatag);
    $data=substr($inputstr,$datastartpos - 1,$dataendpos + strlen($datatag)+2 - $datastartpos);
    return $data;
}

function getSignatureString($inputstr,$sigtag): string
{
    $sigstartpos = strpos($inputstr, $sigtag);
    $sigendpos = strrpos($inputstr, $sigtag);
    $signature=substr($inputstr,$sigstartpos + strlen($sigtag)+1,$sigendpos - $sigstartpos -strlen($sigtag)-3);
    return $signature;
}

function toXML($data)
{

    return simplexml_load_string($data);
}

function toJSON($data){

    return json_decode(json_encode($data,1), TRUE);
}

 function inputXmlBill($data): string
{
    return "<?xml version='1.0' encoding='utf-8' standalone='yes'?>
                        <Gepg>
                        <gepgBillSubReq>
                            <BillHdr>
                                <SpCode>SP896</SpCode>
                                <RtrRespFlg>true</RtrRespFlg>
                            </BillHdr>
                            <BillTrxInf>
                                <BillId>" . $data['BillId'] . "</BillId>
                                <SubSpCode>1001</SubSpCode>
                                <ColCentCode>CC46000120001</ColCentCode>
                                <SpSysId>MoEST</SpSysId>
                                <BillAmt>" . $data['amount'] . "</BillAmt>
                                <MiscAmt>0</MiscAmt>
                                <BillExprDt>" . $data['end'] . "</BillExprDt>
                                <PyrId>" . $data['pyrid'] . "</PyrId>
                                <PyrName>" . $data['name'] . "</PyrName>
                                <BillDesc>" . $data['description'] . "</BillDesc>
                                <BillGenDt>" . $data['start'] . "</BillGenDt>
                                <BillGenBy>2584</BillGenBy>
                                <BillApprBy>SPPORTAL</BillApprBy>
                                <PyrCellNum>" . $data['phone'] . "</PyrCellNum>
                                <PyrEmail></PyrEmail>
                                <Ccy>TZS</Ccy>
                                <BillEqvAmt>" . $data['amount'] . "</BillEqvAmt>
                                <RemFlag>true</RemFlag>
                                <BillPayOpt>2</BillPayOpt>
                                <BillItems>
                                    <BillItem>
                                        <BillItemRef>" . $data['BillId'] . "</BillItemRef>
                                        <UseItemRefOnPay>N</UseItemRefOnPay>
                                        <BillItemAmt>" . $data['amount'] . "</BillItemAmt>
                                        <BillItemEqvAmt>500</BillItemEqvAmt>
                                        <BillItemMiscAmt>0</BillItemMiscAmt>
                                        <GfsCode>142202380001</GfsCode>
                                    </BillItem>
                                </BillItems>
                            </BillTrxInf>
                        </gepgBillSubReq>
                    <gepgSignature>fA6jlnSrPNsZ6fp7H9NJYSigyjGb3jYYLSKquU2iCj0t2bhdWVY4ItN73Fauums2kq7A8aX/PaAO7HZ3etU/NqNgqL0AQEL6GyxTnsKH2eypboSONc2IX4+foPbVJrVMorhb3KKVzerEXjLwYtFa41M3Do2OxvRbNGvUxpavBayhRElbpNKRx6w5XUQE1rSXuYm/B1f4p6XK3aJsvrZmw6ypXi0mAslRBH5UUoY4u5SqgzD8BpYsNC0b1OVUKshYdMXrwCAXRQpRz4EHp7+PrO67sZysAeRPG85nRGDAkzQPd2BWglAdrRoks8TqVR4UXoFWzBgoTub8wAV1WR0hyA==</gepgSignature>
                    </Gepg>";
}
