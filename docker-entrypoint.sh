#!/usr/bin/env bash
set -e

# Entrypoint que ajusta permissões em runtime (útil para ambiente local quando usando volumes bind)
# Também executa possíveis commands passados para o container (ex: php artisan migrate)

# Permissões (executado como root se necessário antes de fazer USER www-data em Dockerfile,
# mas aqui o Dockerfile já usa USER www-data. Se o container iniciar com outro user, ajuste.)
if [ "$(id -u)" = '0' ]; then
  # Se for root, ajusta propriedades antes de trocar para www-data
  chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
  chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache || true
fi

# Se foi passado um comando (ex: artisan), executa com o user atual
if [ $# -gt 0 ]; then
  exec "$@"
else
  # Default fallback: inicia o processo padrão (php-fpm) - já setado no CMD
  exec "$@"
fi
