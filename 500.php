<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errore del Server | Studio Dentistico Sorriso Perfetto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0f7ff 0%, #f0f9ff 100%);
            color: #1a365d;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
        }

        .container {
            max-width: 900px;
            text-align: center;
            padding: 2rem;
            position: relative;
        }

        .error-code {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2rem 0;
            position: relative;
        }

        .number {
            font-size: 8rem;
            font-weight: 900;
            color: #2b90d9;
            text-shadow: 4px 4px 0px rgba(43, 144, 217, 0.2);
        }

        .tooth {
            width: 140px;
            height: 170px;
            margin: 0 20px;
            position: relative;
        }

        .tooth-broken {
            animation: shake 0.5s ease-in-out infinite alternate;
        }

        .crack {
            stroke: #ff6b6b;
            stroke-width: 2;
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: drawCrack 2s ease-out forwards, glow 2s infinite alternate;
        }

        @keyframes drawCrack {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes glow {
            from { stroke: #ff6b6b; }
            to { stroke: #ff3838; }
        }

        @keyframes shake {
            from { transform: rotate(-2deg); }
            to { transform: rotate(2deg); }
        }

        .tools-container {
            position: relative;
            height: 120px;
            margin: 3rem 0;
        }

        .tool {
            position: absolute;
            width: 70px;
            height: 70px;
            animation: float 7s infinite ease-in-out;
            opacity: 0.8;
        }

        .tool:nth-child(1) {
            top: 10px;
            left: 5%;
            animation-delay: 0s;
            color: #2b90d9;
        }

        .tool:nth-child(2) {
            top: 40px;
            left: 25%;
            animation-delay: 1.5s;
            color: #38a169;
        }

        .tool:nth-child(3) {
            top: 0;
            left: 45%;
            animation-delay: 0.5s;
            color: #d69e2e;
        }

        .tool:nth-child(4) {
            top: 30px;
            left: 65%;
            animation-delay: 2s;
            color: #805ad5;
        }

        .tool:nth-child(5) {
            top: 10px;
            left: 85%;
            animation-delay: 3s;
            color: #e53e3e;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(5deg); }
        }

        h1 {
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            color: #1a365d;
            text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.1);
        }

        p {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-details {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 15px;
            padding: 1.5rem;
            margin: 2rem 0;
            border-left: 5px solid #ff6b6b;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .button {
            display: inline-flex;
            align-items: center;
            padding: 14px 32px;
            background-color: #2b90d9;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(43, 144, 217, 0.3);
        }

        .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(43, 144, 217, 0.4);
        }

        .button.home {
            background-color: #2b90d9;
        }

        .button.contact {
            background-color: #38a169;
        }

        .button i {
            margin-right: 10px;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .contact-info {
            margin-top: 2.5rem;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .number {
                font-size: 5rem;
            }

            .tooth {
                width: 90px;
                height: 110px;
                margin: 0 10px;
            }

            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1.1rem;
            }

            .tool {
                width: 50px;
                height: 50px;
            }

            .actions {
                flex-direction: column;
                align-items: center;
            }

            .button {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="error-code">
        <div class="number">5</div>
        <div class="tooth">
            <svg viewBox="0 0 100 120" xmlns="http://www.w3.org/2000/svg">
                <path d="M50,10 C60,10 70,15 75,25 C85,40 85,60 80,75 C75,90 65,100 50,105 C35,100 25,90 20,75 C15,60 15,40 25,25 C30,15 40,10 50,10 Z" fill="white" stroke="#2b90d9" stroke-width="3" class="tooth-broken"/>
                <path d="M35,40 L65,80" class="crack" fill="none"/>
                <path d="M65,40 L35,80" class="crack" fill="none"/>
            </svg>
        </div>
        <div class="number">0</div>
        <div class="tooth">
            <svg viewBox="0 0 100 120" xmlns="http://www.w3.org/2000/svg">
                <path d="M50,10 C60,10 70,15 75,25 C85,40 85,60 80,75 C75,90 65,100 50,105 C35,100 25,90 20,75 C15,60 15,40 25,25 C30,15 40,10 50,10 Z" fill="white" stroke="#2b90d9" stroke-width="3" class="tooth-broken"/>
                <path d="M30,30 L70,90" class="crack" fill="none"/>
                <path d="M50,20 L50,100" class="crack" fill="none"/>
            </svg>
        </div>
        <div class="number">0</div>
    </div>

    <div class="tools-container">
        <div class="tool">
            <i class="fas fa-teeth-open fa-3x"></i>
        </div>
        <div class="tool">
            <i class="fas fa-tooth fa-3x"></i>
        </div>
        <div class="tool">
            <i class="fas fa-teeth fa-3x"></i>
        </div>
        <div class="tool">
            <i class="fas fa-teeth fa-3x"></i>
        </div>
        <div class="tool">
            <i class="fas fa-tooth fa-3x"></i>
        </div>
    </div>

    <h1>Errore del Server</h1>
    <p>Ci dispiace, si è verificato un problema interno al server. Il nostro team tecnico è già al lavoro per risolvere il problema.</p>

    <div class="error-details">
        <p><i class="fas fa-exclamation-circle"></i> Errore 500: Internal Server Error</p>
    </div>

    <p>Nel frattempo, puoi tornare alla homepage o contattarci direttamente per assistenza.</p>

    <div class="actions">
        <a href="/" class="button home pulse">
            <i class="fas fa-home"></i> Torna alla Homepage
        </a>
    </div>
</div>

<script>
    document.querySelectorAll('.tool').forEach(tool => {
        setInterval(() => {
            tool.style.opacity = Math.random() > 0.5 ? '0.8' : '0.4';
        }, 2000);
    });
</script>
</body>
</html>