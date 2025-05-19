// oyunlar.js

const API_KEY = "c488d8ace1d949c49e4f27ba76fea1c1";
// RAWG’dan tam 40 oyun çekiyoruz
const API_URL = `https://api.rawg.io/api/games?key=${API_KEY}&page_size=40`;

fetch(API_URL)
  .then(res => res.json())
  .then(data => {
    const container = document.getElementById("games-container");
    container.innerHTML = ""; // önce temizle

    data.results.forEach(game => {
      // 1) Kart div’i
      const card = document.createElement("div");
      card.className = "game-card";
      // Neon etiket için data-name
      card.setAttribute("data-name", game.name);

      // 2) Pulse efekti div’i (CSS’de .pulse tanımlı)
      const pulse = document.createElement("div");
      pulse.className = "pulse";
      card.appendChild(pulse);

      // 3) Oyunun görseli
      const img = document.createElement("img");
      img.src  = game.background_image
               || "https://via.placeholder.com/300x140?text=No+Image";
      img.alt  = game.name;
      card.appendChild(img);

      // 4) Kartı container’a ekle
      container.appendChild(card);
    });
  })
  .catch(err => {
    console.error("API hatası:", err);
  });
