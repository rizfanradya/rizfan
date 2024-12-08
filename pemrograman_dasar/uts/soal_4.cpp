/*
Soal 4
Buatkan program menggunakan c++ untuk menentukan USIA seseorang berdasarkan tahun lahir.
*/

#include <iostream>
#include <ctime>

using namespace std;

int main() {
    int tahunLahir, tahunSekarang, usia;

    time_t t = time(0);
    tm* now = localtime(&t);
    tahunSekarang = now->tm_year + 1900;

    cout << "Masukkan tahun lahir Anda: ";
    cin >> tahunLahir;

    usia = tahunSekarang - tahunLahir;

    if (usia < 0) {
        cout << "Tahun lahir tidak valid!" << endl;
    } else {
        cout << "Usia Anda adalah: " << usia << " tahun." << endl;
    }

    return 0;
}