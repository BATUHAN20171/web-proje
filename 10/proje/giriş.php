<?php
// Doğru kullanıcı adı ve şifre
$dogru_kullanici_adi = "b241210061@sakarya.edu.tr";
$dogru_sifre = "b241210061";

// Form verilerini al
$kullanici_adi = $_POST['kullanici_adi'] ?? '';
$sifre = $_POST['sifre'] ?? '';

// Giriş kontrolü
if ($kullanici_adi === $dogru_kullanici_adi && $sifre === $dogru_sifre) {
    header("Location: index.html?error=1");


    
    exit();
} else {
    // Giriş başarısızsa, uyarı mesajını URL parametresi olarak gönder
    header("Location: giriş_ekranı.html?error=1");
    exit();
}
?>
