<?php
include("../include/include.php");
/*if (!$pr->getSession("adv")) {
    $pr->redirect("../index.php");
    exit();
}*/
if ($read->get("action", "GET") == 'logout') {
    $adv->logout();
}
if (!$user = $adv->getUser()) {
    
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<?php include ("../include/header_css.php"); ?>
<link rel="stylesheet" type="text/css" href="../css/terms.css">
<?php include ("../include/header_js.php"); ?>
</head>
<body>
<!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

<div id="main-header-wrapper">
  <?php include ("../include/site_header.php"); ?>
</div>
<div id="main-containt-wrapper">
<div id="main-containt">
  <div class="page-title">
    <div class="views float-l">
      <p>Terms of Services </p>
    </div>
  </div>
  <div id="mid-col">
    <div class="containt-block">
      <div class="containt">
        <div class="terms-wrapper">
          <p> These Terms of Service apply to you as a member, being a user or advertiser at Panora Advertising.As a registered user at Panora Advertising, you have confirmed you have read, understood and accepted the following terms and conditions of these Terms of Service. If you do not agree to any of these terms, you cannot use our services.</p>
           
            <ul class="terms-list">
            <li>You have access to reading the Forum, except for private areas.</li>
              <li>When registered and logged in, you can post new topics or polls and answer or vote in previously created ones in the Forum.</li>
              <li>You must respect other users in all of these areas under the penalty of being banned from them if you don't.</li>
              <li>You have the right to express yourself without offending other users.</li>
              <li>All kinds of publicity, attempts to get referrals, money offers/exchange/requests and the offer or request of services are prohibited in Forum posts. Spamming the Forum with nonsense posts/messages, duplicated topics, illegal content, sharing email addresses, social website links and instant messenger IDs is also prohibited.</li>
              <li>Any accusation without proof, intimidation, threat or disrespect against Panora Advertising and / or Panora Advertising staff / assistants, here or elsewhere will be seen as disrespectful and may lead to the removal of the privilege of using the Forum as well as the permanent suspension of your account, temporary suspension of membership or any other benefits.</li>
              <li>Posting topics or messages that may directly or indirectly be prejudicial to Panora Advertising, its users, sponsors or service providers will be considered an offense and are strictly prohibited.</li>
              <li>You need to view at least 250 advertisements before you can use the Forum.</li>
            </ul>
            
            <ul class="terms-list">
            <li>As your password must be kept secret from others, we store it in an irreversible format. In the unlikely event of someone hacking into your account, we will not be held responsible. When you request your password, we will send you a new one to your email.</li>
            
              <li>You can only have one account. Any attempt to create more than one account will lead to the termination of all of them. This also applies to your Payza / PayPal / Skrill account which has to be unique and not shared with another user.</li>
              <li>You can only view advertisements using one IP address within a 24 hours period. On the other hand, you can use multiple IP addresses to login. Any attempt to do otherwise may lead to the termination of your account. Logging in from proxies or shared network environments (such as, but not limited to schools, LAN houses, cybercafés, etc.) is not allowed.</li>
              <li>Your email addresses will not be shown, given or sold.</li>
              <li>Accounts are not transferable.</li>
              <li>Panora Advertising will not modify user account information based on user request.</li>
              <li>Users using false information when registering or changing their personal settings will have their account suspended.</li>
              <li>Only one account per computer is allowed to view advertisements. If more than one account in a single computer view advertisements, all of those accounts will be permanently suspended.</li>
              <li>You can only use a maximum of 3 distinct computers in a 10 days period to view advertisements. Any attempt to use more than that in that defined period will cause an account suspension.</li>
              <li>You must not automatically redirect any page to Panora Advertising or include the Panora Advertising site inside any other site visible or not.</li>
              <li>Any attempt to manually or automatically reload/view pages intensively will lead to the permanent suspension of your account.</li>
            </ul>
            
            <ul class="terms-list">
            <li>You may refer as many people as you want.</li>
              <li>Every one of your referrals, as users, must have a unique email address.</li>
              <li>You must not send unsolicited email or force anyone in any other way into becoming your referral. You also cannot use any service that attempts to sell you referrals. We will verify such incidents and they will result in account termination.</li>
              <li>Rented referrals have a return policy. If, within 14 days one of your rented referrals does not click any advertisement, you will automatically get your referral exchanged with no additional charge and for unlimited times. This exchange policy is only for rented referrals and they will only be replaced when new ones are available. Rented referrals are distributed based on an activity rule but we cannot predict or assure how they will behave afterwards. Letting a referral expire will have a small fee ranging from $0.02 to $0.05 depending on your current membership/pack.</li>
              <li>You only earn from directly referred referrals being them referred directly by you or rented.</li>
              <li>You can only rent referrals when they are available and within the limits of your current membership. Having more referrals than the allowed amount will result in the deactivation of the earnings from all referrals.</li>
              <li>The clicks you earn from referrals are directly related to the clicks you make.</li>
              <li>A referral will never be able to modify the member who referred him/her.</li>
              <li>The amount of direct referrals is limited based on the referrer's membership and membership time. The users can see the limit in the direct referrals listing page.</li>
              <li>Users can only have direct referrals after being a member for at least 45 days and having at least 1000 clicks. Any attempts to get them before that will fail.</li>
            </ul>
            
            
             <ul class="terms-list">
            <li>Each attempt, in any way, to hack into the system will be logged.</li>
             <li>Sometimes we will warn you, sometimes we will not. In either way, when you request payout, our monitoring system will analyze your actions and take its own actions in return. Normally, attempts to hack the system will result in account termination.</li>
              <li>We may or may not inform you that your account was terminated. In the first case, we will send you an email. In either case, you will be notified as soon as you try to use any of the services at Panora Advertising.</li>
            <li>All payments will be made via Payza, PayPal and Skrill. No other method of payment is available at this time. You can only request an unlimited amount to be paid to the payment processor you've used to make the most of your purchases in monetary amount. The maximum amount you can request to the other payment processors is equal to the value of the purchases you've made through them individually. In the event of equal most value of purchases between two or more payment processors you can make an unlimited payment request for each one that is part of the par.</li>
              <li>All payments will be made instantly upon request or within 48 hours after being requested if the payment processor services are down.</li>
              <li>The minimum amount paid is $2.00 on the first cashout. This amount will increase by $1.00 for each cashout until it reaches a fixed minimum amount of $10.00. From the amount paid, a fee can be deducted depending on the payment processor you use.</li>
              <li>You can only request one payment at a time.</li>
              <li>We are responsible only for submitting your payment to the payment processor. Any action after that is to be handled by the payment processor's support.</li>
              <li>You must have a correct and existing Payza or PayPal email address and / or a correct Skrill. All payments will go directly to that user's email address and cannot be canceled. To have your payment sent by PayPal, be sure to have a PayPal account in a country whose accounts can receive money by PayPal and log in from one of those countries.</li>
              <li>After requesting a payment, the user must wait 5 days before requesting another.</li>
              <li>Users must accept the payments made to their Payza, PayPal or Skrill accounts in 30 calendar days or will have the payment canceled and it will not be refunded.</li>
              <li>Any refund of any payment we send you will be ignored and it won't be added back to your account nor sent again.</li>
            </ul>
            <ul class="terms-list">
            <li>We accept any kind of advertisement except for pages that break out of frames, have malicious code, redirect to another page, have adult or illegal content, contain any kind of multi-level offers, contain referral sales and those that include gambling/betting, gambling content or are held by a gambling company. Also, any advertisement that uses Panora Advertising's name for any unrelated services is not allowed. Your advertised webpage must load within 10 seconds as the progress bar counting the exposure period will begin by then. Your advertised website must be capable of supporting multiple visits per second.</li>
            
              <li>You, as a user, can only earn from each advertisement once each 24 hours.</li>
              <li>We reserve the right to deny any advertisement that we do not see fit to be displayed.</li>
              <li>Advertisements must not be viewed on mobile phones. Advertisements must only be clicked on using a mouse and not using any other methods. Doing so may lead to the permanent suspension of your account.</li>
            </ul>
            <ul class="terms-list">
            <li>All payments are to be made using the links available at "your account". No other method of payment will be accepted.</li>
            
              <li>All payments are non-refundable.</li>
              <li>Payments made to Panora Advertising using PayPal and Payza are only accepted from verified accounts. Payments made using unverified PayPal or Payza accounts won't be accepted.</li>
              <li>All chargebacks or reversed transactions made on your payments will lead to an immediate account suspension.</li>
            </ul>
            <ul class="terms-list">
            <li>We have the right to suspend your account at any time for any valid reason including, but not limited to, the disrespect of our Terms of Service.</li>
            
              <li>All suspended accounts will have all their balances reset, all referrals taken away and no refunds will be given.</li>
              <li>All suspended accounts will be archived and you cannot register using the same username or email addresses.</li>
              <li>After 30 days of inactivity, your account will be temporarily suspended and permanently suspended after 60 days of inactivity. An inactive user for 72 hours after registration will have the account permanently suspended.</li>
              <li>We won't delete user's accounts for any reason even if they are active, terminated or suspended.</li>
            </ul>
           
            
            <ul class="terms-list">
            <li>Panora Advertising will not be liable for any kind of delays or failures that are not directly related to Panora Advertising and therefore beyond our control.</li>
              <li>Panora Advertising reserves the right to alter the Terms of Service at any time, including fees, special offers, benefits and rules, amongst others, and also reserves the right to cancel its services any time and without any notice.</li>
              <li>Panora Advertising will not be held responsible for any of its users, advertisers or advertisements. This also includes every supplier we depend on.</li>
              <li>Panora Advertising is not responsible for any tax payment for you on what you receive from us. It's your responsibility to declare what you've received and pay your country's taxes.</li>
            </ul>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="main-footer-wrapper">
  <div id="main-footer">
    <?php include ("../include/main_footer.php");?>
  </div>
</div>
<?php include ("../include/footer_js.php"); ?>
</body>
</html>