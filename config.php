<?php

$tenantId = '40ab0a2e-ecd3-471b-8152-7ec715204102';

return [
    'authUrl' => "https://login.microsoftonline.com/$tenantId/oauth2/authorize",
    'tokenUrl' => "https://login.microsoftonline.com/$tenantId/oauth2/token",
    'apiBaseUrl' => 'https://graph.microsoft.com/v1.0',
    'returnUrl' => 'http://localhost/oauth/web/index.php/site/o365auth',
    'scope' => '',
    'name' => 'office365',
    'title' => 'Office 365',
    //'prompt' => 'login',
    'login_hint' => 'jussi@cranedev.onmicrosoft.com',
    'resource' => 'https://graph.microsoft.com',
];