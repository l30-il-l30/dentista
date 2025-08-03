<?php
session_start();

$index = isset($_GET['i']) ? (int)$_GET['i'] - 1 : 0;

$data = file_get_contents("../data/treatments.json");
$treatments = json_decode($data, true);

if($index < 0 || $index >= count($treatments)) {
    header("Location: index.php");
    exit();
}

$treatment = $treatments[$index];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="<?php echo htmlspecialchars($treatment['content']); ?>">
    <title><?php echo htmlspecialchars($treatment['title']); ?> | Studio Dentistico Sant'Andrea</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
    <style>
        body, h1, h2, h3, h4, h5, h6, p, a, span, li, button, input, textarea {
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
        }
    </style>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/service.css">
    <link rel="stylesheet" href="../assets/css/animations.css">
    <link rel="manifest" href="../manifest.json">
    <link rel="icon" href="../assets/img/favicon.ico" type="image/x-icon">
</head>
<body>
<header class="header">
    <div class="container">
        <div class="header-pre-mobile">
            <a href="../index.php" class="logo">
                <img src="../assets/img/logo.svg" alt="Studio Dentistico Sant'Andrea">
            </a>
            <button class="hamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <nav class="nav">
            <ul class="nav-list">
                <li><a href="../index.php#about">Chi sono</a></li>
                <li><a href="../index.php#services">Trattamenti</a></li>
                <li><a href="../index.php#preventivo">Preventivo</a></li>
                <li><a href="../index.php#atmosphere">Atmosfera</a></li>
                <li><a href="../index.php#contact">Contatti</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <!-- Hero Section per il trattamento specifico -->
    <section class="treatment-hero">
        <div class="treatment-hero-image">
            <img src="../assets/img/treatments/<?php echo $index + 1; ?>.jpg" alt="<?php echo htmlspecialchars($treatment['alt']); ?>" loading="lazy">
        </div>
        <div class="treatment-hero-content">
            <h1><?php echo htmlspecialchars($treatment['title']); ?></h1>
        </div>
    </section>

    <!-- Descrizione del trattamento -->
    <section class="treatment-description section">
        <div class="container">
            <div class="description-content">
                <h2 class="section-title">Processo di Trattamento</h2>
                <div class="description-text">
                    <?php if($treatment['title'] == "IGIENE E PREVENZIONE"): ?>
                        <p>Il nostro approccio all'igiene dentale e alla prevenzione è completo e personalizzato per ogni paziente. Il processo include:</p>
                        <ul>
                            <li>Valutazione iniziale dello stato di salute orale</li>
                            <li>Pulizia professionale con strumentazione ultrasonica</li>
                            <li>Rimozione del tartaro sopra e sotto gengivale</li>
                            <li>Lucidatura dei denti per prevenire l'accumulo di placca</li>
                            <li>Fluoroprofilassi per rinforzare lo smalto</li>
                            <li>Consigli personalizzati per l'igiene domiciliare</li>
                        </ul>
                        <p>Raccomandiamo sedute di igiene professionale ogni 6-12 mesi a seconda delle necessità individuali.</p>

                    <?php elseif($treatment['title'] == "ODONTOIATRIA CONSERVATIVA"): ?>
                        <p>La nostra odontoiatria conservativa mira a preservare il dente naturale attraverso tecniche minimamente invasive:</p>
                        <ul>
                            <li>Diagnosi precoce delle lesioni cariose con tecnologia digitale</li>
                            <li>Rimozione del tessuto cariato con massimo risparmio di struttura sana</li>
                            <li>Ricostruzione con materiali compositi estetici</li>
                            <li>Adesione stratificata per garantire durata e resistenza</li>
                            <li>Finitura e lucidatura per ripristinare la naturale anatomia</li>
                        </ul>
                        <p>Utilizziamo solo materiali di alta qualità certificati per garantire risultati duraturi.</p>

                    <?php elseif($treatment['title'] == "SBIANCAMENTO DENTALE"): ?>
                        <p>Il nostro trattamento di sbiancamento dentale professionale offre risultati visibili in poche sedute:</p>
                        <ul>
                            <li>Valutazione iniziale del colore e dello stato dei denti</li>
                            <li>Pulizia professionale preliminare</li>
                            <li>Applicazione di gel sbiancante ad alta concentrazione</li>
                            <li>Attivazione con luce LED per potenziare l'effetto</li>
                            <li>Idratazione e desensibilizzazione post-trattamento</li>
                            <li>Kit di mantenimento per risultati prolungati</li>
                        </ul>
                        <p>Lo sbiancamento è sicuro e controllato, con risultati che possono schiarire i denti fino a 8 tonalità.</p>

                    <?php elseif($treatment['title'] == "PROTESI DENTARIE"): ?>
                        <p>Le nostre soluzioni protesiche sono personalizzate per ripristinare funzione ed estetica:</p>
                        <ul>
                            <li>Analisi digitale della masticazione e dell'occlusione</li>
                            <li>Progettazione CAD/CAM delle protesi</li>
                            <li>Scelta tra corone in zirconia, disilicato di litio o metallo-ceramica</li>
                            <li>Protesi mobili con attacchi di precisione</li>
                            <li>Prove estetiche per garantire un risultato naturale</li>
                            <li>Applicazione e regolazioni finali</li>
                        </ul>
                        <p>Utilizziamo solo materiali di prima qualità certificati per garantire comfort e durata.</p>

                    <?php elseif($treatment['title'] == "IMPLANTOLOGIA"): ?>
                        <p>La nostra procedura implantologica segue protocolli rigorosi per massimizzare il successo:</p>
                        <ul>
                            <li>Diagnostica avanzata con CBCT 3D</li>
                            <li>Pianificazione digitale della posizione implantare</li>
                            <li>Impianti in titanio di grado medicale con superfici attive</li>
                            <li>Chirurgia guidata computerizzata per precisione millimetrica</li>
                            <li>Carico immediato quando possibile</li>
                            <li>Protesi definitiva dopo l'osteointegrazione</li>
                        </ul>
                        <p>Offriamo garanzie estese sui nostri impianti e un follow-up personalizzato.</p>

                    <?php elseif($treatment['title'] == "ORTODONZIA"): ?>
                        <p>Il nostro approccio ortodontico è personalizzato in base alle esigenze di ogni paziente:</p>
                        <ul>
                            <li>Diagnosi completa con analisi cefalometrica e modelli 3D</li>
                            <li>Pianificazione del trattamento su misura</li>
                            <li>Scelta tra apparecchi tradizionali, autoleganti o allineatori trasparenti</li>
                            <li>Controlli regolari per monitorare i progressi</li>
                            <li>Regolazioni periodiche per ottimizzare i risultati</li>
                            <li>Contenzione post-trattamento per mantenere l'allineamento</li>
                        </ul>
                        <p>Disponiamo di tecnologie all'avanguardia per trattamenti più rapidi e confortevoli.</p>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Galleria immagini del trattamento -->
    <section class="treatment-gallery section">
        <div class="container">
            <h2 class="section-title">Galleria del Trattamento</h2>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="../assets/img/atmosfera/2.jpg" alt="Studio esterno">
                </div>
                <div class="gallery-item">
                    <img src="../assets/img/atmosfera/4.jpg" alt="Sala operatoria">
                </div>
                <div class="gallery-item">
                    <img src="../assets/img/atmosfera/3.jpg" alt="Sala d'attesa">
                </div>
                <div class="gallery-item">
                    <img src="../assets/img/atmosfera/5.jpg" alt="Area relax">
                </div>
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
                        <svg class="social-icon" viewBox="0 0 24 24"><path d="M12 2.16c2.87 0 3.2.01 4.33.06 1.1.05 1.7.24 2.1.4.56.2.96.44 1.38.86.42.42.66.82.86 1.38.16.4.35 1 .4 2.1.05 1.12.06 1.45.06 4.33 0 2.87-.01 3.2-.06 4.33-.05 1.1-.24 1.7-.4 2.1-.2.56-.44.96-.86 1.38-.42.42-.82.66-1.38.86-.4.16-1 .35-2.1.4-1.12.05-1.45.06-4.33.06-2.87 0-3.2-.01-4.33-.06-1.1-.05-1.7-.24-2.1-.4-.56-.2-.96-.44-1.38-.86-.42-.42-.66-.82-.86-1.38-.16-.4-.35-1-.4-2.1-.05-1.12-.06-1.45-.06-4.33 0-2.87.01-3.2.06-4.33.05-1.1.24-1.7.4-2.1.2-.56.44-.96.86-1.38.42-.42.82-.66 1.38-.86.4-.16 1-.35 2.1-.4 1.12-.05 1.45-.06 4.33-.06zM12 11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/></svg>
                    </a>
                    <a href="https://wa.me/393488585578" target="_blank" aria-label="WhatsApp">
                        <svg class="social-icon" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335 .157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Colonna centrale - Link rapidi -->
            <div class="footer-col">
                <h3>Link rapidi</h3>
                <div class="quick-links">
                    <div class="links-column">
                        <a href="../index.php#home">Home</a>
                        <a href="../index.php#about">Chi sono</a>
                        <a href="../index.php#services">Trattamenti</a>
                    </div>
                    <div class="links-column">
                        <a href="../index.php#preventivo">Preventivo</a>
                        <a href="../index.php#atmosphere">Atmosfera</a>
                        <a href="../index.php#contact">Contatti</a>
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
                    <svg class="footer-icon" viewBox="0 0 24 24"><path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/></svg>
                    <a href="tel:3488585578">348 858 5578</a>
                </address>
                <address>
                    <svg class="footer-icon" viewBox="0 0 24 24"><path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/></svg>
                    <a href="mailto:graziadiodovich@gmail.com">graziadiodovich@gmail.com</a><br>
                    <a href="mailto:studiodentisticosantandrea@gmail.com">studiodentisticosantandrea@gmail.com</a>
                </address>
            </div>
        </div>

        <div class="footer-qr">
            <div class="qr-container">
                <img src="../assets/img/qr-code.png" alt="QR Code Contatti" class="qr-code">
                <p>Scansiona per lasciare una recensione</p>
            </div>
        </div>

        <!-- Footer bottom -->
        <div class="footer-bottom">
            <div class="footer-legal">
                <p>&copy; 2025 Studio Dentistico Sant'Andrea. Tutti i diritti riservati.</p>
                <p>P.IVA: 05947740725</p>
            </div>
        </div>
    </div>
</footer>

<script src="../assets/js/main.js"></script>

<div class="whatsapp-float">
    <a href="https://wa.me/393488585578" target="_blank" rel="noopener noreferrer" aria-label="Contattaci su WhatsApp">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
        <span class="whatsapp-tooltip">Scrivici su WhatsApp!</span>
    </a>
</div>

</body>
</html>