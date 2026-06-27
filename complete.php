<?php
// セッションを開始
session_start();

// メール送信初期設定
require './vendor/autoload.php';

// PHPMailerをインポート（取り込み）
use PHPMailer\PHPMailer\PHPMailer;

// セッションに保存されたデータを取得
$name = $_SESSION['name'] ?? '名無し';
$email = $_SESSION['email'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$category = $_SESSION['category'] ?? '';
$message = $_SESSION['message'] ?? '';

try {
  // PHPMailerのインスタンスを生成
  $phpmailer = new PHPMailer();
  $phpmailer->isSMTP();

  $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
  $phpmailer->SMTPAuth = true;
  $phpmailer->Port = 2525;
  $phpmailer->Username = 'MailtrapのID';
  $phpmailer->Password = 'Mailtrapのパスワード';
  // Mailtrap ここまで

  $phpmailer->setFrom($email, $name); // From
  $phpmailer->addAddress('to@example.com', '自分'); // to

  $phpmailer->CharSet = 'UTF-8'; // 文字コード
  $phpmailer->Subject = 'テストメール'; // メールタイトル
  $phpmailer->Body    = "
  性別：{$gender}
  カテゴリー：{$category}
  メッセージ：{$message}
  "; // 本文
  $phpmailer->send(); // メール送信

} catch (Exception $e) {
  echo "メール送信に失敗しました -> {$e->getMessage()}";
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP基礎編</title>
</head>
<body>
  <h2><?php echo $name; ?>様、お問い合わせを承りました。</h2>
  <p>ありがとうございました。今後の参考にさせていただきます。</p>
  <button id="back-btn" onclick="location.href='form.php';">戻る</button>
  <?php
    // セッション変数を初期化
    $_SESSION = [];
    // セッションを終了
    session_destroy();
  ?>
</body>
</html>