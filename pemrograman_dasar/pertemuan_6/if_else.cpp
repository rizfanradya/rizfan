#include<iostream>
using namespace std;

int main() {
    int total_nilai;

    cout << "Masukkan Total Nilai : ";
    cin >> total_nilai;

    if (total_nilai >= 80){
        cout << "Lulus" << endl;
    } else {
        cout << "Tidak Lulus" << endl;
    }

    return 0;
}