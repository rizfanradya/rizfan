#!/bin/bash

# Hapus semua kontainer yang sedang berjalan
containers=$(docker ps -aq)
if [ -n "$containers" ]; then
    echo "Menghapus semua kontainer yang sedang berjalan..."
    docker rm -f $containers
else
    echo "Tidak ada kontainer yang sedang berjalan."
fi

# Hapus semua gambar Docker
images=$(docker images -aq)
if [ -n "$images" ]; then
    echo "Menghapus semua gambar Docker..."
    docker rmi -f $images
else
    echo "Tidak ada gambar Docker yang tersedia."
fi

# Hapus semua volume Docker
volumes=$(docker volume ls -q)
if [ -n "$volumes" ]; then
    echo "Menghapus semua volume Docker..."
    docker volume rm $volumes
else
    echo "Tidak ada volume Docker yang tersedia."
fi

echo "Selesai."
