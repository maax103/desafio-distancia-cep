# Estrutura do Projeto

## Sobre este repositório

O desafio proposto é criar uma aplicação capaz de calcular a distância entre dois CEPs e gravar os registros em um banco de dados, além disso deveria possuir uma interface gráfica e a possibilidade de realizar a operação de cadastros em lote através de um arquivo CSV.

O objetivo deste projeto não é construir uma aplicação útil, mas utilizar diversas ferramentas para demonstrar domínio das tecnologias utilizadas. Neste projeto também foi pensado no ambiente de desenvolvimento, portanto a aplicação deve ser de fácil instalação e vir com um depurador disponível.

## Visão Geral

Este projeto utiliza Docker Compose para orquestrar uma aplicação que consiste em uma API em PHP, um frontend em Vue.js, um servidor Nginx para servir a aplicação e um banco de dados MySQL com um sistema de migrações simples, construído em um script shell. 

Cada componente está containerizado e configurado para comunicação entre si através de uma rede Docker. Os limites da API são configurados através de variáveis de ambiente.

## Passos para iniciar a aplicação

- Clonar o repositório
- Duplicar os arquivos `.env.example` em `api-desafio-cep`e `vue-app`
- Alterar o nome dessas envs para `.env` 
- Executar na raiz do projeto o comando `docker compose up -d`
- Executar na raiz do projeto o comando `docker compose start migrate` (se necessário)
- Acessar a aplicação em `http://localhost:9001`

## Descrição dos serviços

### 1. API (`api-desafio-cep`)

A API foi construída com o uso de alguns componentes Symfony, com o objetivo de não utilizar um framework, possibilitando criar os próprios componentes a fim de demonstrar o domínio do PHP.

Isso tudo não deixando de construir uma aplicação sólida e escalável, com uso de diversos artifícios de aplicações web e orientação a objetos, tais como injeção de dependência, roteamento, controladores, etc.

### 2. Frontend Vue.js (`vue-desafio-cep`)

Devido ao curto tempo para desenvolver toda a aplicação, o frontend foi simplificado com o uso do framework `Nuxt 3`, sendo composta por uma página estilizada com `Bootstrap 5`. 

Está interface gráfica permite visualizar os dados que estão salvos no banco, inserir através de formulário ou com a importação de um arquivo CSV.

### 3. Servidor Nginx (`nginx`)

Este serviço foi utilizado para demonstrar conhecimento de uma situação real onde poderia ser necessário criar mais instâncias da API ou Frontend e onde este o Nginx poderia atuar como um balanceador de carga.

### 4. Banco de Dados MySQL (`db`)

Possui um sistema de migrações simples feito com shell script, utilizado para demonstrar conhecimentos em script shell e para atender as requisitos da aplicação, fornecendo a carga inicial do banco de dados.

## Resumo

Este projeto utiliza múltiplos containers para separar as responsabilidades de cada componente da aplicação:

1. **API em PHP** para gerenciamento de regras de negócio e persistência de dados.
2. **Aplicação Frontend em Vue.js** para interação com o usuário.
3. **Servidor Nginx** para servir a API.
4. **Banco de Dados MySQL** para armazenamento persistente dos dados.
5. **Serviço de Migração** para automatizar a aplicação de migrações no banco de dados.

## Testes automáticos

A aplicação possui testes unitários e utiliza o phpunit para executá-los, a implemetação foi feita apenas para demonstrar o uso de testes unitários na aplicação. 

Para executar basta digitar o seguinte comando na rais no projeto:
`api-desafio-cep/vendor/bin/phpunit -c api-desafio-cep/src/units.xml` 

---
## Problemas conhecidos

- Pode ocorrer do script de migração ser executado antes do servidor permitir conexões, de forma que as migrações não serão executadas.
**Solução**: Executar o comando `docker compose start migrate` na raiz do projeto.
- Os tempos exibidos ao cliente estão em UTC-0 ao invés de UTC-3.
