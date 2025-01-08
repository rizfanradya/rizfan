#include <iostream>
#include "func/menu.cpp"
#include "func/jumlah.cpp"
#include "func/tukar_nilai.cpp"
#include "func/tampil_genap.cpp"
#include "func/hitung_usia.cpp"
#include "func/hitung_nilai_mahasiswa.cpp"

using namespace std;

int main()
{
    int pilihan;
    char ulang;

    do
    {
        menu();
        cout << "Pilihan Anda :";
        cin >> pilihan;

        switch (pilihan)
        {
        case 1:
            jumlah();
            break;
        case 2:
            tukar_nilai();
            break;
        case 3:
            tampil_genap();
            break;
        case 4:
            hitung_usia();
            break;
        case 5:
            hitung_nilai_mahasiswa();
            break;
        default:
            cout << "Menu Tidak Tersedia" << endl;
            cout << "===================================" << endl;
        }
        cout << endl;
        cout << "Ingin Memilih Menu Lain (y/t)? ";
        cin >> ulang;
        cout << endl;
    } while (ulang != 't');
    cout << "Terimakasih..." << endl;
    return 0;
}
