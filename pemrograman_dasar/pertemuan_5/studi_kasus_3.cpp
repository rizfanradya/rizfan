#include <iostream>
using namespace std;

int main() {
    const int hargaSatuan = 800;
    const int hargaSelusin = 9000;
    int totalSapuTangan, jumlahSelusin, sisaSapuTangan, totalBiaya;
    
    cout << "Masukkan total pembelian sapu tangan: ";
    cin >> totalSapuTangan;

    jumlahSelusin = totalSapuTangan / 12;
    sisaSapuTangan = totalSapuTangan % 12;

    totalBiaya = (jumlahSelusin * hargaSelusin) + (sisaSapuTangan * hargaSatuan);

    cout << "Jumlah selusin: " << jumlahSelusin << endl;
    cout << "Sisa sapu tangan: " << sisaSapuTangan << endl;
    cout << "Total bayar: Rp" << totalBiaya << ",-" << endl;

    return 0;
}