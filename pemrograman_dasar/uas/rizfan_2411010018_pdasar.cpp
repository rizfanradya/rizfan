#include <iostream>

using namespace std;

int main()
{
    char ulang;
    int num1, num2, bill1, bill2, hasil, temp, batas, pilihan;
    long long faktorial = 1;
    int jumlah = 0;
    int baris, kolom;
    int **matriks = nullptr;

    do
    {
        cout << "1. Hitung Jumlah 2 Buah Bilang" << endl;
        cout << "2. Menukar Nilai 2 Variabel" << endl;
        cout << "3. Menghitung Faktorial Bilangan" << endl;
        cout << "4. Menampilkan Bilangan Genap" << endl;
        cout << "5. Menampilkan Jumlah Matrik" << endl;
        cout << endl;

        cout << "Pilihan Anda :";
        cin >> pilihan;

        switch (pilihan)
        {
        case 1:
            cout << "====================================================" << endl;
            cout << "JUMLAHKAN 2 BUAH BILANGAN" << endl;
            cout << "====================================================" << endl;

            cout << "Masukkan Bilangan 1: ";
            cin >> bill1;
            cout << "Masukkan Bilangan 2: ";
            cin >> bill2;

            hasil = bill1 + bill2;

            cout << "Hasil Jumlah Adalah = " << hasil << endl;
            break;

        case 2:
            cout << "====================================================" << endl;
            cout << "TUKAR NILAI" << endl;
            cout << "====================================================" << endl;

            cout << "Masukkan angka pertama: ";
            cin >> num1;
            cout << "Masukkan angka kedua: ";
            cin >> num2;
            cout << endl;

            cout << "Sebelum ditukar: " << endl;
            cout << "Angka pertama: " << num1 << endl;
            cout << "Angka kedua: " << num2 << endl;
            cout << endl;

            temp = num1;
            num1 = num2;
            num2 = temp;

            cout << "Setelah ditukar: " << endl;
            cout << "Angka pertama: " << num1 << endl;
            cout << "Angka kedua: " << num2 << endl;
            break;

        case 3:
            cout << "====================================================" << endl;
            cout << "HITUNG FAKTORIAL BILANGAN" << endl;
            cout << "====================================================" << endl;

            cout << "Masukkan sebuah bilangan positif: ";
            cin >> num1;

            if (num1 < 0)
            {
                cout << "Faktorial tidak dapat dihitung untuk bilangan negatif!" << endl;
            }
            else
            {
                faktorial = 1;
                for (int i = 1; i <= num1; i++)
                {
                    faktorial *= i;
                }
                cout << "Faktorial dari " << num1 << " adalah " << faktorial << endl;
            }
            break;

        case 4:
            cout << "====================================================" << endl;
            cout << "TAMPILKAN BILANGAN GENAP" << endl;
            cout << "====================================================" << endl;

            cout << "Masukkan batas angka: ";
            cin >> batas;
            cout << "Bilangan genap dari 1 hingga " << batas << " adalah: " << endl;
            for (int i = 1; i <= batas; i++)
            {
                if (i % 2 == 0)
                {
                    cout << i << " ";
                }
            }
            cout << endl;
            break;

        case 5:
            cout << "====================================================" << endl;
            cout << "MENAMPILKAN JUMLAH MATRIK" << endl;
            cout << "====================================================" << endl;

            cout << "Masukkan jumlah baris matriks: ";
            cin >> baris;
            cout << "Masukkan jumlah kolom matriks: ";
            cin >> kolom;

            matriks = new int*[baris];
            for (int i = 0; i < baris; i++)
            {
                matriks[i] = new int[kolom];
            }

            jumlah = 0;

            cout << "Masukkan elemen-elemen matriks:" << endl;
            for (int i = 0; i < baris; i++)
            {
                for (int j = 0; j < kolom; j++)
                {
                    cout << "Elemen matriks [" << i + 1 << "][" << j + 1 << "]: ";
                    cin >> matriks[i][j];
                    jumlah += matriks[i][j];
                }
            }

            cout << "Matriks yang dimasukkan adalah:" << endl;
            for (int i = 0; i < baris; i++)
            {
                for (int j = 0; j < kolom; j++)
                {
                    cout << matriks[i][j] << " ";
                }
                cout << endl;
            }

            cout << "Jumlah semua elemen dalam matriks adalah: " << jumlah << endl;

            for (int i = 0; i < baris; i++)
            {
                delete[] matriks[i];
            }
            delete[] matriks;

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
