#include <iostream>
#include <cmath>
using namespace std;

int main() {
    double A, B;
    double luas, sisiMiring;

    cout << "Masukkan panjang sisi A: ";
    cin >> A;
    cout << "Masukkan panjang sisi B: ";
    cin >> B;

    luas = 0.5 * A * B;

    sisiMiring = sqrt(pow(A, 2) + pow(B, 2));

    cout << "Luas segitiga siku-siku: " << luas << endl;
    cout << "Panjang sisi miring: " << sisiMiring << endl;

    return 0;
}
