-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 21-Out-2019 às 03:12
-- Versão do servidor: 10.1.41-MariaDB-0+deb9u1
-- versão do PHP: 7.0.33-0+deb9u5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jw_shop`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_content`
--

CREATE TABLE `jw_content` (
  `id` bigint(20) NOT NULL,
  `page_type` char(10) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `normal_name` varchar(250) DEFAULT NULL,
  `element_url` text,
  `image_id` bigint(20) NOT NULL DEFAULT '0',
  `image` text,
  `thumbnail` text,
  `page_template` varchar(30) DEFAULT NULL,
  `page_status` enum('new','draft','active','blocked','trashed','deleted') NOT NULL DEFAULT 'draft',
  `page_parent` bigint(20) DEFAULT NULL,
  `page_home` int(1) DEFAULT '0',
  `page_order` int(5) DEFAULT NULL,
  `editsession_id` double(16,4) DEFAULT NULL,
  `workflow_status` char(5) DEFAULT NULL,
  `redirect` text,
  `rating_editor` decimal(5,2) NOT NULL DEFAULT '0.00',
  `rating_user` decimal(5,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `rating_systemid` int(11) NOT NULL DEFAULT '0',
  `stats_ratings` int(11) NOT NULL DEFAULT '0',
  `stats_pageviews` int(11) NOT NULL DEFAULT '0',
  `stats_shares` int(11) NOT NULL DEFAULT '0',
  `stats_words` int(11) DEFAULT NULL,
  `stats_chars` int(11) DEFAULT NULL,
  `stats_spaces` int(11) DEFAULT NULL,
  `published` int(1) NOT NULL DEFAULT '0',
  `publish_date` datetime DEFAULT NULL,
  `panel_userid` bigint(20) NOT NULL DEFAULT '0',
  `ugc_userid` bigint(20) NOT NULL DEFAULT '0',
  `ugc_accessible` int(1) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `import_id` char(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_content`
--

INSERT INTO `jw_content` (`id`, `page_type`, `name`, `normal_name`, `element_url`, `image_id`, `image`, `thumbnail`, `page_template`, `page_status`, `page_parent`, `page_home`, `page_order`, `editsession_id`, `workflow_status`, `redirect`, `rating_editor`, `rating_user`, `rating_systemid`, `stats_ratings`, `stats_pageviews`, `stats_shares`, `stats_words`, `stats_chars`, `stats_spaces`, `published`, `publish_date`, `panel_userid`, `ugc_userid`, `ugc_accessible`, `created_date`, `created_by`, `updated_date`, `updated_by`, `import_id`) VALUES
(1, 'PAGE', 'Smartphone Xiaomi Redmi Note 7 64GB Preto', 'smartphone-xiaomi-redmi-note-7-64gb-preto', 'smartphone-xiaomi-redmi-note-7-64gb-preto', 1, 'contentFiles/image/2019/10/rednote7-1.jpg', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-1.jpg', '', 'active', 0, 0, 0, 1571619016.9790, 'LIVE', '', '0.00', '0.00', 0, 0, 0, 0, NULL, NULL, NULL, 1, '2019-10-20 02:40:00', 6, 0, 0, '2019-10-20 02:24:16', 6, '2019-10-20 21:50:23', 6, ''),
(2, 'PAGE', 'Smartphone Xiaomi Redmi Note 7 128GB Azul', 'smartphone-xiaomi-redmi-note-7-128gb-azul', 'smartphone-xiaomi-redmi-note-7-128gb-azul', 9, 'contentFiles/image/2019/10/rednote7azul-2.jpg', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-2.jpg', '', 'active', 0, 0, 0, 1571618998.9229, 'LIVE', '', '0.00', '0.00', 0, 0, 0, 0, NULL, NULL, NULL, 1, '2019-10-20 04:04:00', 6, 0, 0, '2019-10-20 04:02:51', 6, '2019-10-20 21:50:10', 6, ''),
(3, 'PAGE', 'Smart TV LED 50\" Samsung 50RU7100', 'smart-tv-led-50-samsung-50ru7100', 'smart-tv-led-50-samsung-50ru7100', 16, 'contentFiles/image/2019/10/tvsam50-1.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-1.jpg', '', 'active', 0, 0, 0, 1571619028.7306, 'LIVE', '', '0.00', '0.00', 0, 0, 0, 0, NULL, NULL, NULL, 1, '2019-10-20 21:03:00', 6, 0, 0, '2019-10-20 20:53:29', 6, '2019-10-20 21:50:36', 6, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_content_text`
--

CREATE TABLE `jw_content_text` (
  `content_id` bigint(20) NOT NULL DEFAULT '0',
  `language` char(5) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `normal_name` varchar(250) DEFAULT NULL,
  `standfirst` text,
  `description` longtext,
  `specifications` longtext,
  `price` decimal(9,2) DEFAULT NULL,
  `stock` int(5) DEFAULT '0',
  `created_by` bigint(20) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `record_hash` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_content_text`
--

INSERT INTO `jw_content_text` (`content_id`, `language`, `name`, `normal_name`, `standfirst`, `description`, `specifications`, `price`, `stock`, `created_by`, `created_date`, `updated_by`, `updated_date`, `record_hash`) VALUES
(1, 'pt_BR', 'Smartphone Xiaomi Redmi Note 7 64GB Preto', 'smartphone-xiaomi-redmi-note-7-64gb-preto', 'Smartphone Xiaomi Redmi Note 7 Android 9 Tela 6.3 Octa-Core 2.2 Ghz 4GB RAM 64GB Versão Global', '<p>Se você é apaixonado por smartphones, o Redmi Note 7 64GB vai deixar você, com borboletas no estômago. A Xiaomi vem conquistando a cada dia mais e mais o coração dos seus usuários, inovação, tecnologia de ponta e preço baixo são seu carro forte. Assim como seus antecessores o Smartphone Xiaomi Redmi Note 7 64GB, possui design surpreendente e muito bonito. Nas câmeras a Xiaomi mostra que não está para brincadeira, além dos recursos já conhecidos das suas câmeras o Smartphone Xiaomi Redmi Note 7 64GB, vem recheado de novidades, pois de primeira, o que mais chama a atenção dos apaixonados por fotografia é a câmera traseira dupla, são 48 megapixels mais 5 megapixels, deixam qualquer um de queixo caído. A qualidade da sua câmera frontal também está de tirar o fôlego, pois ele conta com lente de 13 megapixels. Este super aparelho, conta também com uma super tela, pois são 6.3 polegadas, que ampliam sua visão na hora de navegar. Um celular de última tecnologia, não poderia faltar um sistema operacional de qualidade, por isso o Smartphone Xiaomi Redmi Note 7 64GB, conta com o Android 9 Pie. Para você armazenar tudo sem perder nenhum detalhe, o Smartphone Xiaomi Redmi Note 7, conta com memória interna de 64GB e 4GB de memória RAM. O lançamento da Xiaomi mau chegou e já está abalando corações e se você acha que parou por aí, se enganou pois o Smartphone Xiaomi Redmi Note 7 64GB, tem muito mais a lhe oferecer. Uma super bateria faz parte do pacote deste maravilhoso aparelho, pois ele conta com bateria de 4.000 mAh, que irão lhe garantir um dia inteiro sem preocupações. Processador octa core snapdragon também veio para acrescentar em tecnologia e desempenho do seu Smartphone Xiaomi Redmi Note 7 64GB. Ao comprar esse novo lançamento Smartphone Xiaomi Redmi Note 7 64GB, você tem certeza de adquirir um aparelho completo e com o melhor custo benefício.</p>', '<h5>Detalhes técnicos</h5>\r\n<table class=\"table table-striped\"><tbody><tr><td>Sistema operacional</td><td>android</td></tr><tr><td>Processador</td><td>Snapdragon 660&nbsp;Octa-core (4x2.2 GHz Kryo 260 & 4x1.8 GHz Kryo 260) (14 nm)</td></tr><tr><td>GPU</td><td>Adreno 512 Chipset Qualcomm SDM660</td></tr><tr><td>Memória RAM</td><td>4 GB</td></tr><tr><td>Capacidade de armazenamento digital</td><td>64 GB</td></tr><tr><td>Baterias ou pilhas</td><td>1 Polímero de lítio baterias ou pilhas necessárias (inclusas).</td></tr><tr><td>Número do modelo</td><td>MZB7578EU</td></tr><tr><td>Tamanho da tela</td><td>6.3 polegadas</td></tr><tr><td>Cor</td><td>Preto</td></tr><tr><td>Tempo de conversa</td><td>23 horas</td></tr><tr><td>Tempo de espera com dados</td><td>10 horas</td></tr></tbody></table>\r\n<p></p>\r\n<h5><strong>Informações adicionais</strong></h5>\r\n<p></p>\r\n<table class=\"table table-striped\"><tbody><tr><td>Dimensões do pacote</td><td>16,8 x 8,6 x 5,2 cm</td></tr><tr><td>Peso do produto</td><td>186 g</td></tr><tr><td>Dimensões do produto</td><td>17 x 8,5 x 5 cm</td></tr><tr><td>Peso do envio</td><td>422 g</td></tr><tr><td>Baterias ou pilhas</td><td>1 Polímero de lítio baterias ou pilhas necessárias (inclusas).</td></tr><tr><td>Número do modelo</td><td>MZB7578EU</td></tr><tr><td>ASIN</td><td>B07PGVWHYZ</td></tr><tr><td>Código de barras:</td><td>6941059620983</td></tr><tr><td>Primeira data disponível</td><td>24 de abril de 2019</td></tr></tbody></table>\r\n<p></p>', '1069.78', 3, 6, '2019-10-20 02:24:26', 6, '2019-10-20 21:50:23', '2ba7f1a6f89acbc77d432f0a1c307375c3288a2b'),
(2, 'pt_BR', 'Smartphone Xiaomi Redmi Note 7 128GB Azul', 'smartphone-xiaomi-redmi-note-7-128gb-azul', 'Smartphone Xiaomi Redmi Note 7 Android 9 Tela 6.3 Octa-Core 2.2 Ghz 4GB RAM 128GB Versão Global', '<p>Se você é apaixonado por smartphones, o Redmi Note 7 128GB vai deixar você, com borboletas no estômago. A Xiaomi vem conquistando a cada dia mais e mais o coração dos seus usuários, inovação, tecnologia de ponta e preço baixo são seu carro forte. Assim como seus antecessores o Smartphone Xiaomi Redmi Note 7 128GB, possui design surpreendente e muito bonito. Nas câmeras a Xiaomi mostra que não está para brincadeira, além dos recursos já conhecidos das suas câmeras o Smartphone Xiaomi Redmi Note 7 128GB, vem recheado de novidades, pois de primeira, o que mais chama a atenção dos apaixonados por fotografia é a câmera traseira dupla, são 48 megapixels mais 5 megapixels, deixam qualquer um de queixo caído. A qualidade da sua câmera frontal também está de tirar o fôlego, pois ele conta com lente de 13 megapixels. Este super aparelho, conta também com uma super tela, pois são 6.3 polegadas, que ampliam sua visão na hora de navegar. Um celular de última tecnologia, não poderia faltar um sistema operacional de qualidade, por isso o Smartphone Xiaomi Redmi Note 7 128GB, conta com o Android 9 Pie. Para você armazenar tudo sem perder nenhum detalhe, o Smartphone Xiaomi Redmi Note 7, conta com memória interna de 128GB e 4GB de memória RAM. O lançamento da Xiaomi mau chegou e já está abalando corações e se você acha que parou por aí, se enganou pois o Smartphone Xiaomi Redmi Note 7 128GB, tem muito mais a lhe oferecer. Uma super bateria faz parte do pacote deste maravilhoso aparelho, pois ele conta com bateria de 4.000 mAh, que irão lhe garantir um dia inteiro sem preocupações. Processador octa core snapdragon também veio para acrescentar em tecnologia e desempenho do seu Smartphone Xiaomi Redmi Note 7 128GB. Ao comprar esse novo lançamento Smartphone Xiaomi Redmi Note 7 128GB, você tem certeza de adquirir um aparelho completo e com o melhor custo benefício.</p>', '<h5>Detalhes técnicos</h5>\r\n<table class=\"table table-striped\"><tbody><tr><td>Sistema operacional</td><td>android</td></tr><tr><td>Processador</td><td>Snapdragon 660&nbsp;Octa-core (4x2.2 GHz Kryo 260 & 4x1.8 GHz Kryo 260) (14 nm)</td></tr><tr><td>GPU</td><td>Adreno 512 Chipset Qualcomm SDM660</td></tr><tr><td>Memória RAM</td><td>4 GB</td></tr><tr><td>Capacidade de armazenamento digital</td><td>128 GB</td></tr><tr><td>Baterias ou pilhas</td><td>1 Polímero de lítio baterias ou pilhas necessárias (inclusas).</td></tr><tr><td>Número do modelo</td><td>MZB7578EU</td></tr><tr><td>Tamanho da tela</td><td>6.3 polegadas</td></tr><tr><td>Cor</td><td>Preto</td></tr><tr><td>Tempo de conversa</td><td>23 horas</td></tr><tr><td>Tempo de espera com dados</td><td>10 horas</td></tr></tbody></table>\r\n<p></p>\r\n<h5>Informações adicionais</h5>\r\n<table class=\"table table-striped\"><tbody><tr><td>Dimensões do pacote</td><td>16,8 x 8,6 x 5,2 cm</td></tr><tr><td>Peso do produto</td><td>186 g</td></tr><tr><td>Dimensões do produto</td><td>17 x 8,5 x 5 cm</td></tr><tr><td>Peso do envio</td><td>422 g</td></tr><tr><td>Baterias ou pilhas</td><td>1 Polímero de lítio baterias ou pilhas necessárias (inclusas).</td></tr><tr><td>Número do modelo</td><td>MZB7578EU</td></tr><tr><td>ASIN</td><td>B07PGVWHYZ</td></tr><tr><td>Código de barras:</td><td>6941059620983</td></tr><tr><td>Primeira data disponível</td><td>24 de abril de 2019</td></tr></tbody></table>', '1375.98', 0, 6, '2019-10-20 04:04:55', 6, '2019-10-20 21:50:10', '3fdcf9784af1ccab51d8cc812865843781bc40cb'),
(3, 'pt_BR', 'Smart TV LED 50\" Samsung 50RU7100', 'smart-tv-led-50-samsung-50ru7100', 'Smart TV LED 50\" Samsung 50RU7100 Ultra HD 4K com Conversor Digital 3 HDMI 2 USB Wi-Fi Visual Livre de Cabos Controle Remoto Único e Bluetooth', '<h3>Tudo apenas com o controle<br>remoto da sua TV</h3>\r\n<h4>Controle Remoto Único<sup>1</sup></h4>\r\n<p>Descubra a incrível facilidade de controlar diversos aparelhos conectados à TV com apenas um controle remoto.</p>\r\n<h3>Conexão sem fio entre sua TV e outros dispositivos</h3>\r\n<h4>Bluetooth<sup>2</sup></h4>\r\n<p>Conecte facilmente fones de ouvido, teclados, Soundbar e outros equipamentos via Bluetooth. Tudo sem precisar de cabos adicionais.</p>\r\n<h3>Design Slim<sup>3</sup></h3>\r\n<p>Acabamento preciso, bordas finas e soluções para minimizar a exposição dos fios no ambiente fazem da RU7100 uma TV elegante e completa. Além de ser a TV 4K mais fina da categoria.</p>\r\n<h3>Visual com Cabos<br>Escondidos<sup>4</sup></h3>\r\n<p>Esconda todos os cabos que saem da TV dentro das canaletas e atrás dos pés, deixando seu espaço mais organizado e clean.</p>\r\n<h3>4K de Verdade</h3>\r\n<p>A Samsung RU7100 possui o melhor da tecnologia UHD 4K.&nbsp;<sup>5</sup>&nbsp;Os painéis RGB, sem sub-pixel branco, garantem fidelidade de cores e certificação pelas principais associações internacionais do setor.</p>\r\n<h4>Painel RGBW com sub-pixel branco</h4>\r\n<h4>Painel RGB sem sub-pixel branco</h4>\r\n<p><strong>Arraste o cursor sobre a imagem e veja a diferença.</strong>Uma legítima 4K não tem pixel branco, que diminui a qualidade da imagem.</p>\r\n<h3>HDR Premium<br></h3>\r\n<p>Muito mais brilho e contraste para você aproveitar seu programa tanto nas cenas mais escuras quanto naquelas de alta luminosidade.&nbsp;</p>\r\n<h3>Tela de cinema<br>no conforto<br>da sua sala</h3>\r\n<h4>Mais emoção em<br>uma tela grande!</h4>\r\n<p>Veja cada cena ganhando vida independente do tamanho da sua sala!</p>\r\n<p>SAIBA MAIS</p>\r\n<h3>iTunes: Agora nas TVs Samsung</h3>\r\n<h4>Novidade!</h4>\r\n<p>Assista em UHD 4K os últimos lançamentos de filmes e séries direto do aplicativo iTunes<sup>6</sup>&nbsp;nas TVs Samsung. Mais, veja os seus conteúdos pessoais na TV Samsung através do Apple Airplay 2.</p>', '<h5>Ficha técnica</h5>\r\n<table class=\"table table-striped\"><tbody><tr><td>Código</td><td>134241723</td></tr><tr><td>Código de barras</td><td>7892509106405</td></tr><tr><td>Recursos/Funcionalidades</td><td>Samsung SMART TV, Navegador (Web Browser), Espelhamento do Smartphone para TV, DLNA, Bluetooth Low Energy, WiFi Direct, Som da TV para smartphone, Acessibilidade - Guia de Voz (Inglês - EUA, Português - Brasil), Ampliar, Aumento de Contraste, Aprenda a mexer no Controle Remoto da TV (Inglês - EUA, Áudio de múltiplas saídas, Cores negativas, Preto e Branco, Aprenda a mexer no Menu (Inglês - EUA, Zoom de vídeo, Digital Clean View, Busca automática de canais, Desligamento Automático, Legenda, Connect Share (HDD), ConnectShare (USB 2.0), EPG, Game Mode Sim (Modo Game automático), Idioma (Local - Brasil - Português), Compatível com HID USB, IPv6 Support, MBR Support, Sensor Ecológico, Selo Procel (\"A\"), Digital Broadcasting (ISDB-T), Sintonizador Analógico (Trinorma), Data Broadcasting (GINGA)</td></tr><tr><td>PIP (Picture in Picture)</td><td>Não</td></tr><tr><td>Closed Caption</td><td>Sim</td></tr><tr><td>Local das entradas USB</td><td>2 entradas traseiras</td></tr><tr><td>Peso liq. aproximado do produto (Kg)</td><td>13,9kg - (Com Base)</td></tr><tr><td>Sleep Timer</td><td>Sim</td></tr><tr><td>USB</td><td>2</td></tr><tr><td>Taxa de Atualização com Tecnologia</td><td>120Hz</td></tr><tr><td>Local das entradas HDMI</td><td>3 entradas traseiras</td></tr><tr><td>Timer On/Off</td><td>Não</td></tr><tr><td>Principais Aplicativos</td><td>Youtube, Netflix, Globo Play. Os aplicativos divulgados podem não estar disponíveis em todas as Smart TV Samsung. A plataforma Samsung Smart TV é usada pelos provedores de conteúdo para disponibilizar aplicativos. Os provedores de conteúdo podem remover aplicativos da plataforma Smart TV ou parar de dar suporte a qualquer momento. O prazo entre o lançamento e a disponibilização de um aplicativo pode variar</td></tr><tr><td>Referência do Modelo</td><td>UN50RU7100GXZD</td></tr><tr><td>Recursos de Áudio</td><td>Dolby Digital Plus, Potência Sonora (20W RMS), Tipo de alto falante (2 canais), Multiroom Link, Bluetooth de Áudio</td></tr><tr><td>Cor - ficha técnica</td><td>CHARCOAL BLACK</td></tr><tr><td>HDMI</td><td>3</td></tr><tr><td>Wi-Fi</td><td>Wi-Fi integrado</td></tr><tr><td>Polegadas</td><td>50\"</td></tr><tr><td>Fabricante</td><td>Samsung Eletrônica da Amazônia LTDA</td></tr><tr><td>Consumo (KW/h)</td><td>135W</td></tr><tr><td>Dimensões do produto - cm (AxLxP)</td><td>72,8x112,4x26,1cm - (Com Base)</td></tr><tr><td>Taxa de Atualização</td><td>60Hz</td></tr><tr><td>SAC</td><td>4004-0000 (Capitais e grandes centros) ou 0800-124-421 (Demais cidades e regiões)</td></tr><tr><td>Outras Conexões</td><td>1 - Entrada de Componente (Y, Pb, Pr), 1 - Entrada de Composto (AV - Uso Normal por Componente Y), Ethernet (LAN), 1 - Saída de Áudio Digital (Óptica), Entrada de RF (terrestre/entrada de cabo), 1 (Uso Normal para o Terrestre) - 0, HDMI ARC, HDMI Quick Switch, Rede sem fio integrada, Anynet+ (HDMI-CEC)</td></tr><tr><td>Tipo de TV</td><td>Smart TV</td></tr><tr><td>Processador</td><td>Quad Core</td></tr><tr><td>Conversor Digital Integrado</td><td>Sim</td></tr><tr><td>Monitor</td><td>Ultra HD 4k</td></tr><tr><td>Tecnologia da Tela</td><td>LED</td></tr><tr><td>Conteúdo da Embalagem</td><td>1 TV, 1- Base para TV (I Shape), 1 Manual do usuário, 1 Controle remoto Samsung Smart (Controle Remoto Único - TM1940A), 1 Par pilhas AA para controle remoto (Opcional), 1 Cabo de força, 1 Adaptador de antena, 4 Adaptadores de suporte de parede (Opcional), 2 Suportes do cabo (Opcional)</td></tr><tr><td>Garantia do Fornecedor</td><td>12 Meses</td></tr><tr><td>Potência do Áudio (RMS)</td><td>20W</td></tr><tr><td>Recursos de Vídeos</td><td>PQI (Picture Quality Index) - 1300, HDR Premium, HDR 10+, HLG (Hybrid Log Gamma), Mega Contraste, Tecnologia de Painel - Painel 100% RGB, Contrast Enhancer, Auto Motion Plus, Modo Filme, Modo Natural</td></tr></tbody></table>', '1999.99', 10, 6, '2019-10-20 20:58:22', 6, '2019-10-20 21:50:36', 'a84e04e8ea329f3d7aa1c50b36c8b7e76f09ddd6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_content_url`
--

CREATE TABLE `jw_content_url` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) DEFAULT NULL,
  `language` char(5) DEFAULT NULL,
  `page_url` text,
  `url_key` binary(20) DEFAULT NULL,
  `redirect` text,
  `created_date` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `published` int(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_content_url`
--

INSERT INTO `jw_content_url` (`id`, `content_id`, `language`, `page_url`, `url_key`, `redirect`, `created_date`, `created_by`, `published`) VALUES
(1, 1, 'pt_BR', 'smartphone-xiaomi-redmi-note-7-64gb-preto', 0x3688f9f490d3a8d64ea55dfb20009b6d5fc35a6f, '', '2019-10-21 00:50:23', 6, 1),
(2, 2, 'pt_BR', 'smartphone-xiaomi-redmi-note-7-128gb-azul', 0x0418f1c28e0005fbfe9aefb143a7412b0e548e40, '', '2019-10-21 00:50:10', 6, 1),
(3, 3, 'pt_BR', 'smart-tv-led-50-samsung-50ru7100', 0x6c23c7fdcfdecb3148e7ce6a55880de730b145f8, '', '2019-10-21 00:50:36', 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_media_files`
--

CREATE TABLE `jw_media_files` (
  `id` bigint(20) NOT NULL,
  `type` enum('image','document','multimidia','other') DEFAULT NULL,
  `filename` text,
  `thumbnail` text,
  `realname` text,
  `hash` text,
  `tags` text,
  `published` int(1) DEFAULT NULL COMMENT '0=Moderation, 1=Approved, 2=Trash, 3=Excluded',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `import_id` char(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `jw_media_files`
--

INSERT INTO `jw_media_files` (`id`, `type`, `filename`, `thumbnail`, `realname`, `hash`, `tags`, `published`, `created_date`, `created_by`, `updated_date`, `updated_by`, `import_id`) VALUES
(1, 'image', 'contentFiles/image/2019/10/rednote7-1.jpg', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-1.jpg', 'rednote7-1.jpg', '3f636d7acebff36233e4da6349cabfad33f050e3f483e4782fd48c9471fbfcd9', NULL, 1, '2019-10-20 02:42:10', 6, '2019-10-20 02:42:10', 6, ''),
(2, 'image', 'contentFiles/image/2019/10/rednote7-3.jpg', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-3.jpg', 'rednote7-3.jpg', 'f40832afc70e45fb608e1c6dc17c0c5a9bb018459c7f0ec46c1bfa0148508030', NULL, 1, '2019-10-20 02:42:10', 6, '2019-10-20 02:42:10', 6, ''),
(3, 'image', 'contentFiles/image/2019/10/rednote7-2.jpg', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-2.jpg', 'rednote7-2.jpg', '892d064afeaf460b6e46d7c0dfc86ba1b9c65dbb995c56aa307be08206fbcddd', NULL, 1, '2019-10-20 02:42:10', 6, '2019-10-20 02:42:10', 6, ''),
(4, 'image', 'contentFiles/image/2019/10/rednote7-7.jpg', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-7.jpg', 'rednote7-7.jpg', 'b7e25794e1e69e080961ad182c0fb282b0963144875ba3443f66a298b8377493', NULL, 1, '2019-10-20 02:42:10', 6, '2019-10-20 02:42:10', 6, ''),
(5, 'image', 'contentFiles/image/2019/10/rednote7-6.jpg', 'contentFiles/image/2019/10/default/w450h250_1571550131_rednote7-6.jpg', 'rednote7-6.jpg', '9847d5db82c217a58c6211fa95e6637a204127db0ef9657a47f6345e90e456c7', NULL, 1, '2019-10-20 02:42:11', 6, '2019-10-20 02:42:11', 6, ''),
(6, 'image', 'contentFiles/image/2019/10/rednote7-5.jpg', 'contentFiles/image/2019/10/default/w450h250_1571550131_rednote7-5.jpg', 'rednote7-5.jpg', '61e8b2ffd0fbdd42bdd72537a4c2441ed245607a6f927b4b2149ee8e91d5041d', NULL, 1, '2019-10-20 02:42:11', 6, '2019-10-20 02:42:11', 6, ''),
(7, 'image', 'contentFiles/image/2019/10/rednote7-8.jpg', 'contentFiles/image/2019/10/default/w450h250_1571550131_rednote7-8.jpg', 'rednote7-8.jpg', '9b52a3cbd99dbd51af388683c4c8218cc91ce518eab38a119f562e0a9ac5c221', NULL, 1, '2019-10-20 02:42:11', 6, '2019-10-20 02:42:11', 6, ''),
(8, 'image', 'contentFiles/image/2019/10/rednote7azul-1.jpg', 'contentFiles/image/2019/10/default/w450h250_1571555339_rednote7azul-1.jpg', 'rednote7azul-1.jpg', 'ecf20a6ecb79de0f04f5a15eb0b8384a248801fd3c38c6af77fd69e251ec57de', NULL, 1, '2019-10-20 04:08:59', 6, '2019-10-20 04:08:59', 6, ''),
(9, 'image', 'contentFiles/image/2019/10/rednote7azul-2.jpg', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-2.jpg', 'rednote7azul-2.jpg', '64c63899ff8961980ff5ed90c5512abb92f72b06e60fb928cc6b54a73cda2c10', NULL, 1, '2019-10-20 04:09:00', 6, '2019-10-20 04:09:00', 6, ''),
(10, 'image', 'contentFiles/image/2019/10/rednote7azul-3.jpg', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-3.jpg', 'rednote7azul-3.jpg', '2aeb0f3cd1c3933f9845d7d6cfede70e0ee15496d5b6e0a919861569cfc4b2c4', NULL, 1, '2019-10-20 04:09:00', 6, '2019-10-20 04:09:00', 6, ''),
(11, 'image', 'contentFiles/image/2019/10/rednote7azul-5.jpg', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-5.jpg', 'rednote7azul-5.jpg', 'd14d3b296b4cb953ec1aa7207ff5e3b3a68c5732bc840e155a50c4c0830dc45c', NULL, 1, '2019-10-20 04:09:00', 6, '2019-10-20 04:09:00', 6, ''),
(12, 'image', 'contentFiles/image/2019/10/rednote7azul-4.jpg', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-4.jpg', 'rednote7azul-4.jpg', '4e53d2c6a8c6c3231ac372987c29488ddfc8cce9193bc8457676911ec4d5854b', NULL, 1, '2019-10-20 04:09:00', 6, '2019-10-20 04:09:00', 6, ''),
(13, 'image', 'contentFiles/image/2019/10/tvsam50-2.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615922_tvsam50-2.jpg', 'tvSam50-2.jpg', '7b8d845baaae6d891bf7423526b27352629a4e6c44a2d163d4570816309bf93b', NULL, 1, '2019-10-20 20:58:42', 6, '2019-10-20 20:58:42', 6, ''),
(14, 'image', 'contentFiles/image/2019/10/tvsam50-4.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615922_tvsam50-4.jpg', 'tvSam50-4.jpg', '58d78be10452341255a98d09702598db7841484d2023691075c7b9e054e1aa78', NULL, 1, '2019-10-20 20:58:42', 6, '2019-10-20 20:58:42', 6, ''),
(15, 'image', 'contentFiles/image/2019/10/tvsam50-5.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615922_tvsam50-5.jpg', 'tvSam50-5.jpg', 'f57d59424f8392b893518627cfe470566ca53105dcf2daafb6697e866e6e2790', NULL, 1, '2019-10-20 20:58:43', 6, '2019-10-20 20:58:43', 6, ''),
(16, 'image', 'contentFiles/image/2019/10/tvsam50-1.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-1.jpg', 'tvSam50-1.jpg', '3d0267fb7a49c92e978508daea7c155da53f60dbc41c43b5f76ea8b819c7efdc', NULL, 1, '2019-10-20 20:58:43', 6, '2019-10-20 20:58:43', 6, ''),
(17, 'image', 'contentFiles/image/2019/10/tvsam50-3.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-3.jpg', 'tvSam50-3.jpg', 'c750bffd164106057605291be40ee10a9c26a90f5b8a164fe77a7f9e8e2e492c', NULL, 1, '2019-10-20 20:58:43', 6, '2019-10-20 20:58:43', 6, ''),
(18, 'image', 'contentFiles/image/2019/10/tvsam50-6.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-6.jpg', 'tvSam50-6.jpg', 'd2926174891c6ff1265ba6e2f3254fa19d14fa2845be7936f56b2cb0ab3aa0f9', NULL, 1, '2019-10-20 20:58:43', 6, '2019-10-20 20:58:43', 6, ''),
(19, 'image', 'contentFiles/image/2019/10/tvsam50-7.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-7.jpg', 'tvSam50-7.jpg', '7a0dc68ccd86a6cfa7930bfe8d903e2a1329d06f078a305f04d699b9f68081d7', NULL, 1, '2019-10-20 20:58:43', 6, '2019-10-20 20:58:43', 6, ''),
(20, 'image', 'contentFiles/image/2019/10/tvsam50-8.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615924_tvsam50-8.jpg', 'tvSam50-8.jpg', 'e783b4a8f61465fe3182dd697e3e6fe25efa5ef07cd92f68c690e4d7600ca634', NULL, 1, '2019-10-20 20:58:44', 6, '2019-10-20 20:58:44', 6, ''),
(21, 'image', 'contentFiles/image/2019/10/tvsam50-9.jpg', 'contentFiles/image/2019/10/default/w450h250_1571615924_tvsam50-9.jpg', 'tvSam50-9.jpg', 'a2ff9c47dfdcd1cda38fc3a0590c38b04f73f17cdf5d5c8ca2c232eb1591d15e', NULL, 1, '2019-10-20 20:58:44', 6, '2019-10-20 20:58:44', 6, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_media_galleries`
--

CREATE TABLE `jw_media_galleries` (
  `id` bigint(20) NOT NULL,
  `kind` varchar(20) DEFAULT NULL,
  `content_id` bigint(20) NOT NULL DEFAULT '0',
  `content_kind` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_main` int(1) NOT NULL DEFAULT '0',
  `hash` text,
  `published` int(1) DEFAULT '1' COMMENT '0=Moderation, 1=Approved, 2=Trash, 3=Excluded',
  `thumbnail` text CHARACTER SET utf8 COLLATE utf8_german2_ci,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `jw_media_galleries`
--

INSERT INTO `jw_media_galleries` (`id`, `kind`, `content_id`, `content_kind`, `name`, `is_main`, `hash`, `published`, `thumbnail`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'PAG', 1, 'PAGE', 'Gallery 1', 1, '#11571550337#', 1, NULL, '2019-10-20 02:45:37', 6, '2019-10-20 04:19:28', 6),
(2, 'PAG', 2, 'PAGE', 'Gallery 2', 1, '#21571555906#', 1, NULL, '2019-10-20 04:18:26', 6, '2019-10-20 04:18:44', 6),
(3, 'PAG', 3, 'PAGE', 'Gallery 3', 1, '#31571616315#', 1, NULL, '2019-10-20 21:05:15', 6, '2019-10-20 21:06:09', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_media_gallery_imagedata`
--

CREATE TABLE `jw_media_gallery_imagedata` (
  `data_id` bigint(20) NOT NULL,
  `relation_id` bigint(20) DEFAULT '0',
  `language` char(5) DEFAULT NULL,
  `title` text,
  `description` text,
  `legend` text,
  `copyright` text,
  `created_date` datetime DEFAULT NULL,
  `created_by` bigint(20) NOT NULL DEFAULT '0',
  `updated_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_media_gallery_images`
--

CREATE TABLE `jw_media_gallery_images` (
  `id` bigint(20) NOT NULL,
  `gallery_id` bigint(20) DEFAULT '0',
  `picture_id` bigint(20) DEFAULT '0',
  `filename` text,
  `thumbnail` text,
  `ordering` int(11) DEFAULT '0',
  `is_main` int(1) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '1' COMMENT '1=Approved, 2=Trash, 3=Excluded, 4=hide',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `jw_media_gallery_images`
--

INSERT INTO `jw_media_gallery_images` (`id`, `gallery_id`, `picture_id`, `filename`, `thumbnail`, `ordering`, `is_main`, `published`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1, 1, 'contentFiles/image/2019/10/main/w934h584_1571550337_gal_1_rednote7-1.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550337_gal_1_rednote7-1.jpg', 1, 0, 1, '2019-10-20 02:45:37', 6, '2019-10-20 02:45:37', 6),
(2, 1, 5, 'contentFiles/image/2019/10/main/w934h584_1571550342_gal_1_rednote7-6.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550342_gal_1_rednote7-6.jpg', 2, 0, 1, '2019-10-20 02:45:42', 6, '2019-10-20 02:45:42', 6),
(3, 1, 7, 'contentFiles/image/2019/10/main/w934h584_1571550350_gal_1_rednote7-8.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550350_gal_1_rednote7-8.jpg', 3, 0, 1, '2019-10-20 02:45:50', 6, '2019-10-20 02:45:50', 6),
(4, 1, 4, 'contentFiles/image/2019/10/main/w934h584_1571550362_gal_1_rednote7-7.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550362_gal_1_rednote7-7.jpg', 4, 0, 1, '2019-10-20 02:46:02', 6, '2019-10-20 02:46:02', 6),
(5, 2, 9, 'contentFiles/image/2019/10/main/w934h584_1571555906_gal_2_rednote7azul-2.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555906_gal_2_rednote7azul-2.jpg', 1, 0, 1, '2019-10-20 04:18:26', 6, '2019-10-20 04:18:26', 6),
(6, 2, 10, 'contentFiles/image/2019/10/main/w934h584_1571555910_gal_2_rednote7azul-3.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555910_gal_2_rednote7azul-3.jpg', 2, 0, 1, '2019-10-20 04:18:30', 6, '2019-10-20 04:18:30', 6),
(7, 2, 11, 'contentFiles/image/2019/10/main/w934h584_1571555915_gal_2_rednote7azul-5.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555915_gal_2_rednote7azul-5.jpg', 3, 0, 1, '2019-10-20 04:18:35', 6, '2019-10-20 04:18:35', 6),
(8, 2, 12, 'contentFiles/image/2019/10/main/w934h584_1571555919_gal_2_rednote7azul-4.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555919_gal_2_rednote7azul-4.jpg', 4, 0, 1, '2019-10-20 04:18:39', 6, '2019-10-20 04:18:39', 6),
(9, 2, 8, 'contentFiles/image/2019/10/main/w934h584_1571555924_gal_2_rednote7azul-1.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555924_gal_2_rednote7azul-1.jpg', 5, 0, 1, '2019-10-20 04:18:44', 6, '2019-10-20 04:18:44', 6),
(10, 1, 6, 'contentFiles/image/2019/10/main/w934h584_1571555953_gal_1_rednote7-5.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555953_gal_1_rednote7-5.jpg', 5, 0, 1, '2019-10-20 04:19:13', 6, '2019-10-20 04:19:13', 6),
(11, 1, 2, 'contentFiles/image/2019/10/main/w934h584_1571555965_gal_1_rednote7-3.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555965_gal_1_rednote7-3.jpg', 6, 0, 1, '2019-10-20 04:19:25', 6, '2019-10-20 04:19:25', 6),
(12, 1, 3, 'contentFiles/image/2019/10/main/w934h584_1571555968_gal_1_rednote7-2.jpg', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555968_gal_1_rednote7-2.jpg', 7, 0, 1, '2019-10-20 04:19:28', 6, '2019-10-20 04:19:28', 6),
(13, 3, 16, 'contentFiles/image/2019/10/tvsam50-1.jpgmain/w934h584_1571616315_gal_3_tvSam50-1.jpg', 'contentFiles/image/2019/10/tvsam50-1.jpgthumbnail/w480h480_1571616316_gal_3_tvSam50-1.jpg', 1, 0, 1, '2019-10-20 21:05:15', 6, '2019-10-20 21:05:16', 6),
(14, 3, 13, 'contentFiles/image/2019/10/tvsam50-2.jpgmain/w934h584_1571616324_gal_3_tvSam50-2.jpg', 'contentFiles/image/2019/10/tvsam50-2.jpgthumbnail/w480h480_1571616324_gal_3_tvSam50-2.jpg', 2, 0, 1, '2019-10-20 21:05:24', 6, '2019-10-20 21:05:24', 6),
(15, 3, 19, 'contentFiles/image/2019/10/tvsam50-7.jpgmain/w934h584_1571616329_gal_3_tvSam50-7.jpg', 'contentFiles/image/2019/10/tvsam50-7.jpgthumbnail/w480h480_1571616329_gal_3_tvSam50-7.jpg', 3, 0, 1, '2019-10-20 21:05:29', 6, '2019-10-20 21:05:29', 6),
(16, 3, 17, 'contentFiles/image/2019/10/tvsam50-3.jpgmain/w934h584_1571616333_gal_3_tvSam50-3.jpg', 'contentFiles/image/2019/10/tvsam50-3.jpgthumbnail/w480h480_1571616333_gal_3_tvSam50-3.jpg', 4, 0, 1, '2019-10-20 21:05:33', 6, '2019-10-20 21:05:34', 6),
(17, 3, 21, 'contentFiles/image/2019/10/tvsam50-9.jpgmain/w934h584_1571616338_gal_3_tvSam50-9.jpg', 'contentFiles/image/2019/10/tvsam50-9.jpgthumbnail/w480h480_1571616339_gal_3_tvSam50-9.jpg', 5, 0, 1, '2019-10-20 21:05:38', 6, '2019-10-20 21:05:39', 6),
(18, 3, 15, 'contentFiles/image/2019/10/tvsam50-5.jpgmain/w934h584_1571616343_gal_3_tvSam50-5.jpg', 'contentFiles/image/2019/10/tvsam50-5.jpgthumbnail/w480h480_1571616344_gal_3_tvSam50-5.jpg', 6, 0, 1, '2019-10-20 21:05:43', 6, '2019-10-20 21:05:44', 6),
(19, 3, 18, 'contentFiles/image/2019/10/tvsam50-6.jpgmain/w934h584_1571616353_gal_3_tvSam50-6.jpg', 'contentFiles/image/2019/10/tvsam50-6.jpgthumbnail/w480h480_1571616353_gal_3_tvSam50-6.jpg', 7, 0, 1, '2019-10-20 21:05:53', 6, '2019-10-20 21:05:54', 6),
(20, 3, 20, 'contentFiles/image/2019/10/tvsam50-8.jpgmain/w934h584_1571616358_gal_3_tvSam50-8.jpg', 'contentFiles/image/2019/10/tvsam50-8.jpgthumbnail/w480h480_1571616358_gal_3_tvSam50-8.jpg', 8, 0, 1, '2019-10-20 21:05:58', 6, '2019-10-20 21:05:58', 6),
(21, 3, 14, 'contentFiles/image/2019/10/tvsam50-4.jpgmain/w934h584_1571616369_gal_3_tvSam50-4.jpg', 'contentFiles/image/2019/10/tvsam50-4.jpgthumbnail/w480h480_1571616369_gal_3_tvSam50-4.jpg', 9, 0, 1, '2019-10-20 21:06:09', 6, '2019-10-20 21:06:09', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_media_resizes`
--

CREATE TABLE `jw_media_resizes` (
  `id` bigint(20) NOT NULL,
  `picture_id` bigint(20) NOT NULL DEFAULT '0',
  `relation_id` bigint(20) DEFAULT '0',
  `width` char(6) DEFAULT NULL,
  `height` char(6) DEFAULT NULL,
  `is_crop` int(1) NOT NULL DEFAULT '0',
  `size_name` varchar(20) DEFAULT NULL,
  `filename` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Extraindo dados da tabela `jw_media_resizes`
--

INSERT INTO `jw_media_resizes` (`id`, `picture_id`, `relation_id`, `width`, `height`, `is_crop`, `size_name`, `filename`) VALUES
(1, 1, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-1.jpg'),
(2, 1, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550130_rednote7-1.jpg'),
(3, 1, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550130_rednote7-1.jpg'),
(4, 2, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-3.jpg'),
(5, 2, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550130_rednote7-3.jpg'),
(6, 2, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550130_rednote7-3.jpg'),
(7, 3, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-2.jpg'),
(8, 3, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550130_rednote7-2.jpg'),
(9, 3, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550130_rednote7-2.jpg'),
(10, 4, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-7.jpg'),
(11, 4, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550130_rednote7-7.jpg'),
(12, 4, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550131_rednote7-7.jpg'),
(13, 5, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571550131_rednote7-6.jpg'),
(14, 5, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550131_rednote7-6.jpg'),
(15, 5, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550131_rednote7-6.jpg'),
(16, 6, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571550131_rednote7-5.jpg'),
(17, 6, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550131_rednote7-5.jpg'),
(18, 6, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550131_rednote7-5.jpg'),
(19, 7, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571550131_rednote7-8.jpg'),
(20, 7, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550131_rednote7-8.jpg'),
(21, 7, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550131_rednote7-8.jpg'),
(22, 1, 1, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550337_gal_1_rednote7-1.jpg'),
(23, 1, 1, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550337_gal_1_rednote7-1.jpg'),
(24, 5, 2, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550342_gal_1_rednote7-6.jpg'),
(25, 5, 2, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550342_gal_1_rednote7-6.jpg'),
(26, 7, 3, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550350_gal_1_rednote7-8.jpg'),
(27, 7, 3, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550350_gal_1_rednote7-8.jpg'),
(28, 4, 4, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571550362_gal_1_rednote7-7.jpg'),
(29, 4, 4, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571550362_gal_1_rednote7-7.jpg'),
(30, 8, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571555339_rednote7azul-1.jpg'),
(31, 8, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555339_rednote7azul-1.jpg'),
(32, 8, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555340_rednote7azul-1.jpg'),
(33, 9, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-2.jpg'),
(34, 9, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555340_rednote7azul-2.jpg'),
(35, 9, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555340_rednote7azul-2.jpg'),
(36, 10, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-3.jpg'),
(37, 10, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555340_rednote7azul-3.jpg'),
(38, 10, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555340_rednote7azul-3.jpg'),
(39, 11, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-5.jpg'),
(40, 11, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555340_rednote7azul-5.jpg'),
(41, 11, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555340_rednote7azul-5.jpg'),
(42, 12, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571555340_rednote7azul-4.jpg'),
(43, 12, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555340_rednote7azul-4.jpg'),
(44, 12, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555340_rednote7azul-4.jpg'),
(45, 9, 5, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555906_gal_2_rednote7azul-2.jpg'),
(46, 9, 5, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555906_gal_2_rednote7azul-2.jpg'),
(47, 10, 6, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555910_gal_2_rednote7azul-3.jpg'),
(48, 10, 6, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555910_gal_2_rednote7azul-3.jpg'),
(49, 11, 7, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555915_gal_2_rednote7azul-5.jpg'),
(50, 11, 7, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555915_gal_2_rednote7azul-5.jpg'),
(51, 12, 8, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555919_gal_2_rednote7azul-4.jpg'),
(52, 12, 8, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555919_gal_2_rednote7azul-4.jpg'),
(53, 8, 9, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555924_gal_2_rednote7azul-1.jpg'),
(54, 8, 9, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555924_gal_2_rednote7azul-1.jpg'),
(55, 6, 10, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555953_gal_1_rednote7-5.jpg'),
(56, 6, 10, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555953_gal_1_rednote7-5.jpg'),
(57, 2, 11, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555965_gal_1_rednote7-3.jpg'),
(58, 2, 11, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555965_gal_1_rednote7-3.jpg'),
(59, 3, 12, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571555968_gal_1_rednote7-2.jpg'),
(60, 3, 12, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571555968_gal_1_rednote7-2.jpg'),
(61, 13, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615922_tvsam50-2.jpg'),
(62, 13, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615922_tvsam50-2.jpg'),
(63, 13, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615922_tvsam50-2.jpg'),
(64, 14, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615922_tvsam50-4.jpg'),
(65, 14, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615922_tvsam50-4.jpg'),
(66, 14, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615922_tvsam50-4.jpg'),
(67, 15, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615922_tvsam50-5.jpg'),
(68, 15, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615923_tvsam50-5.jpg'),
(69, 15, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615923_tvsam50-5.jpg'),
(70, 16, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-1.jpg'),
(71, 16, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615923_tvsam50-1.jpg'),
(72, 16, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615923_tvsam50-1.jpg'),
(73, 17, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-3.jpg'),
(74, 17, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615923_tvsam50-3.jpg'),
(75, 17, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615923_tvsam50-3.jpg'),
(76, 18, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-6.jpg'),
(77, 18, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615923_tvsam50-6.jpg'),
(78, 18, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615923_tvsam50-6.jpg'),
(79, 19, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-7.jpg'),
(80, 19, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615923_tvsam50-7.jpg'),
(81, 19, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615924_tvsam50-7.jpg'),
(82, 20, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615924_tvsam50-8.jpg'),
(83, 20, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615924_tvsam50-8.jpg'),
(84, 20, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615924_tvsam50-8.jpg'),
(85, 21, 0, '450', '250', 0, 'default', 'contentFiles/image/2019/10/default/w450h250_1571615924_tvsam50-9.jpg'),
(86, 21, 0, '934', '584', 0, 'image', 'contentFiles/image/2019/10/main/w934h584_1571615924_tvsam50-9.jpg'),
(87, 21, 0, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/thumbnail/w480h480_1571615924_tvsam50-9.jpg'),
(88, 16, 13, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-1.jpgmain/w934h584_1571616315_gal_3_tvSam50-1.jpg'),
(89, 16, 13, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-1.jpgthumbnail/w480h480_1571616316_gal_3_tvSam50-1.jpg'),
(90, 13, 14, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-2.jpgmain/w934h584_1571616324_gal_3_tvSam50-2.jpg'),
(91, 13, 14, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-2.jpgthumbnail/w480h480_1571616324_gal_3_tvSam50-2.jpg'),
(92, 19, 15, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-7.jpgmain/w934h584_1571616329_gal_3_tvSam50-7.jpg'),
(93, 19, 15, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-7.jpgthumbnail/w480h480_1571616329_gal_3_tvSam50-7.jpg'),
(94, 17, 16, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-3.jpgmain/w934h584_1571616333_gal_3_tvSam50-3.jpg'),
(95, 17, 16, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-3.jpgthumbnail/w480h480_1571616333_gal_3_tvSam50-3.jpg'),
(96, 21, 17, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-9.jpgmain/w934h584_1571616338_gal_3_tvSam50-9.jpg'),
(97, 21, 17, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-9.jpgthumbnail/w480h480_1571616339_gal_3_tvSam50-9.jpg'),
(98, 15, 18, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-5.jpgmain/w934h584_1571616343_gal_3_tvSam50-5.jpg'),
(99, 15, 18, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-5.jpgthumbnail/w480h480_1571616344_gal_3_tvSam50-5.jpg'),
(100, 18, 19, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-6.jpgmain/w934h584_1571616353_gal_3_tvSam50-6.jpg'),
(101, 18, 19, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-6.jpgthumbnail/w480h480_1571616353_gal_3_tvSam50-6.jpg'),
(102, 20, 20, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-8.jpgmain/w934h584_1571616358_gal_3_tvSam50-8.jpg'),
(103, 20, 20, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-8.jpgthumbnail/w480h480_1571616358_gal_3_tvSam50-8.jpg'),
(104, 14, 21, '934', '584', 0, 'image', 'contentFiles/image/2019/10/tvsam50-4.jpgmain/w934h584_1571616369_gal_3_tvSam50-4.jpg'),
(105, 14, 21, '480', '480', 0, 'thumb', 'contentFiles/image/2019/10/tvsam50-4.jpgthumbnail/w480h480_1571616369_gal_3_tvSam50-4.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_relationship`
--

CREATE TABLE `jw_relationship` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `relation_type` char(15) DEFAULT NULL,
  `content_id` bigint(20) NOT NULL,
  `relation_id` bigint(20) DEFAULT '0',
  `priority` int(5) NOT NULL DEFAULT '0',
  `created_date` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_relationship`
--

INSERT INTO `jw_relationship` (`id`, `relation_type`, `content_id`, `relation_id`, `priority`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(77, 'tag', 1, 5, 2, '2019-10-20 21:50:23', 6, '2019-10-20 21:50:23', 6),
(76, 'tag', 1, 55, 1, '2019-10-20 21:50:23', 6, '2019-10-20 21:50:23', 6),
(75, 'tag', 2, 5, 2, '2019-10-20 21:50:10', 6, '2019-10-20 21:50:10', 6),
(74, 'tag', 2, 55, 1, '2019-10-20 21:50:10', 6, '2019-10-20 21:50:10', 6),
(79, 'tag', 3, 43, 2, '2019-10-20 21:50:36', 6, '2019-10-20 21:50:36', 6),
(78, 'tag', 3, 1, 1, '2019-10-20 21:50:36', 6, '2019-10-20 21:50:36', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_relationship_text`
--

CREATE TABLE `jw_relationship_text` (
  `relationship_id` bigint(20) NOT NULL,
  `language` char(5) DEFAULT NULL,
  `title` text,
  `description` text,
  `subtitle` text,
  `embed` text,
  `credit` text,
  `picture_id` int(11) NOT NULL DEFAULT '0',
  `picture` text,
  `picture_credit` text,
  `created_date` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_request`
--

CREATE TABLE `jw_request` (
  `id` bigint(21) NOT NULL,
  `user_id` bigint(21) DEFAULT NULL,
  `cliente` varchar(150) DEFAULT NULL,
  `payment_type` varchar(25) DEFAULT NULL,
  `payment_value` decimal(9,2) DEFAULT NULL,
  `payment_freight` decimal(9,2) DEFAULT NULL,
  `payment_amount` decimal(9,2) DEFAULT NULL,
  `payment_installment` char(3) DEFAULT NULL,
  `payment_installment_value` decimal(9,2) DEFAULT NULL,
  `payment_status` enum('pending','approved','unauthorized','canceled') NOT NULL DEFAULT 'pending',
  `address_name` varchar(150) DEFAULT NULL,
  `address_number` varchar(15) DEFAULT NULL,
  `address_complement` varchar(50) DEFAULT NULL,
  `address_details` varchar(150) DEFAULT NULL,
  `address_postcode` varchar(32) DEFAULT NULL,
  `address_district` varchar(150) DEFAULT NULL,
  `address_city_name` varchar(50) DEFAULT NULL,
  `address_state_name` varchar(50) DEFAULT NULL,
  `address_country_name` varchar(50) DEFAULT NULL,
  `address_latitude` decimal(9,6) DEFAULT NULL,
  `address_longitude` decimal(9,6) DEFAULT NULL,
  `address_phone` varchar(25) DEFAULT NULL,
  `address_phone2` varchar(25) DEFAULT NULL,
  `address_phone3` varchar(25) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_request`
--

INSERT INTO `jw_request` (`id`, `user_id`, `cliente`, `payment_type`, `payment_value`, `payment_freight`, `payment_amount`, `payment_installment`, `payment_installment_value`, `payment_status`, `address_name`, `address_number`, `address_complement`, `address_details`, `address_postcode`, `address_district`, `address_city_name`, `address_state_name`, `address_country_name`, `address_latitude`, `address_longitude`, `address_phone`, `address_phone2`, `address_phone3`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 7, 'Julio Cesar Rocha Felisberto', NULL, '3069.00', '15.00', '3084.00', NULL, NULL, 'pending', 'Avenida São Luiz', '225', '', 'Próximo a FIG', '07072-081', 'Vila Rosalia', 'Guarulhos', 'São Paulo', 'Brasil', '-23.448267', '-46.558963', '11 98998-5447', '', '', '2019-10-21 01:03:27', 7, '2019-10-21 02:57:47', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_request_content`
--

CREATE TABLE `jw_request_content` (
  `id` bigint(21) NOT NULL,
  `request_id` bigint(21) DEFAULT NULL,
  `content_id` bigint(21) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `image` text,
  `page_url` text,
  `price` decimal(9,2) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `amount` decimal(9,2) DEFAULT NULL,
  `freight` decimal(9,2) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_request_content`
--

INSERT INTO `jw_request_content` (`id`, `request_id`, `content_id`, `name`, `image`, `page_url`, `price`, `quantidade`, `amount`, `freight`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1, 1, 'Smartphone Xiaomi Redmi Note 7 64GB Preto', 'contentFiles/image/2019/10/default/w450h250_1571550130_rednote7-1.jpg', 'smartphone-xiaomi-redmi-note-7-64gb-preto', '1069.78', 1, '1069.78', '7.55', '2019-10-21 02:33:50', 7, NULL, NULL),
(4, 1, 3, 'Smart TV LED 50', 'contentFiles/image/2019/10/default/w450h250_1571615923_tvsam50-1.jpg', 'smart-tv-led-50-samsung-50ru7100', '1999.99', 1, '1999.99', '7.55', '2019-10-21 02:57:47', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_sas`
--

CREATE TABLE `jw_sas` (
  `user_id` bigint(20) NOT NULL,
  `key` char(128) NOT NULL DEFAULT '',
  `permissions` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_sas`
--

INSERT INTO `jw_sas` (`user_id`, `key`, `permissions`) VALUES
(6, '05fee51e1b6ad289030048a4457b643f4a6c786e31986b0b896de2aff3dd16834cf1b5bf1c7931b9a6bab37ac09de7bcd70835cdd5b8fce85103d033fdec2e4f', '9');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_tags`
--

CREATE TABLE `jw_tags` (
  `id` bigint(20) NOT NULL,
  `tag_id` bigint(20) DEFAULT NULL,
  `tag_status` enum('new','active','trashed','deleted') DEFAULT NULL,
  `language` char(5) DEFAULT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `normal_name` varchar(255) DEFAULT NULL,
  `user_visible` int(1) DEFAULT NULL,
  `image_id` bigint(20) DEFAULT NULL,
  `image` text,
  `thumbnail` text,
  `created_date` datetime NOT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `import_id` char(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_tags`
--

INSERT INTO `jw_tags` (`id`, `tag_id`, `tag_status`, `language`, `parent_id`, `name`, `normal_name`, `user_visible`, `image_id`, `image`, `thumbnail`, `created_date`, `created_by`, `updated_date`, `updated_by`, `import_id`) VALUES
(1, 1, 'active', 'pt_BR', 0, 'Eletrodoméstico', 'eletrodomestico', 1, 0, '', 'fa-charging-station', '2019-10-19 15:06:04', 6, '2019-10-19 15:06:24', 6, ''),
(2, 2, 'active', 'pt_BR', 0, 'Informática', 'informatica', 1, 0, '', 'fa-laptop', '2019-10-19 15:06:30', 6, '2019-10-19 15:08:25', 6, ''),
(3, 3, 'active', 'pt_BR', 0, 'Cama, Mesa e Banho', 'cama-mesa-e-banho', 1, 0, '', 'fa-bed', '2019-10-19 15:06:47', 6, '2019-10-19 15:07:06', 6, ''),
(4, 4, 'active', 'pt_BR', 0, 'Games', 'games', 1, 0, '', 'fa-gamepad', '2019-10-19 15:07:09', 6, '2019-10-19 15:08:48', 6, ''),
(5, 5, 'active', 'pt_BR', 0, 'Telefonia', 'telefonia', 1, 0, '', 'fa-mobile-alt', '2019-10-19 15:08:51', 6, '2019-10-19 15:09:04', 6, ''),
(6, 6, 'active', 'pt_BR', 3, 'Toalhas de banho', 'toalhas-de-banho', 1, 0, '', '', '2019-10-19 15:09:07', 6, '2019-10-19 19:21:35', 6, ''),
(7, 7, 'active', 'pt_BR', 3, 'Toalhas de mesa', 'toalhas-de-mesa', 1, 0, '', '', '2019-10-19 19:21:38', 6, '2019-10-19 19:21:47', 6, ''),
(8, 8, 'active', 'pt_BR', 3, 'Travesseiro', 'travesseiro', 1, 0, '', '', '2019-10-19 19:21:57', 6, '2019-10-19 19:22:14', 6, ''),
(9, 9, 'active', 'pt_BR', 3, 'Fronha', 'fronha', 1, 0, '', '', '2019-10-19 19:22:17', 6, '2019-10-19 19:22:28', 6, ''),
(10, 10, 'active', 'pt_BR', 3, 'Lençol de casal', 'lencol-de-casal', 1, 0, '', '', '2019-10-19 19:22:32', 6, '2019-10-19 19:22:45', 6, ''),
(11, 11, 'active', 'pt_BR', 3, 'Lençol de solteiro', 'lencol-de-solteiro', 1, 0, '', '', '2019-10-19 19:22:52', 6, '2019-10-19 19:23:06', 6, ''),
(12, 12, 'active', 'pt_BR', 3, 'Cobertor de casal', 'cobertor-de-casal', 1, 0, '', '', '2019-10-19 19:23:09', 6, '2019-10-19 19:24:06', 6, ''),
(13, 13, 'active', 'pt_BR', 3, 'Cobertor de solteiro', 'cobertor-de-solteiro', 1, 0, '', '', '2019-10-19 19:24:09', 6, '2019-10-19 19:24:23', 6, ''),
(14, 14, 'active', 'pt_BR', 3, 'Edredom de casal', 'edredom-de-casal', 1, 0, '', '', '2019-10-19 19:24:25', 6, '2019-10-19 19:24:37', 6, ''),
(15, 15, 'active', 'pt_BR', 3, 'Edredom de solteiro', 'edredom-de-solteiro', 1, 0, '', '', '2019-10-19 19:24:39', 6, '2019-10-19 19:24:49', 6, ''),
(16, 16, 'active', 'pt_BR', 3, 'Colcha de casal', 'colcha-de-casal', 1, 0, '', '', '2019-10-19 19:24:51', 6, '2019-10-19 19:25:04', 6, ''),
(17, 17, 'active', 'pt_BR', 3, 'Colcha de solteiro', 'colcha-de-solteiro', 1, 0, '', '', '2019-10-19 19:25:07', 6, '2019-10-19 19:25:19', 6, ''),
(18, 18, 'active', 'pt_BR', 3, 'Tapetes de banheiro', 'tapetes-de-banheiro', 1, 0, '', '', '2019-10-19 19:25:22', 6, '2019-10-19 19:25:41', 6, ''),
(19, 19, 'active', 'pt_BR', 3, 'Tapete', 'tapete', 1, 0, '', '', '2019-10-19 19:25:45', 6, '2019-10-19 19:25:52', 6, ''),
(20, 20, 'active', 'pt_BR', 3, 'Passadeira', 'passadeira', 1, 0, '', '', '2019-10-19 19:25:55', 6, '2019-10-19 19:26:04', 6, ''),
(21, 21, 'active', 'pt_BR', 4, 'Jogos de Xbox 360', 'jogos-de-xbox-360', 1, 0, '', '', '2019-10-19 19:26:08', 6, '2019-10-19 19:26:24', 6, ''),
(22, 22, 'active', 'pt_BR', 4, 'Jogos de Xbox one', 'jogos-de-xbox-one', 1, 0, '', '', '2019-10-19 19:26:27', 6, '2019-10-19 19:26:36', 6, ''),
(23, 23, 'active', 'pt_BR', 4, 'Jogos de Playtation 3', 'jogos-de-playtation-3', 1, 0, '', '', '2019-10-19 19:26:44', 6, '2019-10-19 19:26:54', 6, ''),
(24, 24, 'active', 'pt_BR', 4, 'Jogos de Playstation 4', 'jogos-de-playstation-4', 1, 0, '', '', '2019-10-19 19:26:58', 6, '2019-10-19 19:27:11', 6, ''),
(25, 25, 'active', 'pt_BR', 4, 'Consoles', 'consoles', 1, 0, '', '', '2019-10-19 19:27:15', 6, '2019-10-19 19:27:39', 6, ''),
(26, 26, 'active', 'pt_BR', 5, 'Telefone com fio', 'telefone-com-fio', 1, 0, '', '', '2019-10-19 19:27:45', 6, '2019-10-19 19:28:42', 6, ''),
(27, 27, 'active', 'pt_BR', 5, 'Telefone sem fio', 'telefone-sem-fio', 1, 0, '', '', '2019-10-19 19:28:45', 6, '2019-10-19 19:28:56', 6, ''),
(28, 28, 'active', 'pt_BR', 5, 'Acessórios para celular', 'acessorios-para-celular', 1, 0, '', '', '2019-10-19 19:28:59', 6, '2019-10-19 19:29:37', 6, ''),
(29, 29, 'active', 'pt_BR', 2, 'Notebook', 'notebook', 1, 0, '', '', '2019-10-19 19:29:40', 6, '2019-10-19 19:34:46', 6, ''),
(30, 30, 'active', 'pt_BR', 2, 'Computador', 'computador', 1, 0, '', '', '2019-10-19 19:34:49', 6, '2019-10-19 19:35:33', 6, ''),
(31, 31, 'active', 'pt_BR', 2, 'Monitor', 'monitor', 1, 0, '', '', '2019-10-19 19:35:38', 6, '2019-10-19 19:35:48', 6, ''),
(32, 32, 'active', 'pt_BR', 2, 'HD 2,5', 'hd-25', 1, 0, '', '', '2019-10-19 19:35:52', 6, '2019-10-19 19:36:10', 6, ''),
(33, 33, 'active', 'pt_BR', 2, 'HD 3,5', 'hd-35', 1, 0, '', '', '2019-10-19 19:36:14', 6, '2019-10-19 19:37:03', 6, ''),
(34, 34, 'active', 'pt_BR', 2, 'HD externo', 'hd-externo', 1, 0, '', '', '2019-10-19 19:37:13', 6, '2019-10-19 19:37:25', 6, ''),
(35, 35, 'active', 'pt_BR', 2, 'Case HD 2,5', 'case-hd-25', 1, 0, '', '', '2019-10-19 19:37:29', 6, '2019-10-19 19:37:41', 6, ''),
(36, 36, 'active', 'pt_BR', 2, 'Case HD 3,5', 'case-hd-35', 1, 0, '', '', '2019-10-19 19:37:47', 6, '2019-10-19 19:38:00', 6, ''),
(37, 37, 'active', 'pt_BR', 2, 'Teclado', 'teclado', 1, 0, '', '', '2019-10-19 19:38:04', 6, '2019-10-19 19:38:24', 6, ''),
(38, 38, 'active', 'pt_BR', 2, 'Mouse', 'mouse', 1, 0, '', '', '2019-10-19 19:38:27', 6, '2019-10-19 19:38:36', 6, ''),
(39, 39, 'active', 'pt_BR', 2, 'Caixa de som', 'caixa-de-som', 1, 0, '', '', '2019-10-19 19:38:39', 6, '2019-10-19 19:38:49', 6, ''),
(40, 40, 'active', 'pt_BR', 2, 'Estabilizador', 'estabilizador', 1, 0, '', '', '2019-10-19 19:38:52', 6, '2019-10-19 19:39:17', 6, ''),
(41, 41, 'active', 'pt_BR', 2, 'No breack', 'no-breack', 1, 0, '', '', '2019-10-19 19:39:20', 6, '2019-10-19 19:39:32', 6, ''),
(42, 42, 'active', 'pt_BR', 2, 'Pen drive', 'pen-drive', 1, 0, '', '', '2019-10-19 19:39:35', 6, '2019-10-19 19:39:45', 6, ''),
(43, 43, 'active', 'pt_BR', 1, 'Smarty TV', 'smarty-tv', 1, 0, '', '', '2019-10-19 19:39:49', 6, '2019-10-19 19:41:02', 6, ''),
(44, 44, 'active', 'pt_BR', 1, 'Lava louça', 'lava-louca', 1, 0, '', '', '2019-10-19 19:41:05', 6, '2019-10-19 19:41:13', 6, ''),
(45, 45, 'active', 'pt_BR', 1, 'Lavadora de roupa', 'lavadora-de-roupa', 1, 0, '', '', '2019-10-19 19:41:17', 6, '2019-10-19 19:41:27', 6, ''),
(46, 46, 'active', 'pt_BR', 1, 'Secadora de roupa', 'secadora-de-roupa', 1, 0, '', '', '2019-10-19 19:41:31', 6, '2019-10-19 19:41:41', 6, ''),
(47, 47, 'active', 'pt_BR', 1, 'Ferro de passar roupa', 'ferro-de-passar-roupa', 1, 0, '', '', '2019-10-19 19:41:45', 6, '2019-10-19 19:42:05', 6, ''),
(48, 48, 'active', 'pt_BR', 1, 'Ventilador de teto', 'ventilador-de-teto', 1, 0, '', '', '2019-10-19 19:42:08', 6, '2019-10-19 19:42:18', 6, ''),
(49, 49, 'active', 'pt_BR', 1, 'Ventilador de pé', 'ventilador-de-pe', 1, 0, '', '', '2019-10-19 19:42:22', 6, '2019-10-19 19:42:31', 6, ''),
(50, 50, 'active', 'pt_BR', 1, 'Ventilador de mesa', 'ventilador-de-mesa', 1, 0, '', '', '2019-10-19 19:42:35', 6, '2019-10-19 19:42:45', 6, ''),
(51, 51, 'active', 'pt_BR', 1, 'Ventilador de parede', 'ventilador-de-parede', 1, 0, '', '', '2019-10-19 19:42:48', 6, '2019-10-19 19:42:59', 6, ''),
(52, 52, 'active', 'pt_BR', 1, 'Ar condicionado portátil', 'ar-condicionado-portatil', 1, 0, '', '', '2019-10-19 19:43:02', 6, '2019-10-19 19:43:24', 6, ''),
(53, 53, 'active', 'pt_BR', 1, 'Ar condicionado split', 'ar-condicionado-split', 1, 0, '', '', '2019-10-19 19:43:28', 6, '2019-10-19 19:43:48', 6, ''),
(54, 54, 'active', 'pt_BR', 1, 'Ar condicionado de parede', 'ar-condicionado-de-parede', 1, 0, '', '', '2019-10-19 19:43:53', 6, '2019-10-19 19:44:06', 6, ''),
(55, 55, 'active', 'pt_BR', 5, 'Smartyphone', 'smartyphone', 1, NULL, NULL, NULL, '2019-10-19 19:44:10', 6, '2019-10-19 19:44:10', 6, ''),
(56, 56, 'active', 'pt_BR', 2, 'Tablet', 'tablet', 1, 0, '', '', '2019-10-20 02:59:13', 6, '2019-10-20 03:00:05', 6, ''),
(57, 57, 'active', 'pt_BR', 1, 'Furadeira', 'furadeira', 1, 0, '', '', '2019-10-20 03:00:08', 6, '2019-10-20 03:00:26', 6, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user`
--

CREATE TABLE `jw_user` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `normal_name` varchar(250) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image_id` bigint(20) NOT NULL DEFAULT '0',
  `image` text,
  `thumbnail` text,
  `regid` varchar(32) DEFAULT NULL,
  `fb_id` varchar(32) DEFAULT NULL,
  `go_id` varchar(32) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `status` enum('active','blocked','deleted','disabled','pending','setup') NOT NULL DEFAULT 'pending',
  `language` varchar(5) DEFAULT 'en_US',
  `email_validate_date` datetime DEFAULT NULL,
  `email_validate_attempt` int(1) NOT NULL DEFAULT '0',
  `first_login` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_user`
--

INSERT INTO `jw_user` (`id`, `firstname`, `lastname`, `normal_name`, `email`, `image_id`, `image`, `thumbnail`, `regid`, `fb_id`, `go_id`, `password`, `status`, `language`, `email_validate_date`, `email_validate_attempt`, `first_login`, `last_login`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(6, 'Juliano', 'Eloi Felisberto', 'juliano-eloi-felisberto', 'julianoeloi1@gmail.com', 124, NULL, NULL, 'b9555a8a4bf5e0803f2a90db91fd2c0a', NULL, NULL, '$2a$11$cnAUS5AbVov5pXAN5Qi5eeor2KMhPXUnMhqsV.kpFrPZZ6Zx6G0Wy', 'active', 'pt_BR', '2015-06-02 01:30:10', 1, '2019-05-03 11:04:38', '2019-10-21 00:00:31', '2015-06-02 01:30:10', 6, '2019-10-10 15:48:46', 6),
(7, 'Julio Cesar', 'Rocha Felisberto', 'julio-cesar-rocha-felisberto', 'julianoeloi@hotmail.com', 0, '', '', 'c87e37b41580c3e74abdb8e50ba8fbd7', NULL, NULL, '$2a$11$psyRvaeK0/hNEjoCqm2LEOm916ZhxBkGExurY85N1ARYK7CToMB5a', 'active', 'pt_BR', '2015-06-02 01:30:10', 1, '2019-05-03 11:04:38', '2019-10-21 00:01:30', '2015-06-02 01:30:10', 6, '2019-10-20 18:12:22', 6),
(8, 'Renata Rocha', 'Gomes Felisberto', 'renata-rocha-gomes-felisberto', 'julianoeloi@yahoo.com.br', 0, '', '', '007e308c52047b4e54eb7992fca378dc', NULL, NULL, '$2a$11$bQWsqyO.8o9q/EpVPpISHOK2hVwgS9zGb9OIBKV8/AgJFyP4zq27m', 'active', 'pt_BR', '2015-06-02 01:30:10', 1, '2019-05-03 11:04:38', '2019-10-21 00:01:19', '2015-06-02 01:30:10', 6, '2019-10-20 22:50:24', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_content`
--

CREATE TABLE `jw_user_content` (
  `user_id` int(11) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT '0000-00-00',
  `description` text,
  `address_name` varchar(150) DEFAULT NULL,
  `address_number` varchar(150) DEFAULT NULL,
  `address_complement` varchar(50) DEFAULT NULL,
  `address_details` varchar(150) DEFAULT NULL,
  `address_postcode` varchar(32) DEFAULT NULL,
  `address_district` varchar(150) DEFAULT NULL,
  `address_city_name` varchar(50) DEFAULT NULL,
  `address_state_name` varchar(50) DEFAULT NULL,
  `address_country_name` varchar(50) DEFAULT NULL,
  `address_latitude` decimal(9,6) DEFAULT NULL,
  `address_longitude` decimal(9,6) DEFAULT NULL,
  `address_phone` varchar(25) DEFAULT NULL,
  `address_phone2` varchar(25) DEFAULT NULL,
  `address_phone3` varchar(25) DEFAULT NULL,
  `receive_news` char(1) NOT NULL DEFAULT '0',
  `receive_notifications` int(1) NOT NULL DEFAULT '0',
  `updated_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_user_content`
--

INSERT INTO `jw_user_content` (`user_id`, `gender`, `birthdate`, `description`, `address_name`, `address_number`, `address_complement`, `address_details`, `address_postcode`, `address_district`, `address_city_name`, `address_state_name`, `address_country_name`, `address_latitude`, `address_longitude`, `address_phone`, `address_phone2`, `address_phone3`, `receive_news`, `receive_notifications`, `updated_date`) VALUES
(6, 'M', '1978-04-26', 'Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, bibendum egestas augue arcu ut est. Mé faiz elementum girarzis, nisi eros vermeio. Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vidis. A ordem dos tratores não altera o pão duris.', 'Avenida Andre Luiz', '301', 'AP 53', 'Próximo a Casa Andre Luiz', '07082-050', 'Picanço', 'Guarulhos', 'São Paulo', 'Brasil', '-23.441576', '-46.546645', '11 98998-5447', NULL, NULL, '1', 1, '2019-10-10 15:48:46'),
(7, 'M', '2008-02-08', 'Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, bibendum egestas augue arcu ut est. Mé faiz elementum girarzis, nisi eros vermeio. Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vidis. A ordem dos tratores não altera o pão duris.', 'Avenida São Luiz', '225', NULL, 'Próximo a FIG', '07072-081', 'Vila Rosalia', 'Guarulhos', 'São Paulo', 'Brasil', '-23.448267', '-46.558963', '11 98998-5447', NULL, NULL, '1', 1, '2019-10-10 15:48:46'),
(8, 'F', '1974-06-17', 'Mussum Ipsum, cacilds vidis litro abertis. Delegadis gente finis, bibendum egestas augue arcu ut est. Mé faiz elementum girarzis, nisi eros vermeio. Tá deprimidis, eu conheço uma cachacis que pode alegrar sua vidis. A ordem dos tratores não altera o pão duris.', 'Rua Euclides Pacheco', '208', 'AP 89, BL C', 'Próximo a Cantina La Toscanelli', '03321-000', 'Tatuapé', 'São Paulo', 'São Paulo', 'Brasil', '-23.549033', '-46.572719', '11 98998-5447', NULL, NULL, '1', 1, '2019-08-10 15:48:46');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_email`
--

CREATE TABLE `jw_user_email` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('P','S') DEFAULT NULL COMMENT 'P = Primário, S = Adicional',
  `confirmed` enum('Y','N') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_user_email`
--

INSERT INTO `jw_user_email` (`id`, `user_id`, `email`, `added_date`, `type`, `confirmed`) VALUES
(8, 8, 'julianoeloi@yahoo.com.br', '2019-08-10 19:44:54', 'P', 'Y'),
(7, 7, 'julianoeloi@hotmail.com', '2019-10-10 19:44:54', 'P', 'Y'),
(6, 6, 'julianoeloi1@gmail.com', '2019-05-03 16:44:54', 'P', 'Y');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_email_level`
--

CREATE TABLE `jw_user_email_level` (
  `email_key` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `block_level` int(6) NOT NULL DEFAULT '0',
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_user_email_level`
--

INSERT INTO `jw_user_email_level` (`email_key`, `email_address`, `block_level`, `updated_date`) VALUES
('6a12c8eb171def9a3afd335fbceee3b7', 'julianoeloi1@gmail.com', 100, '2019-04-26 20:30:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_keys`
--

CREATE TABLE `jw_user_keys` (
  `id` char(8) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `key` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_log`
--

CREATE TABLE `jw_user_log` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT NULL,
  `kind` varchar(15) DEFAULT NULL,
  `action_log` text,
  `url` text,
  `ipaddress` varchar(15) DEFAULT NULL,
  `sessid` varchar(32) DEFAULT NULL,
  `adm_action` char(2) DEFAULT NULL,
  `content_kind` char(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_preferences`
--

CREATE TABLE `jw_user_preferences` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `default_currency` int(11) DEFAULT NULL,
  `panel_itens_per_page` varchar(4) DEFAULT '',
  `measurement_unit` enum('metric','imperial') DEFAULT 'metric',
  `updDay` char(1) NOT NULL DEFAULT '0',
  `feedWeekly` char(1) NOT NULL DEFAULT '0',
  `feedMonthly` char(1) NOT NULL DEFAULT '0',
  `interests` text,
  `intro_modals` char(1) DEFAULT 'N',
  `intro_tutor` char(1) DEFAULT 'N',
  `interests_992309` char(1) DEFAULT '0',
  `interests_992310` char(1) DEFAULT '0',
  `interests_992311` char(1) DEFAULT '0',
  `interests_992312` char(1) DEFAULT '0',
  `interests_992313` char(1) DEFAULT '0',
  `interests_992314` char(1) DEFAULT '0',
  `interests_992315` char(1) DEFAULT '0',
  `interests_992316` char(1) DEFAULT '0',
  `interests_992387` char(1) DEFAULT '0',
  `interests_992388` char(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_user_preferences`
--

INSERT INTO `jw_user_preferences` (`user_id`, `default_currency`, `panel_itens_per_page`, `measurement_unit`, `updDay`, `feedWeekly`, `feedMonthly`, `interests`, `intro_modals`, `intro_tutor`, `interests_992309`, `interests_992310`, `interests_992311`, `interests_992312`, `interests_992313`, `interests_992314`, `interests_992315`, `interests_992316`, `interests_992387`, `interests_992388`) VALUES
(6, NULL, '10', 'metric', '0', '0', '0', NULL, 'N', 'N', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_pwdrecovery`
--

CREATE TABLE `jw_user_pwdrecovery` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT NULL,
  `serial` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_saved`
--

CREATE TABLE `jw_user_saved` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `content_pid` int(51) NOT NULL DEFAULT '0',
  `content_kind` char(3) NOT NULL DEFAULT '',
  `list_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jw_user_serial`
--

CREATE TABLE `jw_user_serial` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `browser_id` char(32) DEFAULT NULL,
  `serial` char(8) NOT NULL,
  `date_time` datetime DEFAULT NULL,
  `browser_string` varchar(100) DEFAULT NULL,
  `last_ip` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jw_user_serial`
--

INSERT INTO `jw_user_serial` (`id`, `user_id`, `browser_id`, `serial`, `date_time`, `browser_string`, `last_ip`) VALUES
(1, 6, NULL, '_pbTUzA^', '2019-10-21 00:00:31', NULL, ''),
(2, 7, NULL, 'QBRZjYjg', '2019-10-21 00:01:30', NULL, ''),
(3, 8, NULL, 'dgZBMFm1', '2019-10-21 00:01:19', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jw_content`
--
ALTER TABLE `jw_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `import_id` (`import_id`);

--
-- Indexes for table `jw_content_text`
--
ALTER TABLE `jw_content_text`
  ADD KEY `content_pid` (`content_id`),
  ADD KEY `content_pid_2` (`content_id`,`language`);

--
-- Indexes for table `jw_content_url`
--
ALTER TABLE `jw_content_url`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `normal_name_key` (`url_key`),
  ADD KEY `tipo_link` (`content_id`),
  ADD KEY `normal_name` (`published`),
  ADD KEY `language` (`language`,`content_id`);

--
-- Indexes for table `jw_media_files`
--
ALTER TABLE `jw_media_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_media_galleries`
--
ALTER TABLE `jw_media_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_media_gallery_imagedata`
--
ALTER TABLE `jw_media_gallery_imagedata`
  ADD PRIMARY KEY (`data_id`);

--
-- Indexes for table `jw_media_gallery_images`
--
ALTER TABLE `jw_media_gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_media_resizes`
--
ALTER TABLE `jw_media_resizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_relationship`
--
ALTER TABLE `jw_relationship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`relation_type`,`content_id`);

--
-- Indexes for table `jw_relationship_text`
--
ALTER TABLE `jw_relationship_text`
  ADD KEY `type` (`relationship_id`),
  ADD KEY `type_2` (`relationship_id`);

--
-- Indexes for table `jw_request`
--
ALTER TABLE `jw_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `jw_request_content`
--
ALTER TABLE `jw_request_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `content_id` (`content_id`);

--
-- Indexes for table `jw_sas`
--
ALTER TABLE `jw_sas`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `key` (`key`);

--
-- Indexes for table `jw_tags`
--
ALTER TABLE `jw_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `tag_id` (`tag_id`,`language`),
  ADD KEY `import_id` (`import_id`);

--
-- Indexes for table `jw_user`
--
ALTER TABLE `jw_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `fb_id` (`fb_id`),
  ADD KEY `last_login` (`last_login`),
  ADD KEY `reg_date` (`created_date`),
  ADD KEY `regid` (`regid`);
ALTER TABLE `jw_user` ADD FULLTEXT KEY `firstname` (`firstname`,`lastname`);

--
-- Indexes for table `jw_user_content`
--
ALTER TABLE `jw_user_content`
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `birthdate` (`birthdate`),
  ADD KEY `gender` (`gender`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `jw_user_email`
--
ALTER TABLE `jw_user_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `email` (`email`),
  ADD KEY `data_add` (`added_date`,`type`);

--
-- Indexes for table `jw_user_email_level`
--
ALTER TABLE `jw_user_email_level`
  ADD UNIQUE KEY `email_key` (`email_key`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD KEY `email_key_2` (`email_key`),
  ADD KEY `email_address_2` (`email_address`);

--
-- Indexes for table `jw_user_keys`
--
ALTER TABLE `jw_user_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_user_log`
--
ALTER TABLE `jw_user_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `date_time` (`date_time`),
  ADD KEY `kind` (`kind`),
  ADD KEY `sessid` (`sessid`);

--
-- Indexes for table `jw_user_preferences`
--
ALTER TABLE `jw_user_preferences`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `jw_user_pwdrecovery`
--
ALTER TABLE `jw_user_pwdrecovery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jw_user_saved`
--
ALTER TABLE `jw_user_saved`
  ADD PRIMARY KEY (`user_id`,`content_kind`,`content_pid`),
  ADD KEY `list_id` (`list_id`);

--
-- Indexes for table `jw_user_serial`
--
ALTER TABLE `jw_user_serial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datetime` (`date_time`),
  ADD KEY `user_id` (`user_id`,`browser_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jw_content`
--
ALTER TABLE `jw_content`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jw_content_url`
--
ALTER TABLE `jw_content_url`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jw_media_files`
--
ALTER TABLE `jw_media_files`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jw_media_galleries`
--
ALTER TABLE `jw_media_galleries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jw_media_gallery_imagedata`
--
ALTER TABLE `jw_media_gallery_imagedata`
  MODIFY `data_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_media_gallery_images`
--
ALTER TABLE `jw_media_gallery_images`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jw_media_resizes`
--
ALTER TABLE `jw_media_resizes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `jw_relationship`
--
ALTER TABLE `jw_relationship`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `jw_request`
--
ALTER TABLE `jw_request`
  MODIFY `id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jw_request_content`
--
ALTER TABLE `jw_request_content`
  MODIFY `id` bigint(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jw_sas`
--
ALTER TABLE `jw_sas`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jw_tags`
--
ALTER TABLE `jw_tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `jw_user`
--
ALTER TABLE `jw_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jw_user_email`
--
ALTER TABLE `jw_user_email`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jw_user_log`
--
ALTER TABLE `jw_user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_user_preferences`
--
ALTER TABLE `jw_user_preferences`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jw_user_pwdrecovery`
--
ALTER TABLE `jw_user_pwdrecovery`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jw_user_serial`
--
ALTER TABLE `jw_user_serial`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
