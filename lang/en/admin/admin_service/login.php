<?php
/**
 * Provides translations for my login and reset password page.
 */
return [
    /*login.blade.php page*/
    'login_header'                       => 'Sign in',
    'email'                              => 'Email',
    'email_placeholder'                  => 'Enter email',
    'required_email'                     => 'Email is required!',
    'password'                           => 'Password',
    'password_placeholder'               => 'Enter password',
    'required_password'                  => 'Password is required!',
    'forgot_password'                    => 'Forgot your password?',
    'remember_me'                        => 'Remember me',
    'login_button'                       => 'Login',
    /*login controller*/
    'login_failed'                       => 'Login failed, please try again!',
    /*enter_email.blade.php page*/
    'reset_header'                       => 'Reset password',
    'reset_password_button'              => 'Reset password',
    'back_to_login'                      => 'Back to login page',
    /*forgot password controller*/
    'reset_email_sent_success'           => 'Check your inbox for password reset link!',
    'reset_email_send_fail'              => 'Email does not exist!',
    /*EmailResetLink*/
    'reset_email_subject'                => 'Password reset is requested for your account!',
    /*send_email.blade.php*/
    'reset_email_reset_message_header'   => 'You have requested to reset your password',
    'reset_email_reset_message_body'     => 'To reset your password, click the following link and follow the instructions.',
    'reset_email_password_button'        => 'Reset password',
    /*reset.blade.php*/
    'reset_title'                        => 'Reset password',
    'password_confirmation_reset_button' => 'Reset password',
    'password_confirmation'              => 'Confirm password',
];
