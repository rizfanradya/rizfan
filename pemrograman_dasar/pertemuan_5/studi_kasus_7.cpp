#include <iostream>
#include <cmath>
using namespace std;

int main() {
    double A, B;
    double luasPermukaan, isiTorus;

    cout << "Masukkan jari-jari dalam (A): ";
    cin >> A;
    cout << "Masukkan jari-jari luar (B): ";
    cin >> B;

    luasPermukaan = M_PI * M_PI * (pow(B, 2) - pow(A, 2));

    isiTorus = 0.25 * M_PI * M_PI * (B + A) * pow((B - A), 2);

    cout << "Luas permukaan torus: " << luasPermukaan << endl;
    cout << "Isi torus: " << isiTorus << endl;

    return 0;
}
