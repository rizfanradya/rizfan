#include <iostream>
using namespace std;

int main() {
    int totalMenit;
    int jam, menit, detik;

    cout << "Masukkan total menit: ";
    cin >> totalMenit;

    jam = totalMenit / 60;
    menit = totalMenit % 60;
    detik = 0;

    cout << totalMenit << " menit sama dengan " << jam << " jam, "
         << menit << " menit, dan " << detik << " detik." << endl;

    return 0;
}
