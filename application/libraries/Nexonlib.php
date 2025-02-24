<?php
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2018-08-13
 * Time: 오전 11:34
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: MINO
 * Date: 2018-08-13
 * Time: 오전 11:35
 */

class Nexonlib
{
    private $httpStatus = array(
        200=>"(OK)요청이 성공하였습니다.",
        400=>"(Bad Request)서버에서 처리할 수 없는 잘못된 요청입니다.",
        401=>"(Unauthorized)접근할 수 없는 API 입니다.",
        403=>"(Forbidden)접근할 수 없는 IP 입니다.",
        404=>"(Not Found)잘못된 API 입니다.",
        405=>"(Method Not Allowed)허용하지 않는 요청 메소드 입니다.",
        500=>"(Internal Server Error)서버에서 요청 처리 중 에러가 발생하였습니다.",
        503=>"(Server Unavaiable)서버가 요청을 처리할 수 없는 상태입니다."
    );

    private $returnCode = array(
        0=>"성공(Success)",
        99=>"실패(Fail)",
        2001=>"날짜 형식 오류(InvalidDateTime)",
        2002=>"계약 상세 없음(NotExistContractDetailNo)",
        2003=>"발행 추가 오류(PublishInsertError)",
        2004=>"쿠폰 핀 파싱 오류(CouponPinParseInvalid)",
        2005=>"계약 타입 오류(NotInvalidContractType)",
        2006=>"취소 불가한 상태(CanNotCencelStatus)",
        2007=>"유저 아이디 없음(NotExistUserID)",
        2008=>"발행 서비스 예외(WcfPublishServiceException)",
        2009=>"쿠폰 카드 업데이트 에러(CouponStatusUpdatePublishError)",
        2010=>"계약이 존재하지 않음(ContractInfoNotExist)"
    );

    /**
     * @return array
     */
    public function getHttpStatus($status)
    {
        return $this->httpStatus[$status];
    }

    /**
     * @return array
     */
    public function getReturnCode($code)
    {
        return $this->returnCode[$code];
    }

    public function getNexonCoupon($ContractDetailNo,$OrderDateTime,$SourceOrderId){

        $url = "https://api.coupon.nexon.com/v1/publish";
        $ClientPartyMappingCode ="11_MARKET";	        //string 실시간 발행 업체(게임) 코드
        $method = "POST";
        $requestData = array(
            'ContractDetailNo' => $ContractDetailNo,
            'ClientPartyMappingCode'=>$ClientPartyMappingCode,
            'OrderId'=>$SourceOrderId,
            'OrderDateTime'=>$OrderDateTime,
            'ContractType'=>1120
        );
        $requestJson = json_encode($requestData);
        $returnJson = $this->restSync($url,$requestJson,$method);

        echo "\n[getNexonCoupon]\n".$requestJson."\n->".$returnJson."\n\n";

        $apires = json_decode($returnJson);
        return $apires;
    }

    public function cancelNexonCoupon($couponData){
        $url = "https://api.coupon.nexon.com/v1/publish";

        $CouponPin = $couponData->couponno;
        $ClientPartyMappingCode = $couponData->ClientPartyMappingCode;
        $SourceOrderId = $couponData->NexonOrderId;
        $ApprovalNo = $couponData->ApprovalNo;
        $OrderDateTime = date("Y-m-d",strtotime($couponData->OrderDateTime));

        $OrderId = $couponData->id.time();//;

        $method = "PUT";
        $requestData = array(
            'CouponPin' => $CouponPin,                      //string	쿠폰핀
            'ClientPartyMappingCode' => $ClientPartyMappingCode,	        //string 실시간 발행 업체(게임) 코드
            'OrderId' => $OrderId,	                    //플엠 쿠폰 아이디 string 주문번호 (요청측의 유니크한 구분 값)
            'OrderDateTime' => $OrderDateTime,	                //datetime 주문날짜
            'SourceApprovalNo' => $ApprovalNo,	            //int	발행 시 승인번호
            'SourceOrderId' => $SourceOrderId	                //string	발행 시 주문번호
        );
        $requestJson = json_encode($requestData);

        $returnJson = $this->restSync($url,$requestJson,$method);
        $apires = json_decode($returnJson);
        return $apires;

    }


    function restSync($url,$json,$method)
    {
        //echo $apiurl."\n";

        switch ($method){
            case 'post':
            case 'POST':
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($curl, CURLOPT_POSTFIELDS,$json);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($json))
                );
                curl_setopt($curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1" );
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_TIMEOUT, 5);

                $data = curl_exec($curl);
                $info = curl_getinfo($curl);
                curl_close($curl);
                break;
            case 'put':
            case 'PUT':
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($json)));
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($curl, CURLOPT_POSTFIELDS,$json);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($json))
                );
                $data  = curl_exec($curl);
                $info = curl_getinfo($curl);
                curl_close($curl);
                break;
        }

        //echo "http_code=".$info['http_code']."\n";

        if($info['http_code'] == "200"){
            return $data;
        }else{
            return false;
        }
    }

// 암호화 된 Data를 복호화 한다.
    function decodeNexonCoupon($recv_key,$DataSource)
    {
        $PRIVATE_KEY = 1164371786; // 11_MARKET 라이브키
        $unique_key = $recv_key ^ $PRIVATE_KEY; // 두 키를 xor 연산하여 유니크 키 값을 얻는다
        echo "\nunique_key = {$unique_key}\n";
        return $this->Decode($unique_key, $DataSource);
    }

// 암호화 된 Data를 복호화 한다.
    function Execute()
    {
        $PRIVATE_KEY = 1469757106; // 11_MARKET
        $recv_key = 4657988; // 웹서비스로 전달 받은 outKey 값
        $unique_key = $recv_key ^ $PRIVATE_KEY; // 두 키를 xor 연산하여 유니크 키 값을 얻는다
        $DataSource = "MPTFREUJMPTM0EUPMPTXRE8ZMVTQ0ELRMVOEREWFEVOZREWVMPT50MLCEPOWRELSMVT4RM8GEPOM0MUJMPT5RM8PEPOT0EL5EPOT0M8AMVAZRMU6MVAJ0EUG"; // 웹서비스로 전달 받은 outCouponCodeSource

        $couponPin = Decode($unique_key, $DataSource);

    }

    function Decode ($unique_key, $DataSource)
    {
        $cMap = array
        (
            array('V', 'E', 'B', 'L', 'U', 'S', 'H', 'J', 'I', 'Y', 'O', 'N', 'G', '1', '0', '4'),
            array('P', 'M', '7', '8', 'W', '6', 'X', 'Z', 'Q', 'A', 'T', 'F', '5', 'C', 'R', '3')
        );

        $returnString = '';
        $mapOffset = $unique_key % 16;
        $sourceArray = str_split($DataSource);
        $keyByte = array($unique_key & 0x0000ffff, ($unique_key >> 16) & 0x0000ffff); // 해당 값을 유니코드 문자로 변환

        for($i = 0; $i < count($sourceArray); $i += 4)
        {
            $j = 0;
            $k = 0;
            $keyValue = 0;

            for($k = 0; $k < 4; $k++)
            {
                for($j = 0; $j < 16; $j++)
                {
                    if(($cMap[0][$j] == $sourceArray[$i + $k]) || ($cMap[1][$j] == $sourceArray[$i + $k]))
                    {
                        $keyValue += (($j + 16 - $mapOffset) % 16) << (12 - ($k * 4));
                        break;
                    }
                }
            }

            $returnString .= chr($keyValue ^ $keyByte[($i / 4) % 2]);
        }

        return $returnString;
    }

}