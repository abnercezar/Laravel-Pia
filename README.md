# Projeto do Bie

Projetinho para igreja

## Requerimentos

Docker
WSL2 (Apenas para windows)

## Passo a Passo

Crie o arquivo de configuração
```
cp .env.example .env
```

Instale as dependencias
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Crie o atalho para o comando do sail
```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

Suba os serviços docker
```
sail up -d
```

Instale as dependencias do node
```
sail npm i
```

Instale a chave de criptografia
```
sail artisan key:generate
```

Reinicie os serviços do docker
```
sail down && sail up -d
```

Rode as migrations
```
sail artisan migrate
```

Faça o build do projeto]
```
sail npm run build:all
```

Suba o serviço do node
```
node bootstrap/ssr/ssr.mjs
```

Acesse o projeto
```
http://localhost
```

## Para desenvolvimento local

Necessário subir o vite
```
sail npm run dev
```