<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/UserModel.php';

class EmailService
{
    private $mailer;
    private $userModel;
    private $db;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['SMTP_HOST']; // Replace with your SMTP host
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['USERNAME']; // Replace with your Gmail address
        $this->mailer->Password = $_ENV['PASSWORD']; // Replace with Gmail App Password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->Port = 465;

        $this->db = new PDO("mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']); // Ensure DB connection
        $this->userModel = new UserModel();
    }

    /**
     * Send account approval email
     * @param string $toEmail
     * @param string $name
     * @param string $role
     * @return bool
     */
    public function sendApprovalEmail($toEmail, $name, $role)
    {
        try {
            $this->mailer->setFrom('mlbausa84@gmail.com', 'ACSS System');
            $this->mailer->addAddress($toEmail, $name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = '✅ Welcome to ACSS - Your Account is Now Active';

            $this->mailer->Body = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Account Approved</title>
        </head>
        <body style='margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; line-height: 1.6; color: #333333; background-color: #f8fafc;'>
            <div style='max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); overflow: hidden;'>
                <div style='background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 30px; text-align: center;'>
                    <div style='background-color: rgba(255, 255, 255, 0.2); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255, 255, 255, 0.3);'>
                        <span style='font-size: 36px; color: #ffffff;'>✅</span>
                    </div>
                    <h1 style='color: #ffffff; margin: 0; font-size: 28px; font-weight: 700; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>Account Approved!</h1>
                    <p style='color: rgba(255, 255, 255, 0.9); margin: 10px 0 0 0; font-size: 16px; font-weight: 300;'>Welcome to the ACSS System</p>
                </div>
                <div style='padding: 40px 30px;'>
                    <div style='text-align: center; margin-bottom: 30px;'>
                        <h2 style='color: #2d3748; margin: 0 0 10px 0; font-size: 24px; font-weight: 600;'>Hello, $name! 👋</h2>
                        <p style='color: #718096; margin: 0; font-size: 16px;'>Great news! Your account has been successfully approved.</p>
                    </div>
                    <div style='background-color: #f7fafc; border-left: 4px solid #38a169; padding: 20px 25px; margin: 25px 0; border-radius: 8px;'>
                        <div style='display: flex; align-items: center; margin-bottom: 15px;'>
                            <span style='background-color: #38a169; color: white; padding: 8px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;'>Approved</span>
                        </div>
                        <p style='margin: 0 0 10px 0; color: #4a5568; font-size: 16px;'>
                            <strong>Role:</strong> <span style='color: #2d3748; font-weight: 600;'>$role</span>
                        </p>
                        <p style='margin: 0; color: #4a5568; font-size: 14px;'>
                            <strong>Approved by:</strong> Dean's Office
                        </p>
                    </div>
                    <div style='text-align: center; margin: 35px 0;'>
                        <a href='http://localhost:8000/login' 
                           style='display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; padding: 16px 32px; text-decoration: none; border-radius: 50px; font-weight: 600; font-size: 16px; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4); transition: all 0.3s ease; border: none; cursor: pointer;'>
                            🚀 Access Your Account
                        </a>
                        <p style='margin: 15px 0 0 0; color: #a0aec0; font-size: 13px;'>
                            Or copy this link: <br>
                            <span style='background-color: #edf2f7; padding: 4px 8px; border-radius: 4px; font-family: monospace; font-size: 12px; color: #4a5568;'>http://localhost:8000/login</span>
                        </p>
                    </div>
                    <div style='background-color: #f7fafc; border-radius: 12px; padding: 25px; margin: 30px 0;'>
                        <h3 style='color: #2d3748; margin: 0 0 20px 0; font-size: 18px; font-weight: 600; text-align: center;'>What's Next?</h3>
                        <div style='display: grid; gap: 15px;'>
                            <div style='display: flex; align-items: center;'>
                                <span style='background-color: #e6fffa; color: #319795; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold; font-size: 14px;'>1</span>
                                <div>
                                    <p style='margin: 0; color: #2d3748; font-weight: 500;'>Complete your profile setup</p>
                                    <p style='margin: 0; color: #718096; font-size: 13px;'>Add your personal information and preferences</p>
                                </div>
                            </div>
                            <div style='display: flex; align-items: center;'>
                                <span style='background-color: #e6fffa; color: #319795; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold; font-size: 14px;'>2</span>
                                <div>
                                    <p style='margin: 0; color: #2d3748; font-weight: 500;'>Explore the dashboard</p>
                                    <p style='margin: 0; color: #718096; font-size: 13px;'>Familiarize yourself with the available features</p>
                                </div>
                            </div>
                            <div style='display: flex; align-items: center;'>
                                <span style='background-color: #e6fffa; color: #319795; width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold; font-size: 14px;'>3</span>
                                <div>
                                    <p style='margin: 0; color: #2d3748; font-weight: 500;'>Start using ACSS features</p>
                                    <p style='margin: 0; color: #718096; font-size: 13px;'>Begin managing your academic activities</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style='background-color: #fffaf0; border: 1px solid #fbd38d; border-radius: 8px; padding: 20px; margin: 25px 0; text-align: center;'>
                        <p style='margin: 0 0 10px 0; color: #744210; font-weight: 500;'>Need help getting started?</p>
                        <p style='margin: 0; color: #975a16; font-size: 14px;'>
                            Contact our support team at <a href='mailto:support@acss.com' style='color: #c05621; text-decoration: none; font-weight: 500;'>support@acss.com</a>
                            <br>or visit our <a href='#' style='color: #c05621; text-decoration: none; font-weight: 500;'>Help Center</a>
                        </p>
                    </div>
                </div>
                <div style='background-color: #2d3748; padding: 30px; text-align: center;'>
                    <div style='margin-bottom: 20px;'>
                        <h3 style='color: #ffffff; margin: 0; font-size: 20px; font-weight: 700;'>ACSS System</h3>
                        <p style='color: #a0aec0; margin: 5px 0 0 0; font-size: 14px;'>Academic Coordination & Support System</p>
                    </div>
                    <div style='border-top: 1px solid #4a5568; padding-top: 20px;'>
                        <p style='color: #a0aec0; margin: 0; font-size: 12px;'>
                            This email was sent to $toEmail<br>
                            © 2024 ACSS System. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
            <style>
                @media only screen and (max-width: 600px) {
                    .email-container {
                        margin: 20px auto !important;
                        border-radius: 8px !important;
                    }
                    .email-content {
                        padding: 25px 20px !important;
                    }
                    .cta-button {
                        padding: 14px 24px !important;
                        font-size: 15px !important;
                    }
                }
            </style>
        </body>
        </html>";

            $this->mailer->AltBody = "
            🎉 ACCOUNT APPROVED - Welcome to ACSS System!

            Hello $name,

            Great news! Your account for the role of $role has been successfully approved by the Dean's office.

            🚀 GET STARTED:
            You can now access your account at: http://localhost:8000/login

            📋 WHAT'S NEXT:
            1. Complete your profile setup
            2. Explore the dashboard features  
            3. Start using ACSS system tools

            💡 NEED HELP?
            Contact support: support@acss.com
            Visit our Help Center for guides and tutorials

            Thank you for joining ACSS System!

            Best regards,
            The ACSS Team

            ---
            This email was sent to $toEmail
            © 2024 ACSS System. All rights reserved.
        ";

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Error sending approval email to $toEmail: " . $this->mailer->ErrorInfo);
            return false;
        }
    }

    /**
     * Send password reset email
     * @param string $toEmail
     * @param string $name
     * @param string $token
     * @param string $resetLink
     * @return bool
     */
    public function sendForgotPasswordEmail($toEmail, $name, $resetLink)
    {
        try {
            $this->mailer->setFrom('mlbausa84@gmail.com', 'ACSS System');
            $this->mailer->addAddress($toEmail, $name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = '📩 Reset Your PRMSU Scheduling System Password';

            $this->mailer->Body = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Password Reset</title>
            </head>
            <body style='margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; line-height: 1.6; color: #333333; background-color: #f8fafc;'>
                <div style='max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); overflow: hidden;'>
                    <div style='background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); padding: 40px 30px; text-align: center;'>
                        <div style='background-color: rgba(255, 255, 255, 0.2); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255, 255, 255, 0.3);'>
                            <span style='font-size: 36px; color: #ffffff;'>🔒</span>
                        </div>
                        <h1 style='color: #ffffff; margin: 0; font-size: 28px; font-weight: 700; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>Password Reset</h1>
                        <p style='color: rgba(255, 255, 255, 0.9); margin: 10px 0 0 0; font-size: 16px; font-weight: 300;'>PRMSU Scheduling System</p>
                    </div>
                    <div style='padding: 40px 30px;'>
                        <div style='text-align: center; margin-bottom: 30px;'>
                            <h2 style='color: #2d3748; margin: 0 0 10px 0; font-size: 24px; font-weight: 600;'>Hello, $name! 👋</h2>
                            <p style='color: #718096; margin: 0; font-size: 16px;'>We received a request to reset your password. Click the button below to create a new one.</p>
                        </div>
                        <div style='text-align: center; margin: 30px 0;'>
                            <a href='$resetLink' style='display: inline-block; background-color: #ed8936; color: #ffffff; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 16px; font-weight: 600; transition: background-color 0.3s;'>Reset Password</a>
                        </div>
                        <div style='background-color: #fefcbf; border-left: 4px solid #d69e2e; padding: 20px 25px; margin: 25px 0; border-radius: 8px;'>
                            <p style='margin: 0; color: #744210; font-size: 14px;'>This link will expire in 24 hours. If you didn’t request a password reset, please ignore this email or contact support.</p>
                        </div>
                        <div style='background-color: #fffaf0; border: 1px solid #fbd38d; border-radius: 8px; padding: 20px; margin: 25px 0; text-align: center;'>
                            <p style='margin: 0 0 10px 0; color: #744210; font-weight: 500;'>Need help?</p>
                            <p style='margin: 0; color: #975a16; font-size: 14px;'>
                                Contact our support team at <a href='mailto:support@prmsu.edu.ph' style='color: #c05621; text-decoration: none; font-weight: 500;'>support@prmsu.edu.ph</a>
                            </p>
                        </div>
                    </div>
                    <div style='background-color: #2d3748; padding: 30px; text-align: center;'>
                        <div style='margin-bottom: 20px;'>
                            <h3 style='color: #ffffff; margin: 0; font-size: 20px; font-weight: 700;'>PRMSU Scheduling System</h3>
                            <p style='color: #a0aec0; margin: 5px 0 0 0; font-size: 14px;'>President Ramon Magsaysay State University</p>
                        </div>
                        <div style='border-top: 1px solid #4a5568; padding-top: 20px;'>
                            <p style='color: #a0aec0; margin: 0; font-size: 12px;'>
                                This email was sent to $toEmail<br>
                                © 2025 PRMSU. All rights reserved.
                            </p>
                        </div>
                    </div>
                </div>
            </body>
            </html>";

            $this->mailer->AltBody = "
            🔒 PASSWORD RESET - PRMSU Scheduling System

            Hello $name,

            We received a request to reset your password. Use the link below to create a new one:
            $resetLink

            This link will expire in 24 hours. If you didn’t request this, please ignore this email or contact support at support@prmsu.edu.ph.

            Best regards,
            The PRMSU Scheduling Team

            ---
            This email was sent to $toEmail
            © 2025 PRMSU. All rights reserved.
        ";

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Error sending forgot password email to $toEmail: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Send verification email (to be replaced with PHPMailer)
     * @param int $userId
     * @param string $token
     * @param string $newPassword
     * @return void
     */
    public function sendVerificationEmail($userId, $token, $newPassword)
    {
        $stmt = $this->db->prepare("SELECT email FROM users WHERE user_id = :user_id");
        $stmt->execute([':user_id' => $userId]);
        $email = $stmt->fetchColumn();

        $verificationLink = "http://yourdomain.com/chair/verify-password?token={$token}&user_id={$userId}";
        try {
            $this->mailer->setFrom('mlbausa84@gmail.com', 'ACSS System');
            $this->mailer->addAddress($email);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = 'Verify Your Password Change';

            $this->mailer->Body = "
                <p>Click the link to verify your password change: <a href='$verificationLink'>$verificationLink</a></p>
                <p>New Password: $newPassword</p>
                <p>This link expires in 1 hour.</p>
            ";
            $this->mailer->AltBody = "Click the link to verify your password change: $verificationLink\nNew Password: $newPassword\nThis link expires in 1 hour.";

            $this->mailer->send();
        } catch (Exception $e) {
            error_log("Error sending verification email to $email: " . $this->mailer->ErrorInfo);
        }
    }

    /**
     * Send confirmation email for new registration
     * @param string $toEmail
     * @param string $name
     * @param string $role
     * @return bool
     */
    public function sendConfirmationEmail($toEmail, $name, $role)
    {
        try {
            $this->mailer->setFrom('mlbausa84@gmail.com', 'ACSS System');
            $this->mailer->addAddress($toEmail, $name);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = '📩 Welcome to ACSS - Account Registration';

            $this->mailer->Body = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Account Registration</title>
                </head>
                <body style='margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; line-height: 1.6; color: #333333; background-color: #f8fafc;'>
                    <div style='max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); overflow: hidden;'>
                        <div style='background: linear-gradient(135deg, #48bb78 0%, #2f855a 100%); padding: 40px 30px; text-align: center;'>
                            <div style='background-color: rgba(255, 255, 255, 0.2); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255, 255, 255, 0.3);'>
                                <span style='font-size: 36px; color: #ffffff;'>📩</span>
                            </div>
                            <h1 style='color: #ffffff; margin: 0; font-size: 28px; font-weight: 700; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>Welcome to ACSS!</h1>
                            <p style='color: rgba(255, 255, 255, 0.9); margin: 10px 0 0 0; font-size: 16px; font-weight: 300;'>Your account has been registered</p>
                        </div>
                        <div style='padding: 40px 30px;'>
                            <div style='text-align: center; margin-bottom: 30px;'>
                                <h2 style='color: #2d3748; margin: 0 0 10px 0; font-size: 24px; font-weight: 600;'>Hello, $name! 👋</h2>
                                <p style='color: #718096; margin: 0; font-size: 16px;'>Your account with the role of $role has been successfully registered.</p>
                            </div>
                            <div style='background-color: #f7fafc; border-left: 4px solid #48bb78; padding: 20px 25px; margin: 25px 0; border-radius: 8px;'>
                                <div style='display: flex; align-items: center; margin-bottom: 15px;'>
                                    <span style='background-color: #48bb78; color: white; padding: 8px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;'>Registered</span>
                                </div>
                                <p style='margin: 0 0 10px 0; color: #4a5568; font-size: 16px;'>
                                    <strong>Role:</strong> <span style='color: #2d3748; font-weight: 600;'>$role</span>
                                </p>
                                <p style='margin: 0; color: #4a5568; font-size: 14px;'>
                                    <strong>Status:</strong> Pending Approval
                                </p>
                            </div>
                            <div style='text-align: center; margin: 35px 0;'>
                                <p style='color: #718096; margin: 0; font-size: 16px;'>Please await approval from the Dean's office. You will receive another email once approved.</p>
                            </div>
                            <div style='background-color: #fffaf0; border: 1px solid #fbd38d; border-radius: 8px; padding: 20px; margin: 25px 0; text-align: center;'>
                                <p style='margin: 0 0 10px 0; color: #744210; font-weight: 500;'>Need help?</p>
                                <p style='margin: 0; color: #975a16; font-size: 14px;'>
                                    Contact our support team at <a href='mailto:support@acss.com' style='color: #c05621; text-decoration: none; font-weight: 500;'>support@acss.com</a>
                                    <br>or visit our <a href='#' style='color: #c05621; text-decoration: none; font-weight: 500;'>Help Center</a>
                                </p>
                            </div>
                        </div>
                        <div style='background-color: #2d3748; padding: 30px; text-align: center;'>
                            <div style='margin-bottom: 20px;'>
                                <h3 style='color: #ffffff; margin: 0; font-size: 20px; font-weight: 700;'>ACSS System</h3>
                                <p style='color: #a0aec0; margin: 5px 0 0 0; font-size: 14px;'>Academic Coordination & Support System</p>
                            </div>
                            <div style='border-top: 1px solid #4a5568; padding-top: 20px;'>
                                <p style='color: #a0aec0; margin: 0; font-size: 12px;'>
                                    This email was sent to $toEmail<br>
                                    © 2024 ACSS System. All rights reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                    <style>
                        @media only screen and (max-width: 600px) {
                            .email-container {
                                margin: 20px auto !important;
                                border-radius: 8px !important;
                            }
                            .email-content {
                                padding: 25px 20px !important;
                            }
                            .cta-button {
                                padding: 14px 24px !important;
                                font-size: 15px !important;
                            }
                        }
                    </style>
                </body>
                </html>";

                        $this->mailer->AltBody = "
                    📩 WELCOME TO ACSS SYSTEM - Account Registered!

                    Hello $name,

                    Your account with the role of $role has been successfully registered.
                    Please await approval from the Dean's office. You will receive another email once approved.

                    💡 NEED HELP?
                    Contact support: support@acss.com
                    Visit our Help Center for guides and tutorials

                    Best regards,
                    The ACSS Team

                    ---
                    This email was sent to $toEmail
                    © 2024 ACSS System. All rights reserved.
                ";

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Error sending confirmation email to $toEmail: " . $this->mailer->ErrorInfo);
            return false;
        }
    }

    /**
     * Send notification email to admins or other roles
     * @param string $toEmail
     * @param string $subject
     * @param string $message
     * @return bool
     */
    public function sendNotificationEmail($toEmail, $subject, $message)
    {
        try {
            $this->mailer->setFrom('mlbausa84@gmail.com', 'ACSS System');
            $this->mailer->addAddress($toEmail);
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;

            $this->mailer->Body = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Notification</title>
                </head>
                <body style='margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, \"Helvetica Neue\", Arial, sans-serif; line-height: 1.6; color: #333333; background-color: #f8fafc;'>
                    <div style='max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); overflow: hidden;'>
                        <div style='background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); padding: 40px 30px; text-align: center;'>
                            <div style='background-color: rgba(255, 255, 255, 0.2); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255, 255, 255, 0.3);'>
                                <span style='font-size: 36px; color: #ffffff;'>🔔</span>
                            </div>
                            <h1 style='color: #ffffff; margin: 0; font-size: 28px; font-weight: 700; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);'>Notification</h1>
                            <p style='color: rgba(255, 255, 255, 0.9); margin: 10px 0 0 0; font-size: 16px; font-weight: 300;'>ACSS System Update</p>
                        </div>
                        <div style='padding: 40px 30px;'>
                            <div style='text-align: center; margin-bottom: 30px;'>
                                <h2 style='color: #2d3748; margin: 0 0 10px 0; font-size: 24px; font-weight: 600;'>Attention Admin</h2>
                                <p style='color: #718096; margin: 0; font-size: 16px;'>A new action requires your attention.</p>
                            </div>
                            <div style='background-color: #fefcbf; border-left: 4px solid #d69e2e; padding: 20px 25px; margin: 25px 0; border-radius: 8px;'>
                                <p style='margin: 0; color: #744210; font-size: 16px;'>$message</p>
                            </div>
                            <div style='background-color: #fffaf0; border: 1px solid #fbd38d; border-radius: 8px; padding: 20px; margin: 25px 0; text-align: center;'>
                                <p style='margin: 0 0 10px 0; color: #744210; font-weight: 500;'>Need to take action?</p>
                                <p style='margin: 0; color: #975a16; font-size: 14px;'>
                                    Log in to the admin panel at <a href='http://localhost:8000/admin/users' style='color: #c05621; text-decoration: none; font-weight: 500;'>http://localhost:8000/admin/users</a>
                                </p>
                            </div>
                        </div>
                        <div style='background-color: #2d3748; padding: 30px; text-align: center;'>
                            <div style='margin-bottom: 20px;'>
                                <h3 style='color: #ffffff; margin: 0; font-size: 20px; font-weight: 700;'>ACSS System</h3>
                                <p style='color: #a0aec0; margin: 5px 0 0 0; font-size: 14px;'>Academic Coordination & Support System</p>
                            </div>
                            <div style='border-top: 1px solid #4a5568; padding-top: 20px;'>
                                <p style='color: #a0aec0; margin: 0; font-size: 12px;'>
                                    This email was sent to $toEmail<br>
                                    © 2024 ACSS System. All rights reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                    <style>
                        @media only screen and (max-width: 600px) {
                            .email-container {
                                margin: 20px auto !important;
                                border-radius: 8px !important;
                            }
                            .email-content {
                                padding: 25px 20px !important;
                            }
                        }
                    </style>
                </body>
                </html>";

                        $this->mailer->AltBody = "
                    🔔 NOTIFICATION - ACSS System

                    A new action requires your attention:
                    $message

                    Need to take action? Log in to the admin panel at: http://localhost:8000/admin/users

                    Best regards,
                    The ACSS Team

                    ---
                    This email was sent to $toEmail
                    © 2024 ACSS System. All rights reserved.
                ";

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Error sending notification email to $toEmail: " . $this->mailer->ErrorInfo);
            return false;
        }
    }
}
