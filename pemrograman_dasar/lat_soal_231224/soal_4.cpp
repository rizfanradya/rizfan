#include <iostream>
using namespace std;

long long faktorial(int n) {
    long long hasil = 1;
    for (int i = 1; i <= n; ++i) {
        hasil *= i;
    }
    return hasil;
}

int main() {
    int num;

    cout << "Masukkan sebuah angka: ";
    cin >> num;

    if (num < 0) {
        cout << "Faktorial hanya dapat dihitung untuk angka non-negatif." << endl;
    } else {
        long long hasil = faktorial(num);
        
        cout << "Faktorial dari " << num << " adalah: " << hasil << endl;
    }

    return 0;
}
