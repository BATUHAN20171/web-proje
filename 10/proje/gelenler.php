<?php
// Değişkenleri tanımla ve form gönderildiyse POST verilerini al
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$telefon = isset($_POST['telefon']) ? htmlspecialchars($_POST['telefon']) : '';
$cinsiyet = isset($_POST['cinsiyet']) ? htmlspecialchars($_POST['cinsiyet']) : '';

// Bölümleri dizi halinde topla
$bolumler = array_filter([
    isset($_POST['Bölüm']) ? htmlspecialchars($_POST['Bölüm']) : '',
    isset($_POST['Bölüm_2']) ? htmlspecialchars($_POST['Bölüm_2']) : '',
    isset($_POST['Bölüm_3']) ? htmlspecialchars($_POST['Bölüm_3']) : '',
]);

$konu = isset($_POST['konu']) ? htmlspecialchars($_POST['konu']) : '';
$mesaj = isset($_POST['mesaj']) ? htmlspecialchars($_POST['mesaj']) : '';
$tarih = isset($_POST['tarih']) ? htmlspecialchars($_POST['tarih']) : '';
$renk = isset($_POST['renk']) ? htmlspecialchars($_POST['renk']) : '';

$dosyaLink = '';
if (isset($_FILES['dosya']) && $_FILES['dosya']['error'] === UPLOAD_ERR_OK) {
    $yuklemeKlasoru = 'uploads/';
    if (!file_exists($yuklemeKlasoru)) {
        mkdir($yuklemeKlasoru, 0777, true); // klasör yoksa oluştur
    }

    $dosyaAdi = basename($_FILES['dosya']['name']);
    $hedefYol = $yuklemeKlasoru . $dosyaAdi;

    if (move_uploaded_file($_FILES['dosya']['tmp_name'], $hedefYol)) {
        $dosyaLink = '<a href="' . htmlspecialchars($hedefYol) . '" target="_blank">' . htmlspecialchars($dosyaAdi) . '</a>';
    } else {
        $dosyaLink = 'Dosya yüklenemedi.';
    }
} else {
    $dosyaLink = 'Dosya seçilmedi.';
}

$memnuniyet = isset($_POST['memnuniyet']) ? htmlspecialchars($_POST['memnuniyet']) : '';


// 📝 Verileri .txt dosyasına kaydet
$veriMetni = "Ad Soyad: $name\n";
$veriMetni .= "E-posta: $email\n";
$veriMetni .= "Telefon: $telefon\n";
$veriMetni .= "Cinsiyet: $cinsiyet\n";
$veriMetni .= "Bölümler: " . implode(', ', $bolumler) . "\n";
$veriMetni .= "Konu: $konu\n";
$veriMetni .= "Mesaj: $mesaj\n";
$veriMetni .= "Tarih: $tarih\n";
$veriMetni .= "Renk Kodu: $renk\n";
$veriMetni .= "Dosya: " . strip_tags($dosyaLink) . "\n";
$veriMetni .= "Memnuniyet: $memnuniyet\n";
$veriMetni .= "-------------------------------\n";

file_put_contents("form_kayitlari.txt", $veriMetni, FILE_APPEND);

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Form Verileri</title>
</head>

<body>
    <h1>Form Verileriniz</h1>
    <p><strong>Ad Soyad:</strong> <?= $name ?></p>
    <p><strong>E-posta:</strong> <?= $email ?></p>
    <p><strong>Telefon:</strong> <?= $telefon ?></p>
    <p><strong>Cinsiyet:</strong> <?= $cinsiyet ?></p>
    <p><strong>Bölümler:</strong> <?= implode(' ', $bolumler) ?></p>
    <p><strong>Konu:</strong> <?= $konu ?></p>
    <p><strong>Mesaj:</strong> <?= $mesaj ?></p>
    <p><strong>Tarih:</strong> <?= $tarih ?></p>
    <p><strong>Renk Kodu:</strong> <?= $renk ?></p>
    <p><strong>Dosya:</strong> <?= $dosyaLink ?></p>
    <p><strong>Memnuniyet:</strong> <?= $memnuniyet ?></p>
</body>

</html>