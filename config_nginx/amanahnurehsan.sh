# default_server amanahnurehsan.org
server {
	server_name amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
		try_files $uri $uri/ =404;
	}
}

# default_server tribasuki.net
server {
	server_name tribasuki.net;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
		try_files $uri $uri/ =404;
	}
}

# phpmyadmin
server {
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

# pgadmin
server {
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

# n8n
server {
	server_name n8n.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
        proxy_pass http://localhost:5678/;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-proto $scheme;
        proxy_cache_bypass $http_upgrade;
        proxy_read_timeout 3600;
        proxy_send_timeout 3600;
        client_max_body_size 100M;
  }
}

# hypesindo
# backend hypesindo
server {
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

# music
# backend music
server {
	server_name api-music.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:8007/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
    proxy_read_timeout 1800;
    proxy_connect_timeout 1800;
    proxy_send_timeout 1800;
  }
}
# frontend music
server {
	server_name music.amanahnurehsan.org;
	root /var/www/html;
	index index.html index.htm index.nginx-debian.html;
	location / {
    proxy_pass http://localhost:4180/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-proto $scheme;
    client_max_body_size 100M;
    proxy_read_timeout 1800;
    proxy_connect_timeout 1800;
    proxy_send_timeout 1800;
  }
}