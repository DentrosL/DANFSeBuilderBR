# DANFSeBuilderBR

Projeto simples em PHP criado para testes e validações antes de implementar soluções maiores em um RP ou em um ambiente real.

## O que é este projeto?

Este repositório serve como laboratório para experimentar:

- geração de estrutura baseada em XML de NFS-e;
- renderização de conteúdo em HTML/PDF;
- execução local com PHP;
- uso de containers Docker para facilitar testes rápidos;
- validação de ideias antes de levar a implementação para um projeto maior.

## Estrutura do projeto

- **docker/*** — configurações do ambiente PHP;
- **docker-compose.yml** — serviços do projeto;
- **example/** — exemplos de classes e renderers;
- **src/** — código-fonte da aplicação;
- **public/** — ponto de entrada público para a aplicação;
- **database/** — arquivos relacionados ao banco;

## Requisitos

Antes de começar, certifique-se de ter instalado:

- Docker
- Docker Compose

## Como rodar

1. Copie o arquivo de ambiente:

   ```bash
   cp .env.example .env
   ```

2. Suba os containers:

   ```bash
   docker compose up --build -d
   ```

3. Instale as dependências do PHP, se necessário:

   ```bash
   docker compose exec php composer install
   ```

4. Acesse a aplicação:

   ```text
   http://localhost:8000
   ```

## Variáveis de ambiente

O arquivo .env pode conter valores como:

```env
APP_ENV=local
APP_DEBUG=true

APP_PORT=8000
```

## Observações

Este projeto é voltado para testes e validações. A ideia é confirmar o funcionamento de partes da solução antes de migrar tudo para o RP.