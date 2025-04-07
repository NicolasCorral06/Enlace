# Enlace
Projeto desenvolvido em grupo para o TCA 2024. Site de venda de serviços de intérpretes de Libras.

## Instalação
- Clone o repositório.
- Adicione a um servidor web de sua preferência.
- Configure o banco de dados e importe as tabelas.

### IMPORTANTE
Este sistema usa o Composer para enviar e-mails aos usuários e o hCaptcha para verificações. Portanto, é necessário fazer algumas atualizações no código para que ele funcione completamente:

- Atualizar todas as funções em `Adm/Controller/*` que utilizam o Google para envio de e-mails (pesquisar por "isSMTP").
- Atualizar as chaves de API em `Adm/Model/api.php`.

## Pastas principais
- /ADM: Parte administrativa junto com as pastas de controle MVC.
- /assets: Imagens do site.
- /Cliente: Área do cliente e suas dependências.
- /Interprete: Área do intérprete e suas dependências.
- /paginas: Outras páginas do site.
