#include <iostream>
using namespace std;

int main() {
    int num;
    
    cout << "Masukkan angka: ";
    cin >> num;
    
    while (num != -1) {
        if (num % 2 == 0) {
            cout << num << " adalah angka genap." << endl;
        } else {
            cout << num << " adalah angka ganjil." << endl;
        }
        
        cout << "Masukkan angka (atau -1 untuk keluar): ";
        cin >> num;
    }
    
    cout << "Program selesai." << endl;
    
    return 0;
}