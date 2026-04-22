# 👋💻😅 Bem-vindo(a) ao code test da Energié

Estamos entusiasmados em recebê-lo(a) nesta próxima etapa - você mereceu. Agora é hora de começar a escrever um pouco de código.

## 🐕 Rusky Vet

A Rusky Vet LTDA é a empresa número 1 em saúde canina no mundo, oferecendo soluções em saúde e bem-estar para todas as raças de cachorro.

Atualmente, a especialidade da empresa é garantir a saúde desses animais através de consultas veterinárias, através de um processo manual utilizando telefone e consulta presenciais.
Nossa meta é desenvolvermos uma solução tecnológica que permita que parte desse processo seja feito online.

### 🤹 Suas tarefas

* O cadastro de cachorros está incompleto. Implementar a funcionalidade de adicionar uma foto ao cadastro.
* A tela de agendar consultas existe, mas ao clicar em "Agendar" nada acontece. Implementar a funcionalidade de agendar consultas, e mostrar as consultas do usuário cliente.
* Mostrar todas as consultas agendadas para o usuário veterinário. Ao abrir uma consulta, o veterinário deve ser capaz de adicionar observações e salvar, marcando a consulta como finalizada automaticamente.
* Como o projeto ainda está incompleto, podem haver bugs e/ou problemas de segurança. Caso encontre algum, conserte estes problemas

### 👉 Recomendações técnicas

Para manter as coisas simples, aqui vão algumas recomendações técnicas:

* Não é necessário adicionar nenhum tipo de dependência extra (composer ou npm).
* Ao cadastrar um cachorro, todos os campos são obrigatórios.
* Idealmente, a tela de agendamento de consultas deve mostrar os horários disponíveis via AJAX ao selecionar uma data. Para manter o funcionamento simples, a empresa realiza somente uma consulta por hora em período comercial, exceto finais de semana. Uma vez agendada a consulta, o cliente não pode excluir nem alterar a mesma.
* Todos os veterinários possuem acesso à todas as consultas. 
* Sempre que algum veterinário realizar uma consulta deve ser registrado: Quem realizou a consulta, quais observações foram feitas e quem finalizou esta consulta.
* Não é necessário criar cadastro para veterinários. Contas de cliente são convertidas manualmente em contas de veterinário através do banco de dados.

### ✅ Entrega

A entrega final deve ser um **repositório do github**, contendo no **README** quaisquer informações que achar relevante passar para a empresa e para quem vai revisar seu código. O repositório precisa ser público.

### ⏳ Tempo

Pedimos para que você trabalhe em torno de 5 horas nesse teste (sem contar qualquer necessidade de pesquisa ou setup), e que complete em até 3 dias, a partir da data que receber este teste. Não gaste todos os dias neste teste. Nós não queremos tomar todo o seu tempo.

Se você achar que o teste está tomando mais tempo do que o sugerido, aqui vão algumas dicas:

### Dicas importantes

* A melhor solução, muitas vezes é a que você já conhece. Foque em resolver os problemas primeiro.
* Não gaste tempo tentando entender todo o código fonte. Recomendamos que teste o sistema, faça um "scan" rápido e em seguida parta para as alterações.
* Planeje alocar um tempo para cada passo do desafio antes de iniciar, e adote uma ideia de "timeboxing". Para explicar, timeboxing é a ideia de você cronometrar suas tarefas, e se uma tarefa estiver tomando mais tempo do que o esperado inicialmente, você começa a focar em outra coisa e evita ficar estagnado em um único trecho do código.
* Priorize suas tarefas, faça o mais importante primeiro e deixe os pontos "legais de se ter" pra caso sobre tempo.
* Commits descritivos e significativos são importantes, mas também queremos ver como você chega lá.
* Lembre-se que esse é um projeto fictício. Ao mesmo tempo que é importante levar em conta situações e problemas reais no seu código, não é necessário gastar tempo com soluções muito complexas.

## 🙋 FAQ

*1. Eu tenho dúvidas sobre a solução, devo fazer deste jeito ou deste outro jeito?*

Parte da avaliação é ver como você lida com uma especificação como esta. Implemente uma solução que atenda ao problema e documente suas decisões no README do seu projeto.

*2. Não estou familiarizado com todas as tecnologias. O que fazer?*

Assumimos que você esteja familiarizado com um projeto Laravel e com JavaScript. Se você não conseguir encontrar a resposta para alguma dúvida técnica no Google, sinta-se à vontade para nos perguntar 😉.

*3. Precisarei de mais tempo, o que fazer?*

Entendemos que imprevistos podem acontecer, e se você precisar de mais um prazo, fale com a gente.

## 💻 Como executar o projeto

Faça o clone do projeto, renomeie o arquivo .env.example para .env, e altere este arquivo com as credenciais do seu banco de dados MySQL local.

Em seguida, execute os seguintes comandos na pasta raíz do projeto:

1. Para instalar as dependências do projeto: 

```
    composer install
```

```
    npm install
```


2. Carregar o arquivo .env no cache:

```
    php artisan config:cache
```

3. Para criar o banco de dados e registros de teste:

```
    php artisan migrate
```
```
    php artisan db:seed
```

4. Para executar o projeto:

```
    php artisan serve
```

5. Em outra aba do terminal, utilize o comando:

```
    npm run watch
```

O comando watch vai assistir a pasta do seu projeto e recarregar automaticamente o navegador em localhost:3000 quando houver alguma alteração, além de compilar os arquivos JavaScript e SCSS para dentro de public.

Após rodar o comando db:seed, você será capaz de fazer o login com o usuário cliente joaodasilva@gmail.com, e com o usuário veterinário mariovet@gmail.com, ambos com senha 123123123.

## 🧠 COMENTARIOS

1. Desafios de Ambiente e Adaptação
No início do projeto, enfrentei dificuldades para configurar o ambiente local devido a dependências de PATH nas variáveis de sistema. Após pesquisas a estrutura do projeto foi devidamente configurada. Como foi meu primeiro contato com esta arquitetura específica em PHP, houve uma curva de aprendizado inicial grande, mas que foi superada através da análise da estrutura de pastas e do fluxo de rotas/controllers(Minha experiencia arterior com esse tipo de arquitetura foi em Java).

2. Gestão de Arquivos e Persistência de Dados
Não consegui salvar a imagem upada dentro do programa, embora o nome do arquivo seja devidamente tratado e salvo no banco de dados (coluna image), a persistência no sistema de arquivos apresentou dificuldades, possivelmente relacionadas a permissões de escrita ou configurações de link simbólico no ambiente Windows.

Recuperação de Código: Durante o desenvolvimento, houve uma inconsistência no arquivo edit-patient.blade.php, que foi prontamente resolvida utilizando controle de versão (Rollback), garantindo a integridade da funcionalidade de edição do paciente.

3. Implementações e Correções
Correção de Bug: Detectei um problema na persistência do campo "Raça" (Breed) na tabela de pacientes. A lógica foi corrigida e validada nos commits seguinte.

Módulo de Agendamento: * Implementei a funcionalidade de agendamento integrando os campos de data e hora da View em um único objeto DateTime no backend para otimização de consultas e ordenação.

Gerenciei a criação da nova tabela appointments via Migrations, garantindo a integridade referencial entre usuários, pets e consultas.

Fluxo do Veterinário: Implementei a listagem dinâmica de consultas e a funcionalidade de conclusão de atendimento, permitindo que o veterinário adicione observações médicas e atualize o status da consulta em tempo real.

Em relação a segurança, alguns momentos me questionei de alguns metodos publicos, mas por não saber totalmente da estrutura do projeto e toda a comunicação interna opitei por não tocar por agora devido ao tempo limitado.

4. Conclusão
O projeto foi um desafio a ser enfrentaod e superado. Foquei em entregar um fluxo funcional e logicamente consistente, apesar de não atingir todos os objetivos(foto do paciente), acredito que foi feito um excelente trabalho com meu nivel de conhecimento na área.