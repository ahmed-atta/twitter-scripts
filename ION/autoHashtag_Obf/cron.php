<?php 
/** -------------------------------------|
 * @author AHMED ATTA (parmagy.com)      |
 * @email  info@parmagy.com       |
 * @website http://tweety-ar.com/        |
 * -------------------------------------*/
 require_once("config.php");  require_once('lib/twitter/twitteroauth.php');  $R47C4857E938BD88BA638633CAF296BBA = "SELECT * FROM `tweets`"; if($R7E90BAB0D73D2A09487CEE53867B64B9 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query($R47C4857E938BD88BA638633CAF296BBA)){  if($R7E90BAB0D73D2A09487CEE53867B64B9->num_rows > 0){   while($R050F40040BA8F31097940F999AAC6639 = $R7E90BAB0D73D2A09487CEE53867B64B9->fetch_assoc()) {    if(isset($R050F40040BA8F31097940F999AAC6639['user_id']) && $R050F40040BA8F31097940F999AAC6639['user_id'] == '-1'){     $RA123E8B30C415D1471A6C71BE5AA1713 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM users");    } else if(isset($R050F40040BA8F31097940F999AAC6639['user_id']) && !empty($R050F40040BA8F31097940F999AAC6639['user_id'])){     $RA123E8B30C415D1471A6C71BE5AA1713 = $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("SELECT * FROM users WHERE id IN (".$R050F40040BA8F31097940F999AAC6639['user_id'].");");    } else {     exit;    }    while($RE0D5EDB560A26D4E1BECD832EA026E32 = $RA123E8B30C415D1471A6C71BE5AA1713->fetch_assoc()) {     $R185F7CD086AFAD484A334CB45591BFAB = $RE0D5EDB560A26D4E1BECD832EA026E32['accessToken'];     $R74056FB4CE1465F0BFBFEA38652641B4 = $RE0D5EDB560A26D4E1BECD832EA026E32['accessTokenSecret'];     $R8CE5CE11AD9037C5520515DEF277FD9D = $R050F40040BA8F31097940F999AAC6639['tweet']."\r\n".$R050F40040BA8F31097940F999AAC6639['count'];     $R3247F9DE3A59E8FE17114A24F81329D3 = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $R185F7CD086AFAD484A334CB45591BFAB, $R74056FB4CE1465F0BFBFEA38652641B4);     if($R8CE5CE11AD9037C5520515DEF277FD9D){       switch($R050F40040BA8F31097940F999AAC6639['hashtag_location']){        case 'sa':          $R0FC694E85343C291F53770941ABC26F0 = "23424938";         break;        case 'eg':         $R0FC694E85343C291F53770941ABC26F0 = "23424802";         break;        case 'kw':         $R0FC694E85343C291F53770941ABC26F0 = "23424870";          break;        case 'ae':         $R0FC694E85343C291F53770941ABC26F0 = "23424738";          break;        case 'qa':         $R0FC694E85343C291F53770941ABC26F0 = "23424930";          break;        case 'bh':         $R0FC694E85343C291F53770941ABC26F0 = "23424753";          break;        default:       }       $R6F2F8CF05B0EF041F6F1C7FD327D4627 = $R3247F9DE3A59E8FE17114A24F81329D3->get('trends/place',array("id"=> $R0FC694E85343C291F53770941ABC26F0));       $R89370CFFF4BBFFC8B263128EC6914311  ="\n";      }      $R5FF20CD486D4D3866232FF9C190C883D = mb_strlen($R8CE5CE11AD9037C5520515DEF277FD9D, 'UTF-8');      $RF97F567927F6AF780E206D642A40A602 = 140 - $R5FF20CD486D4D3866232FF9C190C883D;        for($RA16D2280393CE6A2A5428A4A8D09E354 = 0; $RA16D2280393CE6A2A5428A4A8D09E354 < 10; $RA16D2280393CE6A2A5428A4A8D09E354++){       $R8EEB1221AED257518AC7928EB7CF9AA3 = $R89370CFFF4BBFFC8B263128EC6914311 .' '.$R6F2F8CF05B0EF041F6F1C7FD327D4627[0]->trends[$RA16D2280393CE6A2A5428A4A8D09E354]->name;        if(mb_strlen($R8EEB1221AED257518AC7928EB7CF9AA3, 'UTF-8') < $RF97F567927F6AF780E206D642A40A602)         $R89370CFFF4BBFFC8B263128EC6914311 .=' '.$R6F2F8CF05B0EF041F6F1C7FD327D4627[0]->trends[$RA16D2280393CE6A2A5428A4A8D09E354]->name;        else          break;       }      $R8CE5CE11AD9037C5520515DEF277FD9D .= $R89370CFFF4BBFFC8B263128EC6914311;          $R8C072FDF530C84D973287CC76B48DE1A = $R3247F9DE3A59E8FE17114A24F81329D3->post('statuses/update',array('status' =>$R8CE5CE11AD9037C5520515DEF277FD9D));       $RA1D44C0654A40984A103C270FFB9BF33 = $R050F40040BA8F31097940F999AAC6639['count']+1;       $R0DADB0D8CA9669A3F9F73A406CB0A0FC->query("Update `tweets` SET count =".$RA1D44C0654A40984A103C270FFB9BF33." WHERE id= ".$R050F40040BA8F31097940F999AAC6639['id']);     }   }  } } ?>