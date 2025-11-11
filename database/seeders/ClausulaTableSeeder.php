<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clausula;
use App\Models\Team;
use App\Models\User;

class ClausulaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter dinamicamente a primeira equipa e utilizador
        // $teamId = Team::first()?->id ?? 1;
        // $userId = User::first()?->id ?? 1;

        $clausulas = [
            // CONTRATOS DE TRABALHO
            [
                'titulo' => 'Cláusula 1.ª - Objecto do Contrato',
                'conteudo' => 'Nos termos do artigo 16.º da Lei Geral do Trabalho, o presente contrato tem por objecto a prestação de trabalho subordinado pelo Trabalhador ao Empregador, mediante retribuição, nas funções e condições aqui definidas.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 2.ª - Modalidade do Contrato',
                'conteudo' => 'O presente contrato celebra-se na modalidade de contrato por tempo indeterminado/determinado, nos termos dos artigos 18.º a 22.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 3.ª - Período Experimental',
                'conteudo' => 'Nos termos do artigo 24.º da Lei Geral do Trabalho, o Trabalhador estará sujeito a um período experimental de [número] dias/meses, podendo qualquer das partes pôr termo ao contrato sem aviso prévio nem direito a indemnização.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 4.ª - Funções do Trabalhador',
                'conteudo' => 'O Trabalhador exercerá as funções de [designação do cargo], competindo-lhe desempenhar as tarefas inerentes ao mesmo, nos termos do artigo 28.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 5.ª - Local de Trabalho',
                'conteudo' => 'O Trabalhador exercerá a sua atividade em [localidade/morada], podendo ser transferido para outro local nos termos do artigo 29.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 6.ª - Duração do Trabalho',
                'conteudo' => 'Nos termos dos artigos 32.º a 37.º da Lei Geral do Trabalho, o horário normal de trabalho será de 8 horas diárias e 44 horas semanais, com os intervalos para descanso previstos na lei.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 7.ª - Trabalho Suplementar',
                'conteudo' => 'O trabalho suplementar será remunerado nos termos do artigo 38.º da Lei Geral do Trabalho, com acréscimo de 50% para a primeira hora e 100% para as horas seguintes.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 8.ª - Descanso Semanal e Feriados',
                'conteudo' => 'O Trabalhador tem direito a um dia de descanso semanal obrigatório e aos feriados nacionais, nos termos dos artigos 39.º e 40.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 9.ª - Férias Anuais',
                'conteudo' => 'Nos termos dos artigos 41.º a 45.º da Lei Geral do Trabalho, o Trabalhador tem direito a 22 dias úteis de férias por cada ano completo de trabalho, com a respetiva remuneração de férias.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 10.ª - Retribuição',
                'conteudo' => 'O Trabalhador auferirá uma retribuição base mensal de [valor] Kwanzas, além dos subsídios de férias e Natal previstos na lei, nos termos dos artigos 46.º a 52.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 11.ª - Formação Profissional',
                'conteudo' => 'O Empregador proporcionará ao Trabalhador a formação profissional necessária ao exercício das suas funções, nos termos do artigo 53.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 12.ª - Segurança e Saúde no Trabalho',
                'conteudo' => 'O Empregador garantirá as condições de segurança e saúde no trabalho nos termos dos artigos 54.º a 58.º da Lei Geral do Trabalho e legislação complementar.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 13.ª - Acidentes de Trabalho',
                'conteudo' => 'Em caso de acidente de trabalho ou doença profissional, aplicam-se as disposições dos artigos 59.º a 62.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 14.ª - Deveres do Trabalhador',
                'conteudo' => 'O Trabalhador deve cumprir com zelo, diligência e probidade as tarefas que lhe forem confiadas, nos termos do artigo 63.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 15.ª - Deveres do Empregador',
                'conteudo' => 'O Empregador deve tratar o Trabalhador com respeito e urbanidade, proporcionando-lhe boas condições de trabalho, nos termos do artigo 64.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 16.ª - Poder Disciplinar',
                'conteudo' => 'O Empregador pode exercer o poder disciplinar nos termos dos artigos 65.º a 67.º da Lei Geral do Trabalho, aplicando as sanções previstas na lei.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 17.ª - Caderneta do Trabalho',
                'conteudo' => 'Nos termos do artigo 68.º da Lei Geral do Trabalho, será passada caderneta do trabalho ao Trabalhador.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 18.ª - Modificação do Contrato',
                'conteudo' => 'Qualquer modificação do contrato depende de acordo escrito entre as partes, nos termos do artigo 69.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 19.ª - Suspensão do Contrato',
                'conteudo' => 'O contrato pode ser suspenso nas situações previstas nos artigos 70.º a 76.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 20.ª - Caducidade do Contrato',
                'conteudo' => 'O contrato cessa automaticamente nas situações de caducidade previstas no artigo 77.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 21.ª - Rescisão por Mútuo Acordo',
                'conteudo' => 'O contrato pode ser rescindido por mútuo acordo nos termos do artigo 78.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 22.ª - Rescisão pelo Trabalhador',
                'conteudo' => 'O Trabalhador pode rescindir o contrato com aviso prévio nos termos do artigo 79.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 23.ª - Rescisão pelo Empregador',
                'conteudo' => 'O Empregador pode rescindir o contrato nos termos dos artigos 80.º a 82.º da Lei Geral do Trabalho, observando o procedimento legal.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 24.ª - Rescisão por Justa Causa',
                'conteudo' => 'Qualquer das partes pode rescindir o contrato sem aviso prévio por justa causa, nos termos dos artigos 83.º a 85.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 25.ª - Indemnizações por Rescisão',
                'conteudo' => 'As indemnizações por rescisão serão calculadas nos termos dos artigos 86.º a 89.º da Lei Geral do Trabalho.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 26.ª - Competência Territorial',
                'conteudo' => 'Para todos os efeitos legais, as partes elegem como competente o tribunal da área da sede do Empregador.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 27.ª - Legislação Aplicável',
                'conteudo' => 'O presente contrato rege-se pelas disposições da Lei Geral do Trabalho e demais legislação complementar angolana.',
                'tipo' => 'trabalho'
            ],
            [
                'titulo' => 'Cláusula 28.ª - Integração de Cláusulas',
                'conteudo' => 'As cláusulas do presente contrato complementam-se com as disposições legais aplicáveis, prevalecendo estas em caso de conflito.',
                'tipo' => 'trabalho'
            ],

            // CONTRATO DE PRESTAÇÃO DE SERVIÇOS GERAL
            [
                'titulo' => 'Cláusula 1.ª - Objecto do Contrato de Prestação de Serviços',
                'conteudo' => 'Nos termos dos artigos 1124.º a 1130.º do Código Civil, o presente contrato tem por objecto a prestação pelo Prestador de Serviços ao Cliente dos serviços especificados no anexo I, mediante o pagamento da retribuição acordada.',
                'tipo' => 'servico_prestacao'
            ],
            [
                'titulo' => 'Cláusula 2.ª - Duração do Contrato',
                'conteudo' => 'O presente contrato vigorará pelo prazo de [número] meses/anos, iniciando-se em [data] e terminando em [data], podendo ser renovado nos termos do artigo 1128.º do Código Civil.',
                'tipo' => 'servico_prestacao'
            ],
            [
                'titulo' => 'Cláusula 3.ª - Prestação dos Serviços',
                'conteudo' => 'O Prestador de Serviços executará os serviços com a diligência de um bom profissional, nos termos do artigo 1125.º do Código Civil, utilizando os meios adequados para atingir o resultado pretendido.',
                'tipo' => 'servico_prestacao'
            ],
            [
                'titulo' => 'Cláusula 4.ª - Retribuição',
                'conteudo' => 'Pela prestação dos serviços, o Cliente pagará ao Prestador a retribuição de [valor] Kwanzas, nos termos e prazos estabelecidos no anexo II, conforme artigo 1126.º do Código Civil.',
                'tipo' => 'servico_prestacao'
            ],
            [
                'titulo' => 'Cláusula 5.ª - Despesas e Fornecimentos',
                'conteudo' => 'As despesas necessárias à execução dos serviços serão suportadas pelo Prestador/Cliente, nos termos do artigo 1127.º do Código Civil.',
                'tipo' => 'servico_prestacao'
            ],

            // CONTRATO DE CONSULTORIA
            [
                'titulo' => 'Cláusula 6.ª - Objecto do Contrato de Consultoria',
                'conteudo' => 'O Prestador prestará serviços de consultoria na área de [especificar área], fornecendo pareceres, estudos e recomendações nos termos dos artigos 1131.º a 1135.º do Código Civil.',
                'tipo' => 'servico_consultoria'
            ],
            [
                'titulo' => 'Cláusula 7.ª - Deveres do Consultor',
                'conteudo' => 'O Consultor obriga-se a prestar os serviços com isenção e independência técnica, baseando os seus pareceres em critérios objectivos e cientificamente fundamentados.',
                'tipo' => 'servico_consultoria'
            ],
            [
                'titulo' => 'Cláusula 8.ª - Confidencialidade na Consultoria',
                'conteudo' => 'O Consultor obriga-se ao sigilo sobre todas as informações a que tenha acesso no exercício da sua actividade, mesmo após o término do contrato.',
                'tipo' => 'servico_consultoria'
            ],
            [
                'titulo' => 'Cláusula 9.ª - Responsabilidade do Consultor',
                'conteudo' => 'O Consultor responde pelos prejuízos causados por informações ou pareceres incorrectos, quando agir com dolo ou negligência grosseira.',
                'tipo' => 'servico_consultoria'
            ],

            // CONTRATO DE REPRESENTAÇÃO COMERCIAL
            [
                'titulo' => 'Cláusula 10.ª - Objecto do Contrato de Representação',
                'conteudo' => 'Nos termos dos artigos 1185.º a 1204.º do Código Civil, o Representante obriga-se a promover, de forma duradoura e independente, a prática de actos de comércio pelo Representado.',
                'tipo' => 'servico_representacao'
            ],
            [
                'titulo' => 'Cláusula 11.ª - Âmbito Geográfico',
                'conteudo' => 'O Representante exercerá a sua actividade na área de [especificar área geográfica], podendo ou não ter exclusividade nos termos acordados.',
                'tipo' => 'servico_representacao'
            ],
            [
                'titulo' => 'Cláusula 12.ª - Remuneração do Representante',
                'conteudo' => 'O Representante terá direito a comissão sobre os negócios realizados no âmbito da representação, nos termos do artigo 1194.º do Código Civil.',
                'tipo' => 'servico_representacao'
            ],
            [
                'titulo' => 'Cláusula 13.ª - Deveres do Representante',
                'conteudo' => 'O Representante deve zelar pelos interesses do Representado, comunicar informações relevantes e prestar contas da sua gestão.',
                'tipo' => 'servico_representacao'
            ],
            [
                'titulo' => 'Cláusula 14.ª - Indemnização por Clienteela',
                'conteudo' => 'Nos termos do artigo 1201.º do Código Civil, o Representante tem direito a indemnização pelos clientes que haja proporcionado ao Representado.',
                'tipo' => 'servico_representacao'
            ],

            // CONTRATO DE MANDATO
            [
                'titulo' => 'Cláusula 15.ª - Objecto do Contrato de Mandato',
                'conteudo' => 'Nos termos dos artigos 1157.º a 1184.º do Código Civil, o Mandatário obriga-se a praticar um ou mais actos ou negócios jurídicos por conta do Mandante.',
                'tipo' => 'servico_mandato'
            ],
            [
                'titulo' => 'Cláusula 16.ª - Poderes do Mandatário',
                'conteudo' => 'O Mandatário fica investido dos poderes necessários para a realização do objecto do mandato, nos limites estabelecidos no artigo 1162.º do Código Civil.',
                'tipo' => 'servico_mandato'
            ],
            [
                'titulo' => 'Cláusula 17.ª - Execução do Mandato',
                'conteudo' => 'O Mandatário deve executar o mandato pessoalmente, salvo se autorizado a substabelecer, nos termos do artigo 1167.º do Código Civil.',
                'tipo' => 'servico_mandato'
            ],
            [
                'titulo' => 'Cláusula 18.ª - Obrigação de Prestar Contas',
                'conteudo' => 'O Mandatário deve prestar contas da sua gestão ao Mandante, nos termos do artigo 1171.º do Código Civil.',
                'tipo' => 'servico_mandato'
            ],
            [
                'titulo' => 'Cláusula 19.ª - Responsabilidade do Mandatário',
                'conteudo' => 'O Mandatário responde pelos prejuízos resultantes da inexecução ou má execução do mandato, excepto se provar caso de força maior.',
                'tipo' => 'servico_mandato'
            ],

            // CONTRATO DE EMPREITADA
            [
                'titulo' => 'Cláusula 20.ª - Objecto do Contrato de Empreitada',
                'conteudo' => 'Nos termos dos artigos 1205.º a 1221.º do Código Civil, o Empreiteiro obriga-se a realizar uma obra ou serviço, por preço certo, sob a direcção do Dono da Obra.',
                'tipo' => 'servico_empreitada'
            ],
            [
                'titulo' => 'Cláusula 21.ª - Preço e Forma de Pagamento',
                'conteudo' => 'O preço da empreitada é de [valor] Kwanzas, a pagar nos termos estabelecidos no plano de pagamento anexo, conforme artigo 1209.º do Código Civil.',
                'tipo' => 'servico_empreitada'
            ],
            [
                'titulo' => 'Cláusula 22.ª - Materiais e Equipamentos',
                'conteudo' => 'Os materiais e equipamentos necessários à execução da obra serão fornecidos pelo Empreiteiro/Donos da Obra, nos termos do artigo 1210.º do Código Civil.',
                'tipo' => 'servico_empreitada'
            ],
            [
                'titulo' => 'Cláusula 23.ª - Prazos de Execução',
                'conteudo' => 'A obra será executada no prazo de [número] dias/meses, a contar da data de assinatura do contrato, sob pena de aplicação de cláusula penal.',
                'tipo' => 'servico_empreitada'
            ],
            [
                'titulo' => 'Cláusula 24.ª - Receção da Obra',
                'conteudo' => 'A obra será objecto de receção pelo Dono da Obra, que poderá formular reservas nos termos do artigo 1215.º do Código Civil.',
                'tipo' => 'servico_empreitada'
            ],
            [
                'titulo' => 'Cláusula 25.ª - Garantia por Vícios',
                'conteudo' => 'O Empreiteiro garante a obra contra vícios ou defeitos pelo prazo de [número] anos, nos termos do artigo 1218.º do Código Civil.',
                'tipo' => 'servico_empreitada'
            ],

            // CONTRATO DE AGÊNCIA
            [
                'titulo' => 'Cláusula 26.ª - Contrato de Agência',
                'conteudo' => 'O Agente obriga-se de forma duradoura e independente a promover negócios em nome e por conta do Principal, nos termos dos artigos 1185.º e seguintes do Código Civil.',
                'tipo' => 'servico_agencia'
            ],

            // CONTRATO DE MEDIAÇÃO
            [
                'titulo' => 'Cláusula 27.ª - Contrato de Mediação',
                'conteudo' => 'O Mediador obriga-se a proporcionar o encontro de vontades entre partes para a conclusão de um negócio jurídico, sem estar vinculado a qualquer delas.',
                'tipo' => 'servico_mediacao'
            ],

            // CLAÚSULAS GERAIS (aplicáveis a vários tipos)
            [
                'titulo' => 'Cláusula 28.ª - Resolução do Contrato',
                'conteudo' => 'O contrato pode ser resolvido por incumprimento culposo de qualquer das partes, nos termos do artigo 432.º e seguintes do Código Civil.',
                'tipo' => 'geral'
            ],
            [
                'titulo' => 'Cláusula 29.ª - Cláusula Penal',
                'conteudo' => 'Em caso de incumprimento, a parte faltante pagará à outra cláusula penal no valor de [valor] Kwanzas, sem prejuízo da indemnização por danos maiores.',
                'tipo' => 'geral'
            ],
            [
                'titulo' => 'Cláusula 30.ª - Força Maior',
                'conteudo' => 'As partes não serão responsáveis por incumprimentos resultantes de caso de força maior, nos termos do artigo 362.º do Código Civil.',
                'tipo' => 'geral'
            ],
            [
                'titulo' => 'Cláusula 31.ª - Confidencialidade',
                'conteudo' => 'As partes obrigam-se a manter sigilo sobre todas as informações confidenciais a que tenham acesso durante a vigência do contrato.',
                'tipo' => 'geral'
            ],
            [
                'titulo' => 'Cláusula 32.ª - Propriedade Intelectual',
                'conteudo' => 'Os direitos de propriedade intelectual sobre os trabalhos realizados no âmbito do contrato pertencem ao Cliente/Prestador, conforme acordado.',
                'tipo' => 'geral'
            ],
            [
                'titulo' => 'Cláusula 33.ª - Resolução de Litígios',
                'conteudo' => 'Os litígios emergentes do contrato serão resolvidos pelos tribunais judiciais de [localidade], renunciando as partes a qualquer outro foro.',
                'tipo' => 'geral'
            ],
            [
                'titulo' => 'Cláusula 34.ª - Legislação Aplicável',
                'conteudo' => 'O presente contrato rege-se pelas disposições do Código Civil angolano e legislação complementar aplicável.',
                'tipo' => 'geral'
            ],
            [
                'titulo' => 'Cláusula 35.ª - Integralidade do Contrato',
                'conteudo' => 'Este contrato constitui o acordo integral entre as partes, substituindo todos os entendimentos anteriores.',
                'tipo' => 'geral'
            ],
        ];

        foreach ($clausulas as $clausula) {
            Clausula::updateOrCreate(
                [
                    'team_id' => null,
                    'titulo' => $clausula['titulo'],
                    'tipo' => $clausula['tipo'],
                ],
                [
                    'conteudo' => $clausula['conteudo'],
                    'criado_por' => null,
                    'versao' => 1,
                    'status' => 'ativo',
                ]
            );
        }

        $this->command->info('Todas as cláusulas legais angolanas inseridas com sucesso!');
        $this->command->info('Total: ' . count($clausulas) . ' cláusulas inseridas/atualizadas.');
   
    }
}