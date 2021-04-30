<?php

return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,
    
    'bsVersion' => '4.x', // this will set globally `bsVersion` to Bootstrap 4.x for all Krajee Extensions
    'bsDependencyEnabled' => false, // this will not load Bootstrap CSS and JS for all Krajee extensions 

    'upload_path'       => realpath(dirname(__FILE__).'/../../data/'), 


];