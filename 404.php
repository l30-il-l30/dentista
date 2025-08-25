<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina non trovata | Studio Dentistico Sant'Andrea</title>
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f9ff;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            text-align: center;
            padding: 2rem;
            max-width: 800px;
            position: relative;
        }

        .error-code {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .number {
            font-size: 8rem;
            font-weight: bold;
            color: #2b90d9;
            text-shadow: 3px 3px 0px rgba(0, 0, 0, 0.1);
        }

        .tooth {
            width: 120px;
            height: 150px;
            margin: 0 15px;
        }

        .hole {
            fill: #f0f9ff;
            animation: pulse 2s infinite alternate;
        }

        @keyframes pulse {
            from { fill: #f0f9ff; }
            to { fill: #2b90d9; }
        }

        .tools-container {
            position: relative;
            height: 150px;
            margin: 2rem 0;
        }

        .tool {
            position: absolute;
            width: 60px;
            height: 60px;
            animation: float 6s infinite ease-in-out;
        }

        .tool:nth-child(1) {
            top: 10px;
            left: 10%;
            animation-delay: 0s;
        }

        .tool:nth-child(2) {
            top: 40px;
            left: 30%;
            animation-delay: 1s;
        }

        .tool:nth-child(3) {
            top: 0;
            left: 50%;
            animation-delay: 2s;
        }

        .tool:nth-child(4) {
            top: 30px;
            left: 70%;
            animation-delay: 3s;
        }

        .tool:nth-child(5) {
            top: 10px;
            left: 90%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #1a365d;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .home-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #2b90d9;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .home-button:hover {
            background-color: #1a365d;
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .number {
                font-size: 5rem;
            }

            .tooth {
                width: 80px;
                height: 100px;
            }

            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
            }

            .tool {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="error-code">
        <div class="number">4</div>
        <div class="tooth">
            <svg viewBox="0 0 100 120" xmlns="http://www.w3.org/2000/svg">
                <path d="M50,10 C60,10 70,15 75,25 C85,40 85,60 80,75 C75,90 65,100 50,105 C35,100 25,90 20,75 C15,60 15,40 25,25 C30,15 40,10 50,10 Z" fill="white" stroke="#2b90d9" stroke-width="3"/>
                <circle cx="50" cy="60" r="10" class="hole"/>
            </svg>
        </div>
        <div class="number">4</div>
    </div>

    <div class="tools-container">
        <div class="tool">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M30,10 L70,10 L75,40 L65,35 L60,90 L40,90 L35,35 L25,40 Z" fill="#a0d2f7" stroke="#2b90d9" stroke-width="2"/>
            </svg>
        </div>
        <div class="tool">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="40" fill="#a0d2f7" stroke="#2b90d9" stroke-width="2"/>
                <circle cx="50" cy="50" r="25" fill="white" stroke="#2b90d9" stroke-width="2"/>
            </svg>
        </div>
        <div class="tool">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M10,50 L90,50 M50,10 L50,90" stroke="#2b90d9" stroke-width="4"/>
                <circle cx="50" cy="50" r="35" fill="none" stroke="#a0d2f7" stroke-width="10"/>
            </svg>
        </div>
        <div class="tool">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <rect x="25" y="20" width="50" height="60" rx="5" fill="#a0d2f7" stroke="#2b90d9" stroke-width="2"/>
                <line x1="25" y1="40" x2="75" y2="40" stroke="#2b90d9" stroke-width="2"/>
                <line x1="25" y1="60" x2="75" y2="60" stroke="#2b90d9" stroke-width="2"/>
            </svg>
        </div>
        <div class="tool">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M20,50 Q50,10 80,50 Q50,90 20,50 Z" fill="#a0d2f7" stroke="#2b90d9" stroke-width="2"/>
            </svg>
        </div>
    </div>

    <h1>Pagina Non Trovata</h1>
    <p>Ci dispiace, la pagina che stai cercando non è disponibile. Sembra che tu abbia seguito un link errato o che la pagina sia stata rimossa.</p>
    <p>Torna alla nostra homepage per prenotare una visita o scoprire i nostri servizi.</p>

    <a href="/" class="home-button">Torna alla Homepage</a>
</div>

<script>
  copyright.innerHTML = `&copy; ${new Date().getFullYear()} Studio Dentistico Sant'Andrea. Tutti i diritti riservati.`;
</script>
</body>
</html>