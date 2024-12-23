#include <iostream>
using namespace std;

int tambah(int a, int b) {
    return a + b;
}

int main() {
    int num1, num2;

    cout << "Masukkan angka pertama: ";
    cin >> num1;
    cout << "Masukkan angka kedua: ";
    cin >> num2;

    int hasil = tambah(num1, num2);
    cout << "Hasil penjumlahan: " << hasil << endl;

    return 0;
}
