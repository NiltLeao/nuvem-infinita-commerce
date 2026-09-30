# Architecture

## Core

O núcleo do plugin registra o Custom Post Type `nic_product` e as taxonomias de produto e marca.

## Database

A ativação do plugin executa `NIC_Database::install()` e utiliza `dbDelta()` para criar/atualizar:

- `wp_nic_stores`
- `wp_nic_offers`

O prefixo `wp_` é apenas um exemplo; o plugin utiliza o prefixo configurado no WordPress.

## Offers

Cada oferta referencia um produto e uma loja. Os campos normalizados incluem preço, preço anterior, moeda, disponibilidade, URLs, imagem e data da última sincronização.

## Connectors

Conectores de marketplaces deverão ficar isolados do núcleo. A V1.0.1 não habilita integrações externas.
