<?php
    session_start();
    
    // Configurazione cache per performance
    $cache_time = 3600; // 1 ora
    header("Cache-Control: public, max-age=$cache_time");
    header("Expires: " . gmdate('D, d M Y H:i:s', time() + $cache_time) . ' GMT');

    // Caricamento dati con gestione errori
    try {
        $data = file_get_contents("./data/treatments.json");
        if ($data === false) {
            throw new Exception("Impossibile leggere il file treatments.json");
        }
        $json = json_decode($data, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Errore nel parsing JSON: " . json_last_error_msg());
        }
    } catch (Exception $e) {
        error_log("Errore caricamento trattamenti: " . $e->getMessage());
        $json = []; // Array vuoto come fallback
    }
    
    // Meta data per SEO
    $page_title = "Studio Dentistico Sant'Andrea | Dott.ssa Grazia Diodovich - Bisceglie";
    $page_description = "Studio Dentistico Sant'Andrea a Bisceglie. La Dott.ssa Grazia Diodovich offre cure dentali di alta qualità: implantologia, ortodonzia, igiene dentale, protesi. Prenota la tua visita.";
    $page_keywords = "dentista Bisceglie, studio dentistico, implantologia, ortodonzia, igiene dentale, protesi dentarie, Grazia Diodovich";
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
  <meta name="author" content="Dott.ssa Grazia Diodovich">
  <meta name="robots" content="index, follow">
  
  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.studiodentisticosantandrea.it">
  <meta property="og:image" content="https://www.studiodentisticosantandrea.it/assets/img/logo.svg">
  <meta property="og:locale" content="it_IT">
  
  <!-- Twitter Card Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>">
  
  <!-- Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "DentalClinic",
    "name": "Studio Dentistico Sant'Andrea",
    "description": "<?php echo htmlspecialchars($page_description); ?>",
    "url": "https://www.studiodentisticosantandrea.it",
    "telephone": "+393488585578",
    "email": "graziadiodovich@gmail.com",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Via Don Tonino Bello, 5",
      "addressLocality": "Bisceglie",
      "postalCode": "76011",
      "addressRegion": "BT",
      "addressCountry": "IT"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "41.2289786",
      "longitude": "16.490343"
    },
    "openingHours": [
      "Mo 15:00-20:30",
      "Tu 09:00-12:00,15:00-20:30", 
      "We 15:00-20:30",
      "Th 15:00-20:30",
      "Fr 09:00-12:00,15:00-20:30",
      "Sa 10:00-12:30"
    ],
    "priceRange": "€€",
    "image": "https://www.studiodentisticosantandrea.it/assets/img/logo.svg"
  }
  </script>
  
  <title><?php echo htmlspecialchars($page_title); ?></title>
  
  <!-- Preload critical resources -->
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" as="style">
  <link rel="preload" href="assets/css/style.css" as="style">
  <link rel="preload" href="assets/img/background.jpg" as="image">
  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  
  <!-- Google Fonts con display=swap per performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/animations.css">
  
  <link rel="manifest" href="manifest.json">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
  <link rel="canonical" href="https://www.studiodentisticosantandrea.it">
</head>
<body>
<!-- Skip to main content per accessibilità -->
<a href="#main-content" class="skip-link">Vai al contenuto principale</a>

<header class="header">
  <div class="container">
    <div class="header-pre-mobile">
      <a href="index.php" class="logo" aria-label="Torna alla homepage">
        <img src="assets/img/logo.svg" alt="Studio Dentistico Sant'Andrea">
      </a>
      <button class="hamburger" aria-label="Apri menu di navigazione" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>

    <nav class="nav">
      <ul class="nav-list">
        <li><a href="#about" aria-label="Vai alla sezione Chi sono">Chi sono</a></li>
        <li><a href="#services" aria-label="Vai alla sezione Trattamenti">Trattamenti</a></li>
        <li><a href="#preventivo" aria-label="Vai alla sezione Preventivo">Preventivo</a></li>
        <li><a href="#atmosphere" aria-label="Vai alla sezione Atmosfera">Atmosfera</a></li>
        <li><a href="#contact" aria-label="Vai alla sezione Contatti">Contatti</a></li>
      </ul>
    </nav>
  </div>
</header>

<main id="main-content">
  <section id="home" class="hero">
    <div class="hero-background"></div>
    <div class="hero-content">
      <h1 class="hero-title">SORRIDI CON FIDUCIA</h1>
      <p class="hero-subtitle">Cure dentali personalizzate nello Studio Dentistico Sant'Andrea</p>
      <div class="hero-buttons">
        <a href="#contact" class="btn btn-primary" aria-label="Prenota una visita">Prenota una visita adesso</a>
        <a href="#preventivo" class="btn btn-secondary" aria-label="Richiedi preventivo gratuito">Preventivo gratuito</a>
      </div>
    </div>
    <a href="#about" class="scroll-down" aria-label="Scorri per scoprire di più">
      <span>Scopri di più</span>
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
      </svg>
    </a>
  </section>


    <section id="about" class="section about-section">
        <div class="about-grid">
            <!-- Colonna Immagine (tonda) -->
            <div class="about-image">
                <div class="profile-frame">
                    <img src="assets/img/dottoressa.jpeg" alt="Dott.ssa Grazia Diodovich" class="profile-img">
                </div>
            </div>

            <!-- Colonna Testo -->
            <div class="about-content">
                <div class="professional-info">
                    <p><strong>Laurea in Odontoiatria e Protesi dentaria</strong><br>
                        Università degli Studi di Bari - 110 e lode</p>

                    <p><strong>Specializzazione in Chirurgia Odontostomatologica</strong><br>
                        Università degli Studi di Torino - Massimo dei voti</p>
                </div>

                <div class="qualifications">
                    <h3 class="qualification-title">Perfezionamenti:</h3>
                    <ul class="qualification-list">
                        <li><span class="qualification-name">Endodonzia</span> - Università di Pescara</li>
                        <li><span class="qualification-name">Medicina e Odontoiatria forense</span> - Università di Pescara</li>
                        <li><span class="qualification-name">Ortodonzia</span> - Università di Napoli</li>
                        <li><span class="qualification-name">Omeopatia e omotossicologia</span> - Università di Bari, Roma e Baden Baden</li>
                    </ul>
                </div>

                <div class="experience">
                    <p>Esercita la professione con <strong>passione e dedizione da oltre 30 anni</strong> presso lo Studio Dentistico Sant'Andrea, offrendo:</p>
                    <ul class="service-list">
                        <li>Approccio personalizzato</li>
                        <li>Tecnologie all'avanguardia</li>
                        <li>Cure complete e su misura</li>
                        <li>Massima attenzione al comfort</li>
                    </ul>
                </div>

                <div class="signature-container">
                    <div class="signature">Dott.ssa Grazia Diodovich</div>
                </div>
            </div>
        </div>
    </section>

  <section id="services" class="section treatments-section">
    <div class="treatments-container">
      <div class="treatments-header">
        <h2 class="section-title">I NOSTRI TRATTAMENTI</h2>
        <p class="section-subtitle">Scopri tutti i servizi offerti dal nostro studio</p>
      </div>

      <div class="treatments-carousel">
        <div class="carousel-track-container">
          <div class="carousel-track">
            <?php foreach($json as $index => $content): ?>
                <a href="./pages/service.php?i=<?php echo htmlspecialchars($index+1); ?>" class="treatment-card" aria-label="Scopri di più su <?php echo htmlspecialchars($content['title']); ?>">
                    <div class="treatment-image">
                        <img src="assets/img/treatments/<?php echo htmlspecialchars($index+1); ?>.png" alt="<?php echo htmlspecialchars($content['alt']); ?>" loading="lazy" width="300" height="220">
                    </div>
                    <div class="treatment-content">
                        <h3><?php echo htmlspecialchars($content['title']); ?></h3>
                        <p><?php echo htmlspecialchars($content['content']); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="carousel-nav">
          <button class="carousel-prev" aria-label="Trattamento precedente">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"/>
            </svg>
          </button>
          <button class="carousel-next" aria-label="Trattamento successivo">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </section>

  <section id="preventivo" class="section preventivo-section">
    <div class="container">
      <h2 class="section-title">RICHIEDI UN PREVENTIVO GRATUITO</h2>
      <p class="section-subtitle">Compila il form per ricevere una valutazione personalizzata senza impegno</p>
      
      <div class="preventivo-form">
        <form id="preventivo-form" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group">
              <label for="preventivo-nome">Nome</label>
              <input type="text" id="preventivo-nome" name="nome" required placeholder="Il tuo nome" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="preventivo-cognome">Cognome</label>
              <input type="text" id="preventivo-cognome" name="cognome" required placeholder="Il tuo cognome" autocomplete="off">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="preventivo-citta">Città</label>
              <input type="text" id="preventivo-citta" name="citta" required placeholder="La tua città" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="preventivo-telefono">Telefono</label>
              <input type="tel" id="preventivo-telefono" name="telefono" required placeholder="Numero di telefono" autocomplete="off">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="preventivo-email">Email</label>
              <input type="email" id="preventivo-email" name="email" required placeholder="La tua email" autocomplete="off">
            </div>
          </div>

          <div class="form-group">
            <label for="preventivo-messaggio">Descrivi la tua esigenza</label>
            <textarea id="preventivo-messaggio" name="messaggio" required placeholder="Spiegaci il trattamento di cui hai bisogno o le problematiche che riscontri, inserendo delle immagini per rendere la valutazione più corretta." autocomplete="off"></textarea>
          </div>

          <a href="" id="send-preventivo" class="btn btn-primary">Richiedi preventivo gratuito</a>
        </form>
      </div>
    </div>
  </section>

  <section id="atmosphere" class="section atmosphere-section">
    <div class="container">
      <h2 class="section-title">LA NOSTRA ATMOSFERA</h2>
      <p class="section-subtitle">Uno spazio accogliente e professionale pensato per il tuo comfort</p>
      
      <div class="gallery-grid">
        <?php for($i = 0; $i <6; $i++): ?>
          <div class="gallery-item">
              <img src="assets/img/atmosfera/<?php echo htmlspecialchars($i+1); ?>.jpg" alt="Ambiente dello studio dentistico - Immagine <?php echo $i+1; ?>" loading="lazy" width="300" height="300">
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </section>

    <section id="contact" class="section contact-section">
        <div class="container">
            <h2 class="section-title">CONTATTACI</h2>
            <p class="section-subtitle">Prenota una visita o richiedi informazioni</p>

            <div class="contact-grid">
                <div class="contact-info">
                    <div class="contact-item large-icon">
                        <div class="contact-details">
                            <h3>Indirizzo</h3>
                            <p>Via Don Tonino Bello,5<br>Bisceglie, 76011</p>
                        </div>
                    </div>

                    <div class="contact-item large-icon">
                        <div class="contact-details">
                            <h3>Telefono</h3>
                            <p><a href="tel:+393488585578" aria-label="Chiama il numero 348 858 5578">348 858 5578</a></p>
                        </div>
                    </div>

                    <div class="contact-item large-icon">
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p>
                                <a href="mailto:graziadiodovich@gmail.com" aria-label="Invia email a graziadiodovich@gmail.com">graziadiodovich@gmail.com</a><br>
                                <a href="mailto:studiodentisticosantandrea@gmail.com" aria-label="Invia email a studiodentisticosantandrea@gmail.com">studiodentisticosantandrea@gmail.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item large-icon">
                        <div class="contact-details">
                            <h3>Orari</h3>
                            <p>Lunedì: 15:00–20:30<br>
                                Martedì: 9:00 - 12:00 | 15:00–20:30<br>
                                Mercoledì: 15:00–20:30<br>
                                Giovedì: 15:00–20:30<br>
                                Venerdì: 9:00 - 12:00 | 15:00–20:30<br>
                                Sabato: 10:00–12:30<br>
                                Domenica: chiuso</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <form id="appointment-form" novalidate>
                        <div class="form-group">
                            <label for="name" class="sr-only">Nome</label>
                            <input type="text" id="name" name="name" required placeholder="Nome" autocomplete="given-name" aria-describedby="name-error">
                            <span id="name-error" class="error-message" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="surname" class="sr-only">Cognome</label>
                            <input type="text" id="surname" name="surname" required placeholder="Cognome" autocomplete="family-name" aria-describedby="surname-error">
                            <span id="surname-error" class="error-message" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Email" autocomplete="email" aria-describedby="email-error">
                            <span id="email-error" class="error-message" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="sr-only">Telefono</label>
                            <input type="tel" id="phone" name="phone" required placeholder="Telefono" autocomplete="tel" aria-describedby="phone-error">
                            <span id="phone-error" class="error-message" role="alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="message" class="sr-only">Messaggio</label>
                            <textarea id="message" name="message" rows="4" required placeholder="Messaggio" maxlength="2000" autocomplete="off" aria-describedby="message-error"></textarea>
                            <span id="message-error" class="error-message" role="alert"></span>
                        </div>
                        <button type="submit" id="send-mail" class="btn btn-primary">Invia richiesta</button>
                    </form>
                </div>
            </div>

            <div class="map-container">
                <div id="map" role="img" aria-label="Mappa della posizione dello Studio Dentistico Sant'Andrea"></div>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <!-- Colonna sinistra - Descrizione studio -->
      <div class="footer-col">
        <h3>Studio Dentistico Sant'Andrea</h3>
        <p>La Dott.ssa Grazia Diodovich Rosa offre cure dentali complete e personalizzate con tecnologia all'avanguardia e approccio umano.</p>
        
        <!-- Social Links -->
        <div class="social-links">
          <a href="https://www.facebook.com/profile.php?id=61575245981285" target="_blank" aria-label="Facebook">
            <svg class="social-icon" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
          </a>
          <a href="https://www.instagram.com/studio.dentistico.santandrea/" target="_blank" aria-label="Instagram">
            <svg class="social-icon" viewBox="0 0 24 24"><path d="M12 2.16c2.87 0 3.2.01 4.33.06 1.1.05 1.7.24 2.1.4.56.2.96.44 1.38.86.42.42.66.82.86 1.38.16.4.35 1 .4 2.1.05 1.12.06 1.45.06 4.33 0 2.87-.01 3.2-.06 4.33-.05 1.1-.24 1.7-.4 2.1-.2.56-.44.96-.86 1.38-.42.42-.82.66-1.38.86-.4.16-1 .35-2.1.4-1.12.05-1.45.06-4.33.06-2.87 0-3.2-.01-4.33-.06-1.1-.05-1.7-.24-2.1-.4-.56-.2-.96-.44-1.38-.86-.42-.42-.66-.82-.86-1.38-.16-.4-.35-1-.4-2.1-.05-1.12-.06-1.45-.06-4.33 0-2.87.01-3.2.06-4.33.05-1.1.24-1.7.4-2.1.2-.56.44-.96.86-1.38.42-.42.82-.66 1.38-.86.4-.16 1-.35 2.1-.4 1.12-.05 1.45-.06 4.33-.06zm0 1.8c-2.85 0-3.15.01-4.27.06-1 .05-1.54.23-1.9.38-.48.18-.82.4-1.18.76-.36.36-.58.7-.76 1.18-.15.36-.33.9-.38 1.9-.05 1.11-.06 1.41-.06 4.27 0 2.85.01 3.15.06 4.27.05 1 .23 1.54.38 1.9.18.48.4.82.76 1.18.36.36.7.58 1.18.76.36.15.9.33 1.9.38 1.11.05 1.41.06 4.27.06 2.85 0 3.15-.01 4.27-.06 1-.05 1.54-.23 1.9-.38.48-.18.82-.4 1.18-.76.36-.36.58-.7.76-1.18.15-.36.33-.9.38-1.9.05-1.11.06-1.41.06-4.27 0-2.85-.01-3.15-.06-4.27-.05-1-.23-1.54-.38-1.9-.18-.48-.4-.82-.76-1.18-.36-.36-.7-.58-1.18-.76-.36-.15-.9-.33-1.9-.38-1.11-.05-1.41-.06-4.27-.06zM12 7c2.76 0 5 2.24 5 5s-2.24 5-5 5-5-2.24-5-5 2.24-5 5-5zm0 1.8c-1.77 0-3.2 1.43-3.2 3.2 0 1.77 1.43 3.2 3.2 3.2 1.77 0 3.2-1.43 3.2-3.2 0-1.77-1.43-3.2-3.2-3.2zM17.1 7.03c.64 0 1.16.52 1.16 1.16 0 .64-.52 1.16-1.16 1.16-.64 0-1.16-.52-1.16-1.16 0-.64.52-1.16 1.16-1.16z"/></svg>
          </a>
          <a href="https://wa.me/393488585578" target="_blank" aria-label="WhatsApp">
            <a href="https://wa.me/393488585578" target="_blank" aria-label="WhatsApp">
              <svg class="social-icon" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
            </a>
          </a>
        </div>
      </div>

      <!-- Colonna centrale - Link rapidi -->
      <div class="footer-col">
        <h3>Link rapidi</h3>
        <div class="quick-links">
          <div class="links-column">
            <a href="#home">Home</a>
            <a href="#about">Chi sono</a>
            <a href="#services">Trattamenti</a>
          </div>
          <div class="links-column">
            <a href="#preventivo">Preventivo</a>
            <a href="#atmosphere">Atmosfera</a>
            <a href="#contact">Contatti</a>
          </div>
        </div>
      </div>

      <!-- Colonna destra - Contatti -->
      <div class="footer-col">
        <h3>Contatti</h3>
        <address>
          <svg class="footer-icon" viewBox="0 0 24 24"><path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/></svg>
          Via don Tonino Bello, 5<br>76011 Bisceglie BT
        </address>
        <address>
          <svg class="footer-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/></svg>
          <a href="tel:+393488585578">348 858 5578</a>
        </address>
        <address>
          <svg class="footer-icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/></svg>
          <a href="mailto:graziadiodovich@gmail.com">graziadiodovich@gmail.com</a><br>
          <a href="mailto:studiodentisticosantandrea@gmail.com">studiodentisticosantandrea@gmail.com</a>
        </address>
      </div>
    </div>

    <div class="footer-qr">
      <div class="qr-container">
        <img src="assets/img/qr-code.png" alt="QR Code per lasciare una recensione" class="qr-code" width="120" height="120">
        <p>Scansiona per lasciare una recensione</p>
      </div>
      <!-- Footer bottom -->
      <div class="footer-bottom">
        <div class="footer-legal">
          <p>&copy; 2025 Studio Dentistico Sant'Andrea. Tutti i diritti riservati.</p>
          <p>P.IVA: 05947740725</p>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Scripts caricati in modo asincrono per performance -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" defer></script>
<script src="assets/js/leaflet-map.js" defer></script>
<script src="assets/js/main.js" defer></script>
<script src="assets/js/email.js" defer></script>
<script src="assets/js/toast.js" defer></script>
<script src="assets/js/carousel.js" defer></script>

<div class="whatsapp-float">
  <a href="https://wa.me/393488585578" target="_blank" rel="noopener noreferrer" aria-label="Contattaci su WhatsApp">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="60" height="60">
    <span class="whatsapp-tooltip">Scrivici su WhatsApp!</span>
  </a>
</div>

</body>
</html>
