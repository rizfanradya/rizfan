step by step for deploy

- clone or pull from github
- cmd : "docker-compose down && docker-compose up --build"
- open new terminal
- cmd : "docker exec -it --user root ojs_ojs_1 bash"
- cmd : "apt update && apt install nano -y"
- cmd : "nano config.inc.php"
- edit in config.inc.php
  - edit : base_url = "https://ijaih.com"
  - add : trusted_hosts[] = "ijaih.com"
  - add : trusted_hosts[] = "www.ijaih.com"

# nginx config

server {
server_name ijaih.com www.ijaih.com;
add_header Content-Security-Policy "upgrade-insecure-requests";
location / {
proxy_pass http://localhost:8081/;
proxy_set_header Host $host;
proxy_set_header X-Real-IP $remote_addr;
proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
proxy_set_header X-Forwarded-proto $scheme;
proxy_set_header X-Forwarded-Proto https;
client_max_body_size 100M;
}
}
