<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodexiaHub | Inteligencia Operativa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        window.recaptchaSiteKey = "{{ config('services.recaptcha.site_key') }}";
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
        .gradient-text {
            background: linear-gradient(90deg, #1e40af, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .loader {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            animation: spin 1s linear infinite;
            display: inline-block;
        }
        .ai-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        .ai-card:hover {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <!-- Navegación -->
    <nav class="fixed w-full z-50 glass border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">C</div>
                <span class="text-xl font-bold tracking-tight">Codexia<span class="text-blue-600">Hub</span></span>
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="#servicios" class="hover:text-blue-600 transition">Servicios</a>
                <a href="#hub-ia" class="hover:text-blue-600 transition font-bold text-blue-600">Centro IA ✨</a>
                <a href="#metodo" class="hover:text-blue-600 transition">Método</a>
                @auth
                    <a href="/admin" class="hover:text-blue-600 transition font-bold">Dashboard</a>
                @else
                    <a href="/admin" class="hover:text-blue-600 transition">Login</a>
                @endauth
            </div>
            <a href="#contacto" class="bg-blue-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                Diagnóstico Express
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <span class="inline-block px-4 py-1.5 mb-6 text-xs font-semibold tracking-widest text-blue-600 uppercase bg-blue-50 rounded-full">
                Sistematización & Inteligencia Artificial
            </span>
            <h1 class="text-4xl md:text-6xl font-bold mb-8 leading-tight max-w-4xl mx-auto">
                Tu negocio debería funcionar <span class="gradient-text">sin ti</span>.
            </h1>
            <p class="text-lg md:text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                Transformamos el caos operativo en una máquina de precisión. Usa nuestras herramientas de IA para descubrir cuánto tiempo podrías estar ahorrando hoy.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button onclick="document.getElementById('hub-ia').scrollIntoView({behavior: 'smooth'})" class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-700 transition text-lg shadow-xl shadow-blue-200 flex items-center justify-center space-x-2">
                    <span>Probar Centro IA ✨</span>
                </button>
                <button onclick="document.getElementById('servicios').scrollIntoView({behavior: 'smooth'})" class="bg-white border border-slate-200 text-slate-900 px-8 py-4 rounded-xl font-bold hover:bg-slate-50 transition text-lg">
                    Ver Servicios
                </button>
            </div>
        </div>
    </section>

    <!-- Centro de Inteligencia Operativa ✨ -->
    <section id="hub-ia" class="py-24 px-6 bg-slate-900 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-full h-full opacity-10 pointer-events-none">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/></pattern></defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-bold mb-4">Centro de Inteligencia Operativa ✨</h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto">Herramientas gratuitas impulsadas por Gemini para auditar tu estructura de negocio.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Herramienta 1: ROI Simulator -->
                <div class="ai-card p-8 rounded-3xl">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center text-blue-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold uppercase tracking-wider text-blue-400">Simulador de ROI de Automatización ✨</h3>
                    </div>
                    <p class="text-slate-400 mb-6 text-sm">Calcula el retorno de inversión al automatizar una tarea repetitiva.</p>
                    <div class="space-y-4">
                        <input id="roi-task" type="text" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-blue-500 outline-none" placeholder="¿Qué tarea manual consume más tiempo? (Ej: Facturación)">
                        <div class="grid grid-cols-2 gap-4">
                            <input id="roi-hours" type="text" inputmode="numeric" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Horas/Semana">
                            <input id="roi-cost" type="text" inputmode="numeric" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Costo/Hora ($)">
                        </div>
                        <button onclick="calculateROI()" id="roi-btn" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition">Analizar Ahorro ✨</button>
                    </div>
                    <div id="roi-loading" class="hidden mt-6 text-center py-4"><div class="loader"></div></div>
                    <div id="roi-result" class="hidden mt-6 p-6 bg-blue-900/20 border border-blue-500/30 rounded-2xl text-slate-200 prose prose-invert prose-slate max-w-none"></div>
                    @auth
                    <button id="roi-pdf-btn" onclick="downloadPdf('roi')" class="hidden mt-4 w-full bg-slate-700 hover:bg-slate-600 text-white font-bold py-3 rounded-xl transition flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span>Descargar PDF</span>
                    </button>
                    @endauth
                </div>

                <!-- Herramienta 2: RACI Generator -->
                <div class="ai-card p-8 rounded-3xl">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center text-indigo-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold uppercase tracking-wider text-indigo-400">Clarificador de Roles RACI ✨</h3>
                    </div>
                    <p class="text-slate-400 mb-6 text-sm">Elimina el desorden definiendo quién es Responsable, Aprobador, Consultado o Informado.</p>
                    <div class="space-y-4">
                        <textarea id="raci-project" rows="2" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Describe un proyecto o área (Ej: Onboarding de nuevos clientes)"></textarea>
                        <button onclick="generateRACI()" id="raci-btn" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-3 rounded-xl transition">Estructurar Roles ✨</button>
                    </div>
                    <div id="raci-loading" class="hidden mt-6 text-center py-4"><div class="loader"></div></div>
                    <div id="raci-result" class="hidden mt-6 p-6 bg-indigo-900/20 border border-indigo-500/30 rounded-2xl text-slate-200 prose prose-invert prose-indigo max-w-none"></div>
                    @auth
                    <button id="raci-pdf-btn" onclick="downloadPdf('raci')" class="hidden mt-4 w-full bg-slate-700 hover:bg-slate-600 text-white font-bold py-3 rounded-xl transition flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span>Descargar PDF</span>
                    </button>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Metodo & Problema (Contenido Estático Optimizado) -->
    <section id="metodo" class="py-24 bg-white px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-6">Sistematización <span class="text-blue-600">con Alma</span>.</h2>
                <p class="text-slate-600 mb-8 leading-relaxed text-lg">
                    La mayoría de los negocios fallan al escalar porque el dueño se vuelve el soporte técnico, comercial y operativo. Nosotros instalamos una <strong>capa de inteligencia</strong> que permite que el negocio crezca mientras tú recuperas tu vida.
                </p>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4 p-4 bg-slate-50 rounded-xl border-l-4 border-blue-600">
                        <span class="text-2xl">⚡</span>
                        <div>
                            <h4 class="font-bold">Gobernanza Total</h4>
                            <p class="text-sm text-slate-500">Decisiones basadas en datos, no en presentimientos.</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4 p-4 bg-slate-50 rounded-xl border-l-4 border-blue-600">
                        <span class="text-2xl">🤖</span>
                        <div>
                            <h4 class="font-bold">IA de Soporte Real</h4>
                            <p class="text-sm text-slate-500">Agentes que trabajan 24/7 sin margen de error.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="bg-blue-600 rounded-[3rem] p-12 text-white shadow-2xl overflow-hidden">
                    <div class="relative z-10">
                        <p class="text-6xl font-bold mb-4 italic opacity-20">"LIBERTAD"</p>
                        <h3 class="text-2xl font-bold mb-6 italic leading-relaxed">
                            "CodexiaHub no es otra agencia; es el puente entre el caos y un legado con alma."
                        </h3>
                        <p class="font-semibold text-blue-200">— El Éxito que se Siente Bien</p>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section id="servicios" class="py-24 bg-slate-50 px-6">
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h2 class="text-3xl font-bold">Nuestra Infraestructura</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100 card-hover">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6 text-2xl font-bold">01</div>
                <h3 class="text-xl font-bold mb-4">Sprint Operativo</h3>
                <p class="text-slate-500 mb-6">Identificación y limpieza de procesos basura en 7 días.</p>
            </div>
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-slate-100 card-hover">
                <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6 text-2xl font-bold">02</div>
                <h3 class="text-xl font-bold mb-4">Agentes IA</h3>
                <p class="text-slate-500 mb-6">Integración de Gemini y GPT para flujos comerciales autónomos.</p>
            </div>
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-blue-200 bg-blue-50/20 card-hover">
                <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6 text-2xl font-bold">03</div>
                <h3 class="text-xl font-bold mb-4">SaaS in a Box</h3>
                <p class="text-slate-500 mb-6">Tu propia plataforma privada de gestión sin rentas mensuales.</p>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="py-24 px-6">
        <div class="max-w-4xl mx-auto bg-slate-900 rounded-[3rem] p-12 text-white shadow-2xl text-center">
            <h2 class="text-4xl font-bold mb-6">¿Listo para sistematizar?</h2>
            <p class="text-slate-400 mb-10 text-lg">Recupera el control de tu tiempo hoy mismo.</p>
            <form id="lead-form" class="max-w-md mx-auto space-y-4">
                <input id="lead-email" type="email" required class="w-full bg-slate-800 border-none rounded-xl px-6 py-4 outline-none focus:ring-2 focus:ring-blue-600" placeholder="Tu correo electrónico">
                <button 
                    class="g-recaptcha w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl transition text-lg shadow-xl shadow-blue-900/40 disabled:opacity-50"
                    data-sitekey="{{ config('services.recaptcha.site_key') }}"
                    data-callback="onLeadSubmit"
                    data-action="submit"
                    id="lead-submit-btn">
                    Agendar Diagnóstico Express
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 px-6 border-t border-slate-200">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-slate-400 text-sm">
            <div class="flex items-center space-x-2 mb-4 md:mb-0">
                <div class="w-6 h-6 bg-blue-600 rounded flex items-center justify-center text-white font-bold text-[10px]">C</div>
                <span class="text-slate-900 font-bold">CodexiaHub</span>
            </div>
            <p>© 2024 Codexia Hub. El Éxito que se Siente Bien.</p>
        </div>
    </footer>

    <script>
        async function callBackendAi(prompt, tool = null) {
            try {
                const response = await fetch('/ai/process', {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        prompt: prompt,
                        tool: tool
                    })
                });
                
                if (!response.ok) throw new Error('Backend AI Error');
                const data = await response.json();
                
                if (!data.success) throw new Error(data.error);
                return data.result;
            } catch (err) {
                console.error(err);
                return "Lo sentimos, el laboratorio está saturado. Intenta de nuevo en un momento.";
            }
        }

        async function calculateROI() {
            const task = document.getElementById('roi-task').value;
            const hours = document.getElementById('roi-hours').value;
            const cost = document.getElementById('roi-cost').value;
            
            if (!task || !hours || !cost) return;

            const btn = document.getElementById('roi-btn');
            const loader = document.getElementById('roi-loading');
            const result = document.getElementById('roi-result');

            btn.classList.add('hidden');
            loader.classList.remove('hidden');
            result.classList.add('hidden');

            const userPrompt = `Tarea: ${task}. Tiempo invertido: ${hours} horas/semana. Costo operativo: ${cost}$ por hora. Calcula el ahorro anual y sugiere la solución técnica.`;

            const output = await callBackendAi(userPrompt, 'roi');
            result.innerHTML = marked.parse(output);
            result.classList.remove('hidden');
            loader.classList.add('hidden');
            btn.classList.remove('hidden');
            btn.innerText = "Recalcular Impacto ✨";
            
            window.lastRoiPrompt = userPrompt;
            window.lastRoiResult = result.innerHTML;
            const pdfBtn = document.getElementById('roi-pdf-btn');
            if (pdfBtn) pdfBtn.classList.remove('hidden');
        }

        async function generateRACI() {
            const project = document.getElementById('raci-project').value;
            if (!project) return;

            const btn = document.getElementById('raci-btn');
            const loader = document.getElementById('raci-loading');
            const result = document.getElementById('raci-result');

            btn.classList.add('hidden');
            loader.classList.remove('hidden');
            result.classList.add('hidden');

            const userPrompt = `Genera una matriz RACI para el proceso: ${project}. Identifica al menos 4 tareas críticas y los roles involucrados.`;

            const output = await callBackendAi(userPrompt, 'raci');
            result.innerHTML = marked.parse(output);
            result.classList.remove('hidden');
            loader.classList.add('hidden');
            btn.classList.remove('hidden');
            btn.innerText = "Refinar Estructura ✨";
            
            window.lastRaciPrompt = userPrompt;
            window.lastRaciResult = result.innerHTML;
            const pdfBtn = document.getElementById('raci-pdf-btn');
            if (pdfBtn) pdfBtn.classList.remove('hidden');
        }

        function downloadPdf(type) {
            const isRoi = type === 'roi';
            const siteName = "CodexiaHub";
            const date = new Date().toLocaleString();
            const explanation = isRoi 
                ? "Simulador de ROI de Automatización: Calcula el retorno de inversión al automatizar una tarea repetitiva." 
                : "Clarificador de Roles RACI: Define quién es Responsable, Aprobador, Consultado o Informado.";
            
            const prompt = isRoi ? window.lastRoiPrompt : window.lastRaciPrompt;
            const analysisHTML = isRoi ? window.lastRoiResult : window.lastRaciResult;
            
            if (!prompt || !analysisHTML) return;

            const content = `
                <div style="font-family: 'Inter', sans-serif; color: #1e293b; padding: 40px; line-height: 1.6;">
                    <h1 style="color: #2563eb; margin-bottom: 5px; font-size: 28px;">${siteName}</h1>
                    <p style="color: #64748b; font-size: 14px; margin-top: 0; margin-bottom: 20px;"><strong>Fecha y hora:</strong> ${date}</p>
                    
                    <div style="background: #f8fafc; border-left: 4px solid #2563eb; padding: 15px; margin-bottom: 25px;">
                        <h3 style="color: #334155; margin-top: 0; font-size: 18px;">Herramienta Consultada</h3>
                        <p style="margin: 0; color: #475569;">${explanation}</p>
                    </div>
                    
                    <h3 style="color: #334155; font-size: 18px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 15px;">Prompt del Usuario</h3>
                    <div style="background: #f1f5f9; padding: 15px; border-radius: 8px; font-family: monospace; color: #334155; margin-bottom: 25px;">
                        ${prompt}
                    </div>
                    
                    <h3 style="color: #334155; font-size: 18px; border-bottom: 1px solid #e2e8f0; padding-bottom: 8px; margin-bottom: 15px;">Análisis Generado por IA</h3>
                    <div style="color: #334155;">
                        ${analysisHTML}
                    </div>
                </div>
            `;

            const element = document.createElement('div');
            element.innerHTML = content;

            const opt = {
                margin:       10,
                filename:     `CodexiaHub-${type.toUpperCase()}-${new Date().getTime()}.pdf`,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            const btn = document.getElementById(type + '-pdf-btn');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span>Generando PDF...</span>';

            html2pdf().set(opt).from(element).save().then(() => {
                btn.innerHTML = originalText;
            });
        }

        async function onLeadSubmit(token) {
            const email = document.getElementById('lead-email').value;
            if (!email) {
                grecaptcha.reset();
                alert('Por favor, ingresa un correo válido.');
                return;
            }

            const btn = document.getElementById('lead-submit-btn');
            const originalText = btn.innerText;
            btn.innerText = 'Procesando...';
            btn.disabled = true;

            try {
                const response = await fetch('/leads', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        email: email,
                        recaptcha_token: token
                    })
                });

                const data = await response.json();

                if (data.success) {
                    alert(data.message);
                    document.getElementById('lead-form').reset();
                } else {
                    alert(data.error || 'Ocurrió un error. Inténtalo de nuevo.');
                }
            } catch (err) {
                console.error(err);
                alert('Error de conexión. Inténtalo de nuevo.');
            } finally {
                btn.innerText = originalText;
                btn.disabled = false;
                grecaptcha.reset();
            }
        }
    </script>
    <livewire:chatbot />
</body>
</html>