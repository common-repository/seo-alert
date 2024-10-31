<?php

/* 
 * Copyright (C) 2014 Velvary Pty Ltd
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace VanillaBeans\SEOAlert;
            // If this file is called directly, abort.
            if ( ! defined( 'WPINC' ) ) {
                    die;
            }


function RegisterSettings(){
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_recipients' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_message' );
        register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_subject' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_googlebot' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_yahoobot' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_bingbot' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_otherbots' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_googlebotslack' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_yahoobotslack' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_bingbotslack' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_otherbotsslack' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_othersearch' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_botcount' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_googlebotcount' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_yahoobotcount' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_bingbotcount' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_otherbotscount' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_googlelastvisit' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_yahoolastvisit' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_binglastvisit' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_otherbotslastvisit' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_slackchannel' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_slackbotname' );
	register_setting( 'vbean-seoalert-settings', 'vbean_seoalert_slackicon' );
    
}

function SettingsPage(){
        $googlebotcount = intval(get_option('vbean_seoalert_googlebotcount'));
        $yahoobotcount = intval(get_option('vbean_seoalert_yahoobotcount'));
        $bingbotcount = intval(get_option('vbean_seoalert_bingbotcount'));  
        $otherbotscount = intval(get_option('vbean_seoalert_otherbotscount'));  
        $lastbing = date('d M H:i',  (int)get_option('vbean_seoalert_binglastvisit'));
        $lastyahoo = date('d M H:i',  (int)get_option('vbean_seoalert_yahoolastvisit'));
        $lastgoogle = date('d M H:i',  (int)get_option('vbean_seoalert_googlelastvisit'));
        $lastotherbots = date('d M H:i',  (int)get_option('vbean_seoalert_otherbotslastvisit'));
    if((int)get_option('vbean_seoalert_binglastvisit')<1450475992){
        $lastbing='Unknown';
    }
        
    if((int)get_option('vbean_seoalert_binglastvisit')<1450475992){
        $lastyahoo='Unknown';
    }
        
    if((int)get_option('vbean_seoalert_googlelastvisit')<1450475992){
        $lastgoogle='Unknown';
    }
    if((int)get_option('vbean_seoalert_otherbotslastvisit')<1450475992){
        $lastotherbots='Unknown';
    }
        
        
    ?>
<script language="javascript" type="text/javascript">
<?php
?>
</script>

<style>
    #vbexcludelist{
        position:relative;
        display:inline-table;
        width:100%;
        border: 1px groove;
        background-color: #f6c9cc;
        padding:5px;
    }
    .vbexcludelistitemcontainer{
        padding:5px;
        position:relative;
        display:inline-block;
        width:100%;
        margin-bottom:3px;
    }
    
    .vbexcludelistitempath{
        border-bottom:1px dashed;
        display:inline-block;
        width:70%;
    }
    
    .vbexcludelistitemline{
        border-bottom:1px dashed;
        display:inline-block;
        text-align:right;
        margin-right:7px;
        width:10%;
    }
    .vbexcludelistitemremove{
        text-align:right;
        display:inline-block;
        width:15%;
    }
    .vbcheading{
        display:inline-block;
        width:100%;
        font-weight: bold;
       background:#0000ff;
       color:white;
        padding:0;
        
    }
    .pixelplug{display:none;}
    .vbcheading div{
    } 
    .vbcheading div .vbexcludelistitempath{
        padding-left: 10px;
        margin:0;
    } 
    .vbcheading div .vbexcludelistitemline{
        margin:0;
    } 
    .vbcheading div .vbexcludelistitemremove{
        margin:0;
    } 
    .botvalue{
        font-weight: bold;
        margin-right:20px;
        width:50px;
        display:inline-block;
    }
    .botname{
        font-weight: bold;
    }
    .vb-sub{
        font-weight:bold;
        width:80px;
        display:inline-block;
    }
</style>

        <div class="wrap">
        <div>
            <h3>Visits:</h3>
            <table>
                <thead>
                <tr>
                    <th> &nbsp;</th>
                    <th>Total visists</th>
                    <th>&nbsp;&nbsp;&nbsp;Last visit</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th align="right">Google</th>
                        <td align="right"><?php echo($googlebotcount)?></td>
                        <td align="right"><?=$lastgoogle?></td>
                    </tr>
                    
                    <tr>
                        <th align="right">Yahoo</th>
                        <td align="right"><?php echo($yahoobotcount)?></td>
                        <td align="right"><?=$lastyahoo?></td>
                    </tr>
                    
                    <tr>
                        <th align="right">Bing</th>
                        <td align="right"><?php echo($bingbotcount)?></td>
                        <td align="right"><?=$lastbing?></td>
                    </tr>
                    
                    <tr>
                        <th align="right">Other (duckduckgo etc)</th>
                        <td align="right"><?php echo($otherbotscount)?></td>
                        <td align="right"><?=$lastotherbots?></td>
                    </tr>
                    
                    
                    
                </tbody>
                
                
                
            </table>
            

            
        </div>
        <h2>Vanilla Bean search engine visitor register settings</h2>
        <form method="post" action="options.php">
            <input type="hidden" name="vbean_seoalert_googlebotcount" id="vbean_seoalert_googlebotcount" value="<?= get_option('vbean_seoalert_googlebotcount') ?>" />
            <input type="hidden" name="vbean_seoalert_yahoobotcount" id="vbean_seoalert_yahoobotcount" value="<?= get_option('vbean_seoalert_yahoobotcount') ?>" />
            <input type="hidden" name="vbean_seoalert_bingbotcount" id="vbean_seoalert_bingbotcount" value="<?= get_option('vbean_seoalert_bingbotcount') ?>" />
            <input type="hidden" name="vbean_seoalert_otherbotscount" id="vbean_seoalert_otherbotscount" value="<?= get_option('vbean_seoalert_otherbotscount') ?>" />
            <input type="hidden" name="vbean_seoalert_googlelastvisit" id="vbean_seoalert_googlelastvisit" value="<?= get_option('vbean_seoalert_googlelastvisit') ?>" />
            <input type="hidden" name="vbean_seoalert_yahoolastvisit" id="vbean_seoalert_yahoolastvisit" value="<?= get_option('vbean_seoalert_yahoolastvisit') ?>" />
            <input type="hidden" name="vbean_seoalert_binglastvisit" id="vbean_seoalert_binglastvisit" value="<?= get_option('vbean_seoalert_binglastvisit') ?>" />
            <input type="hidden" name="vbean_seoalert_otherbotslastvisit" id="vbean_seoalert_otherbotslastvisit" value="<?= get_option('vbean_seoalert_otherbotslastvisit') ?>" />
    <?php settings_fields( 'vbean-seoalert-settings' ); ?>
    <?php do_settings_sections( 'vbean-seoalert-settings' ); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Recipients</th>
                        <td><textarea cols="60" rows="3" name="vbean_seoalert_recipients" id="vbean_seoalert_recipients"><?php echo \VanillaBeans\vbean_setting('vbean_seoalert_recipients','you@yourdomain.com')?></textarea>
                            <div class="description">Comma separated list of email addresses that you would like error messages sent to.</div>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Subject Line</th>
                        <td><input type="text" name="vbean_seoalert_subject" id="vbean_seoalert_subject" value="<?php echo \VanillaBeans\vbean_setting('vbean_seoalert_subject','{bot} visit')?>" style="width:600px;max-width:90%;">
                            <div class="description">The email subject line for your alerts. You can use these placeholders: <span style="color:darkslateblue">{bot}</span> - The bot that visited.  <span style="color:darkslateblue">{blogname}</span> - The Wordpress site name.  </div>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Message</th>
                        <td><textarea cols="60" rows="5" name="vbean_seoalert_message" id="vbean_seoalert_message"><?php echo \VanillaBeans\vbean_setting('vbean_seoalert_message','{bot} came by and took a look at {uri} on {blogname}\n\n{uas}')?></textarea>
                            <div class="description">The email subject line for your alerts. You can use these placeholders:   <span style="color:darkslateblue">{bot}</span> - The bot that visited. <span style="color:darkslateblue">{blogname}</span> - The Wordpress site name.    <span style="color:darkslateblue">{uri}</span>  - The requested URI. <span style="color:darkslateblue">{uas}</span> - The full user agent string</div>
                        </td>
                    </tr>


                    <tr valign="top">
                        <th scope="row">Email Alerts for</th>
                        <td>
                            <div class="vb-sub">Google : </div><label for="vbean_seoalert_googlebot"><input type="radio" class="checkbox" name="vbean_seoalert_googlebot"  id="vbean_seoalert_googlebot" value="1" <?php echo checked(1, get_option('vbean_seoalert_googlebot'), false)   ?>/>All</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_googlebot"><input type="radio" class="checkbox" name="vbean_seoalert_googlebot"  id="vbean_seoalert_googlebot" value="2" <?php echo checked(2, get_option('vbean_seoalert_googlebot'), false)   ?>/>Max one daily</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_googlebot"><input type="radio" class="checkbox" name="vbean_seoalert_googlebot"  id="vbean_seoalert_googlebot" value="0" <?php echo checked(0, get_option('vbean_seoalert_googlebot'), false)   ?>/>Never</label><br />

                            <div class="vb-sub">Yahoo : </div><label for="vbean_seoalert_yahoobot"><input type="radio" class="checkbox" name="vbean_seoalert_yahoobot"  id="vbean_seoalert_yahoobot" value="1" <?php echo checked(1, get_option('vbean_seoalert_yahoobot'), false)   ?>/>All</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_yahoobot"><input type="radio" class="checkbox" name="vbean_seoalert_yahoobot"  id="vbean_seoalert_yahoobot" value="2" <?php echo checked(2, get_option('vbean_seoalert_yahoobot'), false)   ?>/>Max one daily</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_yahoobot"><input type="radio" class="checkbox" name="vbean_seoalert_yahoobot"  id="vbean_seoalert_yahoobot" value="0" <?php echo checked(0, get_option('vbean_seoalert_yahoobot'), false)   ?>/>Never</label><br />

                            <div class="vb-sub">Bing : </div><label for="vbean_seoalert_bingbot"><input type="radio" class="checkbox" name="vbean_seoalert_bingbot"  id="vbean_seoalert_bingbot" value="1" <?php echo checked(1, get_option('vbean_seoalert_bingbot'), false)   ?>/>All</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_bingbot"><input type="radio" class="checkbox" name="vbean_seoalert_bingbot"  id="vbean_seoalert_bingbot" value="2" <?php echo checked(2, get_option('vbean_seoalert_bingbot'), false)   ?>/>Max one daily</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_bingbot"><input type="radio" class="checkbox" name="vbean_seoalert_bingbot"  id="vbean_seoalert_bingbot" value="0" <?php echo checked(0, get_option('vbean_seoalert_bingbot'), false)   ?>/>Never</label><br />


                            <div class="vb-sub">Other :</div> <label for="vbean_seoalert_otherbots"><input type="radio" class="checkbox" name="vbean_seoalert_otherbots"  id="vbean_seoalert_otherbots" value="1" <?php echo checked(1, get_option('vbean_seoalert_otherbots'), false)   ?>/>All</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_otherbots"><input type="radio" class="checkbox" name="vbean_seoalert_otherbots"  id="vbean_seoalert_otherbots" value="2" <?php echo checked(2, get_option('vbean_seoalert_otherbots'), false)   ?>/>Max one daily</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_otherbots"><input type="radio" class="checkbox" name="vbean_seoalert_otherbots"  id="vbean_seoalert_otherbots" value="0" <?php echo checked(0, get_option('vbean_seoalert_otherbots'), false)   ?>/>Never</label><br />

                            
                            <div class="description">Check the types of Web crawl visits you would like to be alerted about via email.</div>
                        </td>
                    </tr>




                    <tr valign="top">
                        <th scope="row">Slack Alerts for</th>
                        <td>
                            <div class="vb-sub">Google : </div><label for="vbean_seoalert_googlebotslack"><input type="radio" class="checkbox useslackcb" name="vbean_seoalert_googlebotslack"  id="vbean_seoalert_googlebotslack" value="1" <?php echo checked(1, get_option('vbean_seoalert_googlebotslack'), false)   ?> onclick="checkslackuse()" />All</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_googlebotslack"><input type="radio" class="checkbox useslackcb" name="vbean_seoalert_googlebotslack"  id="vbean_seoalert_googlebotslack" value="2" <?php echo checked(2, get_option('vbean_seoalert_googlebotslack'), false)   ?> onclick="checkslackuse()" />Max one daily</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_googlebotslack"><input type="radio" class="checkbox" name="vbean_seoalert_googlebotslack"  id="vbean_seoalert_googlebotslack" value="0" <?php echo checked(0, get_option('vbean_seoalert_googlebotslack'), false)   ?> onclick="checkslackuse()" />Never</label><br />

                            <div class="vb-sub">Yahoo : </div><label for="vbean_seoalert_yahoobotslack"><input type="radio" class="checkbox useslackcb" name="vbean_seoalert_yahoobotslack"  id="vbean_seoalert_yahoobotslack" value="1" <?php echo checked(1, get_option('vbean_seoalert_yahoobotslack'), false)   ?> onclick="checkslackuse()" />All</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_yahoobotslack"><input type="radio" class="checkbox useslackcb" name="vbean_seoalert_yahoobotslack"  id="vbean_seoalert_yahoobotslack" value="2" <?php echo checked(2, get_option('vbean_seoalert_yahoobotslack'), false)   ?> onclick="checkslackuse()" />Max one daily</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_yahoobotslack"><input type="radio" class="checkbox" name="vbean_seoalert_yahoobotslack"  id="vbean_seoalert_yahoobotslack" value="0" <?php echo checked(0, get_option('vbean_seoalert_yahoobotslack'), false)   ?> onclick="checkslackuse()" />Never</label><br />

                            <div class="vb-sub">Bing : </div><label for="vbean_seoalert_bingbotslack"><input type="radio" class="checkbox useslackcb" name="vbean_seoalert_bingbotslack"  id="vbean_seoalert_bingbotslack" value="1" <?php echo checked(1, get_option('vbean_seoalert_bingbotslack'), false)   ?> onclick="checkslackuse()" />All</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_bingbotslack"><input type="radio" class="checkbox useslackcb" name="vbean_seoalert_bingbotslack"  id="vbean_seoalert_bingbotslack" value="2" <?php echo checked(2, get_option('vbean_seoalert_bingbotslack'), false)   ?> onclick="checkslackuse()" />Max one daily</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_bingbotslack"><input type="radio" class="checkbox" name="vbean_seoalert_bingbotslack"  id="vbean_seoalert_bingbotslack" value="0" <?php echo checked(0, get_option('vbean_seoalert_bingbotslack'), false)   ?> onclick="checkslackuse()" />Never</label><br />


                            Other : <label for="vbean_seoalert_otherbotsslack"><input type="radio" class="checkbox useslackcb" name="vbean_seoalert_otherbotsslack"  id="vbean_seoalert_otherbotsslack" value="1" <?php echo checked(1, get_option('vbean_seoalert_otherbotsslack'), false)   ?> onclick="checkslackuse()" />All</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_otherbotsslack"><input type="radio" class="checkbox useslackcb" name="vbean_seoalert_otherbotsslack"  id="vbean_seoalert_otherbotsslack" value="2" <?php echo checked(2, get_option('vbean_seoalert_otherbotsslack'), false)   ?> onclick="checkslackuse()" />Max one daily</label>
                            &nbsp;&nbsp;&nbsp; <label for="vbean_seoalert_otherbotsslack"><input type="radio" class="checkbox" name="vbean_seoalert_otherbotsslack"  id="vbean_seoalert_otherbotsslack" value="0" <?php echo checked(0, get_option('vbean_seoalert_otherbotsslack'), false)   ?> onclick="checkslackuse()" />Never</label><br />

                            <div class="description">Check the types of Web crawl visits you would like to be alerted about through Slack.</div>
                            <?php  
                            
                                $slackvalid = get_option('vbean_slack_hooker_setupvalid');
                            if (empty($slackvalid)){
                            ?>
                            <div class="error" id="slackerrors">* Your Vanilla Bean Slack Message plugin is not installed, untested or not configured correctly.</div>
                                <?php
                                
                            }?>
                            
                            
                        </td>
                    </tr>                    
                    
                    <tr valign="top">
                        <th scope="row"> &nbsp;</th>
                        <td>
                           Slack Channel:<input type="text" name="vbean_seoalert_slackchannel" id="vbean_seoalert_slackchannel" value="<?php echo \VanillaBeans\vbean_setting('vbean_seoalert_slackchannel','general')?>">
                           &nbsp;&nbsp;Bot Name <input type="text" name="vbean_seoalert_slackbotname" id="vbean_seoalert_slackbotname" value="<?php echo \VanillaBeans\vbean_setting('vbean_seoalert_slackbotname','SEO Alerts')?>">
                           &nbsp;&nbsp;Icon <input type="text" name="vbean_seoalert_slackicon" id="vbean_seoalert_slackicon" value="<?php echo \VanillaBeans\vbean_setting('vbean_seoalert_slackicon','')?>">
                            <div class="description">Set your Slack preferences. You need Vanilla Bean Slack Message plugin and a Slack account for this to be used.</div>
                        </td>
                    </tr>
                    
  
                </table>



                

            <?php submit_button(); ?>
            </form>
        </div>    
<script>
    function checkslackuse(){
        var radios=document.getElementsByClassName('useslackcb');
        var useslack=false;
        for(i=0;i<radios.length;i++){
            console.log(radios[i]);
            if(radios[i].checked){
            useslack=true;
            }
        }
        if(useslack){
            jQuery('#useslackcb').show();
        }else{
            jQuery('#useslackcb').hide();
        }
    }
    window.onload=checkslackuse();

</script>
            
            <?php
}



