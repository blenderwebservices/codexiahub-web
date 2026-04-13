<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte CodexiaHub</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #1e293b;
            line-height: 1.5;
        }
        h1 {
            color: #2563eb;
            margin-bottom: 5px;
            font-size: 28px;
        }
        .header-date {
            color: #64748b;
            font-size: 14px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .explanation-box {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 15px;
            margin-bottom: 25px;
        }
        .section-title {
            color: #334155;
            font-size: 18px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        .prompt-box {
            background-color: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
            font-family: monospace;
            color: #334155;
            margin-bottom: 25px;
            white-space: pre-wrap;
        }
        .analysis-content {
            color: #334155;
        }
        .analysis-content h1, .analysis-content h2, .analysis-content h3 {
            color: #1e293b;
            margin-top: 15px;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .analysis-content p {
            margin-bottom: 10px;
        }
        .analysis-content ul, .analysis-content ol {
            padding-left: 20px;
            margin-bottom: 10px;
        }
        .analysis-content li {
            margin-bottom: 5px;
        }
        .analysis-content strong {
            color: #0f172a;
        }
    </style>
</head>
<body>
    <h1>{{ $siteName }}</h1>
    <p class="header-date"><strong>Fecha y hora:</strong> {{ $date }}</p>
    
    <div class="explanation-box">
        <h3 style="margin-top: 0; font-size: 18px; color: #334155;">Herramienta Consultada</h3>
        <p style="margin: 0; color: #475569;">{{ $explanation }}</p>
    </div>
    
    <h3 class="section-title">Prompt del Usuario</h3>
    <div class="prompt-box">
        {{ $prompt }}
    </div>
    
    <h3 class="section-title">Análisis Generado por IA</h3>
    <div class="analysis-content">
        {!! $analysis !!}
    </div>
</body>
</html>
