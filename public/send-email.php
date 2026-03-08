<?php
/**
 * Mieru Internship Form — SMTP Mailer
 * Uses smtp.hostinger.com:465 (SSL) with no-reply@mieru.or.id
 *
 * Place this file in the root of your Hostinger public_html.
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// ─── SMTP Configuration ───
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_PORT', 465);
define('SMTP_USER', 'no-reply@mieru.or.id');
define('SMTP_PASS', ''); // ← Put your email password here
define('SMTP_FROM_NAME', 'Mieru Internship');
define('OWNER_EMAIL', 'me@ruzman.my.id');

// ─── Read form data ───
$input = json_decode(file_get_contents('php://input'), true);

$fullName  = htmlspecialchars(trim($input['full_name'] ?? ''));
$nickname  = htmlspecialchars(trim($input['nickname'] ?? ''));
$email     = filter_var(trim($input['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$birthday  = htmlspecialchars(trim($input['birthday'] ?? ''));
$university = htmlspecialchars(trim($input['university'] ?? ''));
$facultyMajor = htmlspecialchars(trim($input['faculty_major'] ?? ''));
$position  = htmlspecialchars(trim($input['position'] ?? ''));

if (!$fullName || !$email || !$position) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    exit;
}

// ─── Build email bodies ───
$ownerSubject = "New Internship Application — $fullName ($position)";
$ownerBody = "
<div style='font-family:Arial,sans-serif;max-width:600px;margin:0 auto;padding:20px;'>
  <h2 style='color:#f97316;'>New Internship Application</h2>
  <table style='width:100%;border-collapse:collapse;'>
    <tr><td style='padding:8px;font-weight:bold;border-bottom:1px solid #eee;'>Full Name</td><td style='padding:8px;border-bottom:1px solid #eee;'>$fullName</td></tr>
    <tr><td style='padding:8px;font-weight:bold;border-bottom:1px solid #eee;'>Nickname</td><td style='padding:8px;border-bottom:1px solid #eee;'>$nickname</td></tr>
    <tr><td style='padding:8px;font-weight:bold;border-bottom:1px solid #eee;'>Email</td><td style='padding:8px;border-bottom:1px solid #eee;'><a href='mailto:$email'>$email</a></td></tr>
    <tr><td style='padding:8px;font-weight:bold;border-bottom:1px solid #eee;'>Birthday</td><td style='padding:8px;border-bottom:1px solid #eee;'>$birthday</td></tr>
    <tr><td style='padding:8px;font-weight:bold;border-bottom:1px solid #eee;'>University</td><td style='padding:8px;border-bottom:1px solid #eee;'>$university</td></tr>
    <tr><td style='padding:8px;font-weight:bold;border-bottom:1px solid #eee;'>Faculty &amp; Major</td><td style='padding:8px;border-bottom:1px solid #eee;'>$facultyMajor</td></tr>
    <tr><td style='padding:8px;font-weight:bold;border-bottom:1px solid #eee;'>Position</td><td style='padding:8px;border-bottom:1px solid #eee;'>$position</td></tr>
  </table>
</div>
";

$applicantSubject = "Thank you for applying to Mieru Internship!";
$applicantBody = "
<div style='font-family:Arial,sans-serif;max-width:600px;margin:0 auto;padding:20px;'>
  <h2 style='color:#f97316;'>Hi $nickname! 👋</h2>
  <p>Thank you for applying to the <strong>Mieru Internship Program</strong> as a <strong>$position</strong>.</p>
  <p>We have received your application and will review it shortly. We'll get back to you soon!</p>
  <hr style='border:none;border-top:1px solid #eee;margin:20px 0;'>
  <h3 style='color:#333;'>Your Application Summary</h3>
  <table style='width:100%;border-collapse:collapse;'>
    <tr><td style='padding:6px;font-weight:bold;'>Full Name</td><td style='padding:6px;'>$fullName</td></tr>
    <tr><td style='padding:6px;font-weight:bold;'>University</td><td style='padding:6px;'>$university</td></tr>
    <tr><td style='padding:6px;font-weight:bold;'>Faculty &amp; Major</td><td style='padding:6px;'>$facultyMajor</td></tr>
    <tr><td style='padding:6px;font-weight:bold;'>Position</td><td style='padding:6px;'>$position</td></tr>
  </table>
  <hr style='border:none;border-top:1px solid #eee;margin:20px 0;'>
  <p style='color:#888;font-size:13px;'>This is an automated message from Mieru. Please do not reply to this email.</p>
</div>
";

// ─── Minimal SMTP Client ───
function smtpSend($to, $subject, $htmlBody, $replyTo = null) {
    $socket = stream_socket_client(
        'ssl://' . SMTP_HOST . ':' . SMTP_PORT,
        $errno, $errstr, 30
    );

    if (!$socket) {
        throw new Exception("Connection failed: $errstr ($errno)");
    }

    $response = fgets($socket, 512);

    // Helper
    $send = function($cmd) use ($socket) {
        fwrite($socket, $cmd . "\r\n");
        $response = '';
        while ($line = fgets($socket, 512)) {
            $response .= $line;
            if (substr($line, 3, 1) === ' ') break;
        }
        return $response;
    };

    $send('EHLO ' . gethostname());
    $send('AUTH LOGIN');
    $send(base64_encode(SMTP_USER));
    $authResult = $send(base64_encode(SMTP_PASS));

    if (strpos($authResult, '235') === false) {
        fclose($socket);
        throw new Exception('SMTP authentication failed.');
    }

    $send('MAIL FROM:<' . SMTP_USER . '>');
    $send('RCPT TO:<' . $to . '>');
    $send('DATA');

    // Build MIME message
    $boundary = md5(uniqid(time()));
    $headers  = "From: " . SMTP_FROM_NAME . " <" . SMTP_USER . ">\r\n";
    $headers .= "To: $to\r\n";
    if ($replyTo) {
        $headers .= "Reply-To: $replyTo\r\n";
    }
    $headers .= "Subject: $subject\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "\r\n";

    fwrite($socket, $headers . $htmlBody . "\r\n.\r\n");

    $result = fgets($socket, 512);
    $send('QUIT');
    fclose($socket);

    if (strpos($result, '250') === false) {
        throw new Exception('Failed to send email.');
    }

    return true;
}

// ─── Send both emails ───
try {
    // 1. Notification to owner (me@ruzman.my.id)
    smtpSend(OWNER_EMAIL, $ownerSubject, $ownerBody, $email);

    // 2. Confirmation to applicant
    smtpSend($email, $applicantSubject, $applicantBody);

    echo json_encode(['success' => true, 'message' => 'Application submitted successfully!']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to send email. Please try again later.']);
}
