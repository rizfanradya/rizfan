#include <iostream>
using namespace std;

int main() {
    // int jumlah(int a, int b);
    int pilihan;
    char ulang;

    do {
        cout << "## Daftar Menu Prodi TI ##" << endl;
        cout << "==========================" << endl;
        cout << "1. Jumlah 2 buah bilangan" << endl;
        cout << "2. Tukar Nilai" << endl;
        cout << "3. Tampil Genap" << endl;
        cout << "4. Hitung Usia" << endl;
        cout << "5. Hitung Total Nilai Mahasiswa" << endl;
        cout << endl;

        cout << "Pilihan Anda :";
        cin >> pilihan;

        switch(pilihan){
            case 1:
                int bill1, bill2, hasil;
                cout << "====================" << endl;
                cout << "JUMLAHKAN 2 BUAH BILANGAN" << endl;
                cout << "====================" << endl;
                cout << "Masukkan Bilangan 1" << endl;
                cin >> bill1;
                cout << "Masukkan Bilangan 2" << endl;
                cin >> bill2;
                hasil = bill1 + bill2;
                cout << "Hasil Jumlah Adalah = " << hasil << endl;
                cout << "====================" << endl;
                cout << endl;
                break;
            case 2:
                cout << "TUKAR NILAI" << endl;
                cout << "====================" << endl;
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
    cout << "Terimakasih...";
    cout << endl;
    return 0;
    // int jumlah(int a, int b);
}