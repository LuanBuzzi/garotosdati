<?php

session_start();
include 'navbar.php';

$conn = new mysqli("localhost", "root", "", "hivedb");

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit;
}

// Busca o país de residência do usuário logado
$usuario_logado = $_SESSION['nome'];

$stmt = $conn->prepare("SELECT pais_residencia FROM usuarios WHERE nome = ?");
$stmt->bind_param("s", $usuario_logado);
$stmt->execute();
$resultado = $stmt->get_result();
$dados = $resultado->fetch_assoc();

$pais_residencia = $dados['pais_residencia'] ?? 'Brasil';


$dicas_por_pais = [
    'Espanha' => [
        [
            'titulo' => 'Sistema de Saúde na Espanha',
            'descricao' => 'Se você estiver registrado no sistema público de saúde (Seguridad Social), você terá acesso a consultas gratuitas e farmácias com desconto.',
        ],
        [
            'titulo' => 'Transporte Público',
            'descricao' => 'Use o cartão de transporte mensal (Abono Transportes) para economizar em metrôs, trens e ônibus em Madri e outras cidades.',
        ],
        [
            'titulo' => 'Documentação Essencial',
            'descricao' => 'Para residência legal, tenha o NIE (Número de Identificação de Estrangeiro). É essencial para abrir conta, alugar imóvel e trabalhar legalmente.',
        ],
        [
            'titulo' => 'Sistema de Saúde na Espanha',
            'descricao' => 'Se você estiver registrado no sistema público de saúde (Seguridad Social), você terá acesso a consultas gratuitas e farmácias com desconto.',
        ],
        [
            'titulo' => 'Transporte Público',
            'descricao' => 'Use o cartão de transporte mensal (Abono Transportes) para economizar em metrôs, trens e ônibus em Madri e outras cidades.',
        ],
        [
            'titulo' => 'Documentação Essencial',
            'descricao' => 'Para residência legal, tenha o NIE (Número de Identificação de Estrangeiro). É essencial para abrir conta, alugar imóvel e trabalhar legalmente.',
        ],
        [
            'titulo' => 'Sistema de Saúde na Espanha',
            'descricao' => 'Se você estiver registrado no sistema público de saúde (Seguridad Social), você terá acesso a consultas gratuitas e farmácias com desconto.',
        ],
        [
            'titulo' => 'Transporte Público',
            'descricao' => 'Use o cartão de transporte mensal (Abono Transportes) para economizar em metrôs, trens e ônibus em Madri e outras cidades.',
        ],
        [
            'titulo' => 'Documentação Essencial',
            'descricao' => 'Para residência legal, tenha o NIE (Número de Identificação de Estrangeiro). É essencial para abrir conta, alugar imóvel e trabalhar legalmente.',
        ],
    ],
    'Brasil' => [
        [
            'titulo' => 'Cadastro Único e Benefícios',
            'descricao' => 'Migrantes podem se cadastrar no CadÚnico para acesso a programas sociais como Bolsa Família e outros benefícios estaduais.',
        ],
        [
            'titulo' => 'Documentos para Regularização',
            'descricao' => 'Garanta CPF, carteira de trabalho e protocolo da Polícia Federal para dar entrada em processos migratórios.',
        ],
    ],
    'Itália' => [
        [
            'titulo' => 'Saúde Pública na Itália',
            'descricao' => 'O Sistema Sanitario Nazionale (SSN) oferece atendimento público gratuito ou a baixo custo. Faça sua inscrição para obter o cartão sanitário (Tessera Sanitaria).',
        ],
        [
            'titulo' => 'Cidadania e Documentos',
            'descricao' => 'Para viver legalmente, mantenha seu permesso di soggiorno atualizado e registre-se na anagrafe (registro municipal).',
        ],
        [
            'titulo' => 'Transporte e Mobilidade',
            'descricao' => 'Use os passes mensais para transporte público nas grandes cidades como Roma e Milão para economizar.',
        ],
    ],
    'Estados Unidos' => [
        [
            'titulo' => 'Seguro Saúde',
            'descricao' => 'Nos EUA, o seguro saúde é essencial. Verifique se seu plano cobre suas necessidades e procure o mercado de seguros (Health Insurance Marketplace).',
        ],
        [
            'titulo' => 'Documentos Importantes',
            'descricao' => 'Mantenha seu Social Security Number (SSN) e carteira de motorista atualizados para evitar problemas legais.',
        ],
        [
            'titulo' => 'Cultura e Cidadania',
            'descricao' => 'Informe-se sobre os direitos dos imigrantes e oportunidades de naturalização se pretende permanecer a longo prazo.',
        ],
    ],
];

$dicas = $dicas_por_pais[$pais_residencia] ?? [
    [
        'titulo' => 'Bem-vindo!',
        'descricao' => 'Em breve teremos dicas específicas para seu país de residência. Enquanto isso, explore outras seções da Hive.',
    ]
];

$emojis_por_pais = [
    'Brasil' => '🇧🇷',
    'Espanha' => '🇪🇸',
    'Itália' => '🇮🇹',
    'Estados Unidos' => '🇺🇸',
];

$emoji_pais = $emojis_por_pais[$pais_residencia] ?? '🏳️';


?>