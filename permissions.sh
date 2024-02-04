#!/usr/bin/env bash

# Função para verificar e criar diretório, se necessário
check_and_create_dir() {
  local dir=$1
  if [ ! -d "$dir" ]; then
    echo "Diretório $dir não encontrado. Criando..."
    mkdir -p "$dir"
  fi
}

# Verificar e criar diretórios necessários
check_and_create_dir "bootstrap/"
check_and_create_dir "storage/"
check_and_create_dir "storage/logs/"

# Alterando o grupo para www-data e definindo permissões de escrita para o grupo
echo "Alterando o grupo para www-data e definindo permissões de escrita para o grupo"
chgrp -R www-data bootstrap/ storage/ storage/logs/
if [ $? -eq 0 ]; then
  echo "Grupo alterado com sucesso."
else
  echo "Erro ao alterar grupo."
  exit 1
fi

# Definindo permissões de escrita para o grupo
echo "Definindo permissões de escrita para o grupo"
chmod -R g+w bootstrap/ storage/ storage/logs/
if [ $? -eq 0 ]; then
  echo "Permissões definidas com sucesso."
else
  echo "Erro ao definir permissões."
  exit 1
fi

# Definindo o bit setgid em todos os diretórios dentro de bootstrap/, storage/ e storage/logs/
echo "Definindo o bit setgid em todos os diretórios dentro de bootstrap/, storage/ e storage/logs/"
find bootstrap/ storage/ storage/logs/ -type d -exec chmod g+s {} \;
if [ $? -eq 0 ]; then
  echo "Bit setgid definido com sucesso."
else
  echo "Erro ao definir bit setgid."
  exit 1
fi

# Verificar e criar diretório /var/www/html/storage/framework/cache/data/
DIR="/var/www/html/storage/framework/cache/data/"
check_and_create_dir "$DIR"

# Alterando o grupo e definindo permissões no diretório
echo "Alterando o grupo e definindo permissões em $DIR"
chgrp -R www-data $DIR
chmod -R g+w $DIR
echo "Grupo e permissões definidos com sucesso em $DIR"

echo "Permissões e propriedades de grupo atualizadas com sucesso."
