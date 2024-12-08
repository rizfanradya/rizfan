#include <iostream>
using namespace std;

int main() {
    int nilai;
    string nilaiHuruf;

    cout << "Masukkan nilai (0-100) : ";
    cin >> nilai;

    if (nilai >= 0 && nilai <= 40) {
        nilaiHuruf = "E";
    } else if (nilai >= 41 && nilai <= 60) {
        nilaiHuruf = "C";
    } else if (nilai >= 61 && nilai <= 80) {
        nilaiHuruf = "B";
    } else if (nilai >= 81 && nilai <= 100) {
        nilaiHuruf = "A";
    } else {
        cout << "Nilai tidak valid. Masukkan nilai antara (0 - 100)!";
        return 1;
    }

    cout << nilaiHuruf;
    
    return 0;
    
}