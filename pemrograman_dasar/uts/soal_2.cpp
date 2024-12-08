/*
Soal 2
Buatkan program menggunakan c++ untuk menentukan satu bilangan yang diinputkan merupakan bilangan bulat satau bilangan pecahan
*/

#include <iostream>
#include <cmath>

using namespace std;

int main() {
    double angka;

    cout << "Masukkan sebuah bilangan: ";
    cin >> angka;

    if (fmod(angka, 1.0) == 0.0) {
        cout << "Bilangan tersebut adalah bilangan bulat." << endl;
    } else {
        cout << "Bilangan tersebut adalah bilangan pecahan." << endl;
    }

    return 0;
}