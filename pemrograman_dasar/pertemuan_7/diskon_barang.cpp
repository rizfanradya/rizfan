#include<iostream>
using namespace std;

int main() {
    int harga_barang = 10000, jumlah_barang, total_beli;
    string keterangan;
    float diskon, total_setelah_diskon;

    cout << "Masukkan jumlah barang yang dibeli : ";
    cin >> jumlah_barang;

    total_beli = harga_barang * jumlah_barang;

    if (total_beli >= 50000 && total_beli <= 100000) {
        keterangan = "DISKON 10%";
        diskon = total_beli * 0.10;
    } else if (total_beli >= 25000 && total_beli <= 49999) {
        keterangan = "DISKON 5%";
        diskon = total_beli * 0.05;
    } else if (total_beli >= 15000 && total_beli <= 24999) {
        keterangan = "DISKON 2%";
        diskon = total_beli * 0.02;
    } else if (total_beli <= 15000) {
        keterangan = "DISKON 1%";
        diskon = total_beli * 0.01;
    } else {
        keterangan = "TIDAK ADA DISKON";
        diskon = 0;
    }

    total_setelah_diskon = total_beli - diskon;

    cout << "====================================" << endl;
    cout << "Total Beli             : " << total_beli << endl;
    cout << "Keterangan             : " << keterangan << endl;
    cout << "Jumlah Diskon          : " << diskon << endl;
    cout << "Total Setelah Diskon   : " << total_setelah_diskon << endl;
    cout << "====================================" << endl;
    
    return 0;
}