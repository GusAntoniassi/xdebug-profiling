FROM mysql:5.6

# Usamos o comando `tc` pra forçar um delay de 500ms em todas as requisições de rede
# pra simular uma conexão lenta ao BD
ARG SLOW_DB_COMMAND="tc qdisc add dev eth0 root netem delay 500ms"

RUN apt-get update && apt-get install -y iproute2

# Adicionamos o comando que vai deixar lento na segunda linha do script de entrypoint,
# logo após a shebang (#!/bin/bash)
RUN sed -i "s/\/bin\/bash/\/bin\/bash\n${SLOW_DB_COMMAND}/" /usr/local/bin/docker-entrypoint.sh
