/*
Soal 3
Dari soal nomor 1, buatkan program menggunakan c++ untuk menentukan HURUF MUTU mahasiswa tersebut dengan ketentuan sebagai berikut.

Jika total nilai antara 80-100 maka huruf mutu = "A"
Jika total nilai antara 75-79.99 maka huruf mutu = "A-"
Jika total nilai antara 70-74.99 maka huruf mutu = "B+"
Jika total nilai antara 65-69.99 maka huruf mutu = "B"
Jika total nilai antara 55-64.99 maka huruf mutu = "C"
Jika total nilai antara 30-54.99 maka huruf mutu = "D"
Jika total nilai antara <30 maka huruf mutu = "E"
*/

#include <iostream>
#include <iomanip>

using namespace std;

int main() {
    float nilaiTotal;
    string hurufMutu;

    cout << "Masukkan total nilai mahasiswa: ";
    cin >> nilaiTotal;

    if (nilaiTotal >= 80 && nilaiTotal <= 100) {
        hurufMutu = "A";
    } else if (nilaiTotal >= 75 && nilaiTotal < 80) {
        hurufMutu = "A-";
    } else if (nilaiTotal >= 70 && nilaiTotal < 75) {
        hurufMutu = "B+";
    } else if (nilaiTotal >= 65 && nilaiTotal < 70) {
        hurufMutu = "B";
    } else if (nilaiTotal >= 55 && nilaiTotal < 65) {
        hurufMutu = "C";
    } else if (nilaiTotal >= 30 && nilaiTotal < 55) {
        hurufMutu = "D";
    } else if (nilaiTotal < 30) {
        hurufMutu = "E";
    } else {
        hurufMutu = "Nilai tidak valid";
    }

    cout << "Huruf Mutu: " << hurufMutu << endl;

    return 0;
}