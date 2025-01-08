#include <iostream>
#include "menu.cpp"
#include "jumlah.cpp"
#include "tukar.cpp"

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
            tukar();
            break;
        case 3:
            cout << "JUMLAH 2 BUAT MATRIK" << endl;
            cout << "====================" << endl;
            break;
        case 4:
            cout << "KALIKAN 2 BUAT MATRIK" << endl;
            cout << "====================" << endl;
            break;
        case 5:
            cout << "HITUNG FAKTORIAL" << endl;
            cout << "====================" << endl;
            break;
        default:
            cout << "Menu Tidak Tersedia" << endl;
            cout << "====================" << endl;
        }
        cout << endl;
        cout << "Ingin Memilih Menu Lain (y/t)? ";
        cin >> ulang;
        cout << endl;
    } while (ulang != 't');
    cout << "Terimakasih..." << endl;
    return 0;
}
