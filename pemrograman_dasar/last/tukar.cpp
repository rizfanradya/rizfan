#include <iostream>
using namespace std;

void tukar()
{
    int num1, num2;
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

    int temp = num1;
    num1 = num2;
    num2 = temp;

    cout << "Setelah ditukar: " << endl;
    cout << "Angka pertama: " << num1 << endl;
    cout << "Angka kedua: " << num2 << endl;
}
