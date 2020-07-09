<?php
$admin = '1232898350';
$token = '1220134622:AAFyS6eaE_cScS1vzpiv2PvjMmv4x5Fs5Lg';

function bot($method,$datas=[]){
global $token;
    $url = "https://api.telegram.org/bot".$token."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}


$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$msgs = json_decode(file_get_contents('msgs.json'),true);

$type = $message->chat->type;
$text = $message->text;
$cid = $message->chat->id;
$uid= $message->from->id;
$gname = $message->chat->title;
$left = $message->left_chat_member;
$new = $message->new_chat_member;
$name = $message->from->first_name;
$repid = $message->reply_to_message->from->id;
$repname = $message->reply_to_message->from->first_name;
$newid = $message->new_chat_member->id;
$leftid = $message->left_chat_member->id;
$newname = $message->new_chat_member->first_name;
$leftname = $message->left_chat_member->first_name;
$username = $message->from->username;
$cusername = $message->chat->username;
$repmid = $message->reply_to_message->message_id; 

$data = $update->callback_query->data;
$cmid = $update->callback_query->message->message_id;
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;
$qid = $update->callback_query->id; 

$ctext = $update->callback_query->message->text; 
$callfrid = $update->callback_query->from->id; 
$callfname = $update->callback_query->from->first_name;  
$calltitle = $update->callback_query->message->chat->title; 
$calluser = $update->callback_query->message->chat->username; 
 
$channel = $update->channel_post; 
$channel_text = $channel->text;
$channel_mid = $channel->message_id; 
$channel_id = $channel->chat->id; 
$channel_user = $channel->chat->username; 

$chanel_doc = $channel->document; 
$chanel_tex = $channel->text; 
$chanel_vid = $channel->video; 
$chanel_mus = $channel->audio; 
$chanel_voi = $channel->voice; 
$chanel_gif = $channel->animation; 
$chanel_fot = $channel->photo; 
$caption=$channel->caption;
$cap=file_get_contents("baza/$channel_id.txt");
mkdir("like");
mkdir("baza");

if($text=="/start"){
  bot('sendmessage',[
   'chat_id'=>$cid,
   'text'=>"🙋🏻‍♂️Assalom Alaykum<b>$name</b>,@Share_S_Bot ga Hush Kelibsiz,
🤖Bu [BOT] Nima Qila Oladi!!!
1️⃣-Faqat Kanalda Ishlaydi,
2️⃣-Har Bir Postingizga 👍🏻/👎🏻 like Quyadi
3️⃣-Har Bir Postingizga Dustlarga Ulashish Quyadi
4️⃣-Bot Kanalda Admin Boʻlish Shart Boʻlmasa Ishlamaydi
🆗️-Bot Admini @Shox_Xacker

<code>#edit</code> va so'z - Har bir postingizga #edit so'zidan keyingi yozgan so'zingiz qo'shiladi
<code>#edittext</code> - #edit ga yozlilgan matningiz
<code>#tozalash</code> - #edit matnini o'chirib yuborish

<b>Yuqorida buyruqlar faqat kanallarda ishlaydi!</b>",
   'parse_mode' => 'html'
  ]);
}

if(isset($chanel_doc) or isset($chanel_vid) or isset($chanel_mus) or isset($chanel_voi) or isset($chanel_tex) or isset($chanel_gif) or isset($chanel_fot)){

bot('editmessagetext',[
        'chat_id'=>$channel_id,
        'message_id'=>$channel_mid,
        'text'=>"$chanel_tex

$cap",
        'parse_mode'=>'html',
      ]);
  

   bot('editmessagecaption',[
        'chat_id'=>$channel_id,
        'message_id'=>$channel_mid,
        'caption'=>"$caption

$cap",
        'parse_mode'=>'html',
      ]);
  
    $tokenn=uniqid("true");

    bot('editMessageReplyMarkup',[
        'chat_id'=>$channel_id,
        'message_id'=>$channel_mid,
        'inline_query_id'=>$qid, 
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"👍🏻", 'callback_data'=>"$tokenn=👍🏻"],['text'=>"👎🏻",'callback_data'=>"$tokenn=👎🏻"]],
       [['text'=>"↗️Do'stlarga ulashish↗️", "url"=>"https://telegram.me/share/url?url=https://telegram.me/$channel_user/$channel_mid"]], 
       ] 
       ]) 
       ]);
}

$channel_mid = $channel->message_id; 
$channel_user = $channel->chat->username; 
if(mb_stripos($data,"=")!==false){ 
$ex=explode("=",$data); 
$calltok=$ex[0]; 
$emoj=$ex[1]; 
$mylike=file_get_contents("like/$calltok.dat"); 
if(mb_stripos($mylike,"$callfrid")!==false){ 
      bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"✖️Siz Ovoz Berib Bo'lgansiz!❌", 
        'show_alert'=>false, 
    ]); 
}else{ 
file_put_contents("like/$calltok.dat","$mylike\n$callfrid=$emoj"); 
$value=file_get_contents("like/$calltok.dat"); 
$lik=substr_count($value,"👍🏻"); 
$des=substr_count($value,"👎🏻"); 
     bot('editMessageReplyMarkup',[ 
        'chat_id'=>$ccid, 
        'message_id'=>$cmid,
        'inline_query_id'=>$qid,
        'reply_markup'=>json_encode([ 
        'inline_keyboard'=>[ 
       [['text'=>"👍🏻 $lik", 'callback_data'=>"$calltok=👍🏻"],['text'=>"👎🏻 $des",'callback_data'=>"$calltok=👎🏻"]], 
         [['text'=>"↗️Do'stlarga ulashish↗️", "url"=>"https://telegram.me/share/url?url=https://telegram.me/$calluser/$cmid"]],
       ] 
       ]) 
       ]);
       bot('answerCallbackQuery',[ 
        'callback_query_id'=>$qid, 
        'text'=>"✅ Sizning Ovozingiz Qabul Qilindi!✔️", 
        'show_alert'=>false, 
    ]);  
  }
}

if(mb_stripos($channel_text,"#edit")!==false){
  $ex=explode("#edit", $channel_text);
  $exe=$ex[1];
  file_put_contents("baza/$channel_id.txt", "$exe");
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
}

if($channel_text=="#edittext"){
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
  bot('sendmessage',[
    'chat_id'=>$channel_id,
    'text'=>$cap,
    'parse_mode'=>'html',
  ]);
}

if($channel_text=="#tozalash"){
  unlink("baza/$channel_id.txt");
  bot('deletemessage',[
    'chat_id'=>$channel_id,
    'message_id'=>$channel_mid,
  ]);
}

$gruppa = file_get_contents("gruppa.db");
$lichka = file_get_contents("lichka.db");
$xabar = file_get_contents("xabarlar.txt");
if($type==$channel){
if(strpos($gruppa,"$channel_id") !==false){
}else{
file_put_contents("gruppa.db","$gruppa\n$channel_id");
}
}
if($type=="private"){
if(strpos($lichka,"$cid") !==false){
}else{
file_put_contents("lichka.db","$lichka\n$cid");
}
} 
$reply = $message->reply_to_message->text;
$rpl = json_encode([
            'resize_keyboard'=>false,
            'force_reply'=>true,
            'selective'=>true
        ]);
if($text=="/send" and $cid==$admin){
  bot('sendmessage',[
    'chat_id'=>$admin,
    'text'=>"Yuboriladigan xabar matnini kiriting!",
    'parse_mode'=>"html",
]);
    file_put_contents("xabarlar.txt","user");
}
if($xabar=="user" and $cid==$admin){
if($text=="/cancel"){
  file_put_contents("xabarlar.txt","");
}else{
  $lich = file_get_contents("lichka.db");
  $lichka = explode("\n",$lich);
  foreach($lichka as $lichkalar){
  $okuser=bot("sendmessage",[
    'chat_id'=>$lichkalar,
    'text'=>$text,
    'parse_mode'=>'html'
]);
}
if($okuser){
  bot("sendmessage",[
    'chat_id'=>$admin,
    'text'=>"Hamma userlarga yuborildi!",
    'parse_mode'=>'html',
]);
  file_put_contents("xabarlar.txt","");
}
}
}
if($text=="/sendchannel" and $cid==$admin){
  bot('sendmessage',[
    'chat_id'=>$admin,
    'text'=>"Kanallarga yuboriladigan xabar matnini kiriting!",
    'parse_mode'=>"html",
  ]);
  file_put_contents("xabarlar.txt","guruh");
}
if($xabar=="guruh" and $cid==$admin){
  if($text=="/cancel"){
  file_put_contents("xabarlar.txt","");
}else{
  $gr = file_get_contents("gruppa.db");
  $grup = explode("\n",$gr);
foreach($grup as $chatlar){
  $okguruh=bot("sendmessage",[
    'chat_id'=>$chatlar,
    'text'=>$text,
    'parse_mode'=>'html',
]);
}
if($okguruh){
  bot("sendmessage",[
    'chat_id'=>$admin,
    'text'=>"Hamma kanallarga yuborildi!",
    'parse_mode'=>'html',
]);
  file_put_contents("xabarlar.txt","");
}
}
}
if($type=="private"){
if($text=="/stat"){
  $lich = substr_count($lichka,"\n");
  $gr = substr_count($gruppa,"\n");
  $jami = $lich + $gr;
  bot('sendmessage',[
    'chat_id'=>$cid,
    'reply_to_message_id'=>$mid,
    'text'=>"<b>Bot foydalanuvchilari soni:</b>

A'zolar: <b>$lich</b> ta
Kanallar: <b>$gr</b> ta
Xammasi bo'lib: <b>$jami</b> ta",
    'parse_mode'=>"html"
  ]);
}
}