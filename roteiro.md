# git

- O Git é um sistema de controle de versões que permite gerenciar diferentes ramificações (branches) dentro de um mesmo projeto.
- Ele passa a funcionar no seu projeto a partir do momento em que você o inicializa como um repositório.
- Você pode criar um repositório remoto em outra máquina para armazenar o código do seu repositório local.
- O GitHub é uma plataforma online que hospeda repositórios remotos em seus servidores.

1- Primeiro você cria uma pasta no xampp/htdocs/ (por exemplo: xampp/htdocs/trabalho/), onde vai ser o projeto
2- agora, você tem que abrir esse pasta que você criou no vscode e abrir o terminal com Ctrl + Shift + C
3- digite esses códigos para criar o repositório:

```bash
# Inicializa o repositório na pasta atual (.)
git init .

# Entra na branch (ramo) principal
git branch -M main

# Adiciona o repositório remoto do projeto
git remote add origin https://github.com/davi-herbes/aps

# Vai baixar o que tem no repositório remoto para o seu computador, agora você pode começar a programar
git pull origin main
```

Toda vez que você quiser adicionar algo no projeto, você tem que fazer isso:

```bash
# Baixar os dados do repositório remoto
git pull origin main

# Adicionar todos os arquivos na nova versão
git add .
git commit -m "Alterando tal coisa"

# Subir as alterações para o repositório remoto
git push origin main

```
