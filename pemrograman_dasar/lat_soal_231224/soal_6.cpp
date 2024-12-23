#include <iostream>
using namespace std;

void tambahMatriks(int matriks1[2][2], int matriks2[2][2], int hasil[2][2]) {
    for (int i = 0; i < 2; i++) {
        for (int j = 0; j < 2; j++) {
            hasil[i][j] = matriks1[i][j] + matriks2[i][j];
        }
    }
}

void tampilkanMatriks(int matriks[2][2]) {
    for (int i = 0; i < 2; i++) {
        for (int j = 0; j < 2; j++) {
            cout << matriks[i][j] << " ";
        }
        cout << endl;
    }
}

int main() {
    int matriks1[2][2], matriks2[2][2], hasil[2][2];

    cout << "Masukkan elemen matriks pertama (2x2): " << endl;
    for (int i = 0; i < 2; i++) {
        for (int j = 0; j < 2; j++) {
            cout << "Masukkan elemen matriks1 [" << i + 1 << "][" << j + 1 << "]: ";
            cin >> matriks1[i][j];
        }
    }

    cout << "Masukkan elemen matriks kedua (2x2): " << endl;
    for (int i = 0; i < 2; i++) {
        for (int j = 0; j < 2; j++) {
            cout << "Masukkan elemen matriks2 [" << i + 1 << "][" << j + 1 << "]: ";
            cin >> matriks2[i][j];
        }
    }

    tambahMatriks(matriks1, matriks2, hasil);

    cout << "Hasil penjumlahan kedua matriks adalah: " << endl;
    tampilkanMatriks(hasil);

    return 0;
}
