<?php

class KurdishConverter{

  public $number = "";

  function __construct($number){
      $this->number = $number;
  }

  public function generateText(){
    $type = $this->checkType($this->number);
    switch($type){
      case "Time":
        $word = $this->TimeToWord($this->number);
        break;
      case "Date":
        $word = $this->DateToWord($this->number);
        break;
      case "Number":
        $word = $this->NumberToWord($this->number);
        break;
      case "UnknownType":
        return "Unknown Type";
        break;
    }
      return $word;
  }

  public function checkDate($token){
    $dt = DateTime::createFromFormat("d-m-Y", $token);
    return $dt !== false && !array_sum($dt->getLastErrors());
  }

  public function checkType($token){

    if(preg_match("/(1[012]|0[0-9]):([0-5][0-9])/", $token) > 0 || preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $token)>0){
      $tokenType = "Time";
    }
    else if($this->checkDate($token)){
      $tokenType = "Date";
    }
    else if(preg_match("/^[-+]?[0-9]*((([,]?[0-9]+)+)|([\/\.]?[0-9]+))$/", $token) > 0){
      $tokenType = "Number";
    }
    else{
      $tokenType="UnknownType";
    }

    return $tokenType;
  }


  public function CardinalNumber($number){
    $outputWord = "";
    $numberInString =$number;

    $numberHashTable = array();
    $numberHashTable["1"] = " یەک";
    $numberHashTable["2"] = "دوو";
    $numberHashTable["3"] = "سێ";
    $numberHashTable["4"] = "چوار";
    $numberHashTable["5"] = "پێنج";
    $numberHashTable["6"] = "شەش";
    $numberHashTable["7"] = "حەوت";
    $numberHashTable["8"] = "هەشت";
    $numberHashTable["9"] = "نۆ";
    $numberHashTable["0"] = "سفر";

    $numberHashTable["10"] = "دە";
    $numberHashTable["11"] = "یازدە";
    $numberHashTable["12"] = "دوازدە";
    $numberHashTable["13"] = "سێزدە";
    $numberHashTable["14"] = "چواردە";
    $numberHashTable["15"] = "پازدە";
    $numberHashTable["16"] = "شازدە";
    $numberHashTable["17"] = "حەڤدە";
    $numberHashTable["18"] = "هەژدە";
    $numberHashTable["19"] = "نۆزدە";

    $numberHashTable["20"] = "بیست";
    $numberHashTable["30"] = "سی";
    $numberHashTable["40"] = "چل";
    $numberHashTable["50"] = "پەنجا";
    $numberHashTable["60"] = "شەست";
    $numberHashTable["70"] = "حەفتا";
    $numberHashTable["80"] = "هەشتا";
    $numberHashTable["90"] = "نۆوە‌د";
    $numberHashTable["100"] = "سەد";
    $numberHashTable["1000"] = "هەزار";
    $numberHashTable["1000000"] = "ملیۆن";
    $numberHashTable["1000000000"] = "ملیار";
    $numberHashTable["1000000000000"] = "ترلیۆن";

    $numberLength = strlen($numberInString);
    $prefix="";

    if($numberInString[0] == "1" && strlen($numberInString) == 7 || strlen($numberInString) == 10 || strlen($numberInString) == 13){
      $prefix = $numberHashTable[$numberInString[0]];
    }

    if(array_key_exists($numberInString, $numberHashTable)){
      $outputWord = $prefix.$numberHashTable[$numberInString];
    }
    else{
      $partOne = "";
      $partTwo = "";

      switch ($numberLength) {
        case 1: // between 1 to 9
          $outputWord = $numberHashTable[$numberLength];
          break;
        case 2: // between 10 to 99
          if($numberInString[0] > 0) { $partOne = $numberHashTable[$numberInString[0]."0"]; }
          if($numberInString[1] > 0) { $partTwo = $numberHashTable[$numberInString[1]]; }
          break;
        case 3: // between 100 to 999
          if($numberInString[0] == 1){ $partOne = $numberHashTable["100"];}
          else{ if($numberInString[0] != "0"){ $partOne = $numberHashTable[$numberInString[0]]." ".$numberHashTable["100"];} }

          if(substr($numberInString,1,strlen($numberInString)-1)>0) {
            $partTwo = $this->CardinalNumber(substr($numberInString,1,strlen($numberInString)-1));
          }
          break;
        case 4: // between 1000 to 9999
          if($numberInString[0] == 1){ $partOne = $numberHashTable["1000"];}
          else{ $partOne = $numberHashTable[$numberInString[0]]." ".$numberHashTable["1000"];}
          if(substr($numberInString,1,strlen($numberInString)-1)>0) {
            $partTwo = $this->CardinalNumber(substr($numberInString,1,strlen($numberInString)-1));
          }
          break;

        case 5: // between 10000 to 99999
          $partOne = $this->CardinalNumber(substr($numberInString,0,2))." ".$numberHashTable["1000"];
          if(substr($numberInString,2,strlen($numberInString)-2)>0){
            $partTwo = $this->CardinalNumber(substr($numberInString,2,strlen($numberInString)-2));
          }
          break;

        case 6: // between 100000 to 999999
          $partOne = $this->CardinalNumber(substr($numberInString,0,3))." ".$numberHashTable["1000"];
          if(substr($numberInString,3,strlen($numberInString)-3)>0){
            $partTwo = $this->CardinalNumber(substr($numberInString,3,strlen($numberInString)-3));
          }
          break;

        case 7:
          if($numberInString[0] == 1){
            $partOne = $numberHashTable["1000000"];
          }
          else{
            $partOne = $numberHashTable[$numberInString[0]]." ".$numberHashTable["1000000"];
          }
          if(substr($numberInString,1,strlen($numberInString)-1)){
            $partTwo = $this->CardinalNumber(substr($numberInString,1,strlen($numberInString)-1));
          }
          break;

        case 8: // 10000000 to 99999999
          $partOne = $this->CardinalNumber(substr($numberInString,0,2))." ".$numberHashTable["1000000"];
          if(substr($numberInString,2,strlen($numberInString)-2)){
            $partTwo = $this->CardinalNumber(substr($numberInString,2,strlen($numberInString)-2));
          }
          break;

        case 9: // 10000000 to 99999999
          $partOne = $this->CardinalNumber(substr($numberInString,0,3))." ".$numberHashTable["1000000"];
          if(substr($numberInString,3,strlen($numberInString)-3)){
            $partTwo = $this->CardinalNumber(substr($numberInString,3,strlen($numberInString)-3));
          }
          break;

        case 10: //1000000000 to 9999999999
          if($numberInString[0] == 1){
            $partOne = $numberHashTable["1000000000"];
          }
          else{
            $partOne = $numberHashTable[$numberInString[0]]." ".$numberHashTable["1000000000"];
          }
          if(substr($numberInString,1,strlen($numberInString)-1)){
            $partTwo = $this->CardinalNumber(substr($numberInString,1,strlen($numberInString)-1));
          }
          break;

        case 11: //10000000000 to 99999999999
          $partOne = $this->CardinalNumber(substr($numberInString,0,2))." ".$numberHashTable["1000000000"];
          if(substr($numberInString,2,strlen($numberInString)-2)){
            $partTwo = $this->CardinalNumber(substr($numberInString,2,strlen($numberInString)-2));
          }
          break;

        case 12: //100000000000 to 999999999999
          $partOne = $this->CardinalNumber(substr($numberInString,0,3))." ".$numberHashTable["1000000000"];
          if(substr($numberInString,3,strlen($numberInString)-3)){
            $partTwo = $this->CardinalNumber(substr($numberInString,3,strlen($numberInString)-3));
          }
          break;

        case 13: //1000000000000 to 9999999999999
          if($numberInString[0] == 1){
            $partOne = $numberHashTable["1000000000000"];
          }
          else{
            $partOne = $numberHashTable[$numberInString[0]]." ".$numberHashTable["1000000000000"];
          }
          if(substr($numberInString,1,strlen($numberInString)-1)){
            $partTwo = $this->CardinalNumber(substr($numberInString,1,strlen($numberInString)-1));
          }
          break;

        case 14: //10000000000000 to 99999999999999
          $partOne = $this->CardinalNumber(substr($numberInString,0,2))." ".$numberHashTable["1000000000000"];
          if(substr($numberInString,2,strlen($numberInString)-2)){
            $partTwo = $this->CardinalNumber(substr($numberInString,2,strlen($numberInString)-2));
          }
          break;

        case 15: //100000000000000 to 999999999999999
          $partOne = $this->CardinalNumber(substr($numberInString,0,3))." ".$numberHashTable["1000000000000"];
          if(substr($numberInString,3,strlen($numberInString)-3)){
            $partTwo = $this->CardinalNumber(substr($numberInString,3,strlen($numberInString)-3));
          }
          break;

        default:
//            echo "Unknown number!!!";
          break;
      }

      if (strlen($partTwo)>0) {
        $outputWord = $prefix.$partOne." و ".$partTwo;
      } else{
        $outputWord = $prefix.$partOne;
      }
    }

    return $outputWord;
  }

  public function NumberToWord($token){

    $outPutWord="";
    $prefix="";

    if($token[0] == "+"){
      $prefix = "پۆسەتیڤ ";
      $token = substr($token,1);
    }
    else if($token[0] == "-"){
      $prefix = "نێگەتیڤ ";
      $token = substr($token,1);
    }

    if ((preg_match("/^[-+]?[0-9]*(([,]?[0-9])+)+$/", $token) > 0)){
      if(strlen($token) > 15 || $token[0] == "0"){
        $token = str_replace(",", "",$token);
        $number = "";

        for($numberIndex=0;$numberIndex<strlen($token)-1;$numberIndex++){
          $outPutWord .= $this->CardinalNumber(substr($token,$numberIndex,1));
        }
      }
      else{
        $outPutWord = $this->CardinalNumber($token);
      }
    }

    $outPutWord = $prefix.$outPutWord;
    return $outPutWord;
  }

  public function TimeToWord($token){
    $outPutWord="";

    $re = explode(':', $token);
    $minute = $re[1];
    $hour = $re[0];

    $prefix=""; $postfix="";

//    if(!strpos($this->prevToken,"کاتژمێر") && !strpos($this->prevToken,"سەعات")){
      $prefix = "کاتژمێر ";
//    }
//    if(!strpos($this->prevToken,"خولەك") && !strpos($this->prevToken,"دەقە")){
      $postfix = " خولەك ";
//    }

    $outPutWord = $prefix.$this->CardinalNumber($hour);

    if(intVal($minute) > 0){
       $outPutWord .= " و ".$this->CardinalNumber($minute).$postfix;
    }

    return $outPutWord;
  }

  public function DateToWord($token){
    $outPutWord="";

    $dateHashTable = array();
    $dateHashTable["1"] = "کانونی دووەم";
    $dateHashTable["2"] = "شووبات";
    $dateHashTable["3"] = "ئازار";
    $dateHashTable["4"] = "نیسان";
    $dateHashTable["5"] = "مایس";
    $dateHashTable["6"] = "حوزەیران";
    $dateHashTable["7"] = "تەمووز";
    $dateHashTable["8"] = "ئاب";
    $dateHashTable["9"] = "ئەیلول";
    $dateHashTable["01"] = "کانونی دووەم";
    $dateHashTable["02"] = "شووبات";
    $dateHashTable["03"] = "ئازار";
    $dateHashTable["04"] = "نیسان";
    $dateHashTable["05"] = "مایس";
    $dateHashTable["06"] = "حوزەیران";
    $dateHashTable["07"] = "تەمووز";
    $dateHashTable["08"] = "ئاب";
    $dateHashTable["09"] = "ئەیلول";
    $dateHashTable["10"] = "تشرینی یەکەم";
    $dateHashTable["11"] = "تشرینی دووەم";
    $dateHashTable["12"] = "کانونی یەکەم";

    $DateMatch = explode('-', $token);
    $DDay = $this->CardinalNumber($DateMatch[0]);
    $DMonth = $this->CardinalNumber($DateMatch[1]);
    $DYear = $this->CardinalNumber($DateMatch[2]);

    $outPutWord = $DDay."ی ".$dateHashTable[$DateMatch[1]]."ی ".$DYear;

    return $outPutWord;
  }
}
?>
