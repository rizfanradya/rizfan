#include<iostream>

using namespace std;

int main() {
    int a = 4;
    int b = 3;
    bool hasil;

    cout << "Nilai A = " << a << endl;
    cout << "Nilai B = " << b << endl;

    hasil = a > b;
    cout << "Apakah A Lebih besar dari B ? " << hasil << endl;

    hasil = a < b;
    cout << "Apakah A Lebih kecil dari B ? " << hasil << endl;

    hasil = a == b;
    cout << "Apakah A sama dengan B ? " << hasil << endl;

    hasil = a != b;
    cout << "Apakah A tidak sama dengan B ? " << hasil << endl;

    hasil = a >= b;
    cout << "Apakah A lebih besar sama dengan B ? " << hasil << endl;

    hasil = a <= b;
    cout << "Apakah A lebih kecil sama dengan B ? " << hasil << endl;
}