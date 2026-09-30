# Installation

1. Envie a pasta `nuvem-infinita-commerce` para `wp-content/plugins/`.
2. Ative o plugin no painel do WordPress.
3. Durante a ativação, o plugin cria/atualiza as tabelas próprias usando `dbDelta()`.
4. O Custom Post Type `nic_product` e suas taxonomias são registrados.
5. Abra **Nuvem Commerce** no painel administrativo.

Para usar os shortcodes:

```text
[nic_product id="123"]
[nic_offers product_id="123"]
```

Não insira chaves de API, tokens ou outras credenciais diretamente no código ou no repositório.
