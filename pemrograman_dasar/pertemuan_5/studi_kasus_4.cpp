#include <iostream>
#include <cmath>
using namespace std;

int main() {
    double jariJari;
    double keliling, luas;

    cout << "Masukkan jari-jari lingkaran (R): ";
    cin >> jariJari;

    keliling = 2 * M_PI * jariJari;
    luas = M_PI * pow(jariJari, 2);

    cout << "Keliling lingkaran: " << keliling << endl;
    cout << "Luas lingkaran: " << luas << endl;

    return 0;
}
