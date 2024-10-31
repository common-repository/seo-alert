<?php

/* 

 */

namespace VanillaBeans\SEOAlert;

    if(!function_exists('\VanillaBeans\SEOAlert\Visit')){
    function Visit(){
        \VanillaBeans\SEOAlert\Visitor();
    }
        
}

if(!function_exists('\VanillaBeans\SEOAlert\Vareplace')){
    function Vareplace($in, $thisbot){
        $out = str_replace('{bot}', $thisbot, $in);
        $out = str_replace('{uri}', $_SERVER['REQUEST_URI'], $out);
        $out = str_replace('{uas}', $_SERVER['HTTP_USER_AGENT'], $out);
        $out = str_replace('{blogname}', get_option('blogname'), $out);
        return $out;
    }
}


if(!function_exists('\VanillaBeans\SEOAlert\vbean_botMail')){
    
    function vbean_botMail($subject, $string){
        try{
        $chunk = get_option('vbean_seoalert_recipients');
        $recips = explode (",", $chunk);
        $headers = "MIME-Version: 1.0\n" ."From: " . get_option('admin_email') . "\n"."Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
        wp_mail( $recips, $subject, $string );
    } catch (Exception $ex) {
            return;
        }
    }        
}

add_action( 'wp_loaded', '\VanillaBeans\SEOAlert\Visit' );

if(!function_exists('\VanillaBeans\SEOAlert\testalerts')){
    
    function testalerts(){
        \VanillaBeans\SEOAlert\Visitor(true,true);
    }        
}




if(!function_exists('\VanillaBeans\SEOAlert\Visitor')){
    function Visitor($display=false,$senddemomail=false){
        $botcount = intval(get_option('vbean_seoalert_botcount'));
        $googlebotcount = intval(get_option('vbean_seoalert_googlebotcount'));
        $yahoobotcount = intval(get_option('vbean_seoalert_yahoobotcount'));
        $bingbotcount = intval(get_option('vbean_seoalert_bingbotcount'));
        $otherbotscount = intval(get_option('vbean_seoalert_otherbotscount'));
        $visitor = 'none';
        $thisvisit=time();
        $lastvisit=0;
        $setting = '';
        $twentyfour = 24*60*60;
        $istwentyfour=false;
        $notifyemail=0;
        $notifyslack=0;
        $google=false;
        $bing = false;
        $yahoo = false;
        $ua = $_SERVER['HTTP_USER_AGENT'].'';
        $req = $_SERVER['REQUEST_URI'].'';
        $googlebots = array('Googlebot','Googlebot-News','Googlebot-Image','Googlebot-Video','Googlebot-Mobile','Mediapartners-Google','Mediapartners
(Googlebot)','AdsBot-Google','Googlebot/2.1; +http://www.google.com/bot.html','(compatible; Mediapartners-Google/2.1; +http://www.google.com/bot.html)','AdsBot-Google-Mobile-Apps');
        $bingbots=array('Bingbot','MSNBot','MSNBot-Media','AdIdxBot','BingPreview');
        $yahoobots=array('Yahoo Slurp','Yahoo! Slurp');
        $otherbots=array('DuckDuckBot','Baiduspider','YandexBot','Sogou','Exabot','facebookexternalhit','facebot','crawler@alexa.com');
        $ua = strtolower($ua);
        foreach ($googlebots as $b){
            $c=  strtolower($b);
            if (strpos($ua,  $c) !== false) {
                    $visitor = $b;
                    $google = true;
                    $googlebotcount=$googlebotcount+1;
                update_option( 'vbean_seoalert_googlebotcount', $googlebotcount );
                $lastvisit = (int)get_option('vbean_seoalert_googlelastvisit');
                $notifyemail = get_option('vbean_seoalert_googlebot');
                $notifyslack = get_option('vbean_seoalert_googlebotslack');
                $setting = 'vbean_seoalert_googlelastvisit';
            }
        }
        
        foreach ($yahoobots as $b){
            $c=  strtolower($b);
            if (strpos($ua,  $c) !== false) {
                $yahoo = true;
                $yahoobotcount = $yahoobotcount+1;
                $lastvisit = (int)get_option('vbean_seoalert_yahoolastvisit');
                update_option( 'vbean_seoalert_yahoobotcount', $yahoobotcount );
                $notifyemail = get_option('vbean_seoalert_yahoobot');
                $notifyslack = get_option('vbean_seoalert_yahoobotslack');
                $setting = 'vbean_seoalert_yahoolastvisit';
                    $visitor = $b;
            }
        }
        

        foreach ($bingbots as $b){
            $c=  strtolower($b);
            if (strpos($ua,  $c) !== false) {
                $bing = true;
                $bingbotcount=$bingbotcount+1;
                    $visitor = $b;
                $lastvisit = (int)get_option('vbean_seoalert_binglastvisit');
                $notifyemail = get_option('vbean_seoalert_bingbot');
                $notifyslack = get_option('vbean_seoalert_bingbotslack');
                $setting = 'vbean_seoalert_binglastvisit';
                update_option( 'vbean_seoalert_bingbotcount', $bingbotcount );
            }
        }
                
        foreach ($otherbots as $b){
            $c=  strtolower($b);
            if (strpos($ua,  $c) !== false) {
                $bing = true;
                $otherbotscount=$otherbotscount+1;
                    $visitor = $b;
                $lastvisit = (int)get_option('vbean_seoalert_otherbotslastvisit');
                $notifyemail = get_option('vbean_seoalert_otherbot');
                $notifyslack = get_option('vbean_seoalert_otherbotslack');
                $setting = 'vbean_seoalert_otherbotlastvisit';
                update_option( 'vbean_seoalert_otherbotscount', $otherbotscount );
            }
        }
        
        if($visitor!='none'){
            update_option($setting, $thisvisit);
            $subject = get_option('vbean_seoalert_subject');
                $subj = \VanillaBeans\SEOAlert\Vareplace($subject, $visitor);
                $mssg = get_option('vbean_seoalert_message');
                $msg = \VanillaBeans\SEOAlert\Vareplace($mssg, $visitor);
                if($display){
                    echo($subj.'<br />&nbsp;<br />'.$msg);
                }
                if($senddemomail){
                    \VanillaBeans\SEOAlert\vbean_botMail($subj, $msg);
                }else{
                    $istwentyfour = $thisvisit-$twentyfour>$lastvisit;
                    if(($notifyemail==2&&$istwentyfour)||$notifyemail==1){
                        \VanillaBeans\SEOAlert\vbean_botMail($subj, $msg);
                    }
                    if(($notifyslack==2&&$istwentyfour)||$notifyslack==1){
                        $slackvalid = get_option('vbean_slack_hooker_setupvalid');
                        if (!empty($slackvalid)&& function_exists('\VanillaBeans\SlackHooker\vbean_slackhooker')) {
                            \VanillaBeans\SlackHooker\vbean_slackhooker($msg, get_option('vbean_seoalert_slackchannel'), get_option('vbean_seoalert_slackbotname'),get_option('vbean_seoalert_slackicon'));
                        }
                    }
                    
                }
            }else{
                if($display){
                    echo($subj.'<br />&nbsp;<br />'.$msg);
                }
                if($senddemomail){
                        \VanillaBeans\SEOAlert\vbean_botMail($subj, $msg);
                }
        }
        
        
    
        
        
        
    }
}

add_shortcode('testalert', '\VanillaBeans\SEOAlert\testalerts');
