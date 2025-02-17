# Documentations

https://stackoverflow.com/questions/76649318/task-appcopyreactnativevectoriconfonts-failed

https://docs.expo.dev/build-reference/local-builds/
https://docs.expo.dev/build-reference/apk/

https://askubuntu.com/questions/823288/mongodb-loads-but-breaks-returning-status-14

https://stackoverflow.com/questions/77032040/fetcherror-request-to-https-api-expo-dev-v2-sdks-49-0-0-native-modules-failed

http://myaccount.google.com/apppasswords

https://stackoverflow.com/questions/73387155/swag-the-term-swag-is-not-recognized-as-the-name-of-a-cmdlet-function-scri

https://askubuntu.com/questions/1491578/unable-to-install-mysqlclient-on-ubuntu-22-04-3

https://www.creative-tim.com/product/next-js-tailwind-portfolio-page#

# CMD

- pg_restore -c -U db_user -W -F t -d db_name dump_file.tar
- screen -S name_sesi -d -m run_sesi
- git config user.name rizfanradya && git config user.email rizfankusuma@gmail.com
- find / -name "file.txt"
- source $HOME/.env_virt/bin/activate
- swag init -g cmd/api/main.go -o docs
- php -S 0.0.0.0:3000 -t your_folder/
- docker ps -a && docker volume ls && docker images
- sudo certbot --nginx -d domain.com
- sudo du -ah / | sort -rh | head -n 10
- docker container prune && docker image prune -a && docker network prune && docker volume prune && docker builder prune && docker system df
- zip -r name.zip .
- docker ps --format "table {{.ID}}\t{{.Image}}\t{{.Ports}}" | sort -k3
- docker exec -it nama_container psql -U user_postgres -d postgres -c "SELECT pg_terminate_backend(pg_stat_activity.pid) FROM pg_stat_activity WHERE pg_stat_activity.datname = 'nama_database' AND pid <> pg_backend_pid();"
- docker exec -it nama_container psql -U nama_database -d postgres -c "DROP DATABASE IF EXISTS nama_database;"
- docker exec -it nama_container psql -U nama_database -d postgres -c "CREATE DATABASE nama_database;"
- docker exec -it nama_container psql -U nama_user -d postgres -c "SELECT pg_terminate_backend(pid) FROM pg_stat_activity WHERE datname = 'nama_database';"
- echo "vm.overcommit_memory = 1" | sudo tee -a /etc/sysctl.conf && sudo sysctl -p
- elasticsearch-reset-password -u elastic --url https://localhost:9200

# apache kafka

- cd \program\kafka_2.13-3.9.0 && bin\windows\kafka-server-start.bat config\kraft\server.properties
- java -jar \program\kafka_2.13-3.9.0\kafdrop-4.1.0.jar --kafka.brokerConnect=localhost:9092
