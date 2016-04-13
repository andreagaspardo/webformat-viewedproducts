<?php


/********************************************************************
File name: rest_test.php
Description:
A PHP test script that calls the Coupon AutoGen extension
to Magento's REST API.
The Coupon AutoGen API takes:
-- the rule ID of the &quot;Generate Coupons&quot; rule to execute
-- the number of coupon codes to generate
-- the length of each coupon code
-- the format of each coupon code
The API returns the generated coupon codes, in JSON-encoded form
 ********************************************************************/
// Replace <<...>> below with the key and secret values generated for the Coupon AutoGen Test Driver
$consumerKey = 'cfdf18568c092b4bac36ca58dc6ca923'; // from Admin Panel's &quot;REST - OAuth Consumers page&quot;
$consumerSecret = '8a447be4d71145fcb070a1eb42bbfa18'; // from Admin Panel's &quot;REST - OAuth Consumers page&quot;
// Set the OAuth callback URL to this script since it contains the logic
// to execute *after* the user authorizes this script to use the Coupon AutoGen API
$callbackUrl = "http://magento.vitamincenter.localhost/api_client/summary.php";
// Set the URLs below to match your Magento installation
$temporaryCredentialsRequestUrl = "http://magento.vitamincenter.localhost/oauth/initiate?oauth_callback=" . urlencode($callbackUrl);
$adminAuthorizationUrl = 'http://magento.vitamincenter.localhost/admin/oauth_authorize';
$accessTokenRequestUrl = 'http://magento.vitamincenter.localhost/oauth/token';
$apiUrl = 'http://magento.vitamincenter.localhost/api/rest';
session_start();
if (!isset($_GET['oauth_token']) && isset($_SESSION['state']) && $_SESSION['state'] == 1) {
    $_SESSION['state'] = 0;
}
try {
    $authType = ($_SESSION['state'] == 2) ? OAUTH_AUTH_TYPE_AUTHORIZATION : OAUTH_AUTH_TYPE_URI;
    $oauthClient = new OAuth($consumerKey, $consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, $authType);
    $oauthClient->enableDebug();
    if (!isset($_GET['oauth_token']) && !$_SESSION['state']) {
        $requestToken = $oauthClient->getRequestToken($temporaryCredentialsRequestUrl);
        $_SESSION['secret'] = $requestToken['oauth_token_secret'];
        $_SESSION['state'] = 1;
        header('Location: ' . $adminAuthorizationUrl . '?oauth_token=' . $requestToken['oauth_token']);
        exit;
    } else if ($_SESSION['state'] == 1) {
        $oauthClient->setToken($_GET['oauth_token'], $_SESSION['secret']);
        $accessToken = $oauthClient->getAccessToken($accessTokenRequestUrl);
        $_SESSION['state'] = 2;
        $_SESSION['token'] = $accessToken['oauth_token'];
        $_SESSION['secret'] = $accessToken['oauth_token_secret'];
        header('Location: ' . $callbackUrl);
        exit;
    } else {
        $oauthClient->setToken($_SESSION['token'], $_SESSION['secret']);
        $resourceUrl = "$apiUrl/webformat_viewedproducts/summary";
        $oauthClient->fetch($resourceUrl, json_encode(array()), OAUTH_HTTP_METHOD_GET, array(
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ));
        echo $oauthClient->getLastResponse();
    }
} catch (OAuthException $e) {
    print_r($e->getMessage());
    echo "<br/>";
    print_r($e->lastResponse);
}