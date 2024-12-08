#include <iostream>
#include <string>

using namespace std;

int main() {
    string kategori;
    int harga;

    cout << "Masukkan kategori peserta (dosen/mahasiswa/umum): ";
    cin >> kategori;

    if (kategori == "dosen") {
        harga = 50000;
    } else if (kategori == "mahasiswa") {
        harga = 75000;
    } else if (kategori == "umum") {
        harga = 100000;
    } else {
        cout << "Kategori tidak valid." << endl;
        return 1;
    }

    cout << "Harga seminar untuk kategori " << kategori << " adalah: " << harga << endl;

    return 0;
}
