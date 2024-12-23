#include <iostream>
using namespace std;

void tampilkanAngkaGenap(int batas) {
    cout << "Angka genap dari 1 hingga " << batas << " adalah: ";
    for (int i = 2; i <= batas; i += 2) {
        cout << i << " ";
    }
    cout << endl;
}

int main() {
    int batas;

    cout << "Masukkan angka batas: ";
    cin >> batas;

    tampilkanAngkaGenap(batas);

    return 0;
}
