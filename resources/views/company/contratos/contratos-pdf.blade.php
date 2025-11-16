<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $contrato->codigo ?? 'Contrato' }}</title>
    <style>
        :root {
            --primary-color: #003e46;
            --secondary-color: #2c7873;
            --accent-color: #6fb3b8;
            --light-color: #f8f9fa;
            --text-color: #333;
            --border-color: #dee2e6;
            --shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        @page {
            margin: 80px 50px;
        }

        body {
            /* font-family: "DejaVu Sans", "Segoe UI", sans-serif; */
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            text-align: justify;
            line-height: 1.3;
            color: #000;
            background-color: #fff;
        }

        p {
            margin: 0;
            line-height: 1.3;
        }

        h2 {
            margin: 0;
            line-height: 1.2;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 15px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0;
            right: 0;
            height: 60px;
            border-bottom: 2px solid var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            background-color: white;
            box-shadow: var(--shadow);
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        header img {
            height: 45px;
            max-width: 180px;
        }

        .header-title {
            font-size: 18px;
            color: var(--primary-color);
            text-transform: uppercase;
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 55px;
            border-top: 2px solid var(--border-color);
            font-size: 10px;
            color: #003e46;
            /* text-align: center; */
            padding: 5px 0;
            background-color: white;
        }

        main {
            margin-top: 20px;
        }

        .document-header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .document-title {
            color: var(--primary-color);
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .document-code {
            font-size: 14px;
            color: #666;
            font-style: italic;
            margin-bottom: 0;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            color: var(--primary-color);
            font-size: 15px;
            margin-bottom: 12px;
            padding-bottom: 6px;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .subsection-title {
            color: var(--secondary-color);
            font-size: 14px;
            margin: 20px 0 8px 0;
            font-weight: 600;
        }

        .text-block {
            margin-bottom: 15px;
            text-align: justify;
        }

        .highlight {
            /* background-color: rgba(111, 179, 184, 0.1); */
            padding: 0;
            /* border-left: 3px solid var(--accent-color); */
            margin: 0;
            border-radius: 0 4px 4px 0;
        }

        .parties-container {
            display: flex;
            flex-wrap: wrap;
            /* gap: 20px; */
            margin: 10px 0;
        }

        .party-card {
            flex: 1;
            min-width: 300px;
            /* background-color: var(--light-color); */
            padding: 3px 0;
            border-radius: 4px;
            /* border-left: 3px solid var(--primary-color); */
        }

        .party-title {
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
            font-size: 16px;
        }

        .clausulas-container {
            margin-top: 5px;
            padding: 0;
        }

        .clausula {
            margin: 14px 0;
            padding: 5px 2px;
            /* border-bottom: 1px dashed var(--border-color); */
            text-align: center;
        }

        .clausula:last-child {
            border-bottom: none;
        }

        .clausula-title-1 {
            font-size: 13px;
            color: #000;
            margin: 0;
            font-weight: 700;
        }

        .clausula-title {
            font-size: 18px;
            color: #000;
            margin: 0;
            font-weight: 700;
        }

        .clausula-content {
            text-align: justify;
        }

        .assinaturas {
            margin-top: 60px;
            display: flex;
            justify-content: space-around;
            text-align: center;
        }

        .assinatura-bloco {
            width: 45%;
        }

        .assinatura-linha {
            border-top: 1px solid #000;
            margin-top: 60px;
            width: 100%;
        }

        .assinatura-nome {
            margin-top: 5px;
            font-weight: bold;
        }

        .page-number:after {
            content: counter(page);
        }

        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
        }

        .text-active {
            color: var(--primary-color);
        }

        .fw-bold {
            font-weight: bold;
        }

        .lh-base {
            line-height: 1.6;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .mb-4 {
            margin-bottom: 25px;
        }

        .mt-0 {
            margin-top: 0;
        }

        .mt-4 {
            margin-top: 25px;
        }

        .p-0 {
            padding: 0;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="logo-container">
            @if (isset($team->logo_url))
                <img src="{{ public_path('storage/' . $team->logo_url) }}" alt="Logotipo">
            @endif
        </div>
        <h1 class="header-title">{{ $team->name ?? 'KuantuRH' }}</h1>
    </header>

    <footer>
        {{-- Dados do team --}}
        <p>
            <strong>{{ $contrato->team->name }}</strong>
        </p>
        <p>
            {{ $contrato->team->pais }} |
            {{ $contrato->team->provincia }},
            {{ $contrato->team->endereco }}
        </p>
        @if ($contrato->codigo_assinatura)
            <p>
                Documento assinado electronicamente em
                <strong>
                    {{ \Carbon\Carbon::parse($contrato->data_assinatura)->format('d/m/Y') }}
                </strong>
                com código <strong>{{ $contrato->codigo_assinatura ?? 'NA' }}</strong>
            </p>
        @endif
        <span>
            Gerado automaticamente via {{ config('app.name') }}
            • {{ $contrato->codigo ?? '_' }}
        </span>
        <div style="text-align: right;">
            • Página
            <span class="page-number"></span>
        </div>
    </footer>

    <main class="container">
        {{-- Cabeçalho do Contrato --}}
        @php
            use App\Models\Contrato;
            $partes = Contrato::tipoParte($contrato->tipo_contrato);
        @endphp

        <div class="document-header">
            @if ($contrato->status !== 'ativo')
                <div
                    style="
        border: 2px solid red;
        padding: 10px 15px;
        margin: 20px 0;
        text-align: center;
        color: red;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
    ">
                    este encontra-se{{ $contrato->status }}
                    <br>
                    @if ($contrato->status === 'rescindido')
                        <span style="font-size: 11; font-weight: normal; text-transform: none; text-align:justify;">
                            Data da Rescisão:
                            {{ \Carbon\Carbon::parse($contrato->data_rescisao)->format('d/m/Y') }}
                            <br>
                            Motivo: {{ $contrato->motivo_rescisao }}
                        </span>
                    @endif
                </div>
            @endif
            <h1 class="document-title">
                {{ \App\Models\Contrato::TIPOS_CONTRATO[$contrato->tipo_contrato] ?? $contrato->tipo_contrato }}
            </h1>
            <p class="document-code">
                <strong>
                    {{ $contrato->codigo }} •
                    {{ $contrato->codigo_assinatura ?? 'NA' }}
                </strong>
            </p>
        </div>

        <!-- Identificação das Partes -->
        <div class="section">
            {{-- <h2 class="section-title">Identificação das Partes</h2> --}}

            <div class="parties-container">
                <div class="party-card">
                    <div class="party-title">ENTRE</div>
                    <p class="text-justify">
                        <strong class="text-uppercase">{{ $contrato->colaborador->team->name }}</strong>,
                        com sede em
                        <span>
                            @if ($contrato->team->provincia)
                                {{ $contrato->team->provincia }},
                            @else
                                {{ $contrato->team->cidade }}
                            @endif
                            Município de
                            {{ $contrato->team->municipio }},
                            Bairro
                            {{ $contrato->team->bairro }},
                            Rua/Zona
                            {{ $contrato->team->endereco }},
                        </span> titular do NIF: <strong>{{ $contrato->team->nif ?? '000000000' }}</strong> , neste acto
                        representada
                        pelo (a) (s) Senhor (a) (s)
                        <strong style="text-transform: uppercase;">{{ $contrato->team->user->name }}</strong>,
                        na qualidade de Representantes Legais, adiante designada por
                        “<strong>{{ $partes['empregador'] }}</strong>”.
                    </p>
                </div>

                <div class="party-card">
                    <div class="party-title">E</div>
                    <p class="text-justify">
                        <strong class="text-uppercase">{{ $contrato->colaborador->nome_completo }}</strong>,
                        portador do Bilhete de Identidade nº {{ $contrato->colaborador->numero_doc_id }},
                        emitido em {{ $contrato->colaborador->data_emissao_doc?->format('d/m/Y') ?? '---' }},
                        residente em {{ $contrato->colaborador->pais }},
                        @if ($contrato->colaborador->provincia)
                            {{ $contrato->colaborador->provincia }}
                        @else
                            {{ $contrato->colaborador->cidade_estrangeira }}
                        @endif,
                        Rua/Bairro {{ $contrato->colaborador->endereco }},
                        adiante designado por “<strong>{{ $partes['trabalhador'] }}</strong>”.
                    </p>
                </div>
            </div>

            <div class="highlight">
                <p class="text-justify mb-0">
                    É celebrado o presente
                    <strong
                        style="text-transform: uppercase;">{{ strtolower(\App\Models\Contrato::TIPOS_CONTRATO[$contrato->tipo_contrato]) }}</strong>,
                    que se rege supletivamente pelas disposições da
                    @if (str_starts_with($contrato->tipo_contrato, 'trabalho_'))
                        <strong>Lei Geral do Trabalho</strong>,
                    @else
                        <strong>disposições do Código Civil</strong>,
                    @endif
                    respectiva legislação complementar, regulamento interno e pelas cláusulas seguintes:
                </p>
            </div>
        </div>

        {{-- Cláusulas do Contrato --}}
        <div class="section">
            {{-- <h2 class="section-title">Cláusulas Contratuais</h2> --}}
            <div class="clausulas-container">
                @forelse($contrato->clausulas as $index => $clausula)
                    <div class="clausula">
                        <h3 class="clausula-title-1" style="text-transform:uppercase; margin-bottom:0;">
                            Cláusula {{ $index + 1 }}ª
                        </h3>
                        <h3 class="clausula-title">({{ $clausula->titulo_base ?? 'Sem Título' }})</h3>
                        <p class="clausula-content">{{ $clausula->conteudo }}</p>
                    </div>
                @empty
                    <p><em>Não há cláusulas associadas a este contrato.</em></p>
                @endforelse
            </div>
        </div>

        {{-- Assinaturas --}}
        <div class="assinaturas">
            <div class="assinatura-bloco">
                <div class="assinatura-linha"></div>
                <p class="assinatura-nome">{{ $team->representante ?? 'Representante da Empresa' }}</p>
            </div>
            <div class="assinatura-bloco">
                <div class="assinatura-linha"></div>
                <p class="assinatura-nome">Cliente / Contratante</p>
            </div>
        </div>
    </main>

    <script>
        // Script para melhorar a experiência de impressão
        document.addEventListener('DOMContentLoaded', function() {
            // Adicionar data atual ao documento se necessário
            const today = new Date();
            const options = {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            };
            const dateString = today.toLocaleDateString('pt-PT', options);

            // Poderíamos adicionar a data em algum lugar do documento
            // Por exemplo, no footer
            // document.querySelector('footer').innerHTML += ` • ${dateString}`;
        });
    </script>
</body>

</html>
