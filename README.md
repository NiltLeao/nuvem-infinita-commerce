# Nuvem Infinita Commerce

Plugin WordPress open source para catálogo de produtos, lojas e ofertas multi-loja da Nuvem Infinita Tech.

## Versão 1.0.1

A V1.0.1 estabelece uma base funcional e modular para o projeto:

- Custom Post Type `nic_product` para produtos.
- Taxonomias `nic_product_category` e `nic_brand`.
- Tabela `wp_nic_stores` para lojas.
- Tabela `wp_nic_offers` para ofertas.
- Criação/atualização das tabelas durante a ativação do plugin.
- Shortcodes públicos para produtos e ofertas.
- Estrutura preparada para futuros conectores independentes.
- Integrações de Amazon, Mercado Livre e Shopee desativadas até validação oficial.
- Nenhum scraping é utilizado.

## Requisitos

- WordPress 6.4 ou superior.
- PHP 7.4 ou superior.

## Instalação

1. Baixe ou clone este repositório.
2. Coloque a pasta `nuvem-infinita-commerce` em `wp-content/plugins/`.
3. Ative o plugin em **Plugins > Plugins instalados**.
4. A ativação cria/atualiza as tabelas necessárias e registra o tipo de conteúdo do plugin.
5. Acesse **Nuvem Commerce** no painel administrativo.

## Shortcodes

### Produto

```text
[nic_product id="123"]
```

Exibe um produto publicado pelo ID informado.

### Ofertas

```text
[nic_offers product_id="123"]
```

Exibe as ofertas cadastradas para o produto, ordenadas pelo preço quando disponível.

## Arquitetura

Produtos ficam no WordPress como Custom Post Type. Lojas e ofertas ficam em tabelas próprias para permitir uma relação de um produto com várias ofertas de diferentes lojas.

Os conectores de marketplaces serão módulos independentes. O núcleo não deve depender de uma loja específica.

## Integrações e conformidade

Nenhum conector de Amazon, Mercado Livre ou Shopee é ativado na V1.0.1. Futuros conectores devem usar APIs, feeds ou métodos oficialmente autorizados e respeitar os termos dos respectivos programas e serviços.

Não use scraping como substituto de uma API ou feed autorizado.

## Segurança

Nunca publique no GitHub:

- chaves de API;
- tokens;
- senhas;
- cookies de sessão;
- arquivos `.env`;
- credenciais de banco de dados.

## Compatibilidade com o tema

O plugin é independente do tema e foi estruturado para funcionar com o **Nuvem Infinita Tech V2.2**, usando seus próprios estilos e estruturas internas.

## Licença

Este projeto é distribuído sob a **GNU General Public License, versão 2 ou qualquer versão posterior (GPL-2.0-or-later)**.

Consulte o arquivo `LICENSE` para o texto completo da licença.

Amazon, Mercado Livre e Shopee são marcas e serviços de terceiros e não fazem parte do código aberto deste projeto.
