=== Nuvem Infinita Commerce ===
Contributors: nuvem-infinita-tech
Requires at least: 6.4
Requires PHP: 7.4
Stable tag: 1.0.1
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html

Plugin WordPress open source para catálogo de produtos e gerenciamento de ofertas multi-loja.

== Description ==

Arquitetura modular para produtos, lojas e ofertas.
A V1.0.1 inclui Custom Post Type de produtos, tabelas próprias para lojas e ofertas, ativação automática da estrutura de banco de dados e shortcodes públicos.

As integrações externas com Amazon, Mercado Livre e Shopee permanecem desativadas até que APIs, permissões e requisitos de afiliados sejam validados.

== Installation ==

1. Envie a pasta do plugin para `wp-content/plugins/`.
2. Ative em **Plugins > Plugins instalados**.
3. A ativação cria/atualiza as tabelas necessárias do plugin.
4. Acesse **Nuvem Commerce** no painel do WordPress.

== Shortcodes ==

`[nic_product id="123"]` exibe um produto publicado pelo ID.

`[nic_offers product_id="123"]` exibe as ofertas cadastradas para o produto.

== Security ==

Não publique chaves de API, tokens, senhas, cookies ou arquivos `.env` no repositório.

== License ==

GPL-2.0-or-later. Consulte o arquivo `LICENSE`.
