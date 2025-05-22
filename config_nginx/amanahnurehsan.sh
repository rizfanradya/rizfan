# amanahnurehsan.org
server {
	listen 80 default_server;
	listen [::]:80 default_server;
	server_name amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
		try_files $uri $uri/ =404;
	}
}

# tribasuki.net
server {
	listen 80;
	listen [::]:80;
	server_name tribasuki.net;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
		try_files $uri $uri/ =404;
	}
}

# database
# mysql phpmyadmin
server {
	listen 80;
	listen [::]:80;
	server_name db-mysql.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8080/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}
# postgresql pgadmin
server {
	listen 80;
	listen [::]:80;
	server_name db-postgresql.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8081/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}

# hypesindo
# backend hypesindo
server {
	listen 80;
	listen [::]:80;
	server_name api-hypesindo.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8000/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}
# frontend hypesindo
server {
	listen 80;
	listen [::]:80;
	server_name hypesindo.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:4173/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}

# surgery
# backend surgery
server {
	listen 80;
	listen [::]:80;
	server_name api-surgery.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8002/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}
# frontend surgery
server {
	listen 80;
	listen [::]:80;
	server_name surgery.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:4175/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}

# koperasi
# backend koperasi
server {
	listen 80;
	listen [::]:80;
	server_name api-koperasi.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8001/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}
# frontend koperasi
server {
	listen 80;
	listen [::]:80;
	server_name koperasi.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:4174/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}

# keuangan
# backend keuangan
server {
	listen 80;
	listen [::]:80;
	server_name api-keuangan.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8003/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}
# frontend keuangan
server {
	listen 80;
	listen [::]:80;
	server_name keuangan.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:4176/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}

# fakehadist
# backend fakehadist
server {
	listen 80;
	listen [::]:80;
	server_name api-fakehadist.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8004/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}
# frontend fakehadist
server {
	listen 80;
	listen [::]:80;
	server_name fakehadist.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:4177/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}

# riverranger
# backend riverranger
server {
	listen 80;
	listen [::]:80;
	server_name api-riverranger.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8005/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}
# frontend riverranger
server {
	listen 80;
	listen [::]:80;
	server_name riverranger.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:4178/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}

# voiceaibot
# backend voiceaibot
server {
	listen 80;
	listen [::]:80;
	server_name api-voiceaibot.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8006/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}
# frontend voiceaibot
server {
	listen 80;
	listen [::]:80;
	server_name voiceaibot.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:4179/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
  }
}