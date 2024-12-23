#include <iostream>
using namespace std;

void tukar(int &a, int &b) {
    int temp = a;
    a = b;
    b = temp;
}

int main() {
    int num1, num2;

    cout << "Masukkan angka pertama: ";
    cin >> num1;
    cout << "Masukkan angka kedua: ";
    cin >> num2;

    cout << "Sebelum ditukar: " << endl;
    cout << "Angka pertama: " << num1 << endl;
    cout << "Angka kedua: " << num2 << endl;

    tukar(num1, num2);

    cout << "Setelah ditukar: " << endl;
    cout << "Angka pertama: " << num1 << endl;
    cout << "Angka kedua: " << num2 << endl;

    return 0;
}
