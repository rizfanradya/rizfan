/*
Soal 1
Buatkan program menggunakan c++ untuk menentukan total nilai akkhir seorang mahasiswa pada mata kuliah Pemrograman dasar, dengan ketentuan sebagai berikut :

Point penilaian didapat dari 20% nilai UTS, 20% nilai UAS, 20% nilai TUGAS, 20% nilai ETIKA, dan 20% PRESENSI, Nilai ETIKA didapat dari rata - rata nilai tugas dan presensi.
*/

#include <iostream>
#include <iomanip>

using namespace std;

int main() {
    float nilaiUTS, nilaiUAS, nilaiTugas, nilaiPresensi, nilaiEtika, nilaiAkhir;

    cout << "Masukkan nilai UTS: ";
    cin >> nilaiUTS;
    cout << "Masukkan nilai UAS: ";
    cin >> nilaiUAS;
    cout << "Masukkan nilai Tugas: ";
    cin >> nilaiTugas;
    cout << "Masukkan nilai Presensi: ";
    cin >> nilaiPresensi;

    nilaiEtika = (nilaiTugas + nilaiPresensi) / 2;

    nilaiAkhir = (0.2 * nilaiUTS) + (0.2 * nilaiUAS) + (0.2 * nilaiTugas) + (0.2 * nilaiEtika) + (0.2 * nilaiPresensi);

    cout << fixed << setprecision(2);
    cout << "Nilai ETIKA: " << nilaiEtika << endl;
    cout << "Nilai Akhir: " << nilaiAkhir << endl;

    if (nilaiAkhir >= 60) {
        cout << "Selamat, Anda Lulus!" << endl;
    } else {
        cout << "Maaf, Anda Tidak Lulus." << endl;
    }

    return 0;
}