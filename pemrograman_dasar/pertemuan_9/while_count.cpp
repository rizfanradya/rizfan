#include <iostream>
using namespace std;

int main() {
    int sum = 0, num;
    
    cout << "Masukkan angka (0 untuk berhenti): ";
    cin >> num;
    
    while (num != 0) {
        sum += num;
        cout << "Masukkan angka lagi (0 untuk berhenti): ";
        cin >> num;
    }
    
    cout << "Jumlah total: " << sum << endl;
    
    return 0;
}