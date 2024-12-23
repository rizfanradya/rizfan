#include <iostream>
#include <vector>
using namespace std;

vector<int> hitungFaktor(int n) {
    vector<int> faktor;
    
    for (int i = 1; i <= n; ++i) {
        if (n % i == 0) {
            faktor.push_back(i);
        }
    }
    
    return faktor;
}

int main() {
    int num;

    cout << "Masukkan sebuah angka: ";
    cin >> num;

    vector<int> faktor = hitungFaktor(num);

    cout << "Faktor-faktor dari " << num << " adalah: ";
    for (int f : faktor) {
        cout << f << " ";
    }
    cout << endl;

    return 0;
}
