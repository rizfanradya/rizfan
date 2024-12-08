#include<iostream>
using namespace std;

int main() {
    float a, b, c, d, e, f, g;
    int h, i, j;

    cout << "Masukkan nilai A = ";
    cin >> a;
    cout << "Masukkan nilai B = ";
    cin >> b;

    c = a + b;
    d = a - b;
    e = a / b;
    f = a * b;

    cout << "Tambah = " << c << endl;
    cout << "Kurang = " << d << endl;
    cout << "Bagi = " << e << endl;
    cout << "Kali = " << f << endl;

    cout << "Masukkan nilai H = ";
    cin >> h;
    cout << "Masukkan nilai I = ";
    cin >> i;

    j = h % i;
    cout << "Sisa Hasil Bagi atau Modulus = " << j << endl;
}