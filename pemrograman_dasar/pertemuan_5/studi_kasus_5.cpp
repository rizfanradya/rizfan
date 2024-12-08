#include <iostream>
#include <cmath>
using namespace std;

int main() {
    double a, b, c;
    double keliling, luas;

    cout << "Masukkan panjang sisi a: ";
    cin >> a;
    cout << "Masukkan panjang sisi b: ";
    cin >> b;
    cout << "Masukkan panjang sisi c: ";
    cin >> c;

    keliling = a + b + c;

    double s = keliling / 2;

    luas = sqrt(s * (s - a) * (s - b) * (s - c));

    cout << "Keliling segitiga: " << keliling << endl;
    cout << "Luas segitiga: " << luas << endl;

    return 0;
}
